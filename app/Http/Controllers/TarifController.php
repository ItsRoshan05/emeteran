<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarif;
class TarifController extends Controller
{
        public function index()
    {
        $tarifs = Tarif::all();
        return view('admin.tarifs.index', compact('tarifs'));
    }

    public function create()
    {
        return view('admin.tarifs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'harga_per_m3' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string',
        ]);

        Tarif::create($request->only('harga_per_m3', 'keterangan'));

        return redirect()->route('admin.tarifs.index')->with('success', 'Tarif berhasil ditambahkan.');
    }

    public function show(Tarif $tarif)
    {
        return view('admin.tarifs.show', compact('tarif'));
    }

    public function edit(Tarif $tarif)
    {
        return view('admin.tarifs.edit', compact('tarif'));
    }

    public function update(Request $request, Tarif $tarif)
    {
        $request->validate([
            'harga_per_m3' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string',
        ]);

        $tarif->update($request->only('harga_per_m3', 'keterangan'));

        return redirect()->route('admin.tarifs.index')->with('success', 'Tarif berhasil diperbarui.');
    }

    public function destroy(Tarif $tarif)
    {
        $tarif->delete();

        return redirect()->route('admin.tarifs.index')->with('success', 'Tarif berhasil dihapus.');
    }
}
