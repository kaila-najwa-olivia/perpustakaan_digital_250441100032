<?php

namespace App\Providers;

use App\Models\Peminjaman;
use App\Models\User;
use App\Policies\PeminjamanPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Gate untuk seluruh aksi pengelolaan buku.
        Gate::define('kelola-buku', function (User $user) {
            return $user->hasAnyRole(['admin', 'petugas']);
        });

        // Menghubungkan model Peminjaman dengan Policy.
        Gate::policy(Peminjaman::class, PeminjamanPolicy::class);

        // Gate yang sudah digunakan pada Modul 5 tetap dipertahankan.
        Gate::define('lihat-laporan', function (User $user) {
            return $user->hasRole('admin');
        });
    }
}
