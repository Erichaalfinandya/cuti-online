@extends('layouts.main')

@section('title', 'Pengajuan Cuti')

@section('content')
<div class="max-w-6xl mx-auto bg-white rounded-2xl shadow-lg p-8 mt-6">
    <!-- Judul -->
    <div class="flex justify-between items-center mb-6 border-b pb-3">
        <h2 class="text-2xl font-semibold text-[#842A3B] flex items-center">
            <i class="fa-solid fa-calendar-check mr-3"></i> Pengajuan Cuti
        </h2>
    </div>

    <!-- WRAPPER TABEL -->
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-gray-700 border border-gray-100 rounded-lg" id="tabelCuti">
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
            <tbody class="divide-y divide-gray-100">
                {{-- Data dari DataTables --}}
            </tbody>
        </table>
    </div>
</div>

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
          dom: "<'row mb-2'<'col-sm-6'l><'col-sm-6 d-flex justify-content-end'f>>" +
                    // Atas: length kiri, search kanan
                    "<'row'<'col-12'tr>>" + // Tabel
                    "<'row mt-2'<'col-sm-6 d-flex'B><'col-sm-6 text-end'p>>" +
                    // Tombol kiri, pagination kanan
                    "<'row mt-1'<'col-sm-6'i>>", // Info di bawah kir
                buttons: [
                    'copy', // copy ke clipboard
                    'csv', // ekspor CSV
                    'excel', // ekspor Excel
                    'pdf', // PDF
                    'print' // print page
                ],
        columns: [
            { data: null, render: (data, type, row, meta) => meta.row + 1 },
            { data: "user_id", render: (data, type, row) => row.user ? row.user.nama : data },
            { data: "user.golongan" },
            { data: "jenis_cuti.nama_cuti" },
            { data: "tanggal_awal" },
            { data: "tanggal_akhir" },
            { data: "jumlah_hari" },
            { data: "keterangan" },
            {
                data: "status",
                render: function(data) {
                    switch (data) {
                        case 1: return '<span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-xs font-medium">Sedang diverifikasi kepegawaian</span>';
                        case 2: return '<span class="bg-blue-100 text-blue-700 px-2 py-1 rounded text-xs font-medium">Menunggu persetujuan atasan langsung</span>';
                        case 3: return '<span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs font-medium">Sudah disetujui atasan langsung</span>';
                        case 4: return '<span class="bg-orange-100 text-orange-700 px-2 py-1 rounded text-xs font-medium">Menunggu persetujuan ketua</span>';
                        case 5: return '<span class="bg-green-200 text-green-800 px-2 py-1 rounded text-xs font-medium">Sudah disetujui ketua</span>';
                        default: return '<span class="bg-gray-100 text-gray-700 px-2 py-1 rounded text-xs font-medium">Status tidak diketahui</span>';
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
            paginate: { next: "›", previous: "‹" }
        }
    });

    $(document).on('click', '.detail-btn', function() {
        const id = $(this).data('id');
        if (id) window.location.href = `/detail_pengajuan_cuti/${id}`;
    });
});
</script>
@endsection
