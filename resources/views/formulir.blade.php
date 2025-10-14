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
        <form id="form-cuti">
            @csrf

            <!-- NAMA PEGAWAI -->
            <div>
                <label for="nama_pegawai" class="block text-sm font-semibold text-slate-600 mb-1">Nama Pegawai</label>
                <input type="text" id="nama_pegawai" name="nama_pegawai"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 shadow-sm focus:ring-2 focus:ring-[#C95A6B]/40 focus:border-[#C95A6B] focus:outline-none transition"
                    placeholder="Masukkan nama pegawai" required>
            </div>

            <!-- JENIS CUTI -->
            <div>
                <label for="jenis_cuti" class="block text-sm font-semibold text-slate-600 mb-1">Jenis Cuti</label>
                <select id="jenis_cuti" name="jenis_cuti"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 shadow-sm bg-white focus:ring-2 focus:ring-[#C95A6B]/40 focus:border-[#C95A6B] focus:outline-none transition"
                    required>
                    <option value="" disabled selected>Pilih jenis cuti</option>
                    <option value="Cuti Tahunan">Cuti Tahunan</option>
                    <option value="Cuti Besar">Cuti Besar</option>
                    <option value="Cuti Sakit">Cuti Sakit</option>
                    <option value="Cuti Melahirkan">Cuti Melahirkan</option>
                    <option value="Cuti di Luar Tanggungan Negara">Cuti di Luar Tanggungan Negara</option>
                </select>
            </div>

            <!-- TANGGAL -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="tanggal_awal" class="block text-sm font-semibold text-slate-600 mb-1">Tanggal Awal</label>
                    <input type="date" id="tanggal_awal" name="tanggal_awal"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 shadow-sm focus:ring-2 focus:ring-[#C95A6B]/40 focus:border-[#C95A6B] focus:outline-none transition"
                        required>
                </div>

                <div>
                    <label for="tanggal_akhir" class="block text-sm font-semibold text-slate-600 mb-1">Tanggal Akhir</label>
                    <input type="date" id="tanggal_akhir" name="tanggal_akhir"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 shadow-sm focus:ring-2 focus:ring-[#C95A6B]/40 focus:border-[#C95A6B] focus:outline-none transition"
                        required>
                </div>
            </div>

            <!-- JUMLAH HARI -->
            <div>
                <label for="jumlah_hari" class="block text-sm font-semibold text-slate-600 mb-1">Jumlah Hari</label>
                <input type="number" id="jumlah_hari" name="jumlah_hari" min="1"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 shadow-sm focus:ring-2 focus:ring-[#C95A6B]/40 focus:border-[#C95A6B] focus:outline-none transition"
                    placeholder="Masukkan jumlah hari cuti" required>
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
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const formCard = document.querySelector('.max-w-4xl');
                formCard.classList.add('opacity-0', 'translate-y-4');
                setTimeout(() => {
                    formCard.classList.remove('opacity-0', 'translate-y-4');
                    formCard.classList.add('transition', 'duration-500', 'ease-out');
                }, 100);
            });
        </script>
    @endpush
@endsection
