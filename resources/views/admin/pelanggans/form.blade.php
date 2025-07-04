@csrf
<div class="mb-4">
  <label class="block mb-1 text-gray-700">Nama Pelanggan</label>
  <input type="text" name="nama_pelanggan" value="{{ old('nama_pelanggan', $pelanggan->nama_pelanggan ?? '') }}"
         class="w-full px-4 py-2 border rounded-md shadow-sm focus:ring-blue-500" required>
</div>

<div class="mb-4">
  <label class="block mb-1 text-gray-700">No HP</label>
  <input type="text" name="no_hp" value="{{ old('no_hp', $pelanggan->no_hp ?? '') }}"
         class="w-full px-4 py-2 border rounded-md shadow-sm focus:ring-blue-500" required>
</div>

<div class="mb-4">
  <label class="block mb-1 text-gray-700">Email</label>
  <input type="email" name="email" value="{{ old('email', $pelanggan->email ?? '') }}"
         class="w-full px-4 py-2 border rounded-md shadow-sm focus:ring-blue-500" required>
</div>

<div class="mb-4">
  <label class="block mb-1 text-gray-700">Alamat</label>
  <textarea name="alamat" rows="3" class="w-full px-4 py-2 border rounded-md shadow-sm focus:ring-blue-500">{{ old('alamat', $pelanggan->alamat ?? '') }}</textarea>
</div>

<div class="mb-4">
  <label class="block mb-1 text-gray-700">Keterangan</label>
  <textarea name="keterangan" rows="2" class="w-full px-4 py-2 border rounded-md shadow-sm focus:ring-blue-500">{{ old('keterangan', $pelanggan->keterangan ?? '') }}</textarea>
</div>
