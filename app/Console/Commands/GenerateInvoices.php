<?php

namespace App\Console\Commands;

use App\Models\Abonelik;
use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Console\Command;

class GenerateInvoices extends Command
{
    protected $signature = 'invoices:generate';
    protected $description = 'Generate invoices for all active subscribers';

    public function handle()
    {
        $this->info('Generating invoices for active subscribers...');

        $activeSubscriptions = Abonelik::with(['tarife', 'kampanya'])
            ->where('aktif', true)
            ->get();

        $count = 0;
        foreach ($activeSubscriptions as $subscription) {
            // Skip if subscription doesn't have a tariff
            if (!$subscription->tarife) {
                $this->warn("Subscription #{$subscription->id} has no tariff assigned. Skipping...");
                continue;
            }

            // Calculate base amount from tariff
            $baseAmount = $subscription->tarife->fiyat;

            // Apply campaign discount if exists and is active
            $finalAmount = $baseAmount;
            if ($subscription->kampanya && $subscription->kampanya->aktif) {
                $discount = $baseAmount * ($subscription->kampanya->indirim_orani / 100);
                $finalAmount = $baseAmount - $discount;
            }

            // Create invoice
            Invoice::create([
                'abonelik_id' => $subscription->id,
                'amount' => $finalAmount,
                'invoice_date' => Carbon::now(),
                'due_date' => Carbon::now()->addDays(7), // Due in 7 days
                'status' => Invoice::STATUS_UNPAID,
                'billing_period' => Carbon::now()->format('Y-m'),
                'description' => sprintf(
                    '%s tarifesi için %s dönemi faturası%s',
                    $subscription->tarife->ad,
                    Carbon::now()->format('F Y'),
                    $subscription->kampanya ? " ({$subscription->kampanya->ad} kampanyası uygulandı)" : ''
                )
            ]);

            $count++;
        }

        $this->info("Successfully generated {$count} invoices.");
    }
} 