@extends('layouts.app')

@section('title', 'Tambah Tarif')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-xl shadow-lg">
  <h2 class="text-xl font-semibold text-[#1E3A8A] mb-4">Tambah Tarif</h2>

  <form action="{{ route('admin.tarifs.store') }}" method="POST">
    @csrf

    <div class="mb-4">
      <label class="block font-medium text-gray-700">Harga per m³</label>
      <input type="number" name="harga_per_m3" step="0.01" min="0"
             class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-300"
             value="{{ old('harga_per_m3') }}" required>
      @error('harga_per_m3')
        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    <div class="mb-4">
      <label class="block font-medium text-gray-700">Keterangan</label>
      <textarea name="keterangan" rows="3"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-300">{{ old('keterangan') }}</textarea>
      @error('keterangan')
        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    <div class="mt-6">
      <button type="submit" class="px-4 py-2 bg-[#1E3A8A] text-white rounded hover:bg-[#1E40AF]">Simpan</button>
      <a href="{{ route('admin.tarifs.index') }}" class="ml-3 text-gray-600 hover:underline">Batal</a>
    </div>
  </form>
</div>
@endsection
