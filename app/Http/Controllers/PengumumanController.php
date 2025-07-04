<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    public function index()
    {
        $pengumumans = Pengumuman::latest()->get();
        return view('admin.pengumumans.index', compact('pengumumans'));
    }

    public function create()
    {
        return view('admin.pengumumans.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'              => 'required|string|max:255',
            'isi'                => 'required|string',
            'ditampilkan_di_user' => 'nullable|boolean',
        ]);

        Pengumuman::create([
            'judul'              => $request->judul,
            'isi'                => $request->isi,
            'ditampilkan_di_user' => $request->has('ditampilkan_di_user'),
        ]);

        return redirect()->route('admin.pengumumans.index')->with('success', 'Pengumuman berhasil ditambahkan.');
    }

    public function edit(Pengumuman $pengumuman)
    {
        return view('admin.pengumumans.edit', compact('pengumuman'));
    }

    public function update(Request $request, Pengumuman $pengumuman)
    {
        $request->validate([
            'judul'              => 'required|string|max:255',
            'isi'                => 'required|string',
            'ditampilkan_di_user' => 'nullable|boolean',
        ]);

        $pengumuman->update([
            'judul'              => $request->judul,
            'isi'                => $request->isi,
            'ditampilkan_di_user' => $request->has('ditampilkan_di_user'),
        ]);

        return redirect()->route('admin.pengumumans.index')->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function destroy(Pengumuman $pengumuman)
    {
        $pengumuman->delete();
        return redirect()->route('admin.pengumumans.index')->with('success', 'Pengumuman berhasil dihapus.');
    }

    public function toggleTampilkanDiUser($id)
{
    $pengumuman = Pengumuman::findOrFail($id);
    $pengumuman->ditampilkan_di_user = !$pengumuman->ditampilkan_di_user;
    $pengumuman->save();

    return response()->json(['success' => true, 'status' => $pengumuman->ditampilkan_di_user]);
}

}
