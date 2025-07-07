<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meteran;
use App\Models\User;
use App\Models\Periode;
use App\Models\Pelanggan;
use App\Models\Tarif;

class MeteranController extends Controller
{
    public function index()
    {
        $meterans = Meteran::with(['pelanggan', 'periode', 'petugas'])->latest()->get();
        return view('admin.meterans.index', compact('meterans'));
    }

    public function create()
    {
        $pelanggans = Pelanggan::with('user')->get();

        $periodes = Periode::orderByDesc('awal')->get();

        return view('admin.meterans.create', [
    'pelanggans' => Pelanggan::with('user')->get(),
    'periodes' => Periode::all(),
    'petugas' => User::where('role', 'petugas')->get(),
    'tarifs' => Tarif::all(),
]);

    }

public function store(Request $request)
{
    $validated = $request->validate([
        'pelanggan_id' => 'required|exists:pelanggans,id',
        'periode_id' => 'required|exists:periodes,id',
        'jumlah_meteran' => 'required|numeric',
        'tarif' => 'required|numeric',
        'status_bayar' => 'required|in:BELUM,LUNAS',
        'metode_bayar' => 'required|in:CASH',
        'tanggal_bayar' => 'nullable|date',
        'petugas_id' => 'nullable|exists:users,id',
    ]);

    $validated['total_tagihan'] = $validated['jumlah_meteran'] * $validated['tarif'];

    Meteran::create($validated);

    return redirect()->route('meterans.index')->with('success', 'Data meteran berhasil ditambahkan.');
}

    public function edit(Meteran $meteran)
    {
        $pelanggans = Pelanggan::with('user')->get(); 
        $periodes = Periode::orderByDesc('awal')->get();
        $tarifs = Tarif::all();
        $petugas = User::where('role', 'petugas')->get();

        return view('admin.meterans.edit', compact('meteran', 'pelanggans', 'periodes','tarifs','petugas'));
    }

    public function update(Request $request, Meteran $meteran)
    {
        $request->validate([
            'pelanggan_id' => 'required|exists:users,id',
            'periode_id' => 'required|exists:periodes,id',
            'jumlah_meteran' => 'required|numeric|min:0',
            'tarif' => 'required|numeric|min:0',
            'status_bayar' => 'required|in:LUNAS,BELUM',
            'metode_bayar' => 'nullable|in:CASH',
            'tanggal_bayar' => 'nullable|date',
            'petugas_id' => 'nullable|exists:users,id',
        ]);

        $total_tagihan = $request->jumlah_meteran * $request->tarif;

        $meteran->update([
            'pelanggan_id' => $request->pelanggan_id,
            'periode_id' => $request->periode_id,
            'jumlah_meteran' => $request->jumlah_meteran,
            'tarif' => $request->tarif,
            'total_tagihan' => $total_tagihan,
            'status_bayar' => $request->status_bayar,
            'metode_bayar' => $request->metode_bayar,
            'tanggal_bayar' => $request->tanggal_bayar,
            'petugas_id' => $request->petugas_id,
        ]);

        return redirect()->route('meterans.index')->with('success', 'Data meteran berhasil diperbarui.');
    }

    public function destroy(Meteran $meteran)
    {
        $meteran->delete();
        return redirect()->route('meterans.index')->with('success', 'Data meteran berhasil dihapus.');
    }

    public function markAsLunas(Meteran $meteran)
{
    if ($meteran->status_bayar === 'LUNAS') {
        return back()->with('info', 'Status sudah LUNAS.');
    }

    $meteran->update([
        'status_bayar' => 'LUNAS',
        'metode_bayar' => 'CASH',
        'tanggal_bayar' => now(),
    ]);

    return back()->with('success', 'Status pembayaran berhasil diubah menjadi LUNAS.');
}

}
