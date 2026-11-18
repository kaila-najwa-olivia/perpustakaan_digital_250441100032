
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan Digital</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-gradient-to-br from-green-50 via-white to-emerald-100">

    <nav class="flex justify-between items-center px-8 py-5 bg-white shadow-sm">
        <h1 class="text-xl font-bold text-green-700">
            Perpustakaan Digital
        </h1>

        <a href="{{ route('login') }}"
           class="text-green-600 font-semibold hover:text-green-800">
            Login
        </a>
    </nav>

    <main class="min-h-[80vh] flex items-center justify-center px-6">
        <div class="text-center max-w-2xl">

            <p class="text-green-600 font-semibold mb-3">
                SELAMAT DATANG
            </p>

            <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-5">
                Selamat Datang di
                <span class="text-green-600">
                    Perpustakaan Digital
                </span>
            </h2>

            <p class="text-gray-600 text-lg leading-relaxed mb-8">
                Temukan berbagai koleksi buku dan informasi menarik.
                Silakan masuk untuk melihat daftar buku yang tersedia
                di perpustakaan kami.
            </p>

            <a href="{{ route('buku.index') }}"
               class="inline-block bg-green-600 text-white px-8 py-3
                      rounded-xl font-semibold shadow-lg
                      hover:bg-green-700 transition">
                Lihat Daftar Buku
            </a>

        </div>
    </main>

    <footer class="text-center py-5 text-gray-500 text-sm">
        &copy; 2026 Perpustakaan Digital
    </footer>

</body>
</html>
