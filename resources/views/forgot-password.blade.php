<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lupa Password | Cuti Online</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="relative flex items-center justify-center min-h-screen bg-cover bg-center"
      style="background-image: url('/build/assets/img/kantordepan.jpg');">

    <div class="absolute inset-0 bg-black/40 backdrop-blur-[2px]"></div>

    <div class="relative bg-white/95 shadow-2xl rounded-2xl w-full max-w-md p-8 backdrop-blur-sm border border-white/40">
        <div class="text-center mb-6">
            <img src="/build/assets/img/logo.png" alt="Logo" class="mx-auto w-16 mb-3">
            <h2 class="text-2xl font-bold text-slate-700">Lupa Password</h2>
            <p class="text-sm text-slate-600 mt-1">Masukkan NIP atau Email Anda untuk mengatur ulang password.</p>
        </div>

        {{-- <form action="{{ route('password.email') }}" method="POST"> --}}
            <!-- @csrf -->
            <div class="mb-4">
                <label for="nip" class="block text-sm font-medium text-slate-700 mb-1">NIP / Email</label>
                <input type="text" id="nip" name="nip"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-pink-200 focus:outline-none"
                    placeholder="Masukkan NIP atau email anda" required>
            </div>

            <button type="submit"
                class="w-full text-white py-2 rounded-lg font-semibold 
                    bg-gradient-to-r from-[#842A3B] via-[#B94A5B] to-[#C95A6B]
                    hover:from-[#9c3344] hover:via-[#c85568] hover:to-[#d46d7d]
                    transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-[1.03]">
                Kirim Link Reset Password
            </button>
        </form>

        <p class="text-center text-sm text-slate-600 mt-6">
            Kembali ke
            <a href="{{ route('login') }}"
               class="font-semibold bg-gradient-to-r from-[#842A3B] to-[#C95A6B] text-transparent bg-clip-text hover:opacity-80 transition">
               Halaman Login
            </a>
        </p>
    </div>
</body>
</html>
