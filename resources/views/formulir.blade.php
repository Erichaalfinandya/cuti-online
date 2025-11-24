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
        {{-- <div>
            <label for="user_id" class="block text-sm font-semibold text-slate-600 mb-1">Nama Pegawai</label>
            <select name="user_id" id="user_id"
                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 shadow-sm bg-white focus:ring-2 focus:ring-[#C95A6B]/40 focus:border-[#C95A6B] focus:outline-none transition"
                required>
                <option value="">-- Pilih --</option>
                @foreach ($user as $item)
                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                @endforeach
            </select>
        </div> --}}

        <div>
            <label for="user_nama" class="block text-sm font-semibold text-slate-600 mb-1">
                Nama Pegawai
            </label>

            {{-- Tampilkan nama pegawai (readonly) --}}
            <input type="text" id="user_nama" value="{{ auth()->user()->nama }}"
                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 shadow-sm bg-gray-100 cursor-not-allowed"
                readonly>

            {{-- Hidden input untuk kirim id pegawai --}}
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
        </div>


        <!-- JENIS CUTI -->
        <div class="mb-4">
            <label for="jenis_cuti_id" class="block text-sm font-semibold text-slate-600 mb-1">Jenis Cuti</label>
            <select name="jenis_cuti_id" id="jenis_cuti_id"
                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 shadow-sm bg-white focus:ring-2 focus:ring-[#C95A6B]/40 focus:border-[#C95A6B] focus:outline-none transition"
                required>
                <option value="">-- Pilih --</option>
                @foreach ($jenisCuti as $item)
                <option value="{{ $item->id }}" data-jumlah_hari="{{ $item->jumlah_hari }}">
                    {{ $item->nama_cuti }}
                </option>
                @endforeach
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

        <!-- ALAMAT PENGAJUAN CUTI -->
        <div>
            <label for="alamat_cuti" class="block text-sm font-semibold text-slate-600 mb-1">
                Alamat Selama Cuti
            </label>

            <textarea id="alamat_cuti" name="alamat_cuti" rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 shadow-sm
                    focus:ring-2 focus:ring-[#C95A6B]/40 focus:border-[#C95A6B]
                    focus:outline-none transition resize-none"
                placeholder="Masukkan alamat tempat tinggal selama cuti..." required></textarea>
        </div>

        <!-- TANDA TANGAN PEMOHON -->
        <div>
            <label class="block text-sm font-semibold text-[#842A3B] mb-3">
                Tanda Tangan Pemohon
            </label>

            <div class="bg-[#FDFBFA] border border-gray-200 rounded-2xl shadow-lg p-6">

                <!-- Header -->
                <div class="flex items-center mb-4">
                    <div class="h-10 w-10 flex items-center justify-center rounded-xl
                                bg-gradient-to-r from-[#842A3B] to-[#C95A6B] text-white shadow">
                        <i class="fa-solid fa-signature text-lg"></i>
                    </div>
                    <h3 class="ml-3 text-lg font-bold text-[#842A3B]">
                        Area Tanda Tangan
                    </h3>
                </div>

                <hr class="border-gray-300 mb-5">

                <!-- Toolbar -->
                <div class="flex items-center justify-between mb-4">
                    <p class="text-xs text-gray-500 italic">
                        Gunakan mouse / layar sentuh untuk menandatangani
                    </p>

                    <div class="flex space-x-2">
                        <button type="button" id="undo-signature" class="px-4 py-2 text-xs font-semibold rounded-lg
                                bg-gradient-to-r from-[#842A3B] to-[#B94A5B]
                                text-white shadow-md hover:shadow-lg hover:opacity-90
                                transition flex items-center">
                            <i class="fa-solid fa-rotate-left mr-1"></i> Undo
                        </button>
                        <button type="button" id="clear-signature" class="px-4 py-2 text-xs font-semibold rounded-lg
                               bg-gradient-to-r from-[#B94A5B] to-[#C95A6B]
                               text-white shadow-md hover:shadow-lg hover:opacity-90
                               transition flex items-center">
                            <i class="fa-solid fa-trash mr-1"></i> Clear
                        </button>
                    </div>
                </div>

                <!-- Canvas -->
                <div class="flex justify-center">
                    <div class="border-2 border-dashed border-gray-300 rounded-xl bg-white shadow-inner p-3">
                        <canvas id="signature-canvas" width="480" height="200" class="rounded-lg shadow-sm">
                        </canvas>
                    </div>
                </div>

            </div>

            <!-- Base64 (hidden input) -->
            <input type="hidden" name="ttd_pemohon" id="ttd_pemohon">
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
    $(document).ready(function() {
        $('#user_id').select2({
            placeholder: "-- Pilih Pegawai --",
            allowClear: true,
            width: '100%' // biar nggak kepotong
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
    const today = new Date().toISOString().split('T')[0];
    const tanggalAwal = document.getElementById('tanggal_awal');
    const tanggalAkhir = document.getElementById('tanggal_akhir');
    const jumlahHari = document.getElementById('jumlah_hari');
    const jenisCuti = document.getElementById('jenis_cuti_id');
    let maxHari = 0;

    // 🔒 Tanggal awal tidak bisa sebelum hari ini
    tanggalAwal.setAttribute('min', today);
    tanggalAkhir.setAttribute('min', today);

    // 🎯 Ambil jumlah_hari dari option yang dipilih
    jenisCuti.addEventListener('change', function() {
        const selected = this.options[this.selectedIndex];
        maxHari = parseInt(selected.dataset.jumlah_hari) || 0;

        // reset nilai lama
        tanggalAwal.value = '';
        tanggalAkhir.value = '';
        jumlahHari.value = '';
        tanggalAkhir.removeAttribute('max');
        tanggalAkhir.setAttribute('min', today);
    });

    // 🔁 Hitung jumlah hari cuti
    function hitungHari() {
        if (!tanggalAwal.value || !tanggalAkhir.value) {
            jumlahHari.value = '';
            return;
        }

        const start = new Date(tanggalAwal.value);
        const end = new Date(tanggalAkhir.value);

        // Validasi tanggal akhir tidak boleh sebelum tanggal awal
        if (end < start) {
            alert('Tanggal akhir tidak boleh sebelum tanggal awal!');
            tanggalAkhir.value = '';
            jumlahHari.value = '';
            return;
        }

        // Hitung selisih hari
        let diff = Math.ceil((end - start) / (1000 * 60 * 60 * 24)) + 1;

        // Batasi maksimal hari sesuai jenis cuti
        if (maxHari > 0 && diff > maxHari) {
            alert(`Maksimal cuti hanya ${maxHari} hari.`);
            tanggalAkhir.value = '';
            jumlahHari.value = '';
            return;
        }

        jumlahHari.value = diff;
    }

    // ⏳ Saat tanggal awal diubah, perbarui batas minimal & maksimal tanggal akhir
    tanggalAwal.addEventListener('change', function() {
        const start = new Date(this.value);

        // tanggal akhir minimal = tanggal awal
        tanggalAkhir.setAttribute('min', this.value);

        // tanggal akhir maksimal = tanggal awal + (maxHari - 1)
        if (maxHari > 0) {
            const maxDate = new Date(start);
            maxDate.setDate(start.getDate() + (maxHari - 1));
            tanggalAkhir.setAttribute('max', maxDate.toISOString().split('T')[0]);
        }

        // reset tanggal akhir & jumlah hari setiap kali ubah tanggal awal
        tanggalAkhir.value = '';
        jumlahHari.value = '';
    });

    tanggalAkhir.addEventListener('change', hitungHari);
});
</script>

{{-- ajax tambah jenis cuti --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
            const formCuti = document.getElementById("form-tambah-cuti");

            formCuti.addEventListener("submit", function(e) {
                e.preventDefault(); // Biar gak reload

                const formData = new FormData(formCuti);

                // validasi wajib isi tanda tangan
                if (!document.getElementById("ttd_pemohon").value) {
                    Swal.fire({
                        icon: "warning",
                        title: "Tanda tangan belum diisi",
                        text: "Silakan tanda tangan terlebih dahulu sebelum mengajukan cuti.",
                    });
                    return;
                }

                fetch("{{ route('tambah_ajukan_cuti') }}", {
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

<script>
    document.addEventListener("DOMContentLoaded", function () {

        const canvas = document.getElementById("signature-canvas");
        const ctx = canvas.getContext("2d");
        const output = document.getElementById("ttd_pemohon");

        let drawing = false;
        let strokes = [];
        let currentStroke = [];

        // === MULAI MENGGAMBAR ===
        canvas.addEventListener("mousedown", (e) => {
            drawing = true;
            currentStroke = [];

            const {x, y} = getPosition(e);
            currentStroke.push({ x, y });
        });

        canvas.addEventListener("mousemove", (e) => {
            if (!drawing) return;

            const {x, y} = getPosition(e);
            currentStroke.push({ x, y });

            ctx.lineWidth = 2;
            ctx.lineCap = "round";
            ctx.strokeStyle = "#000";

            let last = currentStroke[currentStroke.length - 2];
            if (!last) return;

            ctx.beginPath();
            ctx.moveTo(last.x, last.y);
            ctx.lineTo(x, y);
            ctx.stroke();
        });

        canvas.addEventListener("mouseup", () => {
            drawing = false;
            strokes.push(currentStroke);
            saveSignature();
        });

        canvas.addEventListener("mouseleave", () => drawing = false);

        // === FUNGSI DAPATKAN POSISI KURSOR ===
        function getPosition(ev) {
            const rect = canvas.getBoundingClientRect();
            return {
                x: ev.clientX - rect.left,
                y: ev.clientY - rect.top
            };
        }

        // === UNDO ===
        document.getElementById("undo-signature").onclick = () => {
            strokes.pop();
            redrawCanvas();
            saveSignature();
        };

        // === CLEAR ===
        document.getElementById("clear-signature").onclick = () => {
            strokes = [];
            redrawCanvas();
            output.value = "";
        };

        // === RENDER ULANG ===
        function redrawCanvas() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);

            ctx.lineWidth = 2;
            ctx.lineCap = "round";
            ctx.strokeStyle = "#000";

            strokes.forEach(stroke => {
                ctx.beginPath();
                for (let i = 1; i < stroke.length; i++) {
                    ctx.moveTo(stroke[i - 1].x, stroke[i - 1].y);
                    ctx.lineTo(stroke[i].x, stroke[i].y);
                }
                ctx.stroke();
            });
        }

        // === SIMPAN BASE64 ===
        function saveSignature() {
            output.value = canvas.toDataURL("image/png");
        }
    });
</script>

@endpush
@endsection
