<?php

namespace App\Http\Controllers;

use App\Models\SmsLog;
use App\Models\SimCard;
use Illuminate\Http\Request;

class SmsLogController extends Controller
{
    public function index()
    {
        $smsLogs = SmsLog::with('simCard')->latest()->paginate(10);
        return view('sms-logs.index', compact('smsLogs'));
    }

    public function create()
    {
        $simCards = SimCard::where('durum', 'aktif')->get();
        return view('sms-logs.create', compact('simCards'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sim_kart_id' => 'required|exists:sim_cards,id',
            'alici' => 'required|string|max:20',
            'mesaj' => 'required|string',
            'tarih' => 'required|date',
            'durum' => 'required|string|in:gonderildi,basarisiz'
        ]);

        SmsLog::create($validated);

        return redirect()->route('sms-logs.index')
            ->with('success', 'SMS kaydı başarıyla oluşturuldu.');
    }

    public function show(SmsLog $smsLog)
    {
        $smsLog->load('simCard');
        return view('sms-logs.show', compact('smsLog'));
    }

    public function edit(SmsLog $smsLog)
    {
        $simCards = SimCard::where('durum', 'aktif')->get();
        return view('sms-logs.edit', compact('smsLog', 'simCards'));
    }

    public function update(Request $request, SmsLog $smsLog)
    {
        $validated = $request->validate([
            'sim_kart_id' => 'required|exists:sim_cards,id',
            'alici' => 'required|string|max:20',
            'mesaj' => 'required|string',
            'tarih' => 'required|date',
            'durum' => 'required|string|in:gonderildi,basarisiz'
        ]);

        $smsLog->update($validated);

        return redirect()->route('sms-logs.index')
            ->with('success', 'SMS kaydı başarıyla güncellendi.');
    }

    public function destroy(SmsLog $smsLog)
    {
        $smsLog->delete();

        return redirect()->route('sms-logs.index')
            ->with('success', 'SMS kaydı başarıyla silindi.');
    }
} 