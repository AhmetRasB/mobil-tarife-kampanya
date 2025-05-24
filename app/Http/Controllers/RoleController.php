<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        $users = User::all();
        return view('admin.roles.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Check if the role already exists
        $role = Role::where('name', $request->name)->first();
        if (!$role) {
            $role = Role::create([
                'name' => $request->name,
            ]);
        }

        // If users are selected and the role is Admin, assign the role to those users
        if ($request->name === 'Admin' && $request->has('user_ids')) {
            $userIds = $request->input('user_ids');
            foreach (User::whereIn('id', $userIds)->get() as $user) {
                $user->is_admin = 1;
                $user->save();
            }
        }

        return redirect()->route('admin.roles.index')
            ->with('success', 'Rol ve kullanıcı atamaları başarıyla güncellendi.');
    }

    public function show(Role $role)
    {
        $role->load(['permissions', 'users']);
        return view('admin.roles.show', compact('role'));
    }

    public function edit(Role $role)
    {
        return view('admin.roles.edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
        ]);

        $role->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.roles.index')
            ->with('success', 'Rol başarıyla güncellendi.');
    }

    public function destroy(Role $role)
    {
        // If deleting the Admin role, remove admin status from all users
        if ($role->name === 'Admin') {
            \App\Models\User::where('is_admin', 1)->update(['is_admin' => 0]);
        }

        if ($role->users()->count() > 0) {
            return redirect()->route('admin.roles.index')
                ->with('error', 'Bu role sahip kullanıcılar var. Önce kullanıcıları başka bir role atayın.');
        }

        $role->delete();
        return redirect()->route('admin.roles.index')
            ->with('success', 'Rol başarıyla silindi ve admin yetkileri kaldırıldı.');
    }

    public function removeAdmin(User $user)
    {
        $user->is_admin = 0;
        $user->save();
        return redirect()->route('admin.roles.index')->with('success', $user->name . ' artık admin değil.');
    }
} 