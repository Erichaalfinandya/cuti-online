@extends('layouts.main')

@section('title', 'Dashboard Pegawai')

@section('content')
<div
  x-data="{
    showModal: false,
    detail: { jenis: '', sisa: '', terpakai: '', mulai: '', akhir: '', status: '' },
    openDropdown: null
  }"
>

  {{-- Breadcrumb + Navbar --}}
  <div class="flex justify-between items-center mb-6">
    <div>
      <h2 class="text-2xl font-bold text-[#842A3B]">Dashboard</h2>
    </div>
  </div>

  {{-- Kartu Statistik --}}
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    <div class="bg-white shadow-md rounded-xl p-4 flex justify-between items-center border border-[#842A3B]/20">
      <div>
        <h5 class="text-sm text-gray-500">Total Jatah Cuti</h5>
        <h3 class="text-xl font-bold text-[#842A3B]">12 Hari <span class="text-xs text-green-500">+55%</span></h3>
      </div>
      <div class="bg-gradient-to-tr from-[#842A3B] to-[#C95A6B] w-10 h-10 flex items-center justify-center rounded-lg text-white">
        <i class="fas fa-mug-hot"></i>
      </div>
    </div>

    <div class="bg-white shadow-md rounded-xl p-4 flex justify-between items-center border border-[#842A3B]/20">
      <div>
        <h5 class="text-sm text-gray-500">Cuti Terpakai</h5>
        <h3 class="text-xl font-bold text-[#C95A6B]">4 Hari <span class="text-xs text-green-500">+55%</span></h3>
      </div>
      <div class="bg-gradient-to-tr from-[#842A3B] to-[#C95A6B] w-10 h-10 flex items-center justify-center rounded-lg text-white">
        <i class="fas fa-plane-departure"></i>
      </div>
    </div>

    <div class="bg-white shadow-md rounded-xl p-4 flex justify-between items-center border border-[#842A3B]/20">
      <div>
        <h5 class="text-sm text-gray-500">Sisa Cuti</h5>
        <h3 class="text-xl font-bold text-[#842A3B]">8 Hari <span class="text-xs text-green-500">+55%</span></h3>
      </div>
      <div class="bg-gradient-to-tr from-[#842A3B] to-[#C95A6B] w-10 h-10 flex items-center justify-center rounded-lg text-white">
        <i class="fas fa-sun"></i>
      </div>
    </div>
  </div>

  {{-- Table + Chart --}}
  <div class="bg-white rounded-2xl shadow-md p-6 mt-8 border border-[#842A3B]/20">
    <h5 class="font-semibold text-[#842A3B] mb-2">Jatah Cuti</h5>
    <p class="text-gray-500 text-sm mb-4">Data jatah cuti pegawai</p>
    <div class="overflow-x-auto">
      <table class="min-w-full text-sm text-gray-700">
        <thead>
          <tr class="border-b bg-[#842A3B]/10 text-[#842A3B]">
            <th class="text-left py-2 px-3">NO</th>
            <th class="text-left py-2 px-3">JENIS CUTI</th>
            <th class="text-left py-2 px-3">TOTAL SISA CUTI</th>
            <th class="text-left py-2 px-3">TOTAL CUTI TERPAKAI</th>
            <th class="text-left py-2 px-3">AKSI</th>
          </tr>
        </thead>
        <tbody>
          <tr class="border-b hover:bg-[#842A3B]/5">
            <td class="py-2 px-3">1.</td>
            <td class="py-2 px-3">Cuti Tahunan</td>
            <td class="py-2 px-3">8 Hari</td>
            <td class="py-2 px-3">4 Hari</td>
            <td class="py-2 px-3">
              <button
                @click="
                  detail = { jenis: 'Cuti Tahunan', sisa: '8 Hari', terpakai: '4 Hari' };
                  showModal = true;
                "
                class="bg-[#842A3B] hover:bg-[#C95A6B] text-white font-semibold text-xs px-4 py-1.5 rounded-md"
              >
                Detail
              </button>
            </td>
          </tr>
          <tr class="hover:bg-[#842A3B]/5">
            <td class="py-2 px-3">2.</td>
            <td class="py-2 px-3">Cuti Besar</td>
            <td class="py-2 px-3">12 Hari</td>
            <td class="py-2 px-3">0 Hari</td>
            <td class="py-2 px-3">
              <button
                @click="
                  detail = { jenis: 'Cuti Besar', sisa: '12 Hari', terpakai: '0 Hari' };
                  showModal = true;
                "
                class="bg-[#842A3B] hover:bg-[#C95A6B] text-white font-semibold text-xs px-4 py-1.5 rounded-md"
              >
                Detail
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  {{-- Riwayat Cuti --}}
  <div class="bg-white rounded-2xl shadow-md p-6 mt-8 border border-[#842A3B]/20">
    <h5 class="font-semibold text-[#842A3B] mb-4">Riwayat Cuti</h5>
    <div class="overflow-x-auto">
      <table class="min-w-full text-sm text-gray-700">
        <thead>
          <tr class="border-b bg-[#842A3B]/10 text-[#842A3B]">
            <th class="text-left py-2 px-3">NO</th>
            <th class="text-left py-2 px-3">TANGGAL MULAI</th>
            <th class="text-left py-2 px-3">TANGGAL AKHIR</th>
            <th class="text-left py-2 px-3">JENIS CUTI</th>
            <th class="text-left py-2 px-3">STATUS</th>
            <th class="text-left py-2 px-3">AKSI</th>
          </tr>
        </thead>
        <tbody>
          <tr class="border-b hover:bg-[#842A3B]/5">
            <td class="py-2 px-3">1.</td>
            <td class="py-2 px-3">10 Jan 2025</td>
            <td class="py-2 px-3">14 Jan 2025</td>
            <td class="py-2 px-3">Cuti Tahunan</td>
            <td class="py-2 px-3 text-green-600 font-semibold">Diterima</td>
            <td class="py-2 px-3">
              <button
                @click="
                  detail = { jenis: 'Cuti Tahunan', mulai: '10 Jan 2025', akhir: '14 Jan 2025', status: 'Diterima' };
                  showModal = true;
                "
                class="bg-[#842A3B] hover:bg-[#C95A6B] text-white text-xs px-4 py-1.5 rounded-md"
              >
                Detail
              </button>
            </td>
          </tr>

          <tr class="hover:bg-[#842A3B]/5">
            <td class="py-2 px-3">2.</td>
            <td class="py-2 px-3">20 Feb 2025</td>
            <td class="py-2 px-3">22 Feb 2025</td>
            <td class="py-2 px-3">Cuti Sakit</td>
            <td class="py-2 px-3 text-red-600 font-semibold">Ditolak</td>
            <td class="py-2 px-3">
              <button
                @click="
                  detail = { jenis: 'Cuti Sakit', mulai: '20 Feb 2025', akhir: '22 Feb 2025', status: 'Ditolak' };
                  showModal = true;
                "
                class="bg-[#842A3B] hover:bg-[#C95A6B] text-white text-xs px-4 py-1.5 rounded-md"
              >
                Detail
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

   {{-- MODAL DETAIL CUTI --}}
   <div
   x-show="showModal"
   x-transition.opacity
   x-cloak
   @click.away="showModal = false"
   class="fixed inset-0 bg-black/40 flex items-center justify-center z-50"
 >
   <div class="bg-white rounded-xl shadow-lg w-96 p-6 relative">
     <h3 class="text-lg font-semibold text-[#842A3B] mb-4">Detail Cuti</h3>

     <div class="space-y-2 text-sm text-gray-700">
       <template x-if="detail.jenis">
         <p><span class="font-semibold">Jenis Cuti:</span> <span x-text="detail.jenis"></span></p>
       </template>
       <template x-if="detail.sisa">
         <p><span class="font-semibold">Sisa Cuti:</span> <span x-text="detail.sisa"></span></p>
       </template>
       <template x-if="detail.terpakai">
         <p><span class="font-semibold">Terpakai:</span> <span x-text="detail.terpakai"></span></p>
       </template>
       <template x-if="detail.mulai">
         <p><span class="font-semibold">Tanggal Mulai:</span> <span x-text="detail.mulai"></span></p>
       </template>
       <template x-if="detail.akhir">
         <p><span class="font-semibold">Tanggal Akhir:</span> <span x-text="detail.akhir"></span></p>
       </template>
       <template x-if="detail.status">
         <p><span class="font-semibold">Status:</span> <span x-text="detail.status"></span></p>
       </template>
     </div>

     <div class="mt-5 text-right">
       <button @click="showModal = false"
               class="bg-[#842A3B] hover:bg-[#C95A6B] text-white text-sm font-semibold px-4 py-2 rounded-md">
         Tutup
       </button>
     </div>

     <button @click="showModal = false"
             class="absolute top-2 right-3 text-gray-400 hover:text-[#842A3B] text-lg">
       &times;
     </button>
   </div>
   </div>
</div>

{{-- Chart --}}
@push('scripts')
<style>[x-cloak]{display:none!important}</style>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('chart-line').getContext('2d');
  new Chart(ctx, {
    type: 'line',
    data: {
      labels: ['Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
      datasets: [{
        label: 'Cuti Terpakai',
        data: [0, 10, 30, 20, 40, 30, 50],
        borderColor: '#C95A6B',
        backgroundColor: 'rgba(201, 90, 107, 0.2)',
        tension: 0.4,
        fill: true
      }, {
        label: 'Sisa Cuti',
        data: [0, 20, 10, 40, 30, 50, 40],
        borderColor: '#842A3B',
        backgroundColor: 'rgba(132, 42, 59, 0.2)',
        tension: 0.4,
        fill: true
      }]
    },
    options: {
      responsive: true,
      plugins: { legend: { display: false } },
      scales: {
        y: { beginAtZero: true, grid: { color: '#eee' } },
        x: { grid: { color: 'transparent' } }
      }
    }
  });
</script>
@endpush
@endsection
