<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::paginate(10);
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        return view('roles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:roles',
            'description' => 'nullable|string',
            'permissions' => 'required|array'
        ]);

        $role = Role::create($validated);
        $role->permissions()->sync($request->permissions);

        return redirect()->route('roles.index')
            ->with('success', 'Rol başarıyla oluşturuldu.');
    }

    public function show(Role $role)
    {
        return view('roles.show', compact('role'));
    }

    public function edit(Role $role)
    {
        return view('roles.edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
            'description' => 'nullable|string',
            'permissions' => 'required|array'
        ]);

        $role->update($validated);
        $role->permissions()->sync($request->permissions);

        return redirect()->route('roles.index')
            ->with('success', 'Rol başarıyla güncellendi.');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')
            ->with('success', 'Rol başarıyla silindi.');
    }
} 