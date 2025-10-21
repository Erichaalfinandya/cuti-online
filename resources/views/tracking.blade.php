@extends('layouts.main')

@section('title', 'Tracking Pengajuan Cuti')

@section('content')
<div class="max-w-5xl mx-auto bg-white p-8 rounded-2xl shadow-lg border border-gray-200">
    <h2 class="text-2xl font-bold text-[#842A3B] mb-2">Tracking Pengajuan Cuti</h2>
    <p class="text-gray-600 mb-8">Lihat posisi pengajuan cuti Anda dalam proses verifikasi dan persetujuan.</p>

    <!-- Pilih Pengajuan -->
    <div class="mb-6">
        <label for="pengajuan_id" class="block text-sm font-medium text-gray-700 mb-1">Pilih Pengajuan</label>
        <select id="pengajuan_id" class="w-full border rounded-lg px-3 py-2 focus:ring-[#842A3B]">
            <option value="">-- Pilih Pengajuan Cuti --</option>
            <option value="1">Cuti Tahunan - 12/10/2025 s.d 14/10/2025</option>
            <option value="2">Cuti Besar - 01/11/2025 s.d 10/11/2025</option>
        </select>
    </div>

    <!-- Tracking Timeline -->
    <div id="trackingTimeline" class="relative border-l-4 border-[#842A3B]/40 pl-6">
        <!-- Step -->
        <div class="mb-6">
            <div class="flex items-center">
                <div class="w-4 h-4 rounded-full bg-yellow-400 border-2 border-[#842A3B]"></div>
                <p class="ml-3 font-semibold text-gray-700">Sedang diverifikasi kepegawaian</p>
            </div>
            <p class="text-sm text-gray-500 ml-7 mt-1">Tanggal: 12 Oktober 2025</p>
        </div>

        <div class="mb-6">
            <div class="flex items-center">
                <div class="w-4 h-4 rounded-full bg-orange-400 border-2 border-[#842A3B]"></div>
                <p class="ml-3 font-semibold text-gray-700">Menunggu persetujuan atasan langsung</p>
            </div>
            <p class="text-sm text-gray-500 ml-7 mt-1">Atasan langsung: Panitera</p>
        </div>

        <div class="mb-6">
            <div class="flex items-center">
                <div class="w-4 h-4 rounded-full bg-green-500 border-2 border-[#842A3B]"></div>
                <p class="ml-3 font-semibold text-gray-700">Sudah disetujui atasan langsung</p>
            </div>
            <p class="text-sm text-gray-500 ml-7 mt-1">Disetujui pada 13 Oktober 2025</p>
        </div>

        <div class="mb-6">
            <div class="flex items-center">
                <div class="w-4 h-4 rounded-full bg-purple-400 border-2 border-[#842A3B]"></div>
                <p class="ml-3 font-semibold text-gray-700">Menunggu persetujuan ketua</p>
            </div>
            <p class="text-sm text-gray-500 ml-7 mt-1">Ketua: Bapak Andi Saputra</p>
        </div>

        <div>
            <div class="flex items-center">
                <div class="w-4 h-4 rounded-full bg-[#842A3B] border-2 border-[#842A3B]"></div>
                <p class="ml-3 font-semibold text-gray-700">Sudah disetujui ketua</p>
            </div>
            <p class="text-sm text-gray-500 ml-7 mt-1">Disetujui pada 14 Oktober 2025</p>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // nanti disini bisa kamu isi logika fetch status dari database via AJAX
        // berdasarkan user login dan pengajuan_id yang dipilih
    });
</script>
@endpush
@endsection
