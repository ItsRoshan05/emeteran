@php
    use Illuminate\Support\Facades\Auth;

    $active = fn($route) => request()->routeIs($route) ? 'bg-[#1E3A8A]' : '';
    $role = Auth::user()->role;
@endphp

<aside class="w-64 bg-[#0F172A] text-white flex flex-col shadow-lg">
    <div class="flex items-center justify-center h-16 border-b border-[#1E40AF]">
        <h1 class="text-2xl font-bold tracking-wide">E-Meteran</h1>
    </div>

    <nav class="flex-1 px-4 py-6 text-sm font-medium space-y-1">
        <a href="{{ route('admin.dashboard') }}"
            class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-[#1E3A8A] transition {{ $active('admin.dashboard') }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6" />
            </svg>
            <span>Dashboard</span>
        </a>

        @if ($role === 'admin')
            <!-- Data User -->
            <a href="{{ route('admin.users.index') }}"
                class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-[#1E3A8A] transition {{ $active('admin.users.*') }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m-4 4h10" />
                </svg>
                <span>Data User</span>
            </a>

            <!-- Data Pelanggan -->
            <a href="{{ route('admin.pelanggans.index') }}"
                class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-[#1E3A8A] transition {{ $active('admin.pelanggans.*') }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8c1.657 0 3-1.343 3-3S13.657 2 12 2 9 3.343 9 5s1.343 3 3 3zM6 22h12a2 2 0 002-2v-5H4v5a2 2 0 002 2z" />
                </svg>
                <span>Pelanggan</span>
            </a>

            <!-- Pengumuman -->
            <a href="{{ route('admin.pengumumans.index') }}"
                class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-[#1E3A8A] transition {{ $active('admin.pengumumans.*') }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                <span>Pengumuman</span>
            </a>

            <!-- Periode -->
            <a href="{{ route('admin.periodes.index') }}"
                class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-[#1E3A8A] transition {{ $active('admin.periodes.*') }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 4h10M5 10h14M5 14h14M5 18h14" />
                </svg>
                <span>Periode</span>
            </a>

            <!-- Tarif -->
            <a href="{{ route('admin.tarifs.index') }}"
                class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-[#1E3A8A] transition {{ $active('admin.tarifs.*') }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8c-1.657 0-3 1.343-3 3s1.343 3 3 3m0 0c1.657 0 3-1.343 3-3s-1.343-3-3-3m0 6v2m0-8V6m0 0a9 9 0 110 18 9 9 0 010-18z" />
                </svg>
                <span>Tarif</span>
            </a>
        @endif

        @if ($role === 'admin' || $role === 'petugas')
            <!-- Meteran -->
            <a href="{{ route('meterans.index') }}"
                class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-[#1E3A8A] transition {{ $active('admin.meterans.*') }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m2 0a8 8 0 11-16 0 8 8 0 0116 0z" />
                </svg>
                <span>Meteran</span>
            </a>
        @endif
    </nav>

    <!-- Logout -->
    <div class="px-4 py-4 border-t border-[#1E3A8A]">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button
                class="flex items-center gap-2 w-full px-3 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1m0-9V7" />
                </svg>
                Keluar
            </button>
        </form>
    </div>
</aside>
