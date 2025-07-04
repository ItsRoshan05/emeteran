@extends('layouts.app')

@section('title', 'Dashboard User')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded-xl shadow-md">
  <h2 class="text-2xl font-bold text-[#1E3A8A] mb-4">Dashboard Pengguna</h2>

  <div class="mb-4">
    <p class="text-gray-600">Selamat datang, <strong>{{ $user->name }}</strong></p>
  </div>

  @if ($periodeAktif)
    <div class="mb-4 p-4 rounded-lg bg-blue-50 border border-blue-200">
      <h3 class="text-lg font-semibold text-blue-900">Periode Aktif: {{ $periodeAktif->kode_periode }}</h3>
      <p class="text-sm text-gray-700">Dari {{ \Carbon\Carbon::parse($periodeAktif->awal)->format('d M Y') }} 
         sampai {{ \Carbon\Carbon::parse($periodeAktif->akhir)->format('d M Y') }}</p>
    </div>

    @if ($meteran)
      <div class="p-4 rounded-lg {{ $meteran->status_bayar === 'LUNAS' ? 'bg-green-50 border border-green-300' : 'bg-yellow-50 border border-yellow-300' }}">
        <p class="mb-2">Jumlah Pemakaian: <strong>{{ $meteran->jumlah_meteran }} m³</strong></p>
        <p>Total Tagihan: <strong>Rp {{ number_format($meteran->total_tagihan, 0, ',', '.') }}</strong></p>
        <p>Status Pembayaran: 
          <span class="font-semibold {{ $meteran->status_bayar === 'LUNAS' ? 'text-green-700' : 'text-yellow-700' }}">
            {{ $meteran->status_bayar }}
          </span>
        </p>

        @if ($meteran->status_bayar === 'LUNAS')
          <p class="mt-2 text-sm text-green-700">Terima kasih, pembayaran Anda sudah diterima.</p>
        @else
          <p class="mt-2 text-sm text-yellow-700">Silakan lakukan pembayaran secara <strong>{{ $meteran->metode_bayar ?? 'CASH' }}</strong>.</p>
        @endif
      </div>
    @else
      <div class="p-4 bg-gray-100 rounded-lg border border-gray-300">
        <p class="text-gray-700">Belum ada pencatatan meteran untuk periode ini.</p>
      </div>
    @endif

  @else
    <div class="p-4 bg-red-50 border border-red-300 rounded">
      <p class="text-red-700">Tidak ada periode aktif saat ini.</p>
    </div>
  @endif
</div>
@if ($pengumumans->count())
  <div class="mb-6">
    <h3 class="text-lg font-semibold text-indigo-800 mb-2">Pengumuman</h3>
    <ul class="space-y-3">
      @foreach ($pengumumans as $pengumuman)
        <li class="p-4 bg-indigo-50 border border-indigo-200 rounded-lg">
          <h4 class="font-bold text-indigo-900">{{ $pengumuman->judul }}</h4>
          <p class="text-sm text-gray-700">{{ $pengumuman->isi }}</p>
        </li>
      @endforeach
    </ul>
  </div>
@endif

@endsection
