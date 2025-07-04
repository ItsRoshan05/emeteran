@extends('layouts.app')

@section('title', 'Data Pengumuman')

@section('content')
<div class="bg-white rounded-xl shadow-lg p-6">
  <div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-semibold text-[#1E3A8A]">Data Pengumuman</h2>
    <a href="{{ route('admin.pengumumans.create') }}"
       class="inline-block px-4 py-2 bg-[#1E3A8A] text-white rounded-md hover:bg-[#1E40AF]">
      + Tambah Pengumuman
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
    <input type="text" id="customSearch" placeholder="🔍 Cari judul pengumuman..."
           class="w-full md:w-1/3 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-600 focus:outline-none">
  </div>

  <div class="overflow-x-auto rounded-xl shadow-inner">
    <table id="tablePengumuman" class="min-w-full text-sm text-gray-800 bg-white border-separate" style="border-spacing: 0">
      <thead class="bg-[#0F172A] text-white">
        <tr>
          <th class="px-5 py-3 text-left rounded-tl-xl">#</th>
          <th class="px-5 py-3 text-left">Judul</th>
          <th class="px-5 py-3 text-left">Tampil di User?</th>
          <th class="px-5 py-3 text-left rounded-tr-xl">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($pengumumans as $item)
        <tr class="hover:bg-blue-50 border-b border-gray-200 transition duration-150">
          <td class="px-5 py-4">{{ $loop->iteration }}</td>
          <td class="px-5 py-4">{{ $item->judul }}</td>
<td class="px-5 py-4">
<label class="relative inline-flex items-center cursor-pointer">
  <input type="checkbox" class="sr-only toggle-status" data-id="{{ $item->id }}" {{ $item->ditampilkan_di_user ? 'checked' : '' }}>
  <div class="toggle-bg w-11 h-6 bg-gray-300 rounded-full transition">
    <div class="dot absolute left-1 top-0.5 w-5 h-5 bg-white rounded-full shadow transition"></div>
  </div>
</label>

</td>

          <td class="px-5 py-4 space-x-2 whitespace-nowrap">
            <a href="{{ route('admin.pengumumans.edit', $item->id) }}"
               class="inline-block text-blue-600 hover:text-blue-800 transition" title="Edit">
              <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M11 4h10M5 20h14a2 2 0 002-2v-5M16 4l4 4m0 0L10 18H6v-4L20 4z"/>
              </svg>
            </a>
            <form action="{{ route('admin.pengumumans.destroy', $item->id) }}" method="POST" class="inline-block"
                  onsubmit="return confirm('Yakin ingin menghapus pengumuman ini?')">
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

  .toggle-bg {
    transition: background-color 0.3s ease;
  }
  .dot {
    transition: transform 0.3s ease, background-color 0.3s ease;
  }
  input:checked + .toggle-bg {
    background-color: #22C55E; /* Warna hijau saat aktif */
  }
  input:checked + .toggle-bg .dot {
    transform: translateX(1.25rem); /* Geser ke kanan */
    background-color: #fff; /* Warna dot tetap putih */
  }
  body.swal2-shown {
    overflow-y: auto !important;
  }


</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
  $(document).ready(function () {
    const table = $('#tablePengumuman').DataTable({
      responsive: true,
      dom: 'lrtip',
      language: {
        lengthMenu: "Tampilkan _MENU_ pengumuman",
        info: "Menampilkan _START_ - _END_ dari _TOTAL_ pengumuman",
        paginate: {
          first: "Pertama", last: "Terakhir", next: "›", previous: "‹"
        },
        zeroRecords: "Pengumuman tidak ditemukan",
      }
    });

    $('#customSearch').on('keyup', function () {
      table.search(this.value).draw();
    });
  });
</script>

<script>
  // SweetAlert custom: cegah scroll body saat modal tampil
  const swalCustom = Swal.mixin({
    didOpen: () => {
      document.body.style.overflow = 'hidden';
    },
    didClose: () => {
      document.body.style.overflow = '';
    }
  });

  $(document).on('change', '.toggle-status', function () {
    const pengumumanId = $(this).data('id');
    const isChecked = $(this).is(':checked');
    const switchEl = $(this);

    $.ajax({
      url: `/admin/pengumumans/${pengumumanId}/toggle`,
      method: 'PATCH',
      data: {
        _token: '{{ csrf_token() }}'
      },
      success: function (res) {
        swalCustom.fire({
          icon: 'success',
          title: 'Berhasil!',
          text: res.status ? 'Pengumuman ditampilkan ke user.' : 'Pengumuman disembunyikan dari user.',
          timer: 1500,
          showConfirmButton: false
        });

        const dot = switchEl.next('.toggle-bg').find('.dot');
        if (res.status) {
          dot.addClass('translate-x-full bg-green-500');
        } else {
          dot.removeClass('translate-x-full bg-green-500');
        }
      },
      error: function () {
        swalCustom.fire({
          icon: 'error',
          title: 'Gagal!',
          text: 'Gagal mengubah status. Silakan coba lagi.'
        });
        switchEl.prop('checked', !isChecked);
      }
    });
  });
</script>
@endpush
