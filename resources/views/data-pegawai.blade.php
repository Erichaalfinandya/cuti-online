@extends('layouts.main')

@section('title', 'Data Pegawai')

@section('content')
<div class="flex justify-between items-center mb-6">
  <h2 class="text-xl font-semibold text-slate-700">Data Pegawai</h2>
</div>

<!-- CARD WRAPPER -->
<div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">

  <!-- TABEL DATA PEGAWAI -->
  <table class="min-w-full text-sm text-gray-700">
    <thead>
      <tr class="border-b bg-gradient-to-r from-[#842A3B]/10 to-[#C95A6B]/10 text-[#842A3B] font-semibold">
        <th class="py-3 px-4 text-left">NO</th>
        <th class="py-3 px-4 text-left">Nama</th>
        <th class="py-3 px-4 text-left">NIP</th>
        <th class="py-3 px-4 text-left">Jabatan</th>
        <th class="py-3 px-4 text-left">Role</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($dataPegawai as $index => $pegawai)
        <tr class="border-b hover:bg-gray-50 transition duration-200">
          <td class="py-3 px-4">{{ $index + 1 }}</td>
          <td class="py-3 px-4 font-medium">{{ $pegawai['nama_pegawai'] }}</td>
          <td class="py-3 px-4">{{ $pegawai['nip_pegawai'] }}</td>
          <td class="py-3 px-4">{{ $pegawai['jabatan_pegawai'] }}</td>
          <td class="py-3 px-4">
            <span class="px-3 py-1 rounded-full text-xs font-semibold 
              {{ $pegawai['role'] === 'Admin' ? 'bg-[#842A3B]/10 text-[#842A3B]' : 'bg-green-100 text-green-700' }}">
              {{ $pegawai['role'] }}
            </span>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
