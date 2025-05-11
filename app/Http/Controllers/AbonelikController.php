<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Abonelik;
use App\Models\Tarife;
use App\Models\Kampanya;
use App\Models\Teklif;
use Illuminate\Support\Facades\Auth;

class AbonelikController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->is_admin) {
            $abonelikler = Abonelik::with(['tarife', 'kampanya', 'user'])->orderBy('created_at', 'desc')->paginate(10);
        } else {
            $abonelikler = Auth::user()->abonelikler()->with(['tarife', 'kampanya'])->orderBy('created_at', 'desc')->paginate(10);
        }

        return view('abonelikler.index', compact('abonelikler'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tarifeler = Tarife::all();
        $kampanyalar = Kampanya::all();
        $teklif = null;
        
        if (request('teklif_id')) {
            $teklif = Teklif::with(['user', 'tarife', 'kampanya'])->findOrFail(request('teklif_id'));
        }
        
        return view('abonelikler.create', compact('tarifeler', 'kampanyalar', 'teklif'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'musteri_adi' => 'required|string|max:255',
            'telefon' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'tarife_id' => 'required|exists:tarifeler,id',
            'kampanya_id' => 'nullable|exists:kampanyalar,id',
            'baslangic_tarihi' => 'required|date',
            'bitis_tarihi' => 'nullable|date|after:baslangic_tarihi',
            'aktif' => 'boolean',
        ]);

        // Kullanıcı ID'si atanmamışsa mevcut kullanıcının ID'sini kullan
        if (!$request->has('user_id') || !$request->user_id) {
            $request->merge(['user_id' => Auth::id()]);
        }

        $abonelik = Abonelik::create($request->all());
        
        if ($request->has('teklif_id')) {
            $teklif = Teklif::findOrFail($request->teklif_id);
            // Teklifi işlenmiş olarak işaretle
            $teklif->durum = 'onaylandi';
            $teklif->save();
            
            // Abonelik oluşturulduktan sonra teklifi silelim
            $teklif->delete();
        }

        return redirect()->route('abonelikler.index')
            ->with('success', 'Abonelik başarıyla oluşturuldu.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Abonelik $abonelik)
    {
        if (!Auth::user()->is_admin && $abonelik->user_id !== Auth::id()) {
            return redirect()->route('abonelikler.index')
                ->with('error', 'Bu aboneliği görüntüleme yetkiniz yok.');
        }
        
        try {
            // Load relationships if needed
            $abonelik->load(['tarife', 'kampanya']);
            
            return view('abonelikler.show', compact('abonelik'));
        } catch (\Exception $e) {
            return redirect()->route('abonelikler.index')
                ->with('error', 'Abonelik bilgileri görüntülenirken bir hata oluştu.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Abonelik $abonelik)
    {
        if (!Auth::user()->is_admin) {
            return redirect()->route('abonelikler.index')
                ->with('error', 'Bu işlemi yapma yetkiniz yok.');
        }
        
        $tarifeler = Tarife::all();
        $kampanyalar = Kampanya::all();
        
        return view('abonelikler.edit', compact('abonelik', 'tarifeler', 'kampanyalar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Abonelik $abonelik)
    {
        if (!Auth::user()->is_admin) {
            return redirect()->route('abonelikler.index')
                ->with('error', 'Bu işlemi yapma yetkiniz yok.');
        }
        
        $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'musteri_adi' => 'required|string|max:255',
            'telefon' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'tarife_id' => 'required|exists:tarifeler,id',
            'kampanya_id' => 'nullable|exists:kampanyalar,id',
            'baslangic_tarihi' => 'required|date',
            'bitis_tarihi' => 'nullable|date|after:baslangic_tarihi',
            'aktif' => 'boolean',
        ]);

        $abonelik->update($request->all());

        return redirect()->route('abonelikler.index')
            ->with('success', 'Abonelik başarıyla güncellendi.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Abonelik $abonelik)
    {
        if (!Auth::user()->is_admin) {
            return redirect()->route('abonelikler.index')
                ->with('error', 'Bu işlemi yapma yetkiniz yok.');
        }
        
        $abonelik->delete();

        return redirect()->route('abonelikler.index')
            ->with('success', 'Abonelik başarıyla silindi.');
    }
}
