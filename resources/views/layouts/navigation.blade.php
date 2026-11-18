<nav x-data="{ open: false }" class="bg-white border-b border-green-100 shadow-sm">

    <style>
        /* Warna dasar navbar */
        nav {
            border-bottom: 2px solid #dcfce7 !important;
        }

        /* Logo */
        nav .text-gray-800 {
            color: #166534 !important;
        }

        /* Menu desktop */
        nav a {
            transition: all 0.2s ease;
        }

        nav .border-indigo-400 {
            border-color: #16a34a !important;
        }

        nav .text-gray-900 {
            color: #166534 !important;
        }

        nav .text-gray-500 {
            color: #4b5563 !important;
        }

        nav a:hover {
            color: #16a34a !important;
        }

        /* Tombol akun */
        nav button {
            transition: all 0.2s ease;
        }

        nav button:hover {
            color: #166534 !important;
            background-color: #f0fdf4 !important;
        }

        /* Menu mobile */
        nav .hover\:bg-gray-100:hover {
            background-color: #f0fdf4 !important;
        }

        /* Garis menu mobile */
        nav .border-gray-200 {
            border-color: #dcfce7 !important;
        }
    </style>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- LOGO -->
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ auth()->check() ? route('dashboard') : route('login') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-green-700" />
                    </a>
                </div>

                <!-- MENU DESKTOP -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">

                    @auth

                        @role('admin')
                            <x-nav-link :href="route('admin')" :active="request()->routeIs('admin')">
                                Dashboard Admin
                            </x-nav-link>
                        @endrole

                        @role('petugas')
                            <x-nav-link :href="route('petugas')" :active="request()->routeIs('petugas')">
                                Dashboard Petugas
                            </x-nav-link>
                        @endrole

                        @role('siswa')
                            <x-nav-link :href="route('siswa')" :active="request()->routeIs('siswa')">
                                Dashboard Siswa
                            </x-nav-link>
                        @endrole

                    @endauth

                    @can('lihat-daftar-buku')
                        <x-nav-link :href="route('buku.index')" :active="request()->routeIs('buku.*')">
                            Daftar Buku
                        </x-nav-link>
                    @endcan

                    @can('kelola-data-pengguna')
                        <x-nav-link :href="route('admin.pengguna.index')" :active="request()->routeIs('admin.pengguna.*')">
                            Kelola Pengguna
                        </x-nav-link>
                    @endcan

                    @can('kelola-peminjaman')
                        <x-nav-link :href="route('peminjaman.kelola')" :active="request()->routeIs('peminjaman.kelola')">
                            Kelola Peminjaman
                        </x-nav-link>
                    @endcan

                    <!-- RIWAYAT PEMINJAMAN KHUSUS SISWA -->
                    @role('siswa')
                        @can('melihat-riwayat-peminjaman-sendiri')
                            <x-nav-link :href="route('peminjaman.index')" :active="request()->routeIs('peminjaman.index')">
                                Riwayat Peminjaman
                            </x-nav-link>
                        @endcan
                    @endrole

                    @can('lihat-laporan-perpustakaan')
                        <x-nav-link href="{{ url('/api/rekap/buku-per-kategori') }}">
                            Laporan Buku
                        </x-nav-link>
                    @endcan

                </div>
            </div>

            <!-- MENU AKUN DESKTOP -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">

                @auth
                    <x-dropdown align="right" width="48">

                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md text-green-800 bg-white hover:text-green-700 hover:bg-green-50">

                                <div>{{ Auth::user()->name }}</div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>

                            </button>
                        </x-slot>

                        <x-slot name="content">

                            @can('lihat-profil-sendiri')
                                <x-dropdown-link :href="route('profile.edit')">
                                    Profil Saya
                                </x-dropdown-link>
                            @endcan

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    Logout
                                </x-dropdown-link>
                            </form>

                        </x-slot>
                    </x-dropdown>

                @else
                    <a href="{{ route('login') }}" class="text-sm font-semibold text-green-700 hover:text-green-800">
                        Login
                    </a>

                    <a href="{{ route('register') }}" class="ms-4 text-sm font-semibold text-green-700 hover:text-green-800">
                        Register
                    </a>
                @endauth

            </div>

            <!-- TOMBOL MENU MOBILE -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-green-700 hover:text-green-800 hover:bg-green-50">

                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open}"
                            class="inline-flex" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />

                        <path :class="{'hidden': ! open, 'inline-flex': open}"
                            class="hidden" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>

                </button>
            </div>

        </div>
    </div>

    <!-- MENU MOBILE -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">

        <div class="pt-2 pb-3 space-y-1">

            @auth

                @role('admin')
                    <x-responsive-nav-link :href="route('admin')">
                        Dashboard Admin
                    </x-responsive-nav-link>
                @endrole

                @role('petugas')
                    <x-responsive-nav-link :href="route('petugas')">
                        Dashboard Petugas
                    </x-responsive-nav-link>
                @endrole

                @role('siswa')
                    <x-responsive-nav-link :href="route('siswa')">
                        Dashboard Siswa
                    </x-responsive-nav-link>
                @endrole

            @endauth

            @can('lihat-daftar-buku')
                <x-responsive-nav-link :href="route('buku.index')">
                    Daftar Buku
                </x-responsive-nav-link>
            @endcan

            @can('kelola-data-pengguna')
                <x-responsive-nav-link :href="route('admin.pengguna.index')">
                    Kelola Pengguna
                </x-responsive-nav-link>
            @endcan

            @can('kelola-peminjaman')
                <x-responsive-nav-link :href="route('peminjaman.kelola')">
                    Kelola Peminjaman
                </x-responsive-nav-link>
            @endcan

            <!-- RIWAYAT PEMINJAMAN KHUSUS SISWA -->
            @role('siswa')
                @can('melihat-riwayat-peminjaman-sendiri')
                    <x-responsive-nav-link :href="route('peminjaman.index')">
                        Riwayat Peminjaman
                    </x-responsive-nav-link>
                @endcan
            @endrole

            @can('lihat-laporan-perpustakaan')
                <x-responsive-nav-link href="{{ url('/api/rekap/buku-per-kategori') }}">
                    Laporan Buku
                </x-responsive-nav-link>
            @endcan

        </div>

        <!-- INFORMASI AKUN MOBILE -->
        <div class="pt-4 pb-1 border-t border-green-100">

            @auth

                <div class="px-4">
                    <div class="font-medium text-base text-green-800">
                        {{ Auth::user()->name }}
                    </div>

                    <div class="font-medium text-sm text-gray-500">
                        {{ Auth::user()->email }}
                    </div>
                </div>

                <div class="mt-3 space-y-1">

                    @can('lihat-profil-sendiri')
                        <x-responsive-nav-link :href="route('profile.edit')">
                            Profil Saya
                        </x-responsive-nav-link>
                    @endcan

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            Logout
                        </x-responsive-nav-link>
                    </form>

                </div>

            @else

                <div class="space-y-1">
                    <x-responsive-nav-link :href="route('login')">
                        Login
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('register')">
                        Register
                    </x-responsive-nav-link>
                </div>

            @endauth

        </div>
    </div>

</nav>
