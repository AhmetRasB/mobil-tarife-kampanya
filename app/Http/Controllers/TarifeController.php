<?php

namespace App\Http\Controllers;

use App\Models\Tarife;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TarifeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->is('admin/*')) {
            // Admin view
            $tarifeler = Tarife::paginate(10);
            return view('admin.tarifeler.index', compact('tarifeler'));
        }
        
        // Public view
        $tarifeler = Tarife::where('aktif', true)->paginate(10);
        return view('tarifeler.index', compact('tarifeler'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::user()->is_admin) {
            return redirect()->route('tarifeler.index')
                ->with('error', 'Bu işlemi yapma yetkiniz yok.');
        }
        
        return view('admin.tarifeler.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Auth::user()->is_admin) {
            return redirect()->route('tarifeler.index')
                ->with('error', 'Bu işlemi yapma yetkiniz yok.');
        }
        
        $validated = $request->validate([
            'ad' => 'required|string|max:255',
            'fiyat' => 'required|numeric|min:0',
            'internet_miktari' => 'required|integer|min:0',
            'dakika_miktari' => 'required|integer|min:0',
            'sms_miktari' => 'required|integer|min:0',
        ]);

        // Checkbox değerini manuel olarak işle
        $validated['aktif'] = $request->has('aktif') ? true : false;

        Tarife::create($validated);

        return redirect()->route('admin.tarifeler.index')
            ->with('success', 'Tarife başarıyla oluşturuldu.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tarife $tarife)
    {
        if (request()->is('admin/*')) {
            return view('admin.tarifeler.show', compact('tarife'));
        }
        return view('tarifeler.show', compact('tarife'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tarife $tarife)
    {
        if (!Auth::user()->is_admin) {
            return redirect()->route('tarifeler.index')
                ->with('error', 'Bu işlemi yapma yetkiniz yok.');
        }
        
        return view('admin.tarifeler.edit', compact('tarife'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tarife $tarife)
    {
        if (!Auth::user()->is_admin) {
            return redirect()->route('tarifeler.index')
                ->with('error', 'Bu işlemi yapma yetkiniz yok.');
        }
        
        $validated = $request->validate([
            'ad' => 'required|string|max:255',
            'fiyat' => 'required|numeric|min:0',
            'internet_miktari' => 'required|numeric|min:0',
            'dakika_miktari' => 'required|numeric|min:0',
            'sms_miktari' => 'required|numeric|min:0',
        ]);

        // Checkbox değerini manuel olarak işle
        $validated['aktif'] = $request->has('aktif') ? true : false;

        $tarife->update($validated);

        return redirect()->route('admin.tarifeler.index')
            ->with('success', 'Tarife başarıyla güncellendi.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tarife $tarife)
    {
        if (!Auth::user()->is_admin) {
            return redirect()->route('tarifeler.index')
                ->with('error', 'Bu işlemi yapma yetkiniz yok.');
        }
        
        try {
            // Tarife bir abonelikte kullanılıyorsa silinmesini engelle
            if ($tarife->abonelikler()->exists()) {
                return redirect()->route('admin.tarifeler.index')
                    ->with('error', 'Bu tarife bir aboneliğe bağlı olduğu için silinemez.');
            }
            
            $tarife->delete();

            return redirect()->route('admin.tarifeler.index')
                ->with('success', 'Tarife başarıyla silindi.');
        } catch (\Exception $e) {
            return redirect()->route('admin.tarifeler.index')
                ->with('error', 'Tarife silinirken bir hata oluştu.');
        }
    }
}
