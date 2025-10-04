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
          <li>
            <a href="{{ url('/dashboard') }}" class="flex items-center p-3 hover:bg-gray-100 rounded-xl">
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
              <i class="fa-solid fa-calendar-days mr-3 text-slate-500"></i> Jatah Cuti
            </a>
          </li>
          <li>
            <a href="#" class="flex items-center p-3 hover:bg-gray-100 rounded-xl">
              <i class="fa-solid fa-clock-rotate-left mr-3 text-slate-500"></i> Riwayat Cuti
            </a>
          </li>
        </ul>
      </div>

      <!-- Bawah -->
      <div class="mt-10">
        <p class="text-xs uppercase font-bold text-slate-500 mb-3">Account Pages</p>
        <a href="#" class="flex items-center p-3 hover:bg-gray-100 rounded-xl">
          <i class="fa-solid fa-user mr-3 text-slate-500"></i> Profile
        </a>
      </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 p-6 bg-gray-50 min-h-screen">
      @yield('content')
    </main>
  </div>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  @stack('scripts')
</body>
</html>
