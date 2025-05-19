<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index()
    {
        $subscriptions = Subscription::with('subscriber')->latest()->paginate(10);
        return view('subscriptions.index', compact('subscriptions'));
    }

    public function create()
    {
        $subscribers = Subscriber::where('aktif_mi', true)->get();
        return view('subscriptions.create', compact('subscribers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'abone_id' => 'required|exists:subscribers,id',
            'tarife_adi' => 'required|string|max:255',
            'aylik_ucret' => 'required|numeric|min:0',
            'baslangic_tarihi' => 'required|date',
            'bitis_tarihi' => 'nullable|date|after:baslangic_tarihi',
            'aktif_mi' => 'boolean'
        ]);

        Subscription::create($validated);

        return redirect()->route('admin.abonelikler.index')
            ->with('success', 'Abonelik başarıyla kaydedildi.');
    }

    public function show(Subscription $subscription)
    {
        $subscription->load('subscriber');
        return view('subscriptions.show', compact('subscription'));
    }

    public function edit(Subscription $subscription)
    {
        $subscribers = Subscriber::where('aktif_mi', true)->get();
        return view('subscriptions.edit', compact('subscription', 'subscribers'));
    }

    public function update(Request $request, Subscription $subscription)
    {
        $validated = $request->validate([
            'abone_id' => 'required|exists:subscribers,id',
            'tarife_adi' => 'required|string|max:255',
            'aylik_ucret' => 'required|numeric|min:0',
            'baslangic_tarihi' => 'required|date',
            'bitis_tarihi' => 'nullable|date|after:baslangic_tarihi',
            'aktif_mi' => 'boolean'
        ]);

        $subscription->update($validated);

        return redirect()->route('admin.abonelikler.index')
            ->with('success', 'Abonelik başarıyla güncellendi.');
    }

    public function destroy(Subscription $subscription)
    {
        $subscription->delete();

        return redirect()->route('admin.abonelikler.index')
            ->with('success', 'Abonelik başarıyla silindi.');
    }
} 