<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kampanya;
use App\Models\Tarife;
use Illuminate\Support\Facades\Auth;

class KampanyaController extends Controller
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
            $kampanyalar = Kampanya::paginate(10);
            return view('admin.kampanyalar.index', compact('kampanyalar'));
        }
        
        // Public view
        $kampanyalar = Kampanya::where('aktif', true)->paginate(10);
        return view('kampanyalar.index', compact('kampanyalar'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::user()->is_admin) {
            return redirect()->route('kampanyalar.index')
                ->with('error', 'Bu işlemi yapma yetkiniz yok.');
        }
        
        return view('admin.kampanyalar.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Auth::user()->is_admin) {
            return redirect()->route('kampanyalar.index')
                ->with('error', 'Bu işlemi yapma yetkiniz yok.');
        }
        
        $validated = $request->validate([
            'ad' => 'required|string|max:255',
            'aciklama' => 'nullable|string',
            'indirim_orani' => 'required|numeric|min:0|max:100',
            'baslangic_tarihi' => 'required|date',
            'bitis_tarihi' => 'required|date|after:baslangic_tarihi',
        ]);

        // Checkbox değerini manuel olarak işle
        $validated['aktif'] = $request->has('aktif') ? true : false;

        Kampanya::create($validated);

        return redirect()->route('admin.kampanyalar.index')
            ->with('success', 'Kampanya başarıyla oluşturuldu.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kampanya $kampanya)
    {
        if (request()->is('admin/*')) {
            return view('admin.kampanyalar.show', compact('kampanya'));
        }
        return view('kampanyalar.show', compact('kampanya'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kampanya $kampanya)
    {
        if (!Auth::user()->is_admin) {
            return redirect()->route('kampanyalar.index')
                ->with('error', 'Bu işlemi yapma yetkiniz yok.');
        }
        
        return view('admin.kampanyalar.edit', compact('kampanya'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kampanya $kampanya)
    {
        if (!Auth::user()->is_admin) {
            return redirect()->route('kampanyalar.index')
                ->with('error', 'Bu işlemi yapma yetkiniz yok.');
        }
        
        $validated = $request->validate([
            'ad' => 'required|string|max:255',
            'aciklama' => 'nullable|string',
            'indirim_orani' => 'required|numeric|min:0|max:100',
            'baslangic_tarihi' => 'required|date',
            'bitis_tarihi' => 'required|date|after:baslangic_tarihi',
        ]);

        // Checkbox değerini manuel olarak işle
        $validated['aktif'] = $request->has('aktif') ? true : false;

        $kampanya->update($validated);

        return redirect()->route('admin.kampanyalar.index')
            ->with('success', 'Kampanya başarıyla güncellendi.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kampanya $kampanya)
    {
        if (!Auth::user()->is_admin) {
            return redirect()->route('kampanyalar.index')
                ->with('error', 'Bu işlemi yapma yetkiniz yok.');
        }
        
        try {
            // Kampanya bir teklifte kullanılıyorsa silinmesini engelle
            if ($kampanya->teklifs()->exists()) {
                return redirect()->route('admin.kampanyalar.index')
                    ->with('error', 'Bu kampanya bir teklife bağlı olduğu için silinemez.');
            }
            
            $kampanya->delete();

            return redirect()->route('admin.kampanyalar.index')
                ->with('success', 'Kampanya başarıyla silindi.');
        } catch (\Exception $e) {
            return redirect()->route('admin.kampanyalar.index')
                ->with('error', 'Kampanya silinirken bir hata oluştu.');
        }
    }
}
