<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Pegawai - Cuti Online</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 text-slate-700">

  <!-- Wrapper utama -->
  <div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-72 bg-white shadow-xl p-6 flex flex-col justify-between">
      <div>
        <!-- Logo / Header -->
        <div class="flex items-center mb-10 space-x-3">
          <img src="/build/assets/img/logo.png" alt="Logo"
            class="w-10 h-10">
          <span class="text-lg font-semibold">Pengadilan Negeri Pamekasan</span>
        </div>

        <!-- Menu Navigasi -->
        <ul class="space-y-3">
          <li>
            <a href="{{ route('dashboard') }}"
               class="flex items-center p-3 rounded-xl font-medium 
               {{ request()->routeIs('dashboard') ? 'bg-fuchsia-100 text-fuchsia-700' : 'hover:bg-gray-100 text-slate-600' }}">
              <i class="fa-solid fa-chart-line mr-3"></i> Dashboard
            </a>
          </li>
          <li>
            <a href="#" class="flex items-center p-3 hover:bg-gray-100 rounded-xl">
              <i class="fa-solid fa-house mr-3 text-slate-500"></i> Home
            </a>
          </li>
          <li>
            <a href="#" class="flex items-center p-3 hover:bg-gray-100 rounded-xl">
              <i class="fa-solid fa-file-lines mr-3 text-slate-500"></i> Formulir
            </a>
          </li>
          <li>
            <a href="{{ route('jatah-cuti') }}" class="flex items-center p-3 hover:bg-gray-100 rounded-xl">
              <i class="fa-solid fa-calendar-days mr-3"></i> Jatah Cuti
            </a>
          </li>        
          <li>
            <a href="{{ route('riwayat.cuti') }}"
               class="flex items-center p-3 rounded-xl font-medium 
               {{ request()->routeIs('riwayat.cuti') ? 'bg-fuchsia-100 text-fuchsia-700' : 'hover:bg-gray-100 text-slate-600' }}">
              <i class="fa-solid fa-clock-rotate-left mr-3"></i> Riwayat Cuti
            </a>
          </li>
        </ul>
      </div>

      <!-- Bagian bawah sidebar -->
      <div class="mt-10">
        <p class="text-xs uppercase font-bold text-slate-500 mb-3">Account Pages</p>
        <a href="#" class="flex items-center p-3 hover:bg-gray-100 rounded-xl">
          <i class="fa-solid fa-user mr-3 text-slate-500"></i> Profile
        </a>
      </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6 bg-gray-50 min-h-screen">

      <!-- Navbar -->
      <nav
        class="relative flex flex-wrap items-center justify-between px-0 py-2 mx-6 transition-all shadow-none duration-250 ease-soft-in rounded-2xl lg:flex-nowrap lg:justify-start bg-white">
        <div class="flex items-center justify-between w-full px-4 py-1 mx-auto flex-wrap-inherit">
          <nav>
            <!-- breadcrumb -->
            <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
              <li class="leading-normal text-sm">
                <a class="opacity-50 text-slate-700" href="javascript:;">Pages</a>
              </li>
              <li
                class="text-sm pl-2 capitalize leading-normal text-slate-700 before:float-left before:pr-2 before:text-gray-600 before:content-['/']"
                aria-current="page">
                Dashboard
              </li>
            </ol>
            <h6 class="mb-0 font-bold capitalize">Dashboard</h6>
          </nav>

          <!-- Search + Notification + Profile -->
          <div class="flex items-center space-x-4">
            <!-- Search -->
            <div class="relative">
              <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                <i class="fas fa-search"></i>
              </span>
              <input
                type="text"
                class="pl-10 pr-3 py-2 rounded-lg border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-fuchsia-300"
                placeholder="Type here..." />
            </div>

            <!-- Notification -->
            <button class="text-gray-600 hover:text-gray-800">
              <i class="fas fa-bell text-lg"></i>
            </button>

            <!-- Profile -->
            <div class="flex items-center space-x-2">
              <img src="/build/assets/img/profile.jpg" alt="Profile" class="w-8 h-8 rounded-full">
              <span class="text-sm font-medium text-gray-700">Admin</span>
            </div>
          </div>
        </div>
      </nav>

      <!-- Dashboard Cards -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
        <div class="bg-white shadow-md rounded-xl p-4 flex justify-between items-center">
          <div>
            <h5 class="text-sm text-gray-500">Total Jatah Cuti</h5>
            <h3 class="text-xl font-bold text-green-700">12 Hari <span class="text-xs text-green-500">+55%</span></h3>
          </div>
          <div class="bg-gradient-to-tr from-fuchsia-500 to-purple-400 w-10 h-10 flex items-center justify-center rounded-lg text-white">
            <i class="fas fa-mug-hot"></i>
          </div>
        </div>

        <div class="bg-white shadow-md rounded-xl p-4 flex justify-between items-center">
          <div>
            <h5 class="text-sm text-gray-500">Cuti Terpakai</h5>
            <h3 class="text-xl font-bold text-red-600">4 Hari <span class="text-xs text-green-500">+55%</span></h3>
          </div>
          <div class="bg-gradient-to-tr from-fuchsia-500 to-purple-400 w-10 h-10 flex items-center justify-center rounded-lg text-white">
            <i class="fas fa-mug-hot"></i>
          </div>
        </div>

        <div class="bg-white shadow-md rounded-xl p-4 flex justify-between items-center">
          <div>
            <h5 class="text-sm text-gray-500">Sisa Cuti</h5>
            <h3 class="text-xl font-bold text-blue-700">8 Hari <span class="text-xs text-green-500">+55%</span></h3>
          </div>
          <div class="bg-gradient-to-tr from-fuchsia-500 to-purple-400 w-10 h-10 flex items-center justify-center rounded-lg text-white">
            <i class="fas fa-mug-hot"></i>
          </div>
        </div>
      </div>

      <!-- Table + Chart Jatah Cuti Section -->
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
        <!-- Table -->
        <div class="bg-white rounded-2xl shadow-md p-6">
          <h5 class="font-semibold text-slate-700 mb-2">Jatah Cuti</h5>
          <p class="text-gray-500 text-sm mb-4">30 done this month</p>
          <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-gray-700">
              <thead>
                <tr class="border-b bg-gray-50">
                  <th class="text-left py-2 px-3">NO</th>
                  <th class="text-left py-2 px-3">JENIS CUTI</th>
                  <th class="text-left py-2 px-3">TOTAL SISA CUTI</th>
                  <th class="text-left py-2 px-3">TOTAL CUTI TERPAKAI</th>
                  <th class="text-left py-2 px-3">AKSI</th>
                </tr>
              </thead>
              <tbody>
                <!-- Baris 1 -->
                <tr class="border-b">
                  <td class="py-2 px-3">1.</td>
                  <td class="py-2 px-3">Cuti Tahunan</td>
                  <td class="py-2 px-3">8 Hari</td>
                  <td class="py-2 px-3">4 Hari</td>
                  <td class="py-2 px-3 relative" x-data="{ open: false }">
                    <button
                      @click="open = !open"
                      class="flex items-center justify-between gap-2 bg-green-500 hover:bg-green-600 text-white font-semibold text-xs px-4 py-1.5 rounded-md focus:outline-none"
                    >
                      <span>Aksi</span>
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 fill-current" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.17l3.71-3.94a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                      </svg>
                    </button>

                    <!-- Dropdown -->
                    <div
                      x-show="open"
                      @click.outside="open = false"
                      class="absolute right-0 mt-2 w-32 bg-white rounded-md shadow-lg border border-gray-200 z-50"
                    >
                      <ul class="text-sm text-gray-700 divide-y divide-gray-100">
                        <li>
                          <button class="w-full text-left px-4 py-2 hover:bg-gray-100">
                            Detail
                          </button>
                        </li>
                        <li>
                          <button class="w-full text-left px-4 py-2 hover:bg-gray-100 text-red-600">
                            Hapus
                          </button>
                        </li>
                      </ul>
                    </div>
                  </td>
                </tr>

                <!-- Baris 2 -->
                <tr>
                  <td class="py-2 px-3">2.</td>
                  <td class="py-2 px-3">Cuti Besar</td>
                  <td class="py-2 px-3">12 Hari</td>
                  <td class="py-2 px-3">0 Hari</td>
                  <td class="py-2 px-3 relative" x-data="{ open: false }">
                    <button
                      @click="open = !open"
                      class="flex items-center justify-between gap-2 bg-green-500 hover:bg-green-600 text-white font-semibold text-xs px-4 py-1.5 rounded-md focus:outline-none"
                    >
                      <span>Aksi</span>
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 fill-current" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.17l3.71-3.94a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                      </svg>
                    </button>

                    <!-- Dropdown -->
                    <div
                      x-show="open"
                      @click.outside="open = false"
                      class="absolute right-0 mt-2 w-32 bg-white rounded-md shadow-lg border border-gray-200 z-50"
                    >
                      <ul class="text-sm text-gray-700 divide-y divide-gray-100">
                        <li>
                          <button class="w-full text-left px-4 py-2 hover:bg-gray-100">
                            Detail
                          </button>
                        </li>
                        <li>
                          <button class="w-full text-left px-4 py-2 hover:bg-gray-100 text-red-600">
                            Hapus
                          </button>
                        </li>
                      </ul>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <!-- Chart -->
        <div class="bg-white rounded-2xl shadow-md p-6">
          <canvas id="chart-line" height="200"></canvas>
        </div>
      </div>
      
      <!-- Riwayat Cuti Section -->
      <div class="bg-white rounded-2xl shadow-md p-6 mt-8">
        <h5 class="font-semibold text-slate-700 mb-4">Riwayat Cuti</h5>
        <div class="overflow-x-auto">
          <table class="min-w-full text-sm text-gray-700">
            <thead>
              <tr class="border-b bg-gray-50">
                <th class="text-left py-2 px-3">NO</th>
                <th class="text-left py-2 px-3">TANGGAL MULAI</th>
                <th class="text-left py-2 px-3">TANGGAL AKHIR</th>
                <th class="text-left py-2 px-3">JENIS CUTI</th>
                <th class="text-left py-2 px-3">STATUS</th>
                <th class="text-left py-2 px-3">AKSI</th>
              </tr>
            </thead>
            <tbody>
              <!-- Baris 1 -->
              <tr class="border-b">
                <td class="py-2 px-3">1.</td>
                <td class="py-2 px-3">10 Jan 2025</td>
                <td class="py-2 px-3">14 Jan 2025</td>
                <td class="py-2 px-3">Cuti Tahunan</td>
                <td class="py-2 px-3">
                  <span class="text-green-600 font-semibold">Diterima</span>
                </td>
                <td class="py-2 px-3 relative" x-data="{ open: false }">
                  <button
                    @click="open = !open"
                    class="flex items-center justify-between gap-2 bg-green-500 hover:bg-green-600 text-white font-semibold text-xs px-4 py-1.5 rounded-md focus:outline-none"
                  >
                    <span>Aksi</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 fill-current" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.17l3.71-3.94a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                    </svg>
                  </button>

                  <!-- Dropdown -->
                  <div
                    x-show="open"
                    @click.outside="open = false"
                    class="absolute right-0 mt-2 w-36 bg-white rounded-md shadow-lg border border-gray-200 z-50"
                  >
                    <ul class="text-sm text-gray-700 divide-y divide-gray-100">
                      <li>
                        <button class="w-full text-left px-4 py-2 hover:bg-gray-100">
                          Detail
                        </button>
                      </li>
                      <li>
                        <button class="w-full text-left px-4 py-2 hover:bg-gray-100 text-green-600">
                          Diterima
                        </button>
                      </li>
                      <li>
                        <button class="w-full text-left px-4 py-2 hover:bg-gray-100 text-red-600">
                          Ditolak
                        </button>
                      </li>
                      <li>
                        <button class="w-full text-left px-4 py-2 hover:bg-gray-100 text-gray-600">
                          Hapus
                        </button>
                      </li>
                    </ul>
                  </div>
                </td>
              </tr>

              <!-- Baris 2 -->
              <tr class="border-b">
                <td class="py-2 px-3">2.</td>
                <td class="py-2 px-3">20 Feb 2025</td>
                <td class="py-2 px-3">22 Feb 2025</td>
                <td class="py-2 px-3">Cuti Sakit</td>
                <td class="py-2 px-3">
                  <span class="text-red-600 font-semibold">Ditolak</span>
                </td>
                <td class="py-2 px-3 relative" x-data="{ open: false }">
                  <button
                    @click="open = !open"
                    class="flex items-center justify-between gap-2 bg-green-500 hover:bg-green-600 text-white font-semibold text-xs px-4 py-1.5 rounded-md focus:outline-none"
                  >
                    <span>Aksi</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 fill-current" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.17l3.71-3.94a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                    </svg>
                  </button>

                  <!-- Dropdown -->
                  <div
                    x-show="open"
                    @click.outside="open = false"
                    class="absolute right-0 mt-2 w-36 bg-white rounded-md shadow-lg border border-gray-200 z-50"
                  >
                    <ul class="text-sm text-gray-700 divide-y divide-gray-100">
                      <li>
                        <button class="w-full text-left px-4 py-2 hover:bg-gray-100">
                          Detail
                        </button>
                      </li>
                      <li>
                        <button class="w-full text-left px-4 py-2 hover:bg-gray-100 text-green-600">
                          Diterima
                        </button>
                      </li>
                      <li>
                        <button class="w-full text-left px-4 py-2 hover:bg-gray-100 text-red-600">
                          Ditolak
                        </button>
                      </li>
                      <li>
                        <button class="w-full text-left px-4 py-2 hover:bg-gray-100 text-gray-600">
                          Hapus
                        </button>
                      </li>
                    </ul>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

    </main>
  </div>
</body>
</html>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script>
  const ctx = document.getElementById('chart-line').getContext('2d');
  new Chart(ctx, {
    type: 'line',
    data: {
      labels: ['Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
      datasets: [{
        label: 'Cuti Terpakai',
        data: [0, 10, 30, 20, 40, 30, 50, 40, 60],
        borderColor: '#D946EF',
        backgroundColor: 'rgba(217, 70, 239, 0.2)',
        tension: 0.4,
        fill: true
      }, {
        label: 'Sisa Cuti',
        data: [0, 20, 10, 40, 30, 50, 40, 60, 45],
        borderColor: '#1E3A8A',
        backgroundColor: 'rgba(30, 58, 138, 0.2)',
        tension: 0.4,
        fill: true
      }]
    },
    options: {
      responsive: true,
      plugins: { legend: { display: false } },
      scales: {
        y: { beginAtZero: true, grid: { color: '#eee' } },
        x: { grid: { color: 'transparent' } }
      }
    }
  });
</script>
