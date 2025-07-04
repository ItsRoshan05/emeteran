@extends('layouts.app')

@section('title', 'Edit Pengumuman')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-xl shadow-lg">
  <h2 class="text-xl font-semibold text-[#1E3A8A] mb-4">Edit Pengumuman</h2>

  <form action="{{ route('admin.pengumumans.update', $pengumuman->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-4">
      <label class="block font-medium">Judul</label>
      <input type="text" name="judul" class="w-full px-4 py-2 border rounded" value="{{ old('judul', $pengumuman->judul) }}" required>
    </div>

    <div class="mb-4">
      <label class="block font-medium">Isi Pengumuman</label>
      <textarea name="isi" rows="5" class="w-full px-4 py-2 border rounded" required>{{ old('isi', $pengumuman->isi) }}</textarea>
    </div>

    <div class="mb-4 flex items-center space-x-2">
      <input type="checkbox" id="tampil" name="ditampilkan_di_user" class="accent-blue-600"
             {{ old('ditampilkan_di_user', $pengumuman->ditampilkan_di_user) ? 'checked' : '' }}>
      <label for="tampil" class="text-gray-700">Tampilkan ke User?</label>
    </div>

    <div class="mt-6">
      <button type="submit" class="px-4 py-2 bg-[#1E3A8A] text-white rounded hover:bg-[#1E40AF]">Perbarui</button>
      <a href="{{ route('admin.pengumumans.index') }}" class="ml-3 text-gray-600 hover:underline">Batal</a>
    </div>
  </form>
</div>
@endsection
