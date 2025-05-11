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
