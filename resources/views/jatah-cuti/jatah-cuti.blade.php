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
            <table class="min-w-full text-sm text-gray-700 border border-gray-100 rounded-lg" id="tabelCuti">
                <thead class="bg-gradient-to-r from-[#842A3B] to-[#C95A6B] text-white">
                    <tr>
                        <th class="py-3 px-4 text-left rounded-tl-lg">No</th>
                        <th class="py-3 px-4 text-left">Nama Pegawai</th>
                        <th class="py-3 px-4 text-left">Detail</th>
                        {{-- <th class="py-3 px-4 text-left">Jenis Cuti</th>
                        <th class="py-3 px-4 text-left">Jumlah Total Cuti</th>
                        <th class="py-3 px-4 text-left">Jumlah Cuti Terpakai</th>
                        <th class="py-3 px-4 text-left rounded-tr-lg">Jumlah Sisa Cuti</th> --}}

                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">

                </tbody>
            </table>
        </div>
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
                    url: "{{ route('getUser') }}",
                    dataSrc: function(json) {
                        console.log('Response dari server:', json); // biar keliatan
                        return json.data || []; // ambil array di dalam 'data'
                    }
                },
                columns: [{
                        data: null,
                        render: (data, type, row, meta) => meta.row + 1
                    },
                    // {
                    //     data: "user_id",
                    //     render: function(data, type, row) {
                    //         return row.user ? row.user.nama : data;
                    //     }
                    // },
                    {
                        data: "nama"
                    },
                    {
                        data: "id",
                        className: "text-center",
                        render: function(data) {
                            return `
                            <button class="bg-blue-500 text-white px-2 py-1 rounded detail-btn"">Detail</button>
                        `;
                        }
                    }
                    //                     {
                    //     data: "sisa_cuti"
                    // },
                    // {
                    //     data: "cuti_terpakai"
                    // },
                    // {
                    //     data: "sisa_cuti"
                    // },

                ],
            });
        });
    </script>
@endsection
