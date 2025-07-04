@extends('layouts.app')

@section('title', 'Tambah Pengumuman')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-xl shadow-lg">
  <h2 class="text-xl font-semibold text-[#1E3A8A] mb-4">Tambah Pengumuman</h2>

  <form action="{{ route('admin.pengumumans.store') }}" method="POST">
    @csrf

    <div class="mb-4">
      <label class="block font-medium text-gray-700">Judul</label>
      <input type="text" name="judul" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-300" value="{{ old('judul') }}" required>
      @error('judul')
        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    <div class="mb-4">
      <label class="block font-medium text-gray-700">Isi Pengumuman</label>
      <textarea name="isi" rows="5" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-300" required>{{ old('isi') }}</textarea>
      @error('isi')
        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    <div class="mb-4 flex items-center space-x-2">
      <input type="checkbox" id="tampil" name="ditampilkan_di_user" value="1" class="accent-blue-600"
             {{ old('ditampilkan_di_user') ? 'checked' : '' }}>
      <label for="tampil" class="text-gray-700">Tampilkan ke User?</label>
    </div>

    <div class="mt-6">
      <button type="submit" class="px-4 py-2 bg-[#1E3A8A] text-white rounded hover:bg-[#1E40AF]">Simpan</button>
      <a href="{{ route('admin.pengumumans.index') }}" class="ml-3 text-gray-600 hover:underline">Batal</a>
    </div>
  </form>
</div>
@endsection
