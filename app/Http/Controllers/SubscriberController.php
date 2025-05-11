<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function index()
    {
        $subscribers = Subscriber::latest()->paginate(10);
        return view('subscribers.index', compact('subscribers'));
    }

    public function create()
    {
        return view('subscribers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'ad' => 'required|string|max:255',
            'soyad' => 'required|string|max:255',
            'tc_no' => 'required|string|unique:subscribers',
            'telefon' => 'required|string|max:20',
            'eposta' => 'required|email|max:255',
            'adres' => 'required|string',
        ]);

        Subscriber::create($validated);

        return redirect()->route('subscribers.index')
            ->with('success', 'Abone başarıyla oluşturuldu.');
    }

    public function show(Subscriber $subscriber)
    {
        return view('subscribers.show', compact('subscriber'));
    }

    public function edit(Subscriber $subscriber)
    {
        return view('subscribers.edit', compact('subscriber'));
    }

    public function update(Request $request, Subscriber $subscriber)
    {
        $validated = $request->validate([
            'ad' => 'required|string|max:255',
            'soyad' => 'required|string|max:255',
            'tc_no' => 'required|string|unique:subscribers,tc_no,' . $subscriber->id,
            'telefon' => 'required|string|max:20',
            'eposta' => 'required|email|max:255',
            'adres' => 'required|string',
        ]);

        $subscriber->update($validated);

        return redirect()->route('subscribers.index')
            ->with('success', 'Abone başarıyla güncellendi.');
    }

    public function destroy(Subscriber $subscriber)
    {
        $subscriber->delete();

        return redirect()->route('subscribers.index')
            ->with('success', 'Abone başarıyla silindi.');
    }
} 