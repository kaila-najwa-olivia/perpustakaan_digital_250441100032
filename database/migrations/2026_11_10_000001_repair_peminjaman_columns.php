<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Beberapa versi database Modul 5 sudah memiliki kolom ini.
        // Periksa terlebih dahulu agar migrasi tidak menambah kolom ganda.
        if (!Schema::hasColumn('anggotas', 'user_id')) {
            Schema::table('anggotas', function (Blueprint $table) {
                $table->foreignId('user_id')
                    ->nullable()
                    ->after('id')
                    ->constrained('users')
                    ->nullOnDelete();
            });
        }

        if (!Schema::hasColumn('peminjamans', 'status')) {
            Schema::table('peminjamans', function (Blueprint $table) {
                $table->string('status')->default('menunggu')->after('tanggal_kembali');
            });
        }

        // Pengajuan baru berstatus menunggu sehingga belum memiliki tanggal pinjam.
        if (Schema::hasColumn('peminjamans', 'tanggal_pinjam')) {
            Schema::table('peminjamans', function (Blueprint $table) {
                $table->date('tanggal_pinjam')->nullable()->change();
            });
        }
    }

    public function down(): void
    {
        // Sengaja tidak menghapus kolom pada rollback karena sebagian database
        // Modul 5 mungkin sudah memiliki kolom tersebut sebelum migrasi ini.
    }
};
