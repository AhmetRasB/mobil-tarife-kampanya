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
            $totalTarifeler = Tarife::count();
            $totalKampanyalar = Kampanya::count();
            $totalAbonelikler = Abonelik::count();
            $bekleyenTeklifler = Teklif::where('durum', 'beklemede')->count();
            
            return view('admin.dashboard', compact('totalTarifeler', 'totalKampanyalar', 'totalAbonelikler', 'bekleyenTeklifler'));
        } else {
            // Regular user dashboard - direkt tarifeleri ve kampanyaları gösterelim
            $tarifeler = Tarife::where('aktif', true)->get();
            $kampanyalar = Kampanya::where('aktif', true)->get();
            
            return view('user.dashboard', compact('tarifeler', 'kampanyalar'));
        }
    }
}
