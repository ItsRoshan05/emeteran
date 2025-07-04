@extends('layouts.app')

@section('title', 'Data Pelanggan')

@section('content')
<div class="bg-white rounded-xl shadow-lg p-6">
  <div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-semibold text-[#1E3A8A]">Data Pelanggan</h2>
    <a href="{{ route('admin.pelanggans.create') }}"
       class="inline-block px-4 py-2 bg-[#1E3A8A] text-white rounded-md hover:bg-[#1E40AF] transition-all duration-200">
      + Tambah Pelanggan
    </a>
  </div>

  @if (session('success'))
    <div class="mb-4 px-4 py-3 bg-green-100 border border-green-300 text-green-800 rounded-md shadow-sm">
      {{ session('success') }}
    </div>
  @endif

  @if (session('error'))
    <div class="mb-4 px-4 py-3 bg-red-100 border border-red-300 text-red-800 rounded-md shadow-sm">
      {{ session('error') }}
    </div>
  @endif

  {{-- Search Manual --}}
  <div class="mb-4">
    <input type="text" id="customSearch" placeholder="🔍 Cari nama atau nomor HP..."
           class="w-full md:w-1/3 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-600 focus:outline-none">
  </div>

  <div class="overflow-x-auto rounded-xl shadow-inner">
    <table id="tablePelanggan" class="min-w-full text-sm text-gray-800 bg-white border-separate" style="border-spacing: 0">
      <thead class="bg-[#0F172A] text-white">
        <tr>
          <th class="px-5 py-3 text-left rounded-tl-xl">#</th>
          <th class="px-5 py-3 text-left">Nama</th>
          <th class="px-5 py-3 text-left">No HP</th>
          <th class="px-5 py-3 text-left">Alamat</th>
          <th class="px-5 py-3 text-left">Keterangan</th>
          <th class="px-5 py-3 text-left rounded-tr-xl">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($pelanggans as $pelanggan)
        <tr class="hover:bg-blue-50 border-b border-gray-200 transition duration-150">
          <td class="px-5 py-4">{{ $loop->iteration }}</td>
          <td class="px-5 py-4">{{ $pelanggan->nama_pelanggan }}</td>
          <td class="px-5 py-4">{{ $pelanggan->no_hp }}</td>
          <td class="px-5 py-4">{{ $pelanggan->alamat }}</td>
          <td class="px-5 py-4">{{ $pelanggan->keterangan }}</td>
          <td class="px-5 py-4 space-x-2 whitespace-nowrap">
            <a href="{{ route('admin.pelanggans.edit', $pelanggan->id) }}"
               class="inline-block text-blue-600 hover:text-blue-800 transition" title="Edit">
              <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M11 4h10M5 20h14a2 2 0 002-2v-5M16 4l4 4m0 0L10 18H6v-4L20 4z"/>
              </svg>
            </a>
            <form action="{{ route('admin.pelanggans.destroy', $pelanggan->id) }}" method="POST" class="inline-block"
                  onsubmit="return confirm('Yakin ingin menghapus pelanggan ini?')">
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
<style>
  table.dataTable {
    border-collapse: collapse !important;
    width: 100%;
  }
  table.dataTable thead th {
    background-color: #0F172A;
    color: #fff;
    padding: 12px 20px;
    text-align: left;
  }
  table.dataTable tbody td {
    padding: 12px 20px;
  }
  table.dataTable tbody tr:hover {
    background-color: #DBEAFE;
  }

  .dataTables_wrapper .dataTables_length {
    margin-bottom: 1rem;
    font-size: 0.875rem;
    color: #4B5563;
  }
  .dataTables_wrapper .dataTables_length select {
    padding: 0.4rem 0.6rem;
    border-radius: 0.5rem;
    border: 1px solid #D1D5DB;
    margin-left: 0.5rem;
    background-color: white;
    color: #1E3A8A;
    font-weight: 500;
  }

  .dataTables_wrapper .dataTables_info {
    margin-top: 1rem;
    font-size: 0.875rem;
    color: #4B5563;
  }

  .dataTables_wrapper .dataTables_paginate {
    margin-top: 1rem;
    text-align: right;
  }
  .dataTables_wrapper .dataTables_paginate .paginate_button {
    padding: 0.4rem 0.8rem;
    margin: 0 0.2rem;
    border-radius: 0.5rem;
    background-color: #E5E7EB;
    color: #1E3A8A !important;
    border: none;
    font-weight: 600;
  }
  .dataTables_wrapper .dataTables_paginate .paginate_button.current,
  .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
    background-color: #1E3A8A !important;
    color: white !important;
  }
</style>
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
  $(document).ready(function () {
    const table = $('#tablePelanggan').DataTable({
      responsive: true,
      dom: 'lrtip',
      language: {
        lengthMenu: "Tampilkan _MENU_ pelanggan",
        info: "Menampilkan _START_ - _END_ dari _TOTAL_ pelanggan",
        paginate: {
          first: "Pertama", last: "Terakhir", next: "›", previous: "‹"
        },
        zeroRecords: "Pelanggan tidak ditemukan",
      }
    });

    $('#customSearch').on('keyup', function () {
      table.search(this.value).draw();
    });
  });
</script>
@endpush
