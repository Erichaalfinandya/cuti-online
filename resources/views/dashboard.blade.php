@extends('layouts.main')

@section('title', 'Dashboard Pegawai')

@section('content')
<div x-data="{
        showModal: false,
        detail: { jenis: '', sisa: '', terpakai: '', mulai: '', akhir: '', status: '' },
        openDropdown: null
    }">

    {{-- Breadcrumb + Navbar --}}
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-3xl font-bold text-[#842A3B] tracking-tight">Dashboard</h2>
            <p class="text-gray-500 text-sm mt-1">Selamat datang di sistem informasi cuti pegawai</p>
        </div>
    </div>
    @php
    $roles = [
    'ketua',
    'hakim',
    'panitera',
    'sekretaris',
    'panmud',
    'panmud_1',
    'panmud_2',
    'panmud_3',
    'kasubbag',
    'kasubbag_1',
    'kasubbag_2',
    'kasubbag_3',
    'staf_panitera_1',
    'staf_panitera_2',
    'staf_panitera_3',
    'staf_sekretaris_1',
    'staf_sekretaris_2',
    'staf_sekretaris_3',
    'kepegawaian',
    ];

    $userRole = trim(Auth::user()->golongan); // atau pakai role jika kamu pakai spatie/permission
    @endphp

    {{-- SALAM ROLE-BASED --}}
    <div
        class="bg-gradient-to-r from-[#842A3B]/10 to-[#C95A6B]/10 border border-[#C95A6B]/30 rounded-2xl shadow-sm p-6 mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-xl font-semibold text-[#842A3B]">
                    Halo, {{ Auth::user()->nama }} 👋
                </h3>
                <p class="text-gray-600 mt-1">
                    Selamat datang kembali!
                </p>
            </div>

            {{-- OPTIONAL: ILUSTRASI / ICON --}}
            <div class="hidden md:block">
                <img src="https://cdn-icons-png.flaticon.com/512/4221/4221419.png" alt="Welcome"
                    class="w-20 h-20 opacity-80">
            </div>
        </div>
    </div>

    {{-- Kartu Statistik --}}
    {{-- <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
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
    </div> --}}


    <div class="bg-white rounded-2xl shadow-md p-6 mt-8 border border-[#842A3B]/20">
        <h5 class="font-semibold text-[#842A3B] mb-2">Jatah Cuti</h5>
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-gray-700 border border-gray-100 rounded-lg" id="tabelJatah">
                <thead class="bg-gradient-to-r from-[#842A3B] to-[#C95A6B] text-white">
                    <tr>
                        <th class="py-3 px-4 text-left rounded-tl-lg">No</th>
                        <th class="py-3 px-4 text-left">Nama Pegawai</th>
                        <th class="py-3 px-4 text-left">Nama Jenis Cuti</th>
                        <th class="py-3 px-4 text-left">Jumlah Hari</th>
                        <th class="py-3 px-4 text-left">Cuti Terpakai</th>
                        <th class="py-3 px-4 text-left">Sisa Cuti</th>
                        <th class="py-3 px-4 text-left">Keterangan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    {{-- Data dari DataTables --}}
                </tbody>
            </table>
        </div>
    </div>

    {{-- Riwayat Cuti --}}
    <div class="bg-white rounded-2xl shadow-md p-6 mt-8 border border-[#842A3B]/20">
        <h5 class="font-semibold text-[#842A3B] mb-4">Riwayat Cuti</h5>
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-gray-700" id="tabelCuti">
                <thead class="bg-gradient-to-r from-[#842A3B] to-[#C95A6B] text-white">
                    <tr>
                        <th class="py-3 px-4 text-left rounded-tl-lg">No</th>
                        <th class="py-3 px-4 text-left">Nama Pengaju</th>
                        <th class="py-3 px-4 text-left">Role</th>
                        <th class="py-3 px-4 text-left">Jenis Cuti</th>
                        <th class="py-3 px-4 text-left">Tanggal Mulai</th>
                        <th class="py-3 px-4 text-left">Tanggal Selesai</th>
                        <th class="py-3 px-4 text-left">Jumlah Hari</th>
                        <th class="py-3 px-4 text-left">Keterangan</th>
                        <th class="py-3 px-4 text-left">Status</th>
                        <th class="py-3 px-4 text-center rounded-tr-lg">Aksi</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>


{{-- Chart --}}
@push('scripts')
<style>
    [x-cloak] {
        display: none !important
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>

<script>
    $(document).ready(function() {
                var tabelCuti = $('#tabelCuti').DataTable({
                    ajax: {
                        url: "{{ route('getAjukanCuti') }}",
                        dataSrc: function(json) {
                            console.log('Response dari server:', json);
                            return json.data || [];
                        }
                    },
                    columns: [{
                            data: null,
                            render: (data, type, row, meta) => meta.row + 1
                        },
                        {
                            data: "user_id",
                            render: (data, type, row) => row.user ? row.user.nama : data
                        },
                        {
                            data: "user.golongan"
                        },
                        {
                            data: "jenis_cuti.nama_cuti"
                        },
                        {
                            data: "tanggal_awal"
                        },
                        {
                            data: "tanggal_akhir"
                        },
                        {
                            data: "jumlah_hari"
                        },
                        {
                            data: "keterangan"
                        },
                        {
                            data: "status",
                            render: function(data) {
                                switch (data) {
                                    case 1:
                                        return '<span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-xs font-medium">Sedang diverifikasi kepegawaian</span>';
                                    case 2:
                                        return '<span class="bg-blue-100 text-blue-700 px-2 py-1 rounded text-xs font-medium">Menunggu persetujuan atasan langsung</span>';
                                    case 3:
                                        return '<span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs font-medium">Sudah disetujui atasan langsung</span>';
                                    case 4:
                                        return '<span class="bg-orange-100 text-orange-700 px-2 py-1 rounded text-xs font-medium">Menunggu persetujuan ketua</span>';
                                    case 5:
                                        return '<span class="bg-green-200 text-green-800 px-2 py-1 rounded text-xs font-medium">Sudah disetujui ketua</span>';
                                    default:
                                        return '<span class="bg-gray-100 text-gray-700 px-2 py-1 rounded text-xs font-medium">Status tidak diketahui</span>';
                                }
                            }
                        },
                        {
                            data: "id",
                            className: "text-center",
                            render: data => `
                    <button class="bg-gradient-to-r from-[#842A3B] to-[#C95A6B] text-white px-3 py-1 rounded-md text-sm shadow hover:opacity-90 transition detail-btn" data-id="${data}">
                        <i class="fa-solid fa-circle-info mr-1"></i> Detail
                    </button>`
                        }
                    ],
                    responsive: true,
                    language: {
                        search: "Cari:",
                        lengthMenu: "Tampilkan _MENU_ entri",
                        info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                        zeroRecords: "Tidak ada data ditemukan",
                        paginate: {
                            next: "›",
                            previous: "‹"
                        }
                    }
                });

                $(document).on('click', '.detail-btn', function() {
                    const id = $(this).data('id');
                    if (id) window.location.href = `/detail_pengajuan_cuti/${id}`;
                });
            });
</script>

<script>
    $(document).ready(function() {
                var id = {{ Auth::user()->id }}; // pakai property id
                console.log(id);

                var tabelJatah = $('#tabelJatah').DataTable({
                    ajax: {
                        url: `/getJatahCutiById/${id}`,
                        dataSrc: function(json) {
                            return json.data || [];
                        }
                    },
                    columns: [{
                            data: null,
                            render: (data, type, row, meta) => meta.row + 1
                        }, // No
                        {
                            data: null,
                            render: (data, type, row) => row.user ? row.user.nama : row.user_id
                        },
                        {
                            data: null,
                            render: (data, type, row) => row.jenis_cuti ? row.jenis_cuti.nama_cuti : '-'
                        }, // Nama Jenis Cuti
                        {
                            data: null,
                            render: (data, type, row) => row.jenis_cuti ? row.jenis_cuti.jumlah_hari +
                                ' hari' : '-'
                        },
                        {
                            data: "cuti_terpakai",
                            render: (data) => data + ' hari'
                        },
                        {
                            data: "sisa_cuti",
                            render: (data) => data + ' hari'
                        },
                        {
                            data: null,
                            render: (data, type, row) => row.jenisCuti ? (row.jenisCuti.keterangan ?? '-') :
                                '-'
                        },
                    ],
                    responsive: true,
                    language: {
                        search: "Cari:",
                        lengthMenu: "Tampilkan _MENU_ entri",
                        info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                        zeroRecords: "Tidak ada data ditemukan",
                        paginate: {
                            next: "›",
                            previous: "‹"
                        }
                    }
                });
            });
</script>
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
