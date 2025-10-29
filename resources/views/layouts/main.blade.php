<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Cuti Online')</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- DataTables CSS & JS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.min.css">

    {{-- TAMBAHAN: agar x-cloak bisa menyembunyikan modal sebelum Alpine aktif --}}
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

</head>

<body class="bg-gray-50 text-slate-700">
    <div class="flex min-h-screen">

        <!-- Sidebar -->
        <aside class="w-72 bg-white shadow-xl p-6 flex flex-col justify-between">
            <div>
                <!-- Logo -->
                <div class="flex items-center mb-10 space-x-3">
                    <img src="{{ asset('logo-pengadilan-pamekasan.jpg') }}" alt="Logo" class="w-10 h-10">
                    <span class="text-lg font-semibold">Pengadilan Negeri Pamekasan</span>
                </div>

                <!-- Menu -->
                <ul class="space-y-3">
                    <!-- DASHBOARD -->
                    <li>
                        <a href="{{ url('/dashboard') }}"
                            class="flex items-center p-3 rounded-xl transition duration-200
              {{ request()->is('dashboard')
                  ? 'bg-gradient-to-r from-[#842A3B] to-[#C95A6B] text-white shadow-md'
                  : 'hover:bg-[#842A3B]/10 text-slate-600 hover:text-[#842A3B]' }}">
                            <i
                                class="fa-solid fa-chart-line mr-3 {{ request()->is('dashboard') ? 'text-white' : 'text-[#842A3B]' }}"></i>
                            Dashboard
                        </a>
                    </li>
                    <!-- HOME -->
                    {{-- <li>
                        <a href="#" class="flex items-center p-3 rounded-xl transition duration-200
              hover:bg-[#842A3B]/10 hover:text-[#842A3B] text-slate-600">
                            <i class="fa-solid fa-house mr-3 text-[#842A3B]"></i> Home
                        </a>
                    </li> --}}

                    <!-- FORMULIR -->
                    <li>
                        <a href="{{ route('formulir') }}"
                            class="flex items-center p-3 rounded-xl transition duration-200
              {{ request()->routeIs('formulir')
                  ? 'bg-gradient-to-r from-[#842A3B] to-[#C95A6B] text-white shadow-md'
                  : 'hover:bg-[#842A3B]/10 hover:text-[#842A3B] text-slate-600' }}">
                            <i
                                class="fa-solid fa-file-lines mr-3 {{ request()->routeIs('formulir') ? 'text-white' : 'text-[#842A3B]' }}"></i>
                            Formulir
                        </a>
                    </li>
                    <!-- JATAH CUTI -->
                    {{-- @role('kepegawaian') --}}
                    <li>
                        <a href="{{ route('jatah_cuti') }}"
                            class="flex items-center p-3 rounded-xl transition duration-200
              {{ request()->routeIs('jatah_cuti')
                  ? 'bg-gradient-to-r from-[#842A3B] to-[#C95A6B] text-white shadow-md'
                  : 'hover:bg-[#842A3B]/10 hover:text-[#842A3B] text-slate-600' }}">
                            <i
                                class="fa-solid fa-calendar-days mr-3 {{ request()->routeIs('jatah_cuti') ? 'text-white' : 'text-[#842A3B]' }}"></i>
                            Jatah Cuti
                        </a>
                    </li>
                    {{-- @endrole --}}
                    <!-- RIWAYAT CUTI -->
                    <li>
                        <a href="{{ route('list_ajukan_cuti') }}"
                            class="flex items-center p-3 rounded-xl transition duration-200
              {{ request()->routeIs('list_ajukan_cuti')
                  ? 'bg-gradient-to-r from-[#842A3B] to-[#C95A6B] text-white shadow-md'
                  : 'hover:bg-[#842A3B]/10 hover:text-[#842A3B] text-slate-600' }}">
                            <i
                                class="fa-solid fa-clock-rotate-left mr-3 {{ request()->routeIs('list_ajukan_cuti') ? 'text-white' : 'text-[#842A3B]' }}"></i>
                            Riwayat Cuti
                        </a>
                    </li>
                    <!-- MASTER JENIS CUTI -->
                    @role('kepegawaian')
                        <li>
                            <a href="{{ route('master_jenis_cuti') }}"
                                class="flex items-center p-3 rounded-xl transition duration-200
              {{ request()->routeIs('master_jenis_cuti')
                  ? 'bg-gradient-to-r from-[#842A3B] to-[#C95A6B] text-white shadow-md'
                  : 'hover:bg-[#842A3B]/10 hover:text-[#842A3B] text-slate-600' }}">
                                <i
                                    class="fa-solid fa-clipboard-list mr-3 {{ request()->routeIs('master_jenis_cuti') ? 'text-white' : 'text-[#842A3B]' }}"></i>
                                Master Jenis Cuti
                            </a>
                        </li>
                    @endrole
                    <!-- TRACKING CUTI -->
                    <li>
                        <a href="{{ route('tracking') }}"
                            class="flex items-center p-3 rounded-xl transition duration-200
                            {{ request()->routeIs('tracking')
                                ? 'bg-gradient-to-r from-[#842A3B] to-[#C95A6B] text-white shadow-md'
                                : 'hover:bg-[#842A3B]/10 hover:text-[#842A3B] text-slate-600' }}">
                            <i class="fa-solid fa-route mr-3 {{ request()->routeIs('tracking') ? 'text-white' : 'text-[#842A3B]' }}"></i>
                            Tracking Cuti
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Bawah -->
            <div class="mt-10">
                <p class="text-xs uppercase font-bold text-slate-500 mb-3 tracking-wider">
                    {{ Auth::user()->nama }} <br>
                    {{ Auth::user()->jabatan }} <br>
                    {{ Auth::user()->golongan }}
                </p>
                <button id="btnLogout" type="button"
                    class="flex items-center gap-2 px-4 py-2 rounded-lg text-white font-semibold
                        bg-gradient-to-r from-[#842A3B] to-[#C95A6B]
                        hover:from-[#C95A6B] hover:to-[#842A3B]
                        transition-all duration-300 shadow-md hover:shadow-lg">
                    <i class="fas fa-sign-out-alt text-sm"></i>
                    Logout
                </button>
            </div>
        </aside>

        <!-- MAIN CONTENT -->
        <main class="flex-1 p-6 bg-gray-50">
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>


    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const btnLogout = document.getElementById("btnLogout");

            if (btnLogout) {
                btnLogout.addEventListener("click", function() {
                    Swal.fire({
                        title: "Yakin mau logout?",
                        text: "Sesi kamu akan diakhiri.",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        cancelButtonColor: "#3085d6",
                        confirmButtonText: "Ya, keluar!",
                        cancelButtonText: "Batal"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch("{{ route('logout') }}", {
                                    method: "POST",
                                    headers: {
                                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                        "Accept": "application/json",
                                    },
                                })
                                .then(async (response) => {
                                    const data = await response.json();

                                    if (response.ok && data.status === "success") {
                                        Swal.fire({
                                            icon: "success",
                                            title: "Logout berhasil",
                                            text: data.message,
                                            timer: 1500,
                                            showConfirmButton: false,
                                        });

                                        setTimeout(() => {
                                            window.location.href = data.redirect;
                                        }, 1500);
                                    } else {
                                        Swal.fire({
                                            icon: "error",
                                            title: "Gagal logout",
                                            text: data.message ||
                                                "Terjadi kesalahan.",
                                        });
                                    }
                                })
                                .catch((error) => {
                                    console.error(error);
                                    Swal.fire({
                                        icon: "error",
                                        title: "Kesalahan server",
                                        text: "Coba lagi nanti.",
                                    });
                                });
                        }
                    });
                });
            }
        });
    </script>

    @stack('scripts')
</body>

</html>
