@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 gap-4 mt-6 md:grid-cols-2 xl:grid-cols-3">
  <div class="p-4 bg-white rounded-xl shadow">
    <h2 class="text-sm text-gray-500">Total Pelanggan</h2>
    <p class="mt-1 text-2xl font-bold text-[#1E40AF]">{{ $totalPelanggan }}</p>
  </div>
  <div class="p-4 bg-white rounded-xl shadow">
    <h2 class="text-sm text-gray-500">Belum Bayar</h2>
    <p class="mt-1 text-2xl font-bold text-red-500">{{ $belumBayar }}</p>
  </div>
  <div class="p-4 bg-white rounded-xl shadow">
    <h2 class="text-sm text-gray-500">Total Pembayaran</h2>
    <p class="mt-1 text-2xl font-bold text-green-500">Rp {{ number_format($totalPembayaran, 0, ',', '.') }}</p>
  </div>
</div>


{{-- Chart Section --}}
<div class="mt-8 bg-white rounded-xl shadow p-6">
  <h3 class="text-lg font-semibold text-[#1E3A8A] mb-4">Statistik Pembayaran Bulanan</h3>
  <canvas id="paymentChart" height="100"></canvas>
</div>



@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const chartLabels = {!! json_encode($chartData->pluck('bulan')) !!};
  const chartData = {!! json_encode($chartData->pluck('total')) !!};

  const ctx = document.getElementById('paymentChart').getContext('2d');
  const paymentChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: chartLabels,
      datasets: [{
        label: 'Pembayaran (Rp)',
        data: chartData,
        backgroundColor: '#1E40AF',
        borderRadius: 6,
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          display: false
        }
      },
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            callback: function(value) {
              return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
            }
          }
        }
      }
    }
  });
</script>
@endpush

