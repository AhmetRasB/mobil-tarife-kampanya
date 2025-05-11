<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarife;
use App\Models\Kampanya;
use App\Models\Abonelik;
use App\Models\Teklif;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        
        if ($user->is_admin) {
            // Admin dashboard
            $totalUsers = \App\Models\User::count();
            $totalTarifeler = Tarife::count();
            $totalKampanyalar = Kampanya::count();
            $totalAbonelikler = Abonelik::count();
            $bekleyenTeklifler = Teklif::where('durum', 'beklemede')->count();
            
            // Son 5 yeni kullanıcı
            $recentUsers = \App\Models\User::orderBy('created_at', 'desc')->take(5)->get();
            
            // Son 30 gün için günlük yeni kullanıcı grafiği
            $userStats = \App\Models\User::selectRaw('DATE(created_at) as date, COUNT(*) as count')
                ->where('created_at', '>=', now()->subDays(30))
                ->groupBy('date')
                ->orderBy('date')
                ->get();
            
            return view('admin.dashboard', compact('totalUsers', 'totalTarifeler', 'totalKampanyalar', 'totalAbonelikler', 'bekleyenTeklifler', 'recentUsers', 'userStats'));
        } else {
            // Regular user dashboard - direkt tarifeleri ve kampanyaları gösterelim
            $tarifeler = Tarife::where('aktif', true)->get();
            $kampanyalar = Kampanya::where('aktif', true)->get();
            
            return view('user.dashboard', compact('tarifeler', 'kampanyalar'));
        }
    }
}
