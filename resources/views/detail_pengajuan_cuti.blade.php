@extends('layouts.main')

@section('title', 'Jatah Cuti')
@section('content')
<div id="detailCutiPage" data-id="{{ $id }}">
    <div class="row">
        <div class="col-6">
            <div class="max-w-5xl mx-auto bg-white rounded-2xl shadow-lg p-8 mt-6">
                <input type="hidden" name="status" value="1">
                <!-- NAMA PEGAWAI -->
                <div>
                    <label for="user_id" class="block text-sm font-semibold text-slate-600 mb-1">Nama Pegawai</label>
                    <input type="text" id="user_id" name="user_id" min="1" readonly
                        class="w-full bg-gray-100 cursor-not-allowed border border-gray-300 rounded-lg px-4 py-2.5 shadow-sm focus:outline-none"
                        placeholder="Jumlah hari cuti otomatis muncul">
                </div>

                <!-- JENIS CUTI -->
                <div class="mb-4">
                    <label for="jenis_cuti_id" class="block text-sm font-semibold text-slate-600 mb-1">Jenis
                        Cuti</label>
                    <input type="text" id="jenis_cuti_id" name="jenis_cuti_id" min="1" readonly
                        class="w-full bg-gray-100 cursor-not-allowed border border-gray-300 rounded-lg px-4 py-2.5 shadow-sm focus:outline-none"
                        placeholder="Jumlah hari cuti otomatis muncul">
                </div>

                <!-- TANGGAL -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="mb-4">
                        <label for="tanggal_awal" class="block text-sm font-semibold text-slate-600 mb-1">Tanggal
                            Mulai</label>
                        <input type="date" id="tanggal_awal" name="tanggal_awal" disabled
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-[#C95A6B]/40 focus:border-[#C95A6B] focus:outline-none"
                            min="{{ date('Y-m-d') }}" required>
                    </div>

                    <div class="mb-4">
                        <label for="tanggal_akhir" class="block text-sm font-semibold text-slate-600 mb-1">Tanggal
                            Akhir</label>
                        <input type="date" id="tanggal_akhir" name="tanggal_akhir" disabled
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
                    <textarea id="keterangan" name="keterangan" rows="3" disabled
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 shadow-sm focus:ring-2 focus:ring-[#C95A6B]/40 focus:border-[#C95A6B] focus:outline-none transition resize-none"
                        placeholder="Masukkan keterangan tambahan (opsional)"></textarea>
                </div>
            </div>
        </div>
        <div class="col-6">
            {{-- AKSI KEPEGAWAIAN --}}
            <div class="row">
                <div class="col-12">
                    <div class="max-w-5xl mx-auto bg-white rounded-2xl shadow-lg p-8 mt-6">
                        <form method="POST" action="{{route('aksi_kepegawaian')}}" id="form-aksi">
                            @csrf
                            <input type="hidden" name="ajukan_cuti_id" value="{{ $id }}">
                            <h2>Persetujuan</h2>
                            @role('kepegawaian')
                            <div class="mb-4">
                                <label class="block text-sm font-semibold text-slate-600 mb-1">Aksi Kepegawaian</label>
                                <div class="flex items-center space-x-4">
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="acc" value="1" class="form-radio text-blue-600"
                                            required>
                                        <span class="ml-2 text-gray-700">Acc</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="acc" value="0" class="form-radio text-blue-600">
                                        <span class="ml-2 text-gray-700">Tidak</span>
                                    </label>
                                </div>

                                <div class="mb-4">
                                    <label for="keterangan"
                                        class="block text-sm font-semibold text-slate-600 mb-1">Keterangan</label>
                                    <textarea id="keterangan" name="keterangan"
                                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 shadow-sm focus:outline-none"></textarea>
                                </div>
                            </div>
                            @endrole
                            @role('kasubbag')
                            <div class="mb-4">
                                <label class="block text-sm font-semibold text-slate-600 mb-1">Aksi Kasubbag</label>
                                <div class="flex items-center space-x-4">
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="aksi_kepegawaian" value="0" disabled
                                            class="form-radio text-blue-600">
                                        <span class="ml-2 text-gray-700">Acc</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="aksi_kepegawaian" value="1" disabled
                                            class="form-radio text-blue-600">
                                        <span class="ml-2 text-gray-700">Tidak</span>
                                    </label>
                                </div>
                                <div class="mb-4">
                                    <label for="keterangan"
                                        class="block text-sm font-semibold text-slate-600 mb-1">Keterangan</label>
                                    <textarea id="keterangan" name="keterangan"
                                        class="w-full bg-gray-100 border border-gray-300 rounded-lg px-4 py-2.5 shadow-sm focus:outline-none"></textarea>
                                </div>
                            </div>
                            @endrole
                            @role('sekretaris')
                            <div class="mb-4">
                                <label class="block text-sm font-semibold text-slate-600 mb-1">Aksi Sekretaris</label>
                                <div class="flex items-center space-x-4">
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="aksi_kepegawaian" value="0" disabled
                                            class="form-radio text-blue-600">
                                        <span class="ml-2 text-gray-700">Acc</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="aksi_kepegawaian" value="1" disabled
                                            class="form-radio text-blue-600">
                                        <span class="ml-2 text-gray-700">Tidak</span>
                                    </label>
                                </div>
                                <div class="mb-4">
                                    <label for="keterangan"
                                        class="block text-sm font-semibold text-slate-600 mb-1">Keterangan</label>
                                    <textarea id="keterangan" name="keterangan"
                                        class="w-full bg-gray-100 border border-gray-300 rounded-lg px-4 py-2.5 shadow-sm focus:outline-none"></textarea>
                                </div>
                            </div>
                            @endrole
                            @role('panmud')
                            <div class="mb-4">
                                <label class="block text-sm font-semibold text-slate-600 mb-1">Aksi Panmud</label>
                                <div class="flex items-center space-x-4">
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="aksi_kepegawaian" value="0" disabled
                                            class="form-radio text-blue-600">
                                        <span class="ml-2 text-gray-700">Acc</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="aksi_kepegawaian" value="1" disabled
                                            class="form-radio text-blue-600">
                                        <span class="ml-2 text-gray-700">Tidak</span>
                                    </label>
                                </div>
                                <div class="mb-4">
                                    <label for="keterangan"
                                        class="block text-sm font-semibold text-slate-600 mb-1">Keterangan</label>
                                    <textarea id="keterangan" name="keterangan"
                                        class="w-full bg-gray-100 border border-gray-300 rounded-lg px-4 py-2.5 shadow-sm focus:outline-none"></textarea>
                                </div>
                            </div>
                            @endrole
                            @role('panitera')
                            <div class="mb-4">
                                <label class="block text-sm font-semibold text-slate-600 mb-1">Aksi Panitera</label>
                                <div class="flex items-center space-x-4">
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="aksi_kepegawaian" value="0" disabled
                                            class="form-radio text-blue-600">
                                        <span class="ml-2 text-gray-700">Acc</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="aksi_kepegawaian" value="1" disabled
                                            class="form-radio text-blue-600">
                                        <span class="ml-2 text-gray-700">Tidak</span>
                                    </label>
                                </div>
                                <div class="mb-4">
                                    <label for="keterangan"
                                        class="block text-sm font-semibold text-slate-600 mb-1">Keterangan</label>
                                    <textarea id="keterangan" name="keterangan"
                                        class="w-full bg-gray-border border-gray-300 rounded-lg px-4 py-2.5 shadow-sm focus:outline-none"></textarea>
                                </div>
                            </div>
                            @endrole
                            @role('ketua')
                            <div class="mb-4">
                                <label class="block text-sm font-semibold text-slate-600 mb-1">Aksi Ketua</label>
                                <div class="flex items-center space-x-4">
                                    <button class="btn btn-success">TTE</button>
                                </div>
                            </div>
                            @endrole

                            <div class="mb-4">
                                <div class="flex items-center space-x-4">
                                    <button class="btn btn-success">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>
<script>
    $(document).ready(function () {
    const id = $('#detailCutiPage').data('id');

    $.ajax({
        url: `/getPengajuanCutiById/${id}`,
        type: 'GET',
        success: function (response) {
            if (response.data) {
                const d = response.data;
                // ambil relasi user dan jenis cuti
                $('#id').val(d.id);
                $('#user_id').val(d.user ? d.user.nama : '-');
                $('#jenis_cuti_id').val(d.jenis_cuti ? d.jenis_cuti.nama_cuti : '-');
                $('#tanggal_awal').val(d.tanggal_awal);
                $('#tanggal_akhir').val(d.tanggal_akhir);
                $('#jumlah_hari').val(d.jumlah_hari);
                $('#keterangan').val(d.keterangan);
            } else {
                Swal.fire('Oops!', 'Data tidak ditemukan.', 'warning');
            }
        },
        error: function () {
            Swal.fire('Error', 'Gagal mengambil data pengajuan cuti.', 'error');
        }
    });
});
</script>
{{-- ajax tambah jenis cuti --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
            const formCuti = document.getElementById("form-aksi");

            formCuti.addEventListener("submit", function(e) {
                e.preventDefault(); // Biar gak reload

                const formData = new FormData(formCuti);

                fetch("{{ route('aksi_kepegawaian') }}", {
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
                            }).then(() => {
                                window.location.href = "{{ url('/list_ajukan_cuti') }}";
                            });
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
@endsection
