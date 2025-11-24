@extends('layouts.main')

@section('title', 'Master Form Surat')

@section('content')
<div class="max-w-5xl mx-auto bg-white rounded-2xl shadow-xl p-10 mt-8 border border-gray-200">

    <!-- HEADER -->
    <div class="flex items-center justify-between mb-8">
        <h2 class="text-3xl font-bold text-[#842A3B] flex items-center">
            <i class="fa-solid fa-file-signature mr-3 text-[#842A3B]"></i> 
            Master Form Surat
        </h2>
    </div>

    <!-- FORM -->
    <form method="POST" action="{{ route('simpan_formsurat') }}" enctype="multipart/form-data" class="space-y-10">
        @csrf

        <!-- NOMOR SURAT -->
        <div class="bg-[#F8F6F7] p-6 rounded-xl border border-gray-200 shadow-sm">
            <label for="nomor_surat" class="block text-sm font-semibold text-[#842A3B] mb-2">
                Nomor Surat
            </label>
            <input type="text" name="nomor_surat" id="nomor_surat"
                class="w-full border border-gray-300 rounded-lg px-4 py-3 shadow-sm bg-white 
                focus:ring-2 focus:ring-[#C95A6B]/40 focus:border-[#C95A6B]"
                placeholder="Masukkan nomor surat..." required>
        </div>

        <!-- TTD KETUA -->
        <div class="bg-[#F8F6F7] p-6 rounded-xl border border-gray-200 shadow-sm">
            <h3 class="text-lg font-bold text-[#842A3B] mb-4 flex items-center">
                <i class="fa-solid fa-user-pen mr-2"></i> Tanda Tangan Ketua
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Input -->
                <div>
                    <input type="file" name="ttd_ketua" accept="image/*"
                        class="block w-full border border-gray-300 rounded-lg p-3 bg-white cursor-pointer
                        focus:ring-2 focus:ring-[#C95A6B]/40"
                        onchange="previewImage(event, 'ketua')">
                </div>

                <!-- Preview -->
                <div class="flex justify-center">
                    <div id="wrap_ketua" class="relative hidden">
                        <img id="preview_ketua" class="w-40 rounded-lg shadow border border-gray-200">
                        <button type="button" onclick="removePreview('ketua')"
                            class="absolute -top-2 -right-2 bg-red-600 text-white w-6 h-6 
                            rounded-full flex items-center justify-center shadow hover:bg-red-700">
                            ×
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- TTD PANITERA -->
        <div class="bg-[#F8F6F7] p-6 rounded-xl border border-gray-200 shadow-sm">
            <h3 class="text-lg font-bold text-[#842A3B] mb-4 flex items-center">
                <i class="fa-solid fa-user-tie mr-2"></i> Tanda Tangan Atasan Langsung Panitera
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach (['1','2','3'] as $num)
                <div>
                    <label class="text-sm font-semibold text-slate-600 mb-1 block">
                        Panitera {{ $num }}
                    </label>

                    <input type="file" 
                        name="ttd_panitera{{ $num }}" 
                        accept="image/*"
                        class="block w-full border border-gray-300 rounded-lg p-3 bg-white cursor-pointer"
                        onchange="previewImage(event, 'panitera{{ $num }}')">

                    <div id="wrap_panitera{{ $num }}" class="relative w-32 mt-3 mx-auto hidden">
                        <img id="preview_panitera{{ $num }}" class="w-full rounded-lg shadow border border-gray-200">
                        <button type="button" onclick="removePreview('panitera{{ $num }}')"
                            class="absolute -top-2 -right-2 bg-red-600 text-white w-6 h-6 rounded-full 
                            flex items-center justify-center shadow hover:bg-red-700">
                            ×
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- TTD KASUBBAG -->
        <div class="bg-[#F8F6F7] p-6 rounded-xl border border-gray-200 shadow-sm">
            <h3 class="text-lg font-bold text-[#842A3B] mb-4 flex items-center">
                <i class="fa-solid fa-users-gear mr-2"></i> Tanda Tangan Atasan Langsung Kasubbag
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach (['1','2','3'] as $num)
                <div>
                    <label class="text-sm font-semibold text-slate-600 mb-1 block">
                        Kasubbag {{ $num }}
                    </label>

                    <input type="file" name="ttd_kasubbag{{ $num }}" accept="image/*"
                        class="block w-full border border-gray-300 rounded-lg p-3 bg-white cursor-pointer"
                        onchange="previewImage(event, 'kasubbag{{ $num }}')">

                    <div id="wrap_kasubbag{{ $num }}" class="relative w-32 mt-3 mx-auto hidden">
                        <img id="preview_kasubbag{{ $num }}" class="w-full rounded-lg shadow border border-gray-200">
                        <button type="button" onclick="removePreview('kasubbag{{ $num }}')"
                            class="absolute -top-2 -right-2 bg-red-600 text-white w-6 h-6 rounded-full 
                            flex items-center justify-center shadow hover:bg-red-700">
                            ×
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- BUTTON -->
        <div class="flex justify-end space-x-4">
            <a href="{{ url('/dashboard') }}"
                class="px-5 py-2.5 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition font-medium shadow-sm">
                <i class="fa-solid fa-arrow-left mr-2"></i> Kembali
            </a>

            <button type="submit"
                class="px-7 py-3 bg-gradient-to-r from-[#842A3B] via-[#B94A5B] to-[#C95A6B] 
                text-white rounded-lg shadow-md hover:shadow-lg hover:opacity-90 
                transition font-semibold flex items-center">
                <i class="fa-solid fa-save mr-2"></i> Simpan
            </button>
        </div>

    </form>
</div>

<!-- SCRIPT -->
<script>
function previewImage(event, id) {
    const wrap = document.getElementById("wrap_" + id);
    const img = document.getElementById("preview_" + id);
    img.src = URL.createObjectURL(event.target.files[0]);
    wrap.classList.remove("hidden");
}

function removePreview(id) {
    const wrap = document.getElementById("wrap_" + id);
    const input = document.querySelector(`input[name="ttd_${id}"]`);
    wrap.classList.add("hidden");
    input.value = "";
}
</script>
@endsection
