@extends('layouts.guest')

@section('title', 'Register')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
  <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-md">
    <h2 class="text-2xl font-bold text-center text-blue-800 mb-6">Daftar Akun</h2>

    <form action="{{ route('register') }}" method="POST" class="space-y-4">
      @csrf
      <div>
        <label for="name" class="block text-gray-700 font-medium">Nama</label>
        <input type="text" name="name" id="name" required
               class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
      </div>

      <div>
        <label for="email" class="block text-gray-700 font-medium">Email</label>
        <input type="email" name="email" id="email" required
               class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
      </div>

      <div>
        <label for="password" class="block text-gray-700 font-medium">Password</label>
        <input type="password" name="password" id="password" required
               class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
      </div>

      <div>
        <label for="password_confirmation" class="block text-gray-700 font-medium">Konfirmasi Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation" required
               class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
      </div>

      <button type="submit"
              class="w-full bg-blue-700 text-white py-2 px-4 rounded-md hover:bg-blue-800 transition">
        Daftar
      </button>
    </form>

    <p class="text-center text-sm text-gray-600 mt-6">
      Sudah punya akun?
      <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Masuk di sini</a>
    </p>
  </div>
</div>
@endsection
