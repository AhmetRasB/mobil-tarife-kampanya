<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\InvoiceAdminController;
use App\Http\Controllers\SystemSettingController;
use App\Http\Controllers\ApiSettingController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\SimCardController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\KampanyaController;
use App\Http\Controllers\TarifeController;
use App\Http\Controllers\TeklifController;
use App\Http\Controllers\AbonelikController;

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Admin Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // User Management
    Route::resource('users', AdminUserController::class);
    Route::resource('roles', RoleController::class);

    // Invoice Management
    Route::prefix('invoices')->name('invoices.')->group(function () {
        Route::get('/', [InvoiceAdminController::class, 'index'])->name('index');
        Route::post('/{invoice}/mark-paid', [InvoiceAdminController::class, 'markPaid'])->name('mark-paid');
        Route::post('/{invoice}/suspend', [InvoiceAdminController::class, 'suspend'])->name('suspend');
        Route::get('/{invoice}', [InvoiceAdminController::class, 'show'])->name('show');
    });

    // Settings
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/general', [SystemSettingController::class, 'general'])->name('general');
        Route::get('/notifications', [SystemSettingController::class, 'notifications'])->name('notifications');
        Route::get('/backup', [SystemSettingController::class, 'backup'])->name('backup');
        Route::post('/update-general', [SystemSettingController::class, 'updateGeneral'])->name('update-general');
        Route::post('/update-notifications', [SystemSettingController::class, 'updateNotifications'])->name('update-notifications');
        Route::post('/create-backup', [SystemSettingController::class, 'createBackup'])->name('create-backup');
    });

    // API Settings
    Route::prefix('api-settings')->name('api-settings.')->group(function () {
        Route::get('/', [ApiSettingController::class, 'index'])->name('index');
        Route::get('/credentials', [ApiSettingController::class, 'credentials'])->name('credentials');
        Route::get('/logs', [ApiSettingController::class, 'logs'])->name('logs');
        Route::post('/update', [ApiSettingController::class, 'update'])->name('update');
        Route::post('/generate-key', [ApiSettingController::class, 'generateKey'])->name('generate-key');
    });

    // Reports
    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('/subscribers', [ReportController::class, 'subscribers'])->name('subscribers');
        Route::get('/stock', [ReportController::class, 'stock'])->name('stock');
        Route::get('/financial', [ReportController::class, 'financial'])->name('financial');
    });

    // Device Management
    Route::resource('devices', DeviceController::class);
    Route::resource('abonelikler', AbonelikController::class)->parameters([
        'abonelikler' => 'abonelik'
    ]);

    // Phone Management
    Route::resource('phones', PhoneController::class);
    Route::resource('sim-cards', SimCardController::class);
    Route::resource('subscribers', SubscriberController::class);

    // Tarife and Kampanya Management
    Route::resource('tarifeler', TarifeController::class);
    Route::resource('kampanyalar', KampanyaController::class);

    // Teklif Management
    Route::resource('teklifs', TeklifController::class);

    // Remove admin status from a user
    Route::post('admins/{user}/remove', [RoleController::class, 'removeAdmin'])->name('admins.remove');
}); 