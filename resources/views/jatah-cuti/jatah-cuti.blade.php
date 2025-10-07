@extends('layouts.main')

@section('title', 'Jatah Cuti')

@section('content')
<div class="max-w-5xl mx-auto bg-white rounded-2xl shadow-lg p-8 mt-6">

  <!-- Judul -->
  <div class="flex justify-between items-center mb-6 border-b pb-3">
    <h2 class="text-2xl font-semibold text-[#842A3B] flex items-center">
      <i class="fa-solid fa-calendar-days mr-3"></i> Jatah Cuti Pegawai
    </h2>
  </div>

  <!-- TABEL DATA -->
  <div class="overflow-x-auto">
    <table class="min-w-full text-sm text-gray-700 border border-gray-100 rounded-lg">
      <thead class="bg-gradient-to-r from-[#842A3B] to-[#C95A6B] text-white">
        <tr>
          <th class="py-3 px-4 text-left rounded-tl-lg">No</th>
          <th class="py-3 px-4 text-left">Jenis Cuti</th>
          <th class="py-3 px-4 text-left">Jumlah Total Cuti</th>
          <th class="py-3 px-4 text-left">Jumlah Cuti Terpakai</th>
          <th class="py-3 px-4 text-left rounded-tr-lg">Jumlah Sisa Cuti</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-100">
        @forelse ($jatahCuti as $index => $cuti)
          <tr class="hover:bg-[#842A3B]/5 transition">
            <td class="py-3 px-4 font-medium text-gray-700">{{ $index + 1 }}</td>
            <td class="py-3 px-4">{{ $cuti->jenis_cuti }}</td>
            <td class="py-3 px-4">{{ $cuti->total_cuti }} Hari</td>
            <td class="py-3 px-4">{{ $cuti->cuti_terpakai }} Hari</td>
            <td class="py-3 px-4 text-[#842A3B] font-semibold">{{ $cuti->sisa_cuti }} Hari</td>
          </tr>
        @empty
          <tr>
            <td colspan="5" class="py-6 text-center text-gray-500">Belum ada data jatah cuti.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
