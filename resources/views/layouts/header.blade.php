<header class="flex items-center justify-between px-6 py-4 bg-white border-b">
  <h1 class="text-2xl font-semibold text-[#0F172A]">@yield('title', 'Dashboard')</h1>
  <div class="text-sm text-[#0F172A]">Selamat datang, {{ auth()->user()->name ?? 'Admin' }}</div>
</header>
