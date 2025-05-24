<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function index()
    {
        $devices = Device::with('subscriber')->latest()->paginate(10);
        return view('devices.index', compact('devices'));
    }

    public function create()
    {
        $subscribers = Subscriber::where('aktif_mi', true)->get();
        return view('devices.create', compact('subscribers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'ad' => 'required|string|max:255',
            'marka' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'seri_no' => 'required|string|unique:devices',
            'satis_tarihi' => 'required|date',
            'fiyat' => 'required|numeric|min:0',
            'durum' => 'required|string|in:aktif,pasif,arizali',
            'abone_id' => 'nullable|exists:subscribers,id'
        ]);

        Device::create($validated);

        return redirect()->route('admin.devices.index')
            ->with('success', 'Cihaz başarıyla kaydedildi.');
    }

    public function show(Device $device)
    {
        $device->load('subscriber');
        return view('devices.show', compact('device'));
    }

    public function edit(Device $device)
    {
        $subscribers = Subscriber::where('aktif_mi', true)->get();
        return view('devices.edit', compact('device', 'subscribers'));
    }

    public function update(Request $request, Device $device)
    {
        $validated = $request->validate([
            'ad' => 'required|string|max:255',
            'marka' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'seri_no' => 'required|string|unique:devices,seri_no,' . $device->id,
            'satis_tarihi' => 'required|date',
            'fiyat' => 'required|numeric|min:0',
            'durum' => 'required|string|in:aktif,pasif,arizali',
            'abone_id' => 'nullable|exists:subscribers,id'
        ]);

        $device->update($validated);

        return redirect()->route('admin.devices.index')
            ->with('success', 'Cihaz başarıyla güncellendi.');
    }

    public function destroy(Device $device)
    {
        $device->delete();

        return redirect()->route('admin.devices.index')
            ->with('success', 'Cihaz başarıyla silindi.');
    }
} 