<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceAdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Invoice::with(['abonelik.tarife', 'abonelik.kampanya']);

        // Filter by status if provided
        if ($request->has('status') && in_array($request->status, [
            Invoice::STATUS_PAID,
            Invoice::STATUS_UNPAID,
            Invoice::STATUS_SUSPENDED
        ])) {
            $query->where('status', $request->status);
        }

        // Order by due date
        $query->orderBy('due_date', 'desc');

        $invoices = $query->paginate(15);

        return view('admin.invoices.index', compact('invoices'));
    }

    public function show(Invoice $invoice)
    {
        return view('admin.invoices.show', compact('invoice'));
    }

    public function markPaid(Invoice $invoice)
    {
        if ($invoice->status !== Invoice::STATUS_UNPAID) {
            return redirect()->route('admin.invoices.index')
                ->with('error', 'Sadece bekleyen faturalar ödenmiş olarak işaretlenebilir.');
        }

        $invoice->update(['status' => Invoice::STATUS_PAID]);
        
        return redirect()->route('admin.invoices.index')
            ->with('success', 'Fatura başarıyla ödenmiş olarak işaretlendi.');
    }

    public function suspend(Invoice $invoice)
    {
        if ($invoice->status !== Invoice::STATUS_UNPAID) {
            return redirect()->route('admin.invoices.index')
                ->with('error', 'Sadece bekleyen faturalar askıya alınabilir.');
        }

        $invoice->update(['status' => Invoice::STATUS_SUSPENDED]);
        
        return redirect()->route('admin.invoices.index')
            ->with('success', 'Fatura başarıyla askıya alındı.');
    }
} 