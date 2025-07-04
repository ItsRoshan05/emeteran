@extends('layouts.app')

@section('title', 'Data Tarif')

@section('content')
<div class="bg-white rounded-xl shadow-lg p-6">
  <div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-semibold text-[#1E3A8A]">Data Tarif</h2>
    <a href="{{ route('admin.tarifs.create') }}"
       class="inline-block px-4 py-2 bg-[#1E3A8A] text-white rounded-md hover:bg-[#1E40AF]">+ Tambah Tarif</a>
  </div>

  @if (session('success'))
  <div class="mb-4 px-4 py-3 bg-green-100 border border-green-300 text-green-800 rounded-md shadow-sm">
    {{ session('success') }}
  </div>
  @endif

  {{-- Search --}}
  <div class="mb-4">
    <input type="text" id="customSearch" placeholder="🔍 Cari keterangan tarif..."
           class="w-full md:w-1/3 px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-600">
  </div>

  <div class="overflow-x-auto rounded-xl shadow-inner">
    <table id="tableTarif" class="min-w-full text-sm text-gray-800 bg-white border-separate" style="border-spacing: 0">
      <thead class="bg-[#0F172A] text-white">
        <tr>
          <th class="px-5 py-3 text-left rounded-tl-xl">#</th>
          <th class="px-5 py-3 text-left">Harga per M³</th>
          <th class="px-5 py-3 text-left">Keterangan</th>
          <th class="px-5 py-3 text-left rounded-tr-xl">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($tarifs as $tarif)
        <tr class="hover:bg-blue-50 border-b border-gray-200">
          <td class="px-5 py-4">{{ $loop->iteration }}</td>
          <td class="px-5 py-4">Rp {{ number_format($tarif->harga_per_m3, 0, ',', '.') }}</td>
          <td class="px-5 py-4">{{ $tarif->keterangan }}</td>
          <td class="px-5 py-4 space-x-2 whitespace-nowrap">
            <a href="{{ route('admin.tarifs.edit', $tarif->id) }}"
               class="text-blue-600 hover:text-blue-800 transition" title="Edit">
              <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M11 4h10M5 20h14a2 2 0 002-2v-5M16 4l4 4m0 0L10 18H6v-4L20 4z"/>
              </svg>
            </a>
            <form action="{{ route('admin.tarifs.destroy', $tarif->id) }}" method="POST" class="inline-block"
                  onsubmit="return confirm('Yakin ingin menghapus tarif ini?')">
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
    const table = $('#tableTarif').DataTable({
      dom: 'lrtip',
      language: {
        lengthMenu: "Tampilkan _MENU_ tarif",
        info: "Menampilkan _START_ - _END_ dari _TOTAL_ tarif",
        paginate: {
          next: "›", previous: "‹"
        },
        zeroRecords: "Tarif tidak ditemukan",
      }
    });

    $('#customSearch').on('keyup', function () {
      table.search(this.value).draw();
    });
  });
</script>
@endpush
