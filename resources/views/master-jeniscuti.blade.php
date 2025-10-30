@extends('layouts.main')

@section('title', 'Master Jenis Cuti')

@section('content')
<div class="relative max-w-6xl mx-auto bg-white rounded-2xl shadow-lg p-8 mt-6 border border-gray-100">

    <!-- HEADER + BUTTON DALAM SATU BARIS -->
    <div class="flex justify-between items-center mb-8 border-b pb-4">
        <h2 class="text-2xl font-semibold text-[#842A3B] flex items-center">
            Master Jenis Cuti
        </h2>

        <button type="button"
            class="bg-gradient-to-r from-[#842A3B] to-[#C95A6B] text-white px-5 py-2 rounded-lg text-sm font-semibold shadow-md hover:scale-105 hover:opacity-90 transition"
            data-bs-toggle="modal" data-bs-target="#tambahCutiModal">
            + Tambah Jenis Cuti
        </button>
    </div>

    <!-- TABEL DATA -->
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-gray-700 border border-gray-100 rounded-lg" id="tabelCuti">
            <thead>
                <tr class="bg-gradient-to-r from-[#842A3B] to-[#C95A6B] text-white">
                    <th class="py-3 px-4 text-left">No</th>
                    <th class="py-3 px-4 text-left">Nama Jenis Cuti</th>
                    <th class="py-3 px-4 text-left">Jumlah Hari</th>
                    <th class="py-3 px-4 text-left">Keterangan</th>
                    <th class="py-3 px-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">

            </tbody>
        </table>
    </div>

     <!-- MODAL TAMBAH DATA -->
     <div class="modal fade" id="tambahCutiModal" tabindex="-1" aria-labelledby="tambahCutiLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-2xl shadow-2xl border-0 overflow-hidden">
                <div class="modal-header bg-gradient-to-r from-[#842A3B] to-[#C95A6B] text-white">
                    <h5 class="modal-title font-semibold" id="tambahCutiLabel">Tambah Jenis Cuti</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form id="form-tambah-jenis-cuti">
                    <div class="modal-body p-6 space-y-4">
                        <div>
                            <label for="nama_cuti" class="block text-sm font-medium text-slate-700 mb-1">Nama Jenis
                                Cuti</label>
                            <input type="text" id="nama_cuti" name="nama_cuti"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-300 focus:outline-none"
                                placeholder="Masukkan nama cuti" required>
                        </div>

                        <div>
                            <label for="jumlah_hari" class="block text-sm font-medium text-slate-700 mb-1">Jumlah
                                Hari</label>
                            <input type="number" id="jumlah_hari" name="jumlah_hari"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-300 focus:outline-none"
                                placeholder="Masukkan jumlah hari" required>
                        </div>

                        <div>
                            <label for="keterangan" class="block text-sm font-medium text-slate-700 mb-1">Keterangan</label>
                            <textarea id="keterangan" name="keterangan"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-300 focus:outline-none"
                                placeholder="Masukkan keterangan"></textarea>
                        </div>
                    </div>

                    <div class="modal-footer border-t bg-gray-50">
                        <button type="button"
                            class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 text-slate-700 transition"
                            data-bs-dismiss="modal">Batal</button>
                        <button type="submit"
                            class="px-5 py-2 rounded-lg text-white bg-gradient-to-r from-[#842A3B] to-[#C95A6B] hover:opacity-90 transition">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL EDIT DATA -->
    <div class="modal fade" id="editCutiModal" tabindex="-1" aria-labelledby="editCutiLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-2xl shadow-2xl border-0 overflow-hidden">
                <div class="modal-header bg-gradient-to-r from-[#842A3B] to-[#C95A6B] text-white">
                    <h5 class="modal-title font-semibold" id="editCutiLabel">Edit Jenis Cuti</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form id="form-edit-jenis-cuti">
                    <input type="hidden" id="edit_id" name="id">
                    <div class="modal-body p-6 space-y-4">
                        <div>
                            <label for="nama_cuti" class="block text-sm font-medium text-slate-700 mb-1">Nama Jenis
                                Cuti</label>
                            <input type="text" id="edit_nama_cuti" name="nama_cuti"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-300 focus:outline-none"
                                placeholder="Masukkan nama cuti" required>
                        </div>

                        <div>
                            <label for="jumlah_hari" class="block text-sm font-medium text-slate-700 mb-1">Jumlah
                                Hari</label>
                            <input type="number" id="edit_jumlah_hari" name="jumlah_hari"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-300 focus:outline-none"
                                placeholder="Masukkan jumlah hari" required>
                        </div>

                        <div>
                            <label for="keterangan" class="block text-sm font-medium text-slate-700 mb-1">Keterangan</label>
                            <textarea id="edit_keterangan" name="keterangan"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-300 focus:outline-none"
                                placeholder="Masukkan keterangan"></textarea>
                        </div>
                    </div>

                    <div class="modal-footer border-t bg-gray-50">
                        <button type="button"
                            class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 text-slate-700 transition"
                            data-bs-dismiss="modal">Batal</button>
                        <button type="submit"
                            class="px-5 py-2 rounded-lg text-white bg-gradient-to-r from-[#842A3B] to-[#C95A6B] hover:opacity-90 transition">Simpan</button>
                    </div>
                </form>
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
                    url: "{{ route('getJenisCuti') }}",
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
                    { data: "nama_cuti" },
                    { data: "jumlah_hari" },
                    { data: "keterangan" },
                    {
                        data: "id",
                        className: "text-center",
                        render: function(data) {
                            return `
                                <button class="bg-blue-500 text-white px-2 py-1 rounded edit-btn" data-id="${data}">Edit</button>
                                <button class="bg-red-500 text-white px-2 py-1 rounded delete-btn" data-id="${data}">Hapus</button>
                            `;
                        }
                    }
                ],

                responsive: true,
                language: {
                    search: "Search:",
                    lengthMenu: "Show _MENU_ entries",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    infoEmpty: "Showing 0 to 0 of 0 entries",
                    infoFiltered: "(filtered from _MAX_ total entries)",
                    zeroRecords: "No matching records found",
                    paginate: { next: "›", previous: "‹" }
                }
            });
        });

        // Event hapus
        $(document).on('click', '.delete-btn', function() {
            const id = $(this).data('id');

            Swal.fire({
                title: 'Yakin mau hapus?',
                text: 'Data yang sudah dihapus tidak bisa dikembalikan.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/delete_jenis_cuti/${id}`,
                        type: 'POST',
                        data: { _token: '{{ csrf_token() }}' },
                        success: function(res) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: res.message,
                                timer: 1500,
                                showConfirmButton: false
                            });
                            tabelCuti.ajax.reload(null, false);
                        },
                        error: function(xhr) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: xhr.responseJSON?.message || 'Terjadi kesalahan saat menghapus data.'
                            });
                        }
                    });
                }
            });
        });
    </script>

     {{-- ajax tambah jenis cuti --}}
     <script>
        document.addEventListener("DOMContentLoaded", function() {
            const formCuti = document.getElementById("form-tambah-jenis-cuti");

            formCuti.addEventListener("submit", function(e) {
                e.preventDefault(); // Biar gak reload

                const formData = new FormData(formCuti);

                fetch("{{ route('tambah_jenis_cuti') }}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            "Accept": "application/json",
                        },
                        body: formData,
                    })
                    .then(async (response) => {
                        const data = await response.json();

                        if (response.ok && data.status === "success") {
                            Swal.fire({
                                icon: "success",
                                title: "Berhasil!",
                                text: data.message,
                                timer: 1500,
                                showConfirmButton: false,
                            });

                            // Tutup modal
                            const modal = bootstrap.Modal.getInstance(document.getElementById(
                                "tambahCutiModal"));
                            modal.hide();

                            // Reset form
                            formCuti.reset();

                            // Reload DataTable kalau ada
                            if (typeof tabelCuti !== "undefined") {
                                tabelCuti.ajax.reload(null, false);
                            }
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Gagal menambah cuti",
                                text: data.message || "Periksa kembali input anda.",
                            });
                        }
                    })
                    .catch((error) => {
                        console.error(error);
                        Swal.fire({
                            icon: "error",
                            title: "Kesalahan server",
                            text: "Terjadi error pada server, coba lagi nanti.",
                        });
                    });
            });
        });
    </script>

     {{-- ajax edit jenis cuti --}}
     <script>
        // Event edit
        $(document).on('click', '.edit-btn', function() {
            // alert('Klik terdeteksi!');
            const id = $(this).data('id');
            console.log(id);
            // Ambil data cuti by id (kalau perlu isi form modal)
            $.ajax({
                url: `/getJenisCutiById/${id}`,
                type: 'GET',
                success: function(res) {
                    console.log(res);
                    // Pastikan res.data ada
                    const data = res.data;

                    // isi form modal edit
                    $('#edit_nama_cuti').val(data.nama_cuti);
                    $('#edit_jumlah_hari').val(data.jumlah_hari);
                    $('#edit_keterangan').val(data.keterangan);
                    $('#edit_id').val(data.id);

                    // tampilkan modal
                    const modal = new bootstrap.Modal(document.getElementById('editCutiModal'));
                    modal.show();
                },

                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: 'Tidak dapat mengambil data cuti.',
                    });
                }
            });
        });

        // Event submit form edit
        $(document).on('submit', '#form-edit-jenis-cuti', function(e) {
            e.preventDefault();

            const id = $('#edit_id').val(); // ambil id dari hidden input
            const formData = new FormData(this);

            $.ajax({
                url: `/edit_jenis_cuti/${id}`,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(res) {
                    if (res.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: res.message,
                            timer: 1500,
                            showConfirmButton: false
                        });

                        // Tutup modal
                        const modal = bootstrap.Modal.getInstance(document.getElementById(
                            'editCutiModal'));
                        modal.hide();

                        // Reload datatable
                        $('#tabelCuti').DataTable().ajax.reload(null, false);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: res.message || 'Periksa kembali input Anda.'
                        });
                    }
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Kesalahan!',
                        text: xhr.responseJSON?.message || 'Terjadi kesalahan pada server.'
                    });
                }
            });
        });
    </script>

    {{-- CSS tambahan agar tampilannya cantik seperti contoh --}}
    <style>
        div.dataTables_wrapper {
            margin-top: 1rem;
        }

        div.dataTables_filter input {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 5px 8px;
        }

        div.dataTables_length select {
            border-radius: 8px;
            padding: 4px 6px;
        }

        table.dataTable thead th {
            background: linear-gradient(to right, #842A3B, #C95A6B);
            color: white !important;
            border: none;
        }

        table.dataTable tbody tr {
            border-bottom: 1px solid #eee;
        }

        table.dataTable.no-footer {
            border-bottom: none !important;
        }
    </style>
@endsection
