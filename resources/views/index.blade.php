<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>e-Meteran - Sistem Pencatatan Air</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 font-inter">

  <!-- Hero Section -->
  <section class="bg-white shadow">
    <div class="max-w-6xl mx-auto px-6 py-16 flex flex-col lg:flex-row items-center justify-between gap-10">
      <div class="flex-1">
        <h1 class="text-4xl md:text-5xl font-bold text-[#1E3A8A] leading-tight mb-6">
          Selamat Datang di <br><span class="text-blue-600">e-Meteran</span>
        </h1>
        <p class="text-lg text-gray-600 mb-8">
          Aplikasi pencatatan pemakaian air berbasis web untuk pelanggan eksternal. Efisien, praktis, dan sangat mudah digunakan.
        </p>
        <a href="{{ route('login') }}"
           class="inline-block px-6 py-3 bg-[#1E3A8A] text-white text-lg rounded-md hover:bg-[#1E40AF] transition">
          Masuk Aplikasi
        </a>
      </div>
      <div class="flex-1">
        <img src="https://cdn-icons-png.flaticon.com/512/2706/2706950.png"
             alt="Ilustrasi Water Meter" class="w-full max-w-sm mx-auto drop-shadow-xl">
      </div>
    </div>
  </section>

  <!-- Fitur Section -->
  <section class="py-20 bg-gray-100">
    <div class="max-w-6xl mx-auto px-6 text-center">
      <h2 class="text-3xl font-semibold text-[#1E3A8A] mb-12">Fitur Unggulan</h2>
      <div class="grid md:grid-cols-3 gap-8 text-left">
        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
          <h3 class="text-xl font-semibold text-blue-700 mb-3">Pencatatan Meteran</h3>
          <p class="text-gray-600">Petugas mencatat penggunaan air pelanggan langsung melalui sistem berbasis web.</p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
          <h3 class="text-xl font-semibold text-blue-700 mb-3">Pembayaran Tunai</h3>
          <p class="text-gray-600">Mendukung metode pembayaran langsung (cash) untuk kemudahan transaksi di lapangan.</p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
          <h3 class="text-xl font-semibold text-blue-700 mb-3">Laporan Otomatis</h3>
          <p class="text-gray-600">Admin dapat memantau laporan pemakaian dan pembayaran secara otomatis dan real-time.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-[#1E3A8A] text-white py-6 text-center">
    <p>&copy; {{ date('Y') }} e-Meteran | Dikembangkan oleh </p>
  </footer>

</body>
</html>
