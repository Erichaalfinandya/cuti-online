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
                        <th class="py-3 px-4 text-left">NIP</th>
                        <th class="py-3 px-4 text-left">Detail</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">

                </tbody>
            </table>
        </div>
    </div>
    <!-- Modal -->
    <div id="detailModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-xl shadow-lg w-full max-w-lg p-6 relative overflow-y-auto max-h-[90vh]">

            <!-- Body -->
            <div id="detailContent" class="space-y-3 text-sm text-gray-700">
                <!-- Data detail akan dimasukkan lewat JS -->
            </div>

            <!-- Footer -->
            <div class="mt-5 text-right border-t pt-3">
                <button id="closeModalBtn" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md transition">
                    Tutup
                </button>
            </div>
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
                        return json.data || []; // ambil array di dalam 'data'
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
                columns: [{
                        data: null,
                        render: (data, type, row, meta) => meta.row + 1
                    },
                    {
                        data: "nama"
                    },
                    {
                        data: "nip"
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
            const id = $(this).data('id'); // ambil id user dari tombol
            console.log(id);
            $.ajax({
                url: `/getJatahCutiById/${id}`,
                type: 'GET',
                success: function(res) {
                    let html = `
                <h3 class="text-lg font-semibold mb-2">Daftar Jatah Cuti</h3>
            `;

                    res.data.forEach((item, index) => {
                        html += `
                    <div class="border rounded-md p-3 mb-2 bg-gray-50">
                        <p><strong>${index + 1}. ${item.jenis_cuti.nama_cuti}</strong></p>
                        <p>Jumlah Hari: ${item.jenis_cuti.jumlah_hari}</p>
                        <p>Cuti Terpakai: ${item.cuti_terpakai}</p>
                        <p>Sisa Cuti: ${item.sisa_cuti}</p>
                        <p>Keterangan: ${item.jenis_cuti.keterangan ?? '-'}</p>
                    </div>
                `;
                    });

                    $('#detailContent').html(html);
                    $('#detailModal').removeClass('hidden');
                },
                error: function() {
                    alert('Gagal mengambil data jatah cuti.');
                }
            });
        });
    </script>
    <script>
        // Buka modal
        function openModal() {
            $('#detailModal').removeClass('hidden');
        }

        // Tutup modal
        function closeModal() {
            $('#detailModal').addClass('hidden');
            $('#detailContent').html(''); // bersihkan konten
        }

        // Tombol close
        $('#closeModalBtn, #closeModalIcon').on('click', closeModal);

        // Klik di luar modal juga tutup
        $('#detailModal').on('click', function(e) {
            if (e.target.id === 'detailModal') closeModal();
        });
    </script>
@endsection
