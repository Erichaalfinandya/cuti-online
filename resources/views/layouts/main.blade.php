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

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

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
                    <img src="/build/assets/img/logo.png" alt="Logo" class="w-10 h-10">
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
                    <li>
                        <a href="#"
                            class="flex items-center p-3 rounded-xl transition duration-200
              hover:bg-[#842A3B]/10 hover:text-[#842A3B] text-slate-600">
                            <i class="fa-solid fa-house mr-3 text-[#842A3B]"></i> Home
                        </a>
                    </li>

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
                    <li>
                        <a href="{{ route('jatah-cuti') }}"
                            class="flex items-center p-3 rounded-xl transition duration-200
              {{ request()->routeIs('jatah-cuti')
                  ? 'bg-gradient-to-r from-[#842A3B] to-[#C95A6B] text-white shadow-md'
                  : 'hover:bg-[#842A3B]/10 hover:text-[#842A3B] text-slate-600' }}">
                            <i
                                class="fa-solid fa-calendar-days mr-3 {{ request()->routeIs('jatah-cuti') ? 'text-white' : 'text-[#842A3B]' }}"></i>
                            Jatah Cuti
                        </a>
                    </li>
                    <!-- RIWAYAT CUTI -->
                    <li>
                        <a href="{{ route('riwayat-cuti.index') }}"
                            class="flex items-center p-3 rounded-xl transition duration-200
              {{ request()->routeIs('riwayat-cuti.index')
                  ? 'bg-gradient-to-r from-[#842A3B] to-[#C95A6B] text-white shadow-md'
                  : 'hover:bg-[#842A3B]/10 hover:text-[#842A3B] text-slate-600' }}">
                            <i
                                class="fa-solid fa-clock-rotate-left mr-3 {{ request()->routeIs('riwayat-cuti.index') ? 'text-white' : 'text-[#842A3B]' }}"></i>
                            Riwayat Cuti
                        </a>
                    </li>
                    <!-- MASTER JENIS CUTI -->
                    <li>
                        <a href="{{ route('master.jeniscuti') }}"
                            class="flex items-center p-3 rounded-xl transition duration-200
              {{ request()->routeIs('master.jeniscuti')
                  ? 'bg-gradient-to-r from-[#842A3B] to-[#C95A6B] text-white shadow-md'
                  : 'hover:bg-[#842A3B]/10 hover:text-[#842A3B] text-slate-600' }}">
                            <i
                                class="fa-solid fa-clipboard-list mr-3 {{ request()->routeIs('master.jeniscuti') ? 'text-white' : 'text-[#842A3B]' }}"></i>
                            Master Jenis Cuti
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Bawah -->
            <div class="mt-10">
                <p class="text-xs uppercase font-bold text-slate-500 mb-3 tracking-wider">Account Pages</p>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit"
                        class="flex items-center p-3 rounded-xl hover:bg-[#842A3B]/10 hover:text-[#842A3B] text-slate-600 transition">
                        <i class="fa-solid fa-user mr-3 text-[#842A3B]"></i> Logout
                    </button>
                </form>

            </div>
        </aside>

        <!-- MAIN CONTENT -->
        <main class="flex-1 p-6 bg-gray-50">
            {{-- 🔺 Navbar --}}
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-[#842A3B]">@yield('page-title')</h2>
                    <p class="text-sm text-gray-500">@yield('page-subtitle', 'Selamat datang di sistem cuti online')</p>
                </div>

                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text"
                            class="pl-10 pr-3 py-2 rounded-lg border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-[#C95A6B]/50"
                            placeholder="Cari..." />
                    </div>

                    <button class="text-gray-600 hover:text-[#842A3B]">
                        <i class="fas fa-bell text-lg"></i>
                    </button>

                    <div class="flex items-center space-x-2">
                        <img src="/build/assets/img/profile.jpg" alt="Profile" class="w-8 h-8 rounded-full">
                        <span class="text-sm font-medium text-gray-700">Admin</span>
                    </div>
                </div>
            </div>
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>

</html>
