<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>@yield('title', 'AdminSite')</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  @stack('styles')
</head>
<body class="bg-[#F8FAFC] min-h-screen flex overflow-x-hidden">

  
  @include('layouts.sidebar')

  <div class="flex flex-col flex-1 overflow-hidden">
    
    @include('layouts.header')

    <main class="flex-1 p-6 overflow-y-auto">
      @yield('content')
    </main>

    @include('layouts.footer')
    @stack('scripts')
  </div>
</body>
</html>
