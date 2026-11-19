<?php

use App\Http\Controllers\Admin\PenggunaController;
use App\Http\Controllers\Api\BukuController as ApiBukuController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Halaman utama
Route::get('/', function () {
    return view('welcome');
});

// Daftar dan detail buku
Route::middleware(['auth', 'permission:lihat-daftar-buku'])->group(function () {
    Route::get('/buku', [BukuController::class, 'index'])->name('buku.index');

    // Route form tambah dan ubah menggunakan Gate kelola-buku.
    // Form pengelolaan saat ini berada pada halaman daftar buku.
    Route::get('/buku/create', function () {
        return redirect()->route('buku.index');
    })->middleware('can:kelola-buku')->name('buku.create');

    Route::get('/buku/{id}/edit', function ($id) {
        return redirect()->route('buku.index');
    })->middleware('can:kelola-buku')->name('buku.edit');

    Route::get('/buku/{id}', [BukuController::class, 'show'])->name('buku.show');
});

// A2: pencarian buku hanya dapat diakses pengguna yang sudah login.
Route::get('/buku-cari', [BukuController::class, 'cari'])
    ->middleware('auth')
    ->name('buku.cari');

// A3: Penghapusan menerima DELETE dan dilindungi Gate serta CSRF.
Route::delete('/buku/{buku}', [ApiBukuController::class, 'destroy'])
    ->middleware(['auth', 'can:kelola-buku'])
    ->name('buku.destroy');
// Dashboard umum
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

// Dashboard Admin
Route::get('/admin', function () {
    return view('dashboard-role', [
        'role' => 'Admin',
        'deskripsi' => 'Anda memiliki akses untuk mengelola data dan aktivitas perpustakaan.',
    ]);
})->middleware([
    'auth',
    'role:admin',
    'permission:akses-dashboard-admin',
])->name('admin');

// Dashboard Petugas
Route::get('/petugas', function () {
    return view('dashboard-role', [
        'role' => 'Petugas',
        'deskripsi' => 'Anda dapat membantu mengelola buku dan proses peminjaman perpustakaan.',
    ]);
})->middleware([
    'auth',
    'role:petugas',
    'permission:akses-dashboard-petugas',
])->name('petugas');

// Dashboard Siswa
Route::get('/siswa', function () {
    return view('dashboard-role', [
        'role' => 'Siswa',
        'deskripsi' => 'Anda dapat melihat koleksi buku dan mengelola aktivitas peminjaman.',
    ]);
})->middleware([
    'auth',
    'role:siswa',
    'permission:lihat-profil-sendiri',
])->name('siswa');

// Profil pengguna
Route::middleware(['auth', 'permission:lihat-profil-sendiri'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->middleware('permission:ubah-profil-sendiri')
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->middleware('permission:ubah-profil-sendiri')
        ->name('profile.destroy');
});

// Riwayat peminjaman khusus Siswa
Route::get('/peminjaman', [PeminjamanController::class, 'index'])
    ->middleware([
        'auth',
        'role:siswa',
        'permission:melihat-status-peminjaman-sendiri',
        'permission:melihat-riwayat-peminjaman-sendiri',
    ])
    ->name('peminjaman.index');

// Pengajuan peminjaman khusus Siswa
Route::middleware([
    'auth',
    'role:siswa',
    'permission:mengajukan-peminjaman-buku',
])->group(function () {
    Route::get('/peminjaman/create', [PeminjamanController::class, 'create'])
        ->name('peminjaman.create');

    Route::post('/peminjaman', [PeminjamanController::class, 'store'])
        ->name('peminjaman.store');
});

// A4: semua pengguna login boleh meminta detail; Policy memutuskan aksesnya.
Route::get('/peminjaman/{id}', [PeminjamanController::class, 'show'])
    ->middleware('auth')
    ->whereNumber('id')
    ->name('peminjaman.show');

// Pengelolaan peminjaman Admin dan Petugas
Route::get('/admin/peminjaman', [PeminjamanController::class, 'kelola'])
    ->middleware([
        'auth',
        'role:admin|petugas',
        'permission:kelola-peminjaman',
    ])
    ->name('peminjaman.kelola');

// Persetujuan dan penolakan peminjaman
Route::middleware([
    'auth',
    'role:admin|petugas',
    'permission:memproses-persetujuan-peminjaman',
])->group(function () {
    Route::patch('/admin/peminjaman/{id}/setujui', [PeminjamanController::class, 'setujui'])
        ->name('peminjaman.setujui');

    Route::patch('/admin/peminjaman/{id}/tolak', [PeminjamanController::class, 'tolak'])
        ->name('peminjaman.tolak');
});

// Pengembalian buku
Route::patch('/admin/peminjaman/{id}/kembalikan', [PeminjamanController::class, 'kembalikan'])
    ->middleware([
        'auth',
        'role:admin|petugas',
        'permission:kelola-pengembalian',
        'permission:mencatat-pengembalian-buku',
    ])
    ->name('peminjaman.kembalikan');

// Pengelolaan pengguna khusus Admin
Route::middleware([
    'auth',
    'role:admin',
    'permission:kelola-data-pengguna',
])->prefix('admin')->group(function () {

    Route::get('/pengguna', [PenggunaController::class, 'index'])
        ->name('admin.pengguna.index');

    Route::get('/pengguna/create', [PenggunaController::class, 'create'])
        ->name('admin.pengguna.create');

    Route::post('/pengguna', [PenggunaController::class, 'store'])
        ->name('admin.pengguna.store');

    Route::get('/pengguna/{id}/edit', [PenggunaController::class, 'edit'])
        ->name('admin.pengguna.edit');

    Route::put('/pengguna/{id}', [PenggunaController::class, 'update'])
        ->middleware('permission:kelola-role-pengguna')
        ->name('admin.pengguna.update');

    Route::delete('/pengguna/{id}', [PenggunaController::class, 'destroy'])
        ->name('admin.pengguna.destroy');
});

// Autentikasi Breeze
require __DIR__.'/auth.php';
