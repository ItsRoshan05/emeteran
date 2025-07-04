@extends('layouts.app')

@section('title', 'Tambah Meteran')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
  <h2 class="text-2xl font-semibold text-[#1E3A8A] mb-6">Tambah Data Meteran</h2>

  <form action="{{ route('admin.meterans.store') }}" method="POST">
    @csrf

    <div class="grid md:grid-cols-2 gap-4 mb-4">
      {{-- PILIH PELANGGAN --}}
      <div>
        <label for="pelanggan_id" class="block font-medium">Pelanggan</label>
        <select name="pelanggan_id" id="pelanggan_id" class="select2 w-full border-gray-300 rounded-md">
          <option value="">-- Pilih Pelanggan --</option>
          @foreach ($pelanggans as $pelanggan)
            <option value="{{ $pelanggan->id }}">
              {{ $pelanggan->nama_pelanggan }} ({{ $pelanggan->user->email ?? '-' }})
            </option>
          @endforeach
        </select>
      </div>

      {{-- PILIH PERIODE --}}
      <div>
        <label for="periode_id" class="block font-medium">Periode</label>
        <select name="periode_id" class="w-full border-gray-300 rounded-md">
          <option value="">-- Pilih Periode --</option>
          @foreach ($periodes as $periode)
            <option value="{{ $periode->id }}">
              {{ $periode->kode_periode }} ({{ \Carbon\Carbon::parse($periode->awal)->format('d-m-Y') }} s.d {{ \Carbon\Carbon::parse($periode->akhir)->format('d-m-Y') }})
            </option>
          @endforeach
        </select>
      </div>

      {{-- PILIH TARIF --}}
      <div>
        <label for="tarif" class="block font-medium">Tarif</label>
        <select name="tarif" id="tarif" class="w-full border-gray-300 rounded-md">
          <option value="">-- Pilih Tarif --</option>
          @foreach ($tarifs as $tarif)
            <option value="{{ $tarif->harga_per_m3 }}">
              {{ $tarif->keterangan }} - Rp{{ number_format($tarif->harga_per_m3, 0, ',', '.') }}
            </option>
          @endforeach
        </select>
      </div>

      {{-- JUMLAH METERAN --}}
      <div>
        <label for="jumlah_meteran" class="block font-medium">Jumlah Meteran</label>
        <input type="number" step="0.01" name="jumlah_meteran" id="jumlah_meteran" class="w-full border-gray-300 rounded-md" required>
      </div>

      {{-- TOTAL TAGIHAN (OTOMATIS) --}}
      <div>
        <label for="total_tagihan_display" class="block font-medium">Total Tagihan</label>
        <input type="text" id="total_tagihan_display" class="w-full border-gray-300 rounded-md bg-gray-100" readonly placeholder="Rp 0">
        <input type="hidden" name="total_tagihan" id="total_tagihan">
      </div>

      {{-- STATUS BAYAR --}}
      <div>
        <label for="status_bayar" class="block font-medium">Status Bayar</label>
        <select name="status_bayar" class="w-full border-gray-300 rounded-md">
          <option value="BELUM">BELUM</option>
          <option value="LUNAS">LUNAS</option>
        </select>
      </div>

      {{-- METODE BAYAR --}}
      <div>
        <label for="metode_bayar" class="block font-medium">Metode Bayar</label>
        <select name="metode_bayar" class="w-full border-gray-300 rounded-md">
          <option value="">-- Pilih --</option>
          <option value="CASH">CASH</option>
        </select>
      </div>

      {{-- TANGGAL BAYAR --}}
      <div>
        <label for="tanggal_bayar" class="block font-medium">Tanggal Bayar</label>
        <input type="date" name="tanggal_bayar" class="w-full border-gray-300 rounded-md">
      </div>

      {{-- PILIH PETUGAS --}}
      <div>
        <label for="petugas_id" class="block font-medium">Petugas</label>
        <select name="petugas_id" class="w-full border-gray-300 rounded-md">
          <option value="">-- Pilih Petugas --</option>
          @foreach ($petugas as $user)
            <option value="{{ $user->id }}">{{ $user->name ?? $user->email }}</option>
          @endforeach
        </select>
      </div>
    </div>

    <button type="submit" class="bg-blue-700 text-white px-4 py-2 rounded-md hover:bg-blue-800">Simpan</button>
  </form>
</div>
@endsection

@push('styles')
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('scripts')
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script>
    function formatRupiah(angka) {
      return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
      }).format(angka);
    }

    $(document).ready(function() {
      $('.select2').select2({
        placeholder: "Cari pelanggan...",
        allowClear: true
      });

      $('#jumlah_meteran, #tarif').on('input change', function () {
        let jumlah = parseFloat($('#jumlah_meteran').val()) || 0;
        let tarif = parseFloat($('#tarif').val()) || 0;
        let total = jumlah * tarif;

        $('#total_tagihan_display').val(formatRupiah(total));
        $('#total_tagihan').val(total);
      });
    });
  </script>
@endpush
