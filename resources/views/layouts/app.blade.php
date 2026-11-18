<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Perpustakaan Digital') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --hijau-utama: #16a34a;
            --hijau-tua: #166534;
            --hijau-muda: #dcfce7;
            --background: #f0fdf4;
        }

        body {
            font-family: 'Figtree', sans-serif;
            background-color: var(--background);
            color: #1f2937;
        }

        /* Background halaman */
        .min-h-screen {
            background-color: var(--background);
        }

        .bg-gray-100 {
            background-color: var(--background) !important;
        }

        /* Judul halaman */
        .judul {
            font-size: 30px !important;
            font-weight: 700 !important;
            color: var(--hijau-tua) !important;
            margin-top: 20px;
            margin-bottom: 15px;
        }

        /* Warna teks hijau */
        .text-green-600 {
            color: var(--hijau-utama) !important;
        }

        .text-green-700 {
            color: var(--hijau-tua) !important;
        }

        /* Tombol hijau */
        .bg-green-600 {
            background-color: var(--hijau-utama) !important;
        }

        .bg-green-700 {
            background-color: var(--hijau-tua) !important;
        }

        /* Kartu dan tabel */
        .bg-white {
            background-color: #ffffff;
        }

        /* Garis pemisah */
        hr {
            border-color: #dcfce7;
        }

        /* Efek tombol */
        button,
        a {
            transition: all 0.2s ease;
        }
    </style>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen">

        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow-sm border-b border-green-100">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            @isset($slot)
                {{ $slot }}
            @endisset

            @yield('content')
        </main>

    </div>
</body>
</html>
