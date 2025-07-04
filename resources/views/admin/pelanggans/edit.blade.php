@extends('layouts.app')

@section('title', 'Edit Pelanggan')

@section('content')
<div class="bg-white rounded-xl shadow p-6 max-w-2xl mx-auto">
  <h2 class="text-xl font-semibold text-[#1E3A8A] mb-4">Edit Pelanggan</h2>
  <form action="{{ route('admin.pelanggans.update', $pelanggan->id) }}" method="POST">
    @method('PUT')
    @include('admin.pelanggans.form')
    <div class="mt-4">
      <button type="submit" class="px-4 py-2 bg-[#1E3A8A] text-white rounded hover:bg-[#1E40AF]">Update</button>
      <a href="{{ route('admin.pelanggans.index') }}" class="ml-2 text-gray-600 hover:underline">Batal</a>
    </div>
  </form>
</div>
@endsection
