<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BukuController;
use App\Http\Controllers\Api\RekapController;


Route::middleware(['web', 'auth'])->group(function () {

    // Menampilkan daftar buku
    Route::get('/buku', [BukuController::class, 'index'])
        ->middleware('permission:lihat-daftar-buku')
        ->name('api.buku.index');

    // Menampilkan detail buku
    Route::get('/buku/{id}', [BukuController::class, 'show'])
        ->middleware('permission:lihat-daftar-buku')
        ->name('api.buku.show');

    // Menambahkan buku
    Route::post('/buku', [BukuController::class, 'store'])
        ->middleware('can:kelola-buku')
        ->name('api.buku.store');

    // Mengubah buku
    Route::put('/buku/{id}', [BukuController::class, 'update'])
        ->middleware('can:kelola-buku')
        ->name('api.buku.update');

    Route::patch('/buku/{id}', [BukuController::class, 'update'])
        ->middleware('can:kelola-buku');

    // Menghapus buku
    Route::delete('/buku/{id}', [BukuController::class, 'destroy'])
        ->middleware('can:kelola-buku');

    // Rekap laporan perpustakaan
    Route::get('/rekap/buku-per-kategori', [RekapController::class, 'bukuPerKategori'])
        ->middleware('permission:lihat-laporan-perpustakaan');

    Route::get('/rekap/peminjaman-per-buku', [RekapController::class, 'peminjamanPerBuku'])
        ->middleware('permission:lihat-laporan-perpustakaan');
});
