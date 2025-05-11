<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TarifeController;
use App\Http\Controllers\KampanyaController;
use App\Http\Controllers\AbonelikController;
use App\Http\Controllers\TeklifController;
use App\Models\Tarife;
use App\Models\Kampanya;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;   
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\SimCardController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\SmsLogController;
use App\Http\Controllers\FaxLogController;
use App\Http\Controllers\CallLogController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\StockMovementController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\SectorController;
use App\Http\Controllers\SystemSettingController;
use App\Http\Controllers\ApiSettingController;
use App\Http\Controllers\RelatedSettingController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleController;

// Ana sayfa
Route::get('/', function () {
    $tarifeler = Tarife::where('aktif', true)->get();
    $kampanyalar = Kampanya::where('aktif', true)->get();
    return view('welcome', compact('tarifeler', 'kampanyalar'));
})->name('welcome');

// Auth routes
Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Public routes
Route::get('tarifeler', [TarifeController::class, 'index'])->name('tarifeler.index');
Route::get('tarifeler/{tarife}', [TarifeController::class, 'show'])->name('tarifeler.show');
Route::get('kampanyalar', [KampanyaController::class, 'index'])->name('kampanyalar.index');
Route::get('kampanyalar/{kampanya}', [KampanyaController::class, 'show'])->name('kampanyalar.show');

// Authenticated user routes
Route::middleware(['auth'])->group(function () {
    // Abonelik routes
    Route::get('abonelikler', [AbonelikController::class, 'index'])->name('abonelikler.index');
    Route::get('abonelikler/create', [AbonelikController::class, 'create'])->name('abonelikler.create');
    Route::post('abonelikler', [AbonelikController::class, 'store'])->name('abonelikler.store');
    Route::get('abonelikler/{abonelik}', [AbonelikController::class, 'show'])->name('abonelikler.show');
    Route::get('abonelikler/{abonelik}/edit', [AbonelikController::class, 'edit'])->name('abonelikler.edit');
    Route::put('abonelikler/{abonelik}', [AbonelikController::class, 'update'])->name('abonelikler.update');
    Route::delete('abonelikler/{abonelik}', [AbonelikController::class, 'destroy'])->name('abonelikler.destroy');
    
    // Teklif routes
    Route::get('teklifs/create', [TeklifController::class, 'create'])->name('teklifs.create');
    Route::post('teklifs', [TeklifController::class, 'store'])->name('teklifs.store');
    Route::get('teklifs', [TeklifController::class, 'index'])->name('teklifs.index');
    Route::get('teklifs/{teklif}', [TeklifController::class, 'show'])->name('teklifs.show');
    Route::get('teklifs/{teklif}/edit', [TeklifController::class, 'edit'])->name('teklifs.edit');
    Route::put('teklifs/{teklif}', [TeklifController::class, 'update'])->name('teklifs.update');
    Route::delete('teklifs/{teklif}', [TeklifController::class, 'destroy'])->name('teklifs.destroy');
    
    // Teklif create route
    Route::get('/create-teklif', function () {
        if (!request('tarife_id')) {
            return redirect()->route('welcome')->with('error', 'Lütfen önce bir tarife seçin.');
        }
        
        return redirect()->route('teklifs.create', [
            'tarife_id' => request('tarife_id'),
            'kampanya_id' => request('kampanya_id'),
        ]);
    })->name('create-teklif');
});

// Admin routes
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    // Admin dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Admin middleware group
    Route::middleware(['admin'])->group(function () {
        // Tarife management
        Route::get('tarifeler', [TarifeController::class, 'index'])->name('tarifeler.index');
        Route::get('tarifeler/create', [TarifeController::class, 'create'])->name('tarifeler.create');
        Route::post('tarifeler', [TarifeController::class, 'store'])->name('tarifeler.store');
        Route::get('tarifeler/{tarife}', [TarifeController::class, 'show'])->name('tarifeler.show');
        Route::get('tarifeler/{tarife}/edit', [TarifeController::class, 'edit'])->name('tarifeler.edit');
        Route::put('tarifeler/{tarife}', [TarifeController::class, 'update'])->name('tarifeler.update');
        Route::delete('tarifeler/{tarife}', [TarifeController::class, 'destroy'])->name('tarifeler.destroy');
        
        // Kampanya management
        Route::get('kampanyalar', [KampanyaController::class, 'index'])->name('kampanyalar.index');
        Route::get('kampanyalar/create', [KampanyaController::class, 'create'])->name('kampanyalar.create');
        Route::post('kampanyalar', [KampanyaController::class, 'store'])->name('kampanyalar.store');
        Route::get('kampanyalar/{kampanya}', [KampanyaController::class, 'show'])->name('kampanyalar.show');
        Route::get('kampanyalar/{kampanya}/edit', [KampanyaController::class, 'edit'])->name('kampanyalar.edit');
        Route::put('kampanyalar/{kampanya}', [KampanyaController::class, 'update'])->name('kampanyalar.update');
        Route::delete('kampanyalar/{kampanya}', [KampanyaController::class, 'destroy'])->name('kampanyalar.destroy');
        
        // Abonelik management
        Route::get('abonelikler', [AbonelikController::class, 'index'])->name('abonelikler.index');
        Route::get('abonelikler/create', [AbonelikController::class, 'create'])->name('abonelikler.create');
        Route::post('abonelikler', [AbonelikController::class, 'store'])->name('abonelikler.store');
        Route::get('abonelikler/{abonelik}', [AbonelikController::class, 'show'])->name('abonelikler.show');
        Route::get('abonelikler/{abonelik}/edit', [AbonelikController::class, 'edit'])->name('abonelikler.edit');
        Route::put('abonelikler/{abonelik}', [AbonelikController::class, 'update'])->name('abonelikler.update');
        Route::delete('abonelikler/{abonelik}', [AbonelikController::class, 'destroy'])->name('abonelikler.destroy');
        
        // Teklif management
        Route::get('teklifs', [TeklifController::class, 'index'])->name('teklifs.index');
        Route::get('teklifs/create', [TeklifController::class, 'create'])->name('teklifs.create');
        Route::post('teklifs', [TeklifController::class, 'store'])->name('teklifs.store');
        Route::get('teklifs/{teklif}', [TeklifController::class, 'show'])->name('teklifs.show');
        Route::get('teklifs/{teklif}/edit', [TeklifController::class, 'edit'])->name('teklifs.edit');
        Route::put('teklifs/{teklif}', [TeklifController::class, 'update'])->name('teklifs.update');
        Route::delete('teklifs/{teklif}', [TeklifController::class, 'destroy'])->name('teklifs.destroy');
    });
});

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Abone İşlemleri
Route::resource('subscribers', SubscriberController::class);
Route::resource('subscriptions', SubscriptionController::class);

// Cihaz Yönetimi
Route::resource('phones', PhoneController::class);
Route::resource('sim-cards', SimCardController::class);
Route::resource('devices', DeviceController::class);

// İletişim Servisleri
Route::resource('sms-logs', SmsLogController::class);
Route::resource('fax-logs', FaxLogController::class);
Route::resource('call-logs', CallLogController::class);

// Stok Yönetimi
Route::resource('assets', AssetController::class);
Route::resource('stock-movements', StockMovementController::class);

// Organizasyon Yönetimi
Route::resource('organizations', OrganizationController::class);
Route::resource('locations', LocationController::class);
Route::resource('sectors', SectorController::class);

// Ayarlar
Route::resource('settings', SystemSettingController::class);
Route::resource('api-settings', ApiSettingController::class);
Route::resource('related-settings', RelatedSettingController::class);

// Raporlar
Route::prefix('reports')->group(function () {
    Route::get('/subscribers', [ReportController::class, 'subscribers'])->name('reports.subscribers');
    Route::get('/stock', [ReportController::class, 'stock'])->name('reports.stock');
    Route::get('/financial', [ReportController::class, 'financial'])->name('reports.financial');
});

// API Settings Routes
Route::prefix('api-settings')->name('api-settings.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [ApiSettingController::class, 'index'])->name('index');
    Route::get('/credentials', [ApiSettingController::class, 'credentials'])->name('credentials');
    Route::get('/logs', [ApiSettingController::class, 'logs'])->name('logs');
    Route::post('/update', [ApiSettingController::class, 'update'])->name('update');
    Route::post('/generate-key', [ApiSettingController::class, 'generateKey'])->name('generate-key');
});

// User Management Routes
Route::prefix('users')->name('users.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/', [UserController::class, 'store'])->name('store');
    Route::get('/{user}', [UserController::class, 'show'])->name('show');
    Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
    Route::put('/{user}', [UserController::class, 'update'])->name('update');
    Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
});

// Role Management Routes
Route::prefix('roles')->name('roles.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [RoleController::class, 'index'])->name('index');
    Route::get('/create', [RoleController::class, 'create'])->name('create');
    Route::post('/', [RoleController::class, 'store'])->name('store');
    Route::get('/{role}', [RoleController::class, 'show'])->name('show');
    Route::get('/{role}/edit', [RoleController::class, 'edit'])->name('edit');
    Route::put('/{role}', [RoleController::class, 'update'])->name('update');
    Route::delete('/{role}', [RoleController::class, 'destroy'])->name('destroy');
});

// System Settings Routes
Route::prefix('system-settings')->name('system-settings.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/general', [SystemSettingController::class, 'general'])->name('general');
    Route::get('/notifications', [SystemSettingController::class, 'notifications'])->name('notifications');
    Route::get('/backup', [SystemSettingController::class, 'backup'])->name('backup');
    Route::post('/update-general', [SystemSettingController::class, 'updateGeneral'])->name('update-general');
    Route::post('/update-notifications', [SystemSettingController::class, 'updateNotifications'])->name('update-notifications');
    Route::post('/create-backup', [SystemSettingController::class, 'createBackup'])->name('create-backup');
});
