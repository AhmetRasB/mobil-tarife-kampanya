<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class PhoneController extends Controller
{
    public function index()
    {
        $phones = Phone::with('subscriber')->latest()->paginate(10);
        return view('phones.index', compact('phones'));
    }

    public function create()
    {
        $subscribers = Subscriber::where('aktif_mi', true)->get();
        return view('phones.create', compact('subscribers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'marka' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'imei' => 'required|string|unique:phones',
            'seri_no' => 'required|string|max:255',
            'satis_tarihi' => 'required|date',
            'fiyat' => 'required|numeric|min:0',
            'durum' => 'required|string|in:aktif,pasif,arizali',
            'abone_id' => 'nullable|exists:subscribers,id'
        ]);

        Phone::create($validated);

        return redirect()->route('phones.index')
            ->with('success', 'Telefon başarıyla kaydedildi.');
    }

    public function show(Phone $phone)
    {
        $phone->load('subscriber', 'callLogs');
        return view('phones.show', compact('phone'));
    }

    public function edit(Phone $phone)
    {
        $subscribers = Subscriber::where('aktif_mi', true)->get();
        return view('phones.edit', compact('phone', 'subscribers'));
    }

    public function update(Request $request, Phone $phone)
    {
        $validated = $request->validate([
            'marka' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'imei' => 'required|string|unique:phones,imei,' . $phone->id,
            'seri_no' => 'required|string|max:255',
            'satis_tarihi' => 'required|date',
            'fiyat' => 'required|numeric|min:0',
            'durum' => 'required|string|in:aktif,pasif,arizali',
            'abone_id' => 'nullable|exists:subscribers,id'
        ]);

        $phone->update($validated);

        return redirect()->route('phones.index')
            ->with('success', 'Telefon başarıyla güncellendi.');
    }

    public function destroy(Phone $phone)
    {
        $phone->delete();

        return redirect()->route('phones.index')
            ->with('success', 'Telefon başarıyla silindi.');
    }
} 