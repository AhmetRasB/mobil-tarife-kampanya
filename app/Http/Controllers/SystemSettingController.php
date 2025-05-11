<?php

namespace App\Http\Controllers;

use App\Models\SystemSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class SystemSettingController extends Controller
{
    public function general()
    {
        $settings = SystemSetting::first();
        return view('system-settings.general', compact('settings'));
    }

    public function notifications()
    {
        $settings = SystemSetting::first();
        return view('system-settings.notifications', compact('settings'));
    }

    public function backup()
    {
        $backups = Storage::disk('backups')->files();
        return view('system-settings.backup', compact('backups'));
    }

    public function updateGeneral(Request $request)
    {
        $validated = $request->validate([
            'site_name' => 'required|string|max:255',
            'site_description' => 'nullable|string',
            'maintenance_mode' => 'boolean',
            'timezone' => 'required|string',
            'date_format' => 'required|string',
            'time_format' => 'required|string'
        ]);

        $settings = SystemSetting::first();
        if (!$settings) {
            $settings = new SystemSetting();
        }

        $settings->fill($validated);
        $settings->save();

        return redirect()->route('system-settings.general')
            ->with('success', 'Genel ayarlar başarıyla güncellendi.');
    }

    public function updateNotifications(Request $request)
    {
        $validated = $request->validate([
            'enable_email_notifications' => 'boolean',
            'enable_sms_notifications' => 'boolean',
            'notification_email' => 'required|email',
            'sms_provider' => 'required|string',
            'notification_events' => 'required|array'
        ]);

        $settings = SystemSetting::first();
        if (!$settings) {
            $settings = new SystemSetting();
        }

        $settings->fill($validated);
        $settings->save();

        return redirect()->route('system-settings.notifications')
            ->with('success', 'Bildirim ayarları başarıyla güncellendi.');
    }

    public function createBackup()
    {
        try {
            Artisan::call('backup:run');
            return redirect()->route('system-settings.backup')
                ->with('success', 'Yedekleme başarıyla oluşturuldu.');
        } catch (\Exception $e) {
            return redirect()->route('system-settings.backup')
                ->with('error', 'Yedekleme oluşturulurken bir hata oluştu: ' . $e->getMessage());
        }
    }
} 