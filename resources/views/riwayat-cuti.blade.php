@extends('layouts.main')

@section('title', 'Riwayat Cuti')

@section('content')
<div 
  x-data="{
    openModal: false,
    selected: null,
    async showDetail(id) {
      const res = await fetch(`/riwayat-cuti/${id}`);
      const data = await res.json();
      this.selected = data;
      this.openModal = true;
    }
  }"
  class="relative max-w-6xl mx-auto bg-white rounded-2xl shadow-lg p-8 mt-6 border border-gray-100">

  <!-- HEADER -->
  <div class="flex justify-between items-center mb-6 border-b pb-3">
    <h2 class="text-2xl font-semibold text-[#842A3B] flex items-center">
      <i class="fa-solid fa-clock-rotate-left mr-3"></i> Riwayat Cuti Pegawai
    </h2>
  </div>

  <!-- WRAPPER TABLE -->
  <div class="overflow-x-auto rounded-lg border border-gray-200">
    <table class="min-w-full text-sm text-gray-700">
      <thead>
        <tr class="bg-gradient-to-r from-[#842A3B] to-[#C95A6B] text-white font-medium">
          <th class="py-3 px-4 text-left rounded-tl-lg">No</th>
          <th class="py-3 px-4 text-left">User</th>
          <th class="py-3 px-4 text-left">Tanggal</th>
          <th class="py-3 px-4 text-left">Posisi</th>
          <th class="py-3 px-4 text-left">Nama Pegawai</th>
          <th class="py-3 px-4 text-left">Jenis Cuti</th>
          <th class="py-3 px-4 text-left">Tanggal Awal</th>
          <th class="py-3 px-4 text-left">Tanggal Akhir</th>
          <th class="py-3 px-4 text-left">Status</th>
          <th class="py-3 px-4 text-center rounded-tr-lg">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($riwayatCuti as $index => $riwayat)
        <tr class="border-b hover:bg-[#842A3B]/5 transition">
          <td class="py-3 px-4">{{ $index + 1 }}</td>
          <td class="py-3 px-4">{{ $riwayat->user }}</td>
          <td class="py-3 px-4">{{ $riwayat->tanggal }}</td>
          <td class="py-3 px-4">{{ $riwayat->posisi }}</td>
          <td class="py-3 px-4">{{ $riwayat->nama_pegawai }}</td>
          <td class="py-3 px-4">{{ $riwayat->jenis_cuti }}</td>
          <td class="py-3 px-4">{{ $riwayat->tanggal_awal }}</td>
          <td class="py-3 px-4">{{ $riwayat->tanggal_akhir }}</td>
          <td class="py-3 px-4">
            <span class="px-2 py-1 rounded-md text-xs font-medium
              @if($riwayat->status === 'Disetujui') bg-green-100 text-green-700
              @elseif($riwayat->status === 'Ditolak') bg-red-100 text-red-700
              @else bg-yellow-100 text-yellow-700 @endif">
              {{ $riwayat->status }}
            </span>
          </td>
          <td class="py-3 px-4 text-center">
            <button 
              @click="showDetail({{ $riwayat->id }})"
              class="px-4 py-2 bg-gradient-to-r from-[#842A3B] to-[#C95A6B] text-white rounded-lg shadow hover:opacity-90 transition text-sm font-medium">
              <i class="fa-solid fa-circle-info mr-1"></i> Detail
            </button>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <!-- MODAL DETAIL -->
  <div 
    x-show="openModal"
    x-transition
    class="fixed inset-0 flex items-center justify-center bg-black/40 z-50"
    x-cloak>
    <div class="bg-white rounded-2xl p-6 w-[90%] max-w-2xl shadow-xl border border-gray-200">
      <h3 class="text-xl font-semibold text-[#842A3B] mb-4 flex items-center">
        <i class="fa-solid fa-file-lines mr-2"></i> Detail Pengajuan Cuti
      </h3>

      <template x-if="selected">
        <div class="grid grid-cols-2 gap-4 text-sm text-gray-700">
          <div><b>Nama Pegawai:</b> <span x-text="selected.nama_pegawai"></span></div>
          <div><b>Jenis Cuti:</b> <span x-text="selected.jenis_cuti"></span></div>
          <div><b>Tanggal Awal:</b> <span x-text="selected.tanggal_awal"></span></div>
          <div><b>Tanggal Akhir:</b> <span x-text="selected.tanggal_akhir"></span></div>
          <div><b>Tanggal Pengajuan:</b> <span x-text="selected.tanggal"></span></div>
          <div><b>Status:</b> <span x-text="selected.status"></span></div>
          <div class="col-span-2"><b>Posisi Saat Ini:</b> <span x-text="selected.posisi"></span></div>
        </div>
      </template>

      <div class="mt-6 flex justify-end">
        <button 
          @click="openModal = false"
          class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
          <i class="fa-solid fa-xmark mr-1"></i> Tutup
        </button>
      </div>
    </div>
  </div>
</div>
@endsection
