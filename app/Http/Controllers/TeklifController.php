<?php

namespace App\Http\Controllers;

use App\Models\Teklif;
use App\Models\Tarife;
use App\Models\Kampanya;
use App\Models\Abonelik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Services\InvoiceService;

class TeklifController extends Controller
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
        $teklifs = Auth::user()->is_admin 
            ? Teklif::with(['user', 'tarife', 'kampanya'])->paginate(10)
            : Auth::user()->teklifs()->with(['tarife', 'kampanya'])->paginate(10);
            
        return view('teklifs.index', compact('teklifs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $tarife_id = $request->tarife_id;
        $kampanya_id = $request->kampanya_id;

        if (!$tarife_id) {
            return redirect()->route('tarifeler.index')
                ->with('error', 'Lütfen önce bir tarife seçin.');
        }

        $tarife = Tarife::findOrFail($tarife_id);
        $kampanya = $kampanya_id ? Kampanya::findOrFail($kampanya_id) : null;

        return view('teklifs.create', compact('tarife', 'kampanya'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tarife_id' => 'required|exists:tarifeler,id',
            'kampanya_id' => 'nullable|exists:kampanyalar,id',
            'ad_soyad' => 'required|string|max:255',
            'telefon' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'adres' => 'required|string',
            'notlar' => 'nullable|string',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['durum'] = 'beklemede';

        $teklif = Teklif::create($validated);

        return redirect()->route('teklifs.show', $teklif)
            ->with('success', 'Teklifiniz başarıyla oluşturuldu.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Teklif $teklif)
    {
        if (!Auth::user()->is_admin && Auth::id() !== $teklif->user_id) {
            return redirect()->route('teklifs.index')
                ->with('error', 'Bu teklifi görüntüleme yetkiniz yok.');
        }

        return view('teklifs.show', compact('teklif'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teklif $teklif)
    {
        if (!Auth::user()->is_admin) {
            return redirect()->route('teklifs.index')
                ->with('error', 'Bu işlemi yapma yetkiniz yok.');
        }

        $validated = $request->validate([
            'durum' => 'required|in:beklemede,onaylandi,reddedildi',
            'notlar' => 'nullable|string',
        ]);

        $teklif->update($validated);

        // If the teklif is approved, automatically create a subscription
        if ($validated['durum'] === 'onaylandi') {
            try {
                // Create or find subscriber
                $subscriber = \App\Models\Subscriber::firstOrCreate(
                    ['eposta' => $teklif->email],
                    [
                        'ad' => explode(' ', $teklif->ad_soyad)[0] ?? $teklif->ad_soyad,
                        'soyad' => explode(' ', $teklif->ad_soyad)[1] ?? '',
                        'tc_no' => null,
                        'telefon' => $teklif->telefon,
                        'adres' => $teklif->adres ?? '',
                        'kayit_tarihi' => now(),
                        'aktif_mi' => true
                    ]
                );

                // Create subscription
                $abonelik = Abonelik::create([
                    'user_id' => $teklif->user_id,
                    'subscriber_id' => $subscriber->id,
                    'musteri_adi' => $teklif->ad_soyad,
                    'telefon' => $teklif->telefon,
                    'email' => $teklif->email,
                    'tarife_id' => $teklif->tarife_id,
                    'kampanya_id' => $teklif->kampanya_id,
                    'baslangic_tarihi' => Carbon::now(),
                    'bitis_tarihi' => null,
                    'aktif' => true
                ]);

                try {
                    // Try to generate invoice, but don't fail if it errors
                    $this->invoiceService->generateMonthlyInvoice($abonelik);
                } catch (\Exception $invoiceError) {
                    // Log the invoice error but continue with subscription creation
                    \Log::error('Invoice generation failed: ' . $invoiceError->getMessage());
                }

                // Delete the teklif after successful subscription creation
                $teklif->delete();

                return redirect()->route('admin.abonelikler.index')
                    ->with('success', 'Teklif onaylandı ve abonelik başarıyla oluşturuldu.')
                    ->with('warning', isset($invoiceError) ? 'Abonelik oluşturuldu fakat fatura oluşturulurken bir hata oluştu.' : null);

            } catch (\Exception $e) {
                // If subscription creation fails, revert the teklif status
                $teklif->update(['durum' => 'beklemede']);
                \Log::error('Subscription creation failed: ' . $e->getMessage());
                return redirect()->route('teklifs.show', $teklif)
                    ->with('error', 'Abonelik oluşturulurken bir hata oluştu: ' . $e->getMessage());
            }
        }

        return redirect()->route('teklifs.index')
            ->with('success', 'Teklif durumu güncellendi.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teklif $teklif)
    {
        // Check if user is admin or owns the teklif
        if (!Auth::user()->is_admin && Auth::id() !== $teklif->user_id) {
            return redirect()->route('teklifs.index')
                ->with('error', 'Bu işlemi yapma yetkiniz yok.');
        }

        try {
            $teklif->delete();
            return redirect()->route('teklifs.index')
                ->with('success', 'Teklif başarıyla silindi.');
        } catch (\Exception $e) {
            return redirect()->route('teklifs.index')
                ->with('error', 'Teklif silinirken bir hata oluştu.');
        }
    }
}
