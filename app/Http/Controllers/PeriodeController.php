<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Periode;

class PeriodeController extends Controller
{
    public function index()
    {
        $periodes = Periode::orderByDesc('awal')->get();
        return view('admin.periodes.index', compact('periodes'));
    }

    public function create()
    {
        return view('admin.periodes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_periode' => 'required|unique:periodes,kode_periode',
            'awal' => 'required|date',
            'akhir' => 'required|date|after_or_equal:awal',
            'status' => 'required|in:AKTIF,NONAKTIF',
        ]);

        // Jika status AKTIF, nonaktifkan periode lainnya
        if ($request->status === 'AKTIF') {
            Periode::where('status', 'AKTIF')->update(['status' => 'NONAKTIF']);
        }

        Periode::create($request->all());

        return redirect()->route('admin.periodes.index')->with('success', 'Periode berhasil ditambahkan.');
    }

    public function edit(Periode $periode)
    {
        return view('admin.periodes.edit', compact('periode'));
    }

    public function update(Request $request, Periode $periode)
    {
        $request->validate([
            'kode_periode' => 'required|unique:periodes,kode_periode,' . $periode->id,
            'awal' => 'required|date',
            'akhir' => 'required|date|after_or_equal:awal',
            'status' => 'required|in:AKTIF,NONAKTIF',
        ]);

        // Jika status AKTIF, nonaktifkan periode lainnya
        if ($request->status === 'AKTIF') {
            Periode::where('status', 'AKTIF')->where('id', '!=', $periode->id)->update(['status' => 'NONAKTIF']);
        }

        $periode->update($request->all());

        return redirect()->route('admin.periodes.index')->with('success', 'Periode berhasil diperbarui.');
    }

    public function destroy(Periode $periode)
    {
        // Tidak boleh menghapus periode yang sedang aktif
        if ($periode->status === 'AKTIF') {
            return back()->with('error', 'Tidak bisa menghapus periode yang sedang AKTIF.');
        }

        $periode->delete();
        return redirect()->route('admin.periodes.index')->with('success', 'Periode berhasil dihapus.');
    }
}
