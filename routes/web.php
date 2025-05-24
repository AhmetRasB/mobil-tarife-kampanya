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
use App\Http\Controllers\PayController;

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
    Route::resource('abonelikler', AbonelikController::class);
    
    // Teklif routes
    Route::resource('teklifs', TeklifController::class);
    
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

    // User Pay Section
    Route::get('/pay', [PayController::class, 'index'])->name('pay.index');
    Route::post('/pay/{invoice}', [PayController::class, 'pay'])->name('pay.pay');
});

// Include admin routes
require __DIR__.'/admin.php';
