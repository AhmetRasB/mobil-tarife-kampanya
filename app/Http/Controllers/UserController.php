<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarife;
use App\Models\Kampanya;
use App\Models\Teklif;

class UserController extends Controller
{
    public function tarifeler()
    {
        // Tarifeleri listeleme işlemi
        $tarifeler = Tarife::where('aktif', true)->get();
        return view('user.tarifeler', compact('tarifeler'));
    }

    public function kampanyalar()
    {
        // Kampanyaları listeleme işlemi
        $kampanyalar = Kampanya::where('aktif', true)->get();
        return view('user.kampanyalar', compact('kampanyalar'));
    }

    public function teklifAl(Request $request)
    {
        // Kampanyadan teklif alma işlemi
        $request->validate([
            'tarife_id' => 'required|exists:tarifeler,id',
            'kampanya_id' => 'nullable|exists:kampanyalar,id',
        ]);

        $teklif = Teklif::create([
            'user_id' => auth()->id(),
            'tarife_id' => $request->tarife_id,
            'kampanya_id' => $request->kampanya_id,
        ]);

        return redirect()->route('user.tarifeler')->with('success', 'Teklif başarıyla alındı.');
    }
}
