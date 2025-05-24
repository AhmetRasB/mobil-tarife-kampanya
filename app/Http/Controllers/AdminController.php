<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kampanya;
use App\Models\User;
use App\Models\Tarife;
use App\Models\Abonelik;
use App\Models\Invoice;
use App\Models\Subscriber;
use App\Models\Phone;
use App\Models\SimCard;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Get total counts
        $totalUsers = User::count();
        $totalKampanyalar = Kampanya::count();
        $totalTarifeler = Tarife::count();
        $totalAbonelikler = Abonelik::count();

        // Get invoice statistics
        $totalInvoices = Invoice::count();
        $paidInvoices = Invoice::where('status', 'paid')->count();
        $unpaidInvoices = Invoice::where('status', 'unpaid')->count();
        $suspendedInvoices = Invoice::where('status', 'suspended')->count();

        // Get recent users
        $recentUsers = User::latest()->take(5)->get();

        // Get user statistics for the last 30 days
        $userStats = User::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Get recent invoices
        $recentInvoices = Invoice::with('subscriber')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalKampanyalar',
            'totalTarifeler',
            'totalAbonelikler',
            'totalInvoices',
            'paidInvoices',
            'unpaidInvoices',
            'suspendedInvoices',
            'recentUsers',
            'userStats',
            'recentInvoices'
        ));
    }

    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }
}
