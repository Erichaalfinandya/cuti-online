@extends('layouts.main')

@section('title', 'Dashboard Pegawai')

@section('content')
    <div x-data="{ openDropdown: null }">

        {{-- Breadcrumb + Navbar --}}
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-2xl font-bold text-[#842A3B]">Dashboard</h2>
                <p class="text-sm text-gray-500">Selamat datang di sistem cuti online</p>
            </div>

            <div class="flex items-center space-x-4">
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="text"
                        class="pl-10 pr-3 py-2 rounded-lg border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-[#C95A6B]/50"
                        placeholder="Cari..." />
                </div>

                <button class="text-gray-600 hover:text-[#842A3B]">
                    <i class="fas fa-bell text-lg"></i>
                </button>

                <div class="flex items-center space-x-2">
                    <img src="/build/assets/img/profile.jpg" alt="Profile" class="w-8 h-8 rounded-full">
                    <span class="text-sm font-medium text-gray-700">Admin</span>
                </div>
            </div>
        </div>



        {{-- Kartu Statistik --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white shadow-md rounded-xl p-4 flex justify-between items-center border border-[#842A3B]/20">
                <div>
                    <h5 class="text-sm text-gray-500">Total Jatah Cuti</h5>
                    <h3 class="text-xl font-bold text-[#842A3B]">12 Hari <span class="text-xs text-green-500">+55%</span>
                    </h3>
                </div>
                <div
                    class="bg-gradient-to-tr from-[#842A3B] to-[#C95A6B] w-10 h-10 flex items-center justify-center rounded-lg text-white">
                    <i class="fas fa-mug-hot"></i>
                </div>
            </div>

            <div class="bg-white shadow-md rounded-xl p-4 flex justify-between items-center border border-[#842A3B]/20">
                <div>
                    <h5 class="text-sm text-gray-500">Cuti Terpakai</h5>
                    <h3 class="text-xl font-bold text-[#C95A6B]">4 Hari <span class="text-xs text-green-500">+55%</span>
                    </h3>
                </div>
                <div
                    class="bg-gradient-to-tr from-[#842A3B] to-[#C95A6B] w-10 h-10 flex items-center justify-center rounded-lg text-white">
                    <i class="fas fa-plane-departure"></i>
                </div>
            </div>

            <div class="bg-white shadow-md rounded-xl p-4 flex justify-between items-center border border-[#842A3B]/20">
                <div>
                    <h5 class="text-sm text-gray-500">Sisa Cuti</h5>
                    <h3 class="text-xl font-bold text-[#842A3B]">8 Hari <span class="text-xs text-green-500">+55%</span>
                    </h3>
                </div>
                <div
                    class="bg-gradient-to-tr from-[#842A3B] to-[#C95A6B] w-10 h-10 flex items-center justify-center rounded-lg text-white">
                    <i class="fas fa-sun"></i>
                </div>
            </div>
        </div>

        @role('ketua')
            <p>Ini ketua</p>
        @endrole
        @role('hakim')
            <p>Ini hakim</p>
        @endrole
        @role('panitera')
            <p>Ini panitera</p>
        @endrole
        @role('sekretaris')
            <p>Ini sekretaris</p>
        @endrole
        @role('panmud')
            <p>Ini panmud</p>
        @endrole
        @role('kasubbag')
            <p>Ini kasubbag</p>
        @endrole
        @role('staf_panitera_3')
            <p>Ini staf_panitera_3</p>
        @endrole
        @role('staf_panitera_2')
            <p>Ini staf_panitera_2</p>
        @endrole
        @role('staf_panitera_1')
            <p>Ini staf_panitera_1</p>
        @endrole
        @role('staf_sekretaris_1')
            <p>Ini staf_sekretaris_1</p>
        @endrole
        @role('staf_sekretaris_2')
            <p>Ini staf_sekretaris_2</p>
        @endrole
        @role('staf_sekretaris_3')
            <p>Ini staf_sekretaris_3</p>
        @endrole
        {{-- Table + Chart --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
            {{-- Table --}}
            <div class="bg-white rounded-2xl shadow-md p-6 border border-[#842A3B]/20">
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
                                <td class="py-2 px-3 relative" x-data="{ open: false }">
                                    <button @click="open = !open"
                                        class="flex items-center justify-between gap-2 bg-[#842A3B] hover:bg-[#C95A6B] text-white font-semibold text-xs px-4 py-1.5 rounded-md">
                                        <span>Aksi</span>
                                        <i class="fa-solid fa-chevron-down text-xs"></i>
                                    </button>
                                    <div x-show="open" @click.outside="open = false"
                                        class="absolute right-0 mt-2 w-32 bg-white rounded-md shadow-lg border border-gray-200 z-50">
                                        <ul class="text-sm text-gray-700 divide-y divide-gray-100">
                                            <li><button class="w-full text-left px-4 py-2 hover:bg-gray-100">Detail</button>
                                            </li>
                                            <li><button
                                                    class="w-full text-left px-4 py-2 hover:bg-gray-100 text-red-600">Hapus</button>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr class="hover:bg-[#842A3B]/5">
                                <td class="py-2 px-3">2.</td>
                                <td class="py-2 px-3">Cuti Besar</td>
                                <td class="py-2 px-3">12 Hari</td>
                                <td class="py-2 px-3">0 Hari</td>
                                <td class="py-2 px-3 relative" x-data="{ open: false }">
                                    <button @click="open = !open"
                                        class="flex items-center justify-between gap-2 bg-[#842A3B] hover:bg-[#C95A6B] text-white font-semibold text-xs px-4 py-1.5 rounded-md">
                                        <span>Aksi</span>
                                        <i class="fa-solid fa-chevron-down text-xs"></i>
                                    </button>
                                    <div x-show="open" @click.outside="open = false"
                                        class="absolute right-0 mt-2 w-32 bg-white rounded-md shadow-lg border border-gray-200 z-50">
                                        <ul class="text-sm text-gray-700 divide-y divide-gray-100">
                                            <li><button class="w-full text-left px-4 py-2 hover:bg-gray-100">Detail</button>
                                            </li>
                                            <li><button
                                                    class="w-full text-left px-4 py-2 hover:bg-gray-100 text-red-600">Hapus</button>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Chart --}}
            <div class="bg-white rounded-2xl shadow-md p-6 border border-[#842A3B]/20">
                <canvas id="chart-line" height="200"></canvas>
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
                            <td class="py-2 px-3"><span class="text-green-600 font-semibold">Diterima</span></td>
                            <td class="py-2 px-3 relative" x-data="{ open: false }">
                                <button @click="open = !open"
                                    class="flex items-center justify-between gap-2 bg-[#842A3B] hover:bg-[#C95A6B] text-white font-semibold text-xs px-4 py-1.5 rounded-md">
                                    <span>Aksi</span>
                                    <i class="fa-solid fa-chevron-down text-xs"></i>
                                </button>
                                <div x-show="open" @click.outside="open = false"
                                    class="absolute right-0 mt-2 w-36 bg-white rounded-md shadow-lg border border-gray-200 z-50">
                                    <ul class="text-sm text-gray-700 divide-y divide-gray-100">
                                        <li><button class="w-full text-left px-4 py-2 hover:bg-gray-100">Detail</button>
                                        </li>
                                        <li><button
                                                class="w-full text-left px-4 py-2 hover:bg-gray-100 text-green-600">Diterima</button>
                                        </li>
                                        <li><button
                                                class="w-full text-left px-4 py-2 hover:bg-gray-100 text-red-600">Ditolak</button>
                                        </li>
                                        <li><button
                                                class="w-full text-left px-4 py-2 hover:bg-gray-100 text-gray-600">Hapus</button>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>

                        <tr class="hover:bg-[#842A3B]/5">
                            <td class="py-2 px-3">2.</td>
                            <td class="py-2 px-3">20 Feb 2025</td>
                            <td class="py-2 px-3">22 Feb 2025</td>
                            <td class="py-2 px-3">Cuti Sakit</td>
                            <td class="py-2 px-3"><span class="text-red-600 font-semibold">Ditolak</span></td>
                            <td class="py-2 px-3 relative" x-data="{ open: false }">
                                <button @click="open = !open"
                                    class="flex items-center justify-between gap-2 bg-[#842A3B] hover:bg-[#C95A6B] text-white font-semibold text-xs px-4 py-1.5 rounded-md">
                                    <span>Aksi</span>
                                    <i class="fa-solid fa-chevron-down text-xs"></i>
                                </button>
                                <div x-show="open" @click.outside="open = false"
                                    class="absolute right-0 mt-2 w-36 bg-white rounded-md shadow-lg border border-gray-200 z-50">
                                    <ul class="text-sm text-gray-700 divide-y divide-gray-100">
                                        <li><button class="w-full text-left px-4 py-2 hover:bg-gray-100">Detail</button>
                                        </li>
                                        <li><button
                                                class="w-full text-left px-4 py-2 hover:bg-gray-100 text-green-600">Diterima</button>
                                        </li>
                                        <li><button
                                                class="w-full text-left px-4 py-2 hover:bg-gray-100 text-red-600">Ditolak</button>
                                        </li>
                                        <li><button
                                                class="w-full text-left px-4 py-2 hover:bg-gray-100 text-gray-600">Hapus</button>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Chart --}}
    @push('scripts')
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
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: '#eee'
                            }
                        },
                        x: {
                            grid: {
                                color: 'transparent'
                            }
                        }
                    }
                }
            });
        </script>
    @endpush
@endsection
