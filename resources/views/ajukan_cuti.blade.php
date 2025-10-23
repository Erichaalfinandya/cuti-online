@extends('layouts.main')

@section('title', 'Master Jenis Cuti')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-slate-700">Pengajuan Cuti</h2>
</div>
<div class="bg-white rounded-2xl shadow-md overflow-hidden">
    <table class="min-w-full text-sm text-gray-700 border border-gray-200" id="tabelCuti">
        <thead>
            <tr class="bg-gradient-to-r from-[#842A3B]/10 to-[#C95A6B]/10 text-slate-700 font-semibold border-b">
                <th class="py-3 px-4 text-left">No</th>
                <th class="py-3 px-4 text-left">Nama Pengaju</th>
                <th class="py-3 px-4 text-left">Role</th>
                <th class="py-3 px-4 text-left">Jenis Cuti</th>
                <th class="py-3 px-4 text-left">Tanggal Mulai</th>
                <th class="py-3 px-4 text-left">Tanggal Selesai</th>
                <th class="py-3 px-4 text-left">Jumlah Hari</th>
                <th class="py-3 px-4 text-left">Keterangan</th>
                <th class="py-3 px-4 text-left">Status</th>
                <th class="py-3 px-4 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>


{{-- tampilan data table dan hapus --}}
<script>
    var tabelCuti; // deklarasikan di luar agar jadi global

        $(document).ready(function() {
            tabelCuti = $('#tabelCuti').DataTable({
                ajax: {
                    url: "{{ route('getAjukanCuti') }}",
                    dataSrc: function(json) {
                        console.log('Response dari server:', json); // biar keliatan
                        return json.data || []; // ambil array di dalam 'data'
                    }
                },
                columns: [{
                        data: null,
                        render: (data, type, row, meta) => meta.row + 1
                    },
                    {
                        data: "user_id",
                        render: function(data, type, row) {
                            return row.user ? row.user.nama : data;
                        }
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
                        render: function(data, type, row) {
                            switch (data) {
                                case 1:
                                    return "sedang diverifikasi kepegawaian";
                                case 2:
                                    return "menunggu persetujuan atasan langsung";
                                case 3:
                                    return "sudah disetujui atasan langsung";
                                case 4:
                                    return "menunggu persetujuan ketua";
                                case 5:
                                    return "sudah disetujui ketua";
                                default:
                                    return "status tidak diketahui";
                            }
                        }
                    },
                    {
                        data: "id",
                        className: "text-center",
                        render: function(data) {
                            return `
                            <button class="bg-blue-500 text-white px-2 py-1 rounded detail-btn" data-id="${data}">Detail</button>
                        `;
                        }
                    }
                ],
            });
        });
</script>
<script>
    $(document).on('click', '.detail-btn', function() {
    const id = $(this).data('id');

    if (!id) {
        alert('ID tidak ditemukan.');
        return;
    }

    // arahkan ke route sesuai ID
    window.location.href = `/detail_pengajuan_cuti/${id}`;

});
</script>

@endsection
