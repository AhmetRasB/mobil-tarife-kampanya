<?php

namespace App\Services;

use App\Models\Abonelik;
use App\Models\Invoice;
use Carbon\Carbon;

class InvoiceService
{
    public function generateMonthlyInvoice(Abonelik $abonelik, $period = null)
    {
        $now = Carbon::now();
        $billingPeriod = $period ?? $now->format('Y-m');
        $invoiceDate = Carbon::createFromFormat('Y-m', $billingPeriod)->startOfMonth();
        $dueDate = $invoiceDate->copy()->addDays(7);

        // Check if invoice already exists for this billing period
        $existingInvoice = Invoice::where('abonelik_id', $abonelik->id)
            ->where('billing_period', $billingPeriod)
            ->first();

        if ($existingInvoice) {
            return $existingInvoice;
        }

        // Calculate amount with campaign discount if any
        $baseAmount = $abonelik->tarife->fiyat;
        $finalAmount = $baseAmount;
        if ($abonelik->kampanya && $abonelik->kampanya->aktif) {
            $discount = $baseAmount * ($abonelik->kampanya->indirim_orani / 100);
            $finalAmount = $baseAmount - $discount;
        }

        // Create new invoice
        return Invoice::create([
            'user_id' => $abonelik->user_id,
            'abonelik_id' => $abonelik->id,
            'amount' => $finalAmount,
            'invoice_date' => $invoiceDate,
            'due_date' => $dueDate,
            'billing_period' => $billingPeriod,
            'description' => "{$abonelik->tarife->ad} için {$invoiceDate->format('F Y')} dönemi faturası",
            'status' => 'unpaid'
        ]);
    }

    public function generateInvoicesForActiveSubscriptions()
    {
        $activeSubscriptions = Abonelik::where('aktif', true)
            ->where(function($q) {
                $q->whereNull('bitis_tarihi')->orWhere('bitis_tarihi', '>', now());
            })
            ->get();

        foreach ($activeSubscriptions as $subscription) {
            $start = Carbon::parse($subscription->baslangic_tarihi)->startOfMonth();
            $end = Carbon::now()->startOfMonth();
            while ($start <= $end) {
                $period = $start->format('Y-m');
                $this->generateMonthlyInvoice($subscription, $period);
                $start->addMonth();
            }
        }
    }
} 