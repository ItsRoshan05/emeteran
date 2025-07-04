@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')
<div class="bg-white rounded-xl shadow p-6 max-w-xl mx-auto">
  <h2 class="text-xl font-semibold text-[#1E3A8A] mb-4">Tambah User</h2>

  <form action="{{ route('admin.users.store')}} " method="POST" class="space-y-4">
    @csrf

    <div>
      <label for="name" class="block font-medium mb-1 text-gray-700">Nama</label>
      <input type="text" name="name" id="name"
             class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none"
             placeholder="Nama lengkap">
    </div>

    <div>
      <label for="email" class="block font-medium mb-1 text-gray-700">Email</label>
      <input type="email" name="email" id="email"
             class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none"
             placeholder="Alamat email">
    </div>

    <div>
      <label for="role" class="block font-medium mb-1 text-gray-700">Role</label>
      <select name="role" id="role"
              class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none">
        <option value="">-- Pilih Role --</option>
        <option value="admin">Admin</option>
        <option value="petugas">Petugas</option>
        <option value="user">User</option>
      </select>
    </div>

    <div>
      <label for="password" class="block font-medium mb-1 text-gray-700">Password</label>
      <input type="password" name="password" id="password"
             class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none"
             placeholder="Password user">
    </div>

    <div class="text-right">
      <button type="submit"
              class="px-5 py-2 bg-[#1E3A8A] text-white rounded-md hover:bg-[#1E40AF] transition-all">
        Simpan
      </button>
    </div>
  </form>
</div>
@endsection
