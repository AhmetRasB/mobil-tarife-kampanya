<?php

namespace App\Http\Controllers;

use App\Models\SimCard;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class SimCardController extends Controller
{
    public function index()
    {
        $simCards = SimCard::with('subscriber')->latest()->paginate(10);
        return view('sim-cards.index', compact('simCards'));
    }

    public function create()
    {
        $subscribers = Subscriber::where('aktif_mi', true)->get();
        return view('sim-cards.create', compact('subscribers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'numara' => 'required|string|unique:sim_cards',
            'puk' => 'required|string|max:255',
            'pin' => 'required|string|max:255',
            'aktivasyon_tarihi' => 'required|date',
            'durum' => 'required|string|in:aktif,pasif,bloke',
            'abone_id' => 'nullable|exists:subscribers,id'
        ]);

        SimCard::create($validated);

        return redirect()->route('admin.sim-cards.index')
            ->with('success', 'SIM Kart başarıyla kaydedildi.');
    }

    public function show(SimCard $simCard)
    {
        $simCard->load('subscriber', 'callLogs', 'smsLogs');
        return view('sim-cards.show', compact('simCard'));
    }

    public function edit(SimCard $simCard)
    {
        $subscribers = Subscriber::where('aktif_mi', true)->get();
        return view('sim-cards.edit', compact('simCard', 'subscribers'));
    }

    public function update(Request $request, SimCard $simCard)
    {
        $validated = $request->validate([
            'numara' => 'required|string|unique:sim_cards,numara,' . $simCard->id,
            'puk' => 'required|string|max:255',
            'pin' => 'required|string|max:255',
            'aktivasyon_tarihi' => 'required|date',
            'durum' => 'required|string|in:aktif,pasif,bloke',
            'abone_id' => 'nullable|exists:subscribers,id'
        ]);

        $simCard->update($validated);

        return redirect()->route('admin.sim-cards.index')
            ->with('success', 'SIM Kart başarıyla güncellendi.');
    }

    public function destroy(SimCard $simCard)
    {
        $simCard->delete();

        return redirect()->route('admin.sim-cards.index')
            ->with('success', 'SIM Kart başarıyla silindi.');
    }
} 