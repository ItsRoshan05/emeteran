@extends('layouts.app')

@section('title', 'Data Meteran')

@section('content')
<div class="bg-white rounded-xl shadow-lg p-6">
  <div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-semibold text-[#1E3A8A]">Data Meteran</h2>
    <a href="{{ route('admin.meterans.create') }}"
       class="px-4 py-2 bg-[#1E3A8A] text-white rounded-md hover:bg-[#1E40AF] transition-all duration-200">
      + Tambah Meteran
    </a>
  </div>

  @if (session('success'))
  <div class="mb-4 px-4 py-3 bg-green-100 border border-green-300 text-green-800 rounded-md shadow-sm">
    {{ session('success') }}
  </div>
  @endif

  <div class="mb-4">
    <input type="text" id="customSearch" placeholder="🔍 Cari pelanggan atau periode..."
           class="w-full md:w-1/3 px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-600">
  </div>

  <div class="overflow-x-auto rounded-xl shadow-inner">
    <table id="tableMeteran" class="min-w-full text-sm text-gray-800 bg-white border-separate" style="border-spacing: 0">
      <thead class="bg-[#0F172A] text-white">
        <tr>
          <th class="px-5 py-3 text-left rounded-tl-xl">#</th>
          <th class="px-5 py-3 text-left">Pelanggan</th>
          <th class="px-5 py-3 text-left">Periode</th>
          <th class="px-5 py-3 text-left">Jumlah Meteran</th>
          <th class="px-5 py-3 text-left">Total Tagihan</th>
          <th class="px-5 py-3 text-left">Status Bayar</th>
          <th class="px-5 py-3 text-left">Tanggal Bayar</th>
          <th class="px-5 py-3 text-left">Aksi</th>
          <th class="px-5 py-3 text-left rounded-tr-xl">Tandai Lunas</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($meterans as $meteran)
        <tr class="hover:bg-blue-50 border-b border-gray-200 transition duration-150">
          <td class="px-5 py-4">{{ $loop->iteration }}</td>
          <td class="px-5 py-4">{{ $meteran->pelanggan->nama_pelanggan ?? '-' }}</td>
          <td class="px-5 py-4">{{ $meteran->periode->kode_periode ?? '-' }}</td>
          <td class="px-5 py-4">{{ number_format($meteran->jumlah_meteran, 2) }}</td>
          <td class="px-5 py-4">Rp{{ number_format($meteran->total_tagihan, 0, ',', '.') }}</td>
          <td class="px-5 py-4">
            <span class="inline-block px-2 py-1 text-xs rounded-md font-semibold {{ $meteran->status_bayar === 'LUNAS' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
              {{ $meteran->status_bayar }}
            </span>
          </td>
          <td class="px-5 py-4">
            {{ $meteran->tanggal_bayar ? \Carbon\Carbon::parse($meteran->tanggal_bayar)->format('d-m-Y') : '-' }}
          </td>
          <td class="px-5 py-4 space-x-2 whitespace-nowrap">
            <a href="{{ route('admin.meterans.edit', $meteran->id) }}"
               class="text-blue-600 hover:text-blue-800 transition" title="Edit">
              <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M11 4h10M5 20h14a2 2 0 002-2v-5M16 4l4 4m0 0L10 18H6v-4L20 4z"/>
              </svg>
            </a>
            <form action="{{ route('admin.meterans.destroy', $meteran->id) }}" method="POST" class="inline-block"
                  onsubmit="return confirm('Yakin ingin menghapus data ini?')">
              @csrf
              @method('DELETE')
              <button type="submit" class="text-red-600 hover:text-red-800 transition" title="Hapus">
                <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4m-4 0a1 1 0 00-1 1v1h6V4a1 1 0 00-1-1m-4 0h4"/>
                </svg>
              </button>
            </form>
          </td>
          <td class="px-5 py-4 space-x-2 whitespace-nowrap">
  @if ($meteran->status_bayar === 'BELUM')
    <form action="{{ route('admin.meterans.markAsLunas', $meteran->id) }}" method="POST" onsubmit="return confirm('Tandai meteran ini sebagai LUNAS?')">
      @csrf
      @method('PATCH')
      <button type="submit" class="text-green-600 hover:text-green-800 font-semibold text-sm">
        Tandai LUNAS
      </button>
    </form>
  @else
    <span class="text-green-600 font-semibold text-sm">LUNAS</span>
  @endif
</td>

        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
  $(document).ready(function () {
    const table = $('#tableMeteran').DataTable({
      dom: 'lrtip',
      language: {
        lengthMenu: "Tampilkan _MENU_ data",
        info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
        paginate: {
          next: "›", previous: "‹"
        },
        zeroRecords: "Data tidak ditemukan",
      }
    });

    $('#customSearch').on('keyup', function () {
      table.search(this.value).draw();
    });
  });
</script>
@endpush
