<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscriber;
use App\Models\Device;
use App\Models\Phone;
use App\Models\SimCard;
use App\Models\Invoice;
use Carbon\Carbon;
use App\Models\Abonelik;

class ReportController extends Controller
{
    public function subscribers()
    {
        $totalSubscribers = Abonelik::count();
        $activeSubscribers = Abonelik::where('aktif', true)->count();
        $newSubscribersThisMonth = Abonelik::whereMonth('created_at', Carbon::now()->month)->count();
        
        $subscribersByStatus = Abonelik::selectRaw('aktif, count(*) as count')
            ->groupBy('aktif')
            ->get();

        $monthlySubscribers = Abonelik::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return view('admin.reports.subscribers', compact(
            'totalSubscribers',
            'activeSubscribers',
            'newSubscribersThisMonth',
            'subscribersByStatus',
            'monthlySubscribers'
        ));
    }

    public function stock()
    {
        $totalDevices = Device::count();
        $availableDevices = Device::where('durum', 'aktif')->count();
        
        $totalPhones = Phone::count();
        $availablePhones = Phone::where('durum', 'aktif')->count();
        
        $totalSimCards = SimCard::count();
        $availableSimCards = SimCard::where('durum', 'aktif')->count();

        $stockByType = [
            'devices' => [
                'total' => $totalDevices,
                'available' => $availableDevices
            ],
            'phones' => [
                'total' => $totalPhones,
                'available' => $availablePhones
            ],
            'sim_cards' => [
                'total' => $totalSimCards,
                'available' => $availableSimCards
            ]
        ];

        return view('admin.reports.stock', compact('stockByType'));
    }

    public function financial()
    {
        $totalInvoices = Invoice::count();
        $paidInvoices = Invoice::where('status', 'paid')->count();
        $unpaidInvoices = Invoice::where('status', 'unpaid')->count();
        
        $totalRevenue = Invoice::where('status', 'paid')->sum('amount');
        $pendingRevenue = Invoice::where('status', 'unpaid')->sum('amount');
        
        $monthlyRevenue = Invoice::where('status', 'paid')
            ->whereYear('created_at', Carbon::now()->year)
            ->selectRaw('MONTH(created_at) as month, SUM(amount) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return view('admin.reports.financial', compact(
            'totalInvoices',
            'paidInvoices',
            'unpaidInvoices',
            'totalRevenue',
            'pendingRevenue',
            'monthlyRevenue'
        ));
    }
} 