<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Abonelik;
use App\Models\Tarife;
use App\Models\Kampanya;
use App\Models\Teklif;
use Illuminate\Support\Facades\Auth;
use App\Services\InvoiceService;

class AbonelikController extends Controller
{
    protected $invoiceService;

    public function __construct(InvoiceService $invoiceService)
    {
        $this->middleware('auth');
        $this->invoiceService = $invoiceService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->is('admin/*')) {
            // Admin view
            $abonelikler = Abonelik::with(['tarife', 'kampanya', 'user'])->orderBy('created_at', 'desc')->paginate(10);
            return view('admin.abonelikler.index', compact('abonelikler'));
        }

        // User view
        $abonelikler = Auth::user()->abonelikler()->with(['tarife', 'kampanya'])->orderBy('created_at', 'desc')->paginate(10);
        return view('abonelikler.index', compact('abonelikler'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::user()->is_admin) {
            return redirect()->route('abonelikler.index')
                ->with('error', 'Bu işlemi yapma yetkiniz yok.');
        }

        $tarifeler = Tarife::all();
        $kampanyalar = Kampanya::all();
        $teklif = null;
        
        if (request('teklif_id')) {
            $teklif = Teklif::with(['user', 'tarife', 'kampanya'])->findOrFail(request('teklif_id'));
        }
        
        return view('admin.abonelikler.create', compact('tarifeler', 'kampanyalar', 'teklif'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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

        // Kullanıcı ID'si atanmamışsa mevcut kullanıcının ID'sini kullan
        if (!$request->has('user_id') || !$request->user_id) {
            $request->merge(['user_id' => Auth::id()]);
        }

        $abonelik = Abonelik::create($request->all());
        
        // Generate all missing invoices for this subscription (from start date to now)
        app(\App\Services\InvoiceService::class)->generateMonthlyInvoice($abonelik, null); // Current month
        $start = \Carbon\Carbon::parse($abonelik->baslangic_tarihi)->startOfMonth();
        $end = \Carbon\Carbon::now()->startOfMonth();
        while ($start <= $end) {
            $period = $start->format('Y-m');
            app(\App\Services\InvoiceService::class)->generateMonthlyInvoice($abonelik, $period);
            $start->addMonth();
        }

        if ($request->has('teklif_id')) {
            $teklif = Teklif::findOrFail($request->teklif_id);
            // Teklifi işlenmiş olarak işaretle
            $teklif->durum = 'onaylandi';
            $teklif->save();
            
            // Abonelik oluşturulduktan sonra teklifi silelim
            $teklif->delete();
        }

        return redirect()->route('admin.abonelikler.show', $abonelik)
            ->with('success', 'Abonelik başarıyla oluşturuldu.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Abonelik $abonelik)
    {
        if (!Auth::user()->is_admin && $abonelik->user_id !== Auth::id()) {
            return redirect()->route('admin.abonelikler.index')
                ->with('error', 'Bu aboneliği görüntüleme yetkiniz yok.');
        }
        
        try {
            // Load relationships if needed
            $abonelik->load(['tarife', 'kampanya']);
            
            if (request()->is('admin/*')) {
                return view('admin.abonelikler.show', compact('abonelik'));
            }
            
            return view('abonelikler.show', compact('abonelik'));
        } catch (\Exception $e) {
            return redirect()->route('admin.abonelikler.index')
                ->with('error', 'Abonelik bilgileri görüntülenirken bir hata oluştu.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Abonelik $abonelik)
    {
        if (!Auth::user()->is_admin) {
            return redirect()->route('admin.abonelikler.index')
                ->with('error', 'Bu işlemi yapma yetkiniz yok.');
        }
        
        $tarifeler = Tarife::all();
        $kampanyalar = Kampanya::all();
        
        return view('admin.abonelikler.edit', compact('abonelik', 'tarifeler', 'kampanyalar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Abonelik $abonelik)
    {
        if (!Auth::user()->is_admin) {
            return redirect()->route('admin.abonelikler.index')
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

        return redirect()->route('admin.abonelikler.index')
            ->with('success', 'Abonelik başarıyla güncellendi.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Abonelik $abonelik)
    {
        if (!Auth::user()->is_admin) {
            return redirect()->route('admin.abonelikler.index')
                ->with('error', 'Bu işlemi yapma yetkiniz yok.');
        }
        
        $abonelik->delete();

        return redirect()->route('admin.abonelikler.index')
            ->with('success', 'Abonelik başarıyla silindi.');
    }
}
