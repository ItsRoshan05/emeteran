<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggans = Pelanggan::with('user')->get();
        return view('admin.pelanggans.index', compact('pelanggans'));
    }

    public function create()
    {
        return view('admin.pelanggans.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'email'          => 'required|unique:users,email',
            'no_hp'          => 'required|string|max:20',
            'email'          => 'required|email|unique:pelanggans,email',
            'alamat'         => 'nullable|string',
            'keterangan'     => 'nullable|string',
        ]);

        // Buat akun user otomatis
        $user = User::create([
            'name'     => $request->nama_pelanggan,
            'email'    => $request->email,
            'password' => Hash::make('123456789'), // Password default (ganti jika perlu)
            'role'     => 'user',
        ]);

        // Buat data pelanggan
        Pelanggan::create([
            'user_id'        => $user->id,
            'nama_pelanggan' => $request->nama_pelanggan,
            'no_hp'          => $request->no_hp,
            'email'          => $request->email,
            'alamat'         => $request->alamat,
            'keterangan'     => $request->keterangan,
        ]);

        return redirect()->route('admin.pelanggans.index')->with('success', 'Pelanggan berhasil ditambahkan.');
    }

    public function show(Pelanggan $pelanggan)
    {
        return view('admin.pelanggans.show', compact('pelanggan'));
    }

    public function edit(Pelanggan $pelanggan)
    {
        return view('admin.pelanggans.edit', compact('pelanggan'));
    }

    public function update(Request $request, Pelanggan $pelanggan)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'no_hp'          => 'required|string|max:20',
            'email'          => 'required|email|unique:pelanggans,email,' . $pelanggan->id,
            'alamat'         => 'nullable|string',
            'keterangan'     => 'nullable|string',
        ]);

        // Update user (jika perlu)
            $pelanggan->user->update([
            'name' => $request->nama_pelanggan,
            'email' => $request->email,
            // Password tidak diupdate, biarkan tetap sama
        ]);

        // Update pelanggan
        $pelanggan->update([
            'nama_pelanggan' => $request->nama_pelanggan,
            'no_hp'          => $request->no_hp,
            'email'          => $request->email,
            'alamat'         => $request->alamat,
            'keterangan'     => $request->keterangan,
        ]);

        return redirect()->route('admin.pelanggans.index')->with('success', 'Pelanggan berhasil diperbarui.');
    }

    public function destroy(Pelanggan $pelanggan)
    {
        // Hapus user juga (karena relasi cascade sudah diset di migration)
        $pelanggan->delete();

        return redirect()->route('admin.pelanggans.index')->with('success', 'Pelanggan berhasil dihapus.');
    }
}
