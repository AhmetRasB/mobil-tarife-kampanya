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

            // Invoice statistics
            $totalInvoices = \App\Models\Invoice::count();
            $paidInvoices = \App\Models\Invoice::where('status', 'paid')->count();
            $unpaidInvoices = \App\Models\Invoice::where('status', 'unpaid')->count();
            $suspendedInvoices = \App\Models\Invoice::where('status', 'suspended')->count();

            // Son 5 yeni kullanıcı
            $recentUsers = \App\Models\User::orderBy('created_at', 'desc')->take(5)->get();

            // Son 30 gün için günlük yeni kullanıcı grafiği
            $userStats = \App\Models\User::selectRaw('DATE(created_at) as date, COUNT(*) as count')
                ->where('created_at', '>=', now()->subDays(30))
                ->groupBy('date')
                ->orderBy('date')
                ->get();

            // Son 5 fatura
            $recentInvoices = \App\Models\Invoice::with('subscriber')
                ->latest()
                ->take(5)
                ->get();

            return view('admin.dashboard', compact(
                'totalUsers',
                'totalTarifeler',
                'totalKampanyalar',
                'totalAbonelikler',
                'totalInvoices',
                'paidInvoices',
                'unpaidInvoices',
                'suspendedInvoices',
                'recentUsers',
                'userStats',
                'recentInvoices'
            ));
        } else {
            // Regular user dashboard - direkt tarifeleri ve kampanyaları gösterelim
            $tarifeler = Tarife::where('aktif', true)->get();
            $kampanyalar = Kampanya::where('aktif', true)->get();
            
            return view('user.dashboard', compact('tarifeler', 'kampanyalar'));
        }
    }
}
