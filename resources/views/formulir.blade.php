@extends('layouts.main')

@section('title', 'Formulir Pengajuan Cuti')

@section('content')
    <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-lg p-8 mt-8 border border-gray-100">

        <!-- HEADER -->
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-slate-700 flex items-center">
                <i class="fa-solid fa-file-pen text-[#842A3B] mr-3"></i> Formulir Pengajuan Cuti
            </h2>
        </div>

        <!-- FORM -->
        <form id="form-tambah-cuti" method="POST" action="{{ route('tambah_ajukan_cuti') }}" class="space-y-6">
            @csrf
            <input type="hidden" name="status" value="1">
            <!-- NAMA PEGAWAI -->
            <div>
                <label for="user_id" class="block text-sm font-semibold text-slate-600 mb-1">Nama Pegawai</label>
                <select name="user_id" id="user_id"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 shadow-sm bg-white focus:ring-2 focus:ring-[#C95A6B]/40 focus:border-[#C95A6B] focus:outline-none transition"
                    required>
                    <option value="" disabled selected>Pilih pegawai...</option>
                </select>
            </div>

            <!-- JENIS CUTI -->
            <div class="mb-4">
                <label for="jenis_cuti_id" class="block text-sm font-semibold text-slate-600 mb-1">Jenis Cuti</label>
                <select id="jenis_cuti_id" name="jenis_cuti_id"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 shadow-sm bg-white focus:ring-2 focus:ring-[#C95A6B]/40 focus:border-[#C95A6B] focus:outline-none transition"
                    required>
                    <option value="" disabled selected>Pilih jenis cuti</option>
                </select>
            </div>

            <!-- TANGGAL -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="mb-4">
                    <label for="tanggal_awal" class="block text-sm font-semibold text-slate-600 mb-1">Tanggal Mulai</label>
                    <input type="date" id="tanggal_awal" name="tanggal_awal"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-[#C95A6B]/40 focus:border-[#C95A6B] focus:outline-none"
                        min="{{ date('Y-m-d') }}" required>
                </div>

                <div class="mb-4">
                    <label for="tanggal_akhir" class="block text-sm font-semibold text-slate-600 mb-1">Tanggal Akhir</label>
                    <input type="date" id="tanggal_akhir" name="tanggal_akhir"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-[#C95A6B]/40 focus:border-[#C95A6B] focus:outline-none"
                        min="{{ date('Y-m-d') }}" required>
                </div>
            </div>

            <!-- JUMLAH HARI -->
            <div>
                <label for="jumlah_hari" class="block text-sm font-semibold text-slate-600 mb-1">Jumlah Hari</label>
                <input type="number" id="jumlah_hari" name="jumlah_hari" min="1" readonly
                    class="w-full bg-gray-100 cursor-not-allowed border border-gray-300 rounded-lg px-4 py-2.5 shadow-sm focus:outline-none"
                    placeholder="Jumlah hari cuti otomatis muncul">
            </div>

            <!-- KETERANGAN -->
            <div>
                <label for="keterangan" class="block text-sm font-semibold text-slate-600 mb-1">Keterangan</label>
                <textarea id="keterangan" name="keterangan" rows="3"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 shadow-sm focus:ring-2 focus:ring-[#C95A6B]/40 focus:border-[#C95A6B] focus:outline-none transition resize-none"
                    placeholder="Masukkan keterangan tambahan (opsional)"></textarea>
            </div>

            <!-- TOMBOL -->
            <div class="flex justify-end space-x-4 pt-4">
                <a href="{{ url('/dashboard') }}"
                    class="px-5 py-2.5 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition font-medium shadow-sm">
                    <i class="fa-solid fa-arrow-left mr-2"></i> Batal
                </a>

                <button type="submit"
                    class="px-6 py-2.5 bg-gradient-to-r from-[#842A3B] via-[#B94A5B] to-[#C95A6B] text-white rounded-lg shadow-md hover:shadow-lg hover:opacity-90 transition font-medium flex items-center">
                    <i class="fa-solid fa-paper-plane mr-2"></i> Kirim Pengajuan
                </button>
            </div>
        </form>
    </div>

    <!-- ANIMASI HALUS SAAT HALAMAN MUNCUL -->
    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const formCard = document.querySelector('.max-w-4xl');
                formCard.classList.add('opacity-0', 'translate-y-4');
                setTimeout(() => {
                    formCard.classList.remove('opacity-0', 'translate-y-4');
                    formCard.classList.add('transition', 'duration-500', 'ease-out');
                }, 100);

                const today = new Date().toISOString().split('T')[0];
                const tanggalAwal = document.getElementById('tanggal_awal');
                const tanggalAkhir = document.getElementById('tanggal_akhir');
                const jumlahHari = document.getElementById('jumlah_hari');
                let maxHari = 0; // jumlah hari dari jenis cuti

                tanggalAwal.setAttribute('min', today);
                tanggalAkhir.setAttribute('min', today);

                // === Ambil data Jenis Cuti dari Controller via AJAX ===
                $.ajax({
                    url: "{{ route('getJenisCuti') }}",
                    type: "GET",
                    success: function(response) {
                        if (response.data && response.data.length > 0) {
                            let select = $("#jenis_cuti_id");
                            select.empty();
                            select.append(`<option value="" disabled selected>Pilih jenis cuti</option>`);

                            // Tambahkan jumlah_hari di data-attribute
                            response.data.forEach(item => {
                                select.append(
                                    `<option value="${item.id}" data-jumlah_hari="${item.jumlah_hari}">${item.nama_cuti}</option>`
                                );
                            });
                        }
                    },
                    error: function(xhr) {
                        console.error("Gagal mengambil data jenis cuti:", xhr);
                    }
                });

                // === Simpan jumlah_hari ke variabel saat jenis cuti dipilih ===
                $("#jenis_cuti_id").on("change", function() {
                    maxHari = parseInt($(this).find(":selected").data("jumlah_hari")) || 0;
                    $("#jumlah_hari").val("");
                    $("#tanggal_awal, #tanggal_akhir").val("");
                });

                // === Hitung jumlah hari dan validasi batas maksimal ===
                function hitungHari() {
                    const start = new Date(tanggalAwal.value);
                    const end = new Date(tanggalAkhir.value);

                    if (!tanggalAwal.value || !tanggalAkhir.value) {
                        jumlahHari.value = "";
                        return;
                    }

                    let diff = Math.ceil((end - start) / (1000 * 60 * 60 * 24)) + 1;

                    if (diff <= 0) {
                        alert("Tanggal akhir tidak boleh sebelum tanggal mulai.");
                        tanggalAkhir.value = "";
                        jumlahHari.value = "";
                        return;
                    }

                    if (maxHari > 0 && diff > maxHari) {
                        alert(`Maksimal cuti hanya ${maxHari} hari.`);
                        tanggalAkhir.value = "";
                        jumlahHari.value = "";
                        return;
                    }

                    jumlahHari.value = diff;
                }

                tanggalAwal.addEventListener("change", hitungHari);
                tanggalAkhir.addEventListener("change", hitungHari);

                // === Batasi tanggal akhir sesuai maxHari ===
                $("#tanggal_awal").on("change", function() {
                    if (maxHari > 0) {
                        let start = new Date($(this).val());
                        start.setDate(start.getDate() + (maxHari - 1));
                        let maxDate = start.toISOString().split("T")[0];
                        $("#tanggal_akhir").attr("max", maxDate);
                    }
                });

                // === AMBIL DATA PEGAWAI ===
                $.ajax({
                    url: "{{ route('getUser') }}",
                    type: "GET",
                    success: function(response) {
                        let select = $("#user_id");
                        select.empty().append(
                            `<option value="" disabled selected>Pilih pegawai...</option>`);
                        response.forEach(user => {
                            select.append(`<option value="${user.id}">${user.nama}</option>`);
                        });

                        // aktifkan Select2 agar bisa search nama
                        select.select2({
                            placeholder: "Cari nama pegawai...",
                            allowClear: true,
                            width: '100%'
                        });
                    },
                    error: function() {
                        console.error("Gagal mengambil data pegawai");
                    }
                });
                // === Submit via AJAX ===
                $("#form-tambah-cuti").on("submit", function(e) {
                    e.preventDefault();

                    const formData = $(this).serialize();

                    $.ajax({
                        url: "{{ route('tambah_ajukan_cuti') }}",
                        type: "POST",
                        data: formData,
                        success: function(response) {
                            Swal.fire({
                                title: "Berhasil!",
                                text: "Pengajuan cuti berhasil dikirim.",
                                icon: "success",
                                confirmButtonText: "OK"
                            }).then(() => {
                                window.location.href = "{{ url('/ajukan_cuti') }}";
                            });
                        },
                        error: function(xhr) {
                            console.log(xhr);
                            let msg = "Terjadi kesalahan saat mengirim data.";
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                msg = xhr.responseJSON.message;
                            }
                            Swal.fire("Gagal", msg, "error");
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
