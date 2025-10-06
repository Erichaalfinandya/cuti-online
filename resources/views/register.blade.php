<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Daftar | Cuti Online</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body
        class="relative flex items-center justify-center min-h-screen bg-cover bg-center"
        style="background-image: url('/build/assets/img/kantordepan.jpg');"
    >
        <!-- Overlay gelap agar teks/form tetap terbaca -->
        <div class="absolute inset-0 bg-black/40 backdrop-blur-[2px]"></div>

        <!-- Card form -->
        <div
            class="relative bg-white/95 shadow-2xl rounded-2xl w-full max-w-md p-8 backdrop-blur-sm border border-white/40"
        >
            <div class="text-center mb-6">
                <img
                    src="/build/assets/img/logo.png"
                    alt="Logo"
                    class="mx-auto w-16 mb-3"
                />
                <h2 class="text-2xl font-bold text-slate-700">
                    Buat Akun Baru
                </h2>
                <p class="text-sm text-slate-500">
                    Silakan isi data di bawah untuk mendaftar
                </p>
            </div>

            <!-- Form Register -->
            {{-- <form action="{{ route('register') }}" method="POST"> --}}
                <!-- @csrf -->
                <div class="mb-4">
                    <label
                        for="name"
                        class="block text-sm font-medium text-slate-700 mb-1"
                        >Nama Lengkap</label
                    >
                    <input
                        type="text"
                        id="name"
                        name="name"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-pink-200 focus:outline-none"
                        placeholder="Masukkan nama lengkap anda"
                        required
                    />
                </div>

                <div class="mb-4">
                    <label
                        for="email"
                        class="block text-sm font-medium text-slate-700 mb-1"
                        >Email</label
                    >
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-pink-200 focus:outline-none"
                        placeholder="Masukkan email anda"
                        required
                    />
                </div>

                <div class="mb-4">
                    <label
                        for="password"
                        class="block text-sm font-medium text-slate-700 mb-1"
                        >Password</label
                    >
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-pink-200 focus:outline-none"
                        placeholder="Masukkan password"
                        required
                    />
                </div>

                <div class="mb-6">
                    <label
                        for="confirm_password"
                        class="block text-sm font-medium text-slate-700 mb-1"
                        >Konfirmasi Password</label
                    >
                    <input
                        type="password"
                        id="confirm_password"
                        name="confirm_password"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-pink-200 focus:outline-none"
                        placeholder="Ulangi password anda"
                        required
                    />
                </div>

                <div class="flex items-center mb-6 text-sm text-slate-600">
                    <input
                        type="checkbox"
                        id="terms"
                        class="mr-2 rounded border-gray-300"
                        required
                    />
                    <label for="terms">
                        Saya setuju dengan
                        <a
                            href="#"
                            class="font-semibold bg-gradient-to-r from-[#842A3B] to-[#C95A6B] text-transparent bg-clip-text hover:opacity-80"
                            >syarat & ketentuan</a
                        >
                    </label>
                </div>

                <!-- Tombol Daftar -->
                <button
                    type="submit"
                    class="w-full text-white py-2 rounded-lg font-semibold 
                           bg-gradient-to-r from-[#842A3B] via-[#B94A5B] to-[#C95A6B]
                           hover:from-[#9c3344] hover:via-[#c85568] hover:to-[#d46d7d]
                           transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-[1.03]"
                >
                    Daftar
                </button>
            </form>

            <p class="text-center text-sm text-slate-600 mt-6">
                Sudah punya akun?
                <a
                    class="font-semibold bg-gradient-to-r from-[#842A3B] to-[#C95A6B] text-transparent bg-clip-text hover:opacity-80 transition"
                    >Masuk Sekarang</a
                >
            </p>
        </div>
    </body>
</html>
