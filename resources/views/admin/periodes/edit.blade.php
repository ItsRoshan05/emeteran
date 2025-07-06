@extends('layouts.app')

@section('title', 'Edit Periode')

@section('content')
    <div class="max-w-xl mx-auto bg-white p-6 rounded-xl shadow-lg">
        <h2 class="text-xl font-semibold text-[#1E3A8A] mb-4">Edit Periode</h2>

        <form action="{{ route('admin.periodes.update', $periode->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="kode_periode" class="block font-semibold mb-1">Kode Periode</label>
                <input type="text" name="kode_periode" id="kode_periode" required class="w-full border-gray-300 rounded-md"
                    value="{{ old('kode_periode', $periode->kode_periode) }}">
            </div>

            <div class="mb-4">
                <label for="awal" class="block font-semibold mb-1">Tanggal Awal</label>
                <input type="date" name="awal" id="awal" required class="w-full border-gray-300 rounded-md"
                    value="{{ old('awal', \Carbon\Carbon::parse($periode->awal)->format('Y-m-d')) }}" </div>

                <div class="mb-4">
                    <label for="akhir" class="block font-semibold mb-1">Tanggal Akhir</label>
                    <input type="date" name="akhir" id="akhir" required class="w-full border-gray-300 rounded-md"
                        value="{{ old('awal', \Carbon\Carbon::parse($periode->akhir)->format('Y-m-d')) }}" </div>

                    <div class="mb-4">
                        <label for="status" class="block font-semibold mb-1">Status</label>
                        <select name="status" id="status" class="w-full border-gray-300 rounded-md">
                            <option value="AKTIF" {{ old('status', $periode->status) == 'AKTIF' ? 'selected' : '' }}>AKTIF
                            </option>
                            <option value="NONAKTIF" {{ old('status', $periode->status) == 'NONAKTIF' ? 'selected' : '' }}>
                                NONAKTIF</option>
                        </select>
                    </div>

                    <div class="flex justify-end">
                        <a href="{{ route('admin.periodes.index') }}"
                            class="mr-2 px-4 py-2 bg-gray-200 rounded-md">Batal</a>
                        <button type="submit" class="px-4 py-2 bg-[#1E3A8A] text-white rounded-md hover:bg-[#1E40AF]">
                            Update
                        </button>
                    </div>
        </form>
    </div>
@endsection
