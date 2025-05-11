<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kampanya;
use App\Models\User;
use App\Models\Tarife;
use App\Models\Abonelik;

class AdminController extends Controller
{
    public function kampanyalar()
    {
        // Kampanyaları listeleme işlemi
        $kampanyalar = Kampanya::all();
        return view('admin.kampanyalar', compact('kampanyalar'));
    }

    public function kampanyaEkle(Request $request)
    {
        // Kampanya ekleme işlemi
        $request->validate([
            'ad' => 'required|string|max:255',
            'aciklama' => 'nullable|string',
        ]);

        Kampanya::create($request->all());
        return redirect()->route('admin.kampanyalar')->with('success', 'Kampanya başarıyla eklendi.');
    }

    public function kampanyaDuzenle(Request $request, $id)
    {
        // Kampanya düzenleme işlemi
        $kampanya = Kampanya::findOrFail($id);

        $request->validate([
            'ad' => 'required|string|max:255',
            'aciklama' => 'nullable|string',
        ]);

        $kampanya->update($request->all());
        return redirect()->route('admin.kampanyalar')->with('success', 'Kampanya başarıyla güncellendi.');
    }

    public function kampanyaSil($id)
    {
        // Kampanya silme işlemi
        $kampanya = Kampanya::findOrFail($id);
        $kampanya->delete();
        return redirect()->route('admin.kampanyalar')->with('success', 'Kampanya başarıyla silindi.');
    }

    public function dashboard()
    {
        $totalUsers = User::count();
        $totalKampanyalar = \App\Models\Kampanya::count();
        $totalTarifeler = Tarife::count();
        $totalAbonelikler = Abonelik::count();

        // Son 5 yeni kullanıcı
        $recentUsers = User::orderBy('created_at', 'desc')->take(5)->get();

        // Son 30 gün için günlük yeni kullanıcı grafiği
        $userStats = User::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalKampanyalar',
            'totalTarifeler',
            'totalAbonelikler',
            'recentUsers',
            'userStats'
        ));
    }
}
