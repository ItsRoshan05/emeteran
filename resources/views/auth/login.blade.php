@extends('layouts.guest')

@section('title', 'Login')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
  <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-md">
    <h2 class="text-2xl font-bold text-center text-blue-800 mb-6">Login</h2>

    @if(session('error'))
      <div class="mb-4 text-sm text-red-600 bg-red-100 rounded-md px-4 py-2">
        {{ session('error') }}
      </div>
    @endif

    <form action="" method="POST" class="space-y-4">
      @csrf
      <div>
        <label for="email" class="block text-gray-700 font-medium">Email</label>
        <input type="email" name="email" id="email" required autofocus
               class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
      </div>
      <div>
        <label for="password" class="block text-gray-700 font-medium">Password</label>
        <input type="password" name="password" id="password" required
               class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
      </div>

      <button type="submit"
              class="w-full bg-blue-700 text-white py-2 px-4 rounded-md hover:bg-blue-800 transition">
        Masuk
      </button>
    </form>

  </div>
</div>
@endsection
