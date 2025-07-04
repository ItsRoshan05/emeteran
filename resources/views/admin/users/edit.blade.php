@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="bg-white rounded-xl shadow p-6 max-w-xl mx-auto">
  <h2 class="text-xl font-semibold text-[#1E3A8A] mb-4">Edit User</h2>
  <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
      <label for="name" class="block font-medium mb-1 text-gray-700">Nama</label>
      <input type="text" name="name" id="name" value="{{ $user->name }}"
             class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none">
    </div>

    <div>
      <label for="email" class="block font-medium mb-1 text-gray-700">Email</label>
      <input type="email" name="email" id="email" value="{{ $user->email }}"
             class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none">
    </div>

    <div>
      <label for="role" class="block font-medium mb-1 text-gray-700">Role</label>
      <select name="role" id="role"
              class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none">
        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
        <option value="petugas" {{ $user->role === 'petugas' ? 'selected' : '' }}>Petugas</option>
        <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
      </select>
    </div>

    <div class="text-sm text-gray-500 italic">* Biarkan password kosong jika tidak ingin mengubahnya.</div>
    <div>
      <label for="password" class="block font-medium mb-1 text-gray-700">Password Baru</label>
      <input type="password" name="password" id="password"
             class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none"
             placeholder="Isi jika ingin mengganti password">
    </div>

    <div class="text-right">
      <button type="submit"
              class="px-5 py-2 bg-[#1E3A8A] text-white rounded-md hover:bg-[#1E40AF] transition-all">
        Update
      </button>
    </div>
  </form>
</div>
@endsection
