@extends('layouts.main')

@section('title', 'Tracking Pengajuan Cuti')

@section('content')
<div class="max-w-5xl mx-auto bg-white p-8 rounded-2xl shadow-lg border border-gray-200 mt-6">
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-[#842A3B]">Tracking Pengajuan Cuti</h2>
            <p class="text-gray-600">Lihat posisi pengajuan cuti Anda dalam proses verifikasi dan persetujuan.</p>
        </div>
        <div class="bg-gradient-to-r from-[#842A3B] to-[#C95A6B] text-white px-4 py-2 rounded-xl text-sm font-semibold shadow">
            <i class="fa-solid fa-clipboard-list mr-2"></i> Status Cuti
        </div>
    </div>

    <!-- Pilih Pengajuan -->
    <div class="mb-8">
        <label for="pengajuan_id" class="block text-sm font-medium text-gray-700 mb-2">Pilih Pengajuan</label>
        <select id="pengajuan_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#842A3B] focus:border-[#842A3B] transition">
            <option value="">-- Pilih Pengajuan Cuti --</option>
            <option value="1">Cuti Tahunan - 12/10/2025 s.d 14/10/2025</option>
            <option value="2">Cuti Besar - 01/11/2025 s.d 10/11/2025</option>
        </select>
    </div>

    <!-- Timeline Section -->
    <div class="relative pl-8">
        <!-- Vertical line -->
        <div class="absolute left-3 top-0 bottom-0 w-1 bg-gradient-to-b from-[#842A3B] to-[#C95A6B] rounded-full"></div>

        <!-- Step 1 -->
        <div class="relative mb-8">
            <div class="flex items-center">
                <div class="w-6 h-6 rounded-full bg-yellow-400 border-4 border-white shadow-md"></div>
                <h3 class="ml-4 text-lg font-semibold text-gray-800">Sedang diverifikasi kepegawaian</h3>
            </div>
            <p class="ml-10 mt-2 text-sm text-gray-500">Tanggal: 12 Oktober 2025</p>
        </div>

        <!-- Step 2 -->
        <div class="relative mb-8">
            <div class="flex items-center">
                <div class="w-6 h-6 rounded-full bg-orange-400 border-4 border-white shadow-md"></div>
                <h3 class="ml-4 text-lg font-semibold text-gray-800">Menunggu persetujuan atasan langsung</h3>
            </div>
            <p class="ml-10 mt-2 text-sm text-gray-500">Atasan langsung: Panitera</p>
        </div>

        <!-- Step 3 -->
        <div class="relative mb-8">
            <div class="flex items-center">
                <div class="w-6 h-6 rounded-full bg-green-500 border-4 border-white shadow-md"></div>
                <h3 class="ml-4 text-lg font-semibold text-gray-800">Sudah disetujui atasan langsung</h3>
            </div>
            <p class="ml-10 mt-2 text-sm text-gray-500">Disetujui pada 13 Oktober 2025</p>
        </div>

        <!-- Step 4 -->
        <div class="relative mb-8">
            <div class="flex items-center">
                <div class="w-6 h-6 rounded-full bg-purple-400 border-4 border-white shadow-md"></div>
                <h3 class="ml-4 text-lg font-semibold text-gray-800">Menunggu persetujuan ketua</h3>
            </div>
            <p class="ml-10 mt-2 text-sm text-gray-500">Ketua: Bapak Andi Saputra</p>
        </div>

        <!-- Step 5 -->
        <div class="relative">
            <div class="flex items-center">
                <div class="w-6 h-6 rounded-full bg-[#842A3B] border-4 border-white shadow-md"></div>
                <h3 class="ml-4 text-lg font-semibold text-gray-800">Sudah disetujui ketua</h3>
            </div>
            <p class="ml-10 mt-2 text-sm text-gray-500">Disetujui pada 14 Oktober 2025</p>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // nanti bisa kamu isi logika fetch status dari database via AJAX
        // berdasarkan user login dan pengajuan_id yang dipilih
    });
</script>
@endpush
@endsection
