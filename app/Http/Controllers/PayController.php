<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class PayController extends Controller
{
    public function index()
    {
        $invoices = Invoice::where('subscriber_id', auth()->user()->subscriber->id)->get();
        return view('pay.index', compact('invoices'));
    }

    public function pay(Invoice $invoice)
    {
        if ($invoice->status === 'unpaid') {
            $invoice->update(['status' => 'paid']);
            // Here you can add logic to record payment details if needed
        }
        return redirect()->route('pay.index')->with('success', 'Invoice paid successfully.');
    }
} 