<?php

namespace App\Policies;

use App\Models\Peminjaman;
use App\Models\User;

class PeminjamanPolicy
{
    /**
     * Admin dan Petugas dapat melihat semua peminjaman.
     * Siswa hanya dapat melihat peminjaman miliknya sendiri.
     */
    public function view(User $user, Peminjaman $peminjaman): bool
    {
        if ($user->hasAnyRole(['admin', 'petugas'])) {
            return true;
        }

        if ($user->hasRole('siswa')) {
            return $peminjaman->anggota()
                ->where('user_id', $user->id)
                ->exists();
        }

        return false;
    }
}
