<?php

namespace App\Http\Controllers;

use App\Models\ApiSetting;
use App\Models\ApiLog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ApiSettingController extends Controller
{
    public function index()
    {
        $settings = ApiSetting::first();
        return view('api-settings.index', compact('settings'));
    }

    public function credentials()
    {
        $settings = ApiSetting::first();
        return view('api-settings.credentials', compact('settings'));
    }

    public function logs()
    {
        $logs = ApiLog::latest()->paginate(20);
        return view('api-settings.logs', compact('logs'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'api_url' => 'required|url',
            'api_version' => 'required|string',
            'timeout' => 'required|integer|min:1',
            'retry_attempts' => 'required|integer|min:0',
            'enable_logging' => 'boolean'
        ]);

        $settings = ApiSetting::first();
        if (!$settings) {
            $settings = new ApiSetting();
        }

        $settings->fill($validated);
        $settings->save();

        return redirect()->route('api-settings.index')
            ->with('success', 'API ayarları başarıyla güncellendi.');
    }

    public function generateKey()
    {
        $settings = ApiSetting::first();
        if (!$settings) {
            $settings = new ApiSetting();
        }

        $settings->api_key = Str::random(64);
        $settings->save();

        return redirect()->route('api-settings.credentials')
            ->with('success', 'Yeni API anahtarı başarıyla oluşturuldu.');
    }
} 