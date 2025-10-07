@extends('layouts.main')

@section('title', 'Master Jenis Cuti')

@section('content')
<div class="flex justify-between items-center mb-6">
  <h2 class="text-2xl font-bold text-slate-700">Master Jenis Cuti</h2>

  <!-- Tombol Tambah Data -->
  <button 
    type="button" 
    class="bg-gradient-to-r from-[#842A3B] to-[#C95A6B] text-white px-5 py-2 rounded-lg text-sm font-semibold shadow-md hover:scale-105 hover:opacity-90 transition"
    data-bs-toggle="modal" 
    data-bs-target="#tambahCutiModal">
    + Tambah Jenis Cuti
  </button>
</div>

<!-- TABEL DATA -->
<div class="bg-white rounded-2xl shadow-md overflow-hidden">
  <table class="min-w-full text-sm text-gray-700 border border-gray-200">
    <thead>
      <tr class="bg-gradient-to-r from-[#842A3B]/10 to-[#C95A6B]/10 text-slate-700 font-semibold border-b">
        <th class="py-3 px-4 text-left">No</th>
        <th class="py-3 px-4 text-left">Nama Jenis Cuti</th>
        <th class="py-3 px-4 text-left">Jumlah Hari</th>
        <th class="py-3 px-4 text-left">Keterangan</th>
        <th class="py-3 px-4 text-center">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <tr class="border-b hover:bg-gray-50 transition">
        <td class="py-3 px-4">1</td>
        <td class="py-3 px-4">Cuti Tahunan</td>
        <td class="py-3 px-4">12</td>
        <td class="py-3 px-4">Cuti rutin tiap tahun</td>
        <td class="py-3 px-4 text-center space-x-2">
          <button class="text-blue-600 hover:text-blue-800">
            <i class="fa-solid fa-pen-to-square"></i>
          </button>
          <button class="text-red-600 hover:text-red-800">
            <i class="fa-solid fa-trash"></i>
          </button>
        </td>
      </tr>
      <tr class="border-b hover:bg-gray-50 transition">
        <td class="py-3 px-4">2</td>
        <td class="py-3 px-4">Cuti Melahirkan</td>
        <td class="py-3 px-4">90</td>
        <td class="py-3 px-4">Untuk pegawai wanita</td>
        <td class="py-3 px-4 text-center space-x-2">
          <button class="text-blue-600 hover:text-blue-800">
            <i class="fa-solid fa-pen-to-square"></i>
          </button>
          <button class="text-red-600 hover:text-red-800">
            <i class="fa-solid fa-trash"></i>
          </button>
        </td>
      </tr>
    </tbody>
  </table>
</div>

<!-- MODAL TAMBAH DATA -->
<div class="modal fade" id="tambahCutiModal" tabindex="-1" aria-labelledby="tambahCutiLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-2xl shadow-2xl border-0 overflow-hidden">
      <div class="modal-header bg-gradient-to-r from-[#842A3B] to-[#C95A6B] text-white">
        <h5 class="modal-title font-semibold" id="tambahCutiLabel">Tambah Jenis Cuti</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form>
        <div class="modal-body p-6 space-y-4">
          <div>
            <label for="nama_cuti" class="block text-sm font-medium text-slate-700 mb-1">Nama Jenis Cuti</label>
            <input type="text" id="nama_cuti" name="nama_cuti" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-300 focus:outline-none" placeholder="Masukkan nama cuti" required>
          </div>

          <div>
            <label for="jumlah_hari" class="block text-sm font-medium text-slate-700 mb-1">Jumlah Hari</label>
            <input type="number" id="jumlah_hari" name="jumlah_hari" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-300 focus:outline-none" placeholder="Masukkan jumlah hari" required>
          </div>

          <div>
            <label for="keterangan" class="block text-sm font-medium text-slate-700 mb-1">Keterangan</label>
            <textarea id="keterangan" name="keterangan" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-300 focus:outline-none" placeholder="Masukkan keterangan"></textarea>
          </div>
        </div>

        <div class="modal-footer border-t bg-gray-50">
          <button type="button" class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 text-slate-700 transition" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="px-5 py-2 rounded-lg text-white bg-gradient-to-r from-[#842A3B] to-[#C95A6B] hover:opacity-90 transition">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection
