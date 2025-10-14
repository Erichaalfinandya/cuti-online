<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login | Cuti Online</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="relative flex items-center justify-center min-h-screen bg-cover bg-center"
    style="background-image: url('/build/assets/img/kantordepan.jpg');">
    <!-- Overlay gelap agar teks/form tetap terbaca -->
    <div class="absolute inset-0 bg-black/40 backdrop-blur-[2px]"></div>

    <div class="relative bg-white/95 shadow-2xl rounded-2xl w-full max-w-md p-8 backdrop-blur-sm border border-white/40">
        <div class="text-center mb-6">
            <img src="/build/assets/img/logo.png" alt="Logo" class="mx-auto w-16 mb-3" />
            <h2 class="text-2xl font-bold text-slate-700">
                Selamat Datang
            </h2>
        </div>

        <!-- Form Login -->
        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="nip" class="block text-sm font-medium text-slate-700 mb-1">
                    NIP
                </label>
                <input type="text" id="nip" name="nip"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-pink-200 focus:outline-none"
                    placeholder="Masukkan NIP anda" required />
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                <input type="password" id="password" name="password"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-blue-200 focus:outline-none"
                    placeholder="Masukkan password" required />
            </div>

            <div class="flex items-center justify-between mb-6">
                <label class="flex items-center text-sm text-slate-600">
                    <input type="checkbox" name="remember" class="mr-2" />
                    Ingat saya
                </label>
                {{-- <a
                        href="#"
                        class="text-sm font-semibold bg-gradient-to-r from-[#842A3B] to-[#C95A6B] text-transparent bg-clip-text hover:opacity-80 transition"
                        >Lupa password?</a
                    > --}}
            </div>
            <button type="submit"
                class="w-full text-white py-2 rounded-lg font-semibold
                        bg-gradient-to-r from-[#842A3B] via-[#B94A5B] to-[#C95A6B]
                        hover:from-[#9c3344] hover:via-[#c85568] hover:to-[#d46d7d]
                        transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-[1.03]">
                Masuk
            </button>
        </form>
        <p class="text-center text-sm text-slate-600 mt-6">
            Pegawai baru? Silakan hubungi bagian <span
                class="font-semibold bg-gradient-to-r from-[#842A3B] to-[#C95A6B] text-transparent bg-clip-text">
                Kepegawaian</span> untuk mendapatkan akun.
        </p>
    </div>
</body>

</html>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const form = document.querySelector('form[action="{{ route('login.post') }}"]');

        form.addEventListener('submit', function(e) {
            e.preventDefault(); // Biar gak reload

            const formData = new FormData(form);

            fetch("{{ route('login.post') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": formData.get('_token'),
                        "Accept": "application/json",
                    },
                    body: formData,
                })
                .then(async (response) => {
                    const data = await response.json();

                    if (response.ok && data.status === "success") {
                        Swal.fire({
                            icon: "success",
                            title: "Berhasil",
                            text: data.message,
                            timer: 1500,
                            showConfirmButton: false,
                        });

                        // Redirect setelah 1.5 detik
                        setTimeout(() => {
                            window.location.href = data.redirect;
                        }, 1500);
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Login gagal",
                            text: data.message || "Terjadi kesalahan.",
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
        });
    });
</script>
