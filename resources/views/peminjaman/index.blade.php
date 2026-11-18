@extends('layouts.app')

@section('content')

<style>
    .riwayat-page {
        min-height: 100vh;
        background-color: #f0fdf4;
        padding: 32px 24px;
    }

    .riwayat-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .riwayat-title {
        color: #166534;
        font-size: 26px;
        font-weight: 700;
    }

    .riwayat-subtitle {
        color: #64748b;
        margin-top: 8px;
        font-size: 15px;
    }

    .btn-ajukan {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background-color: #16a34a;
        color: white !important;
        font-weight: 600;
        padding: 11px 22px;
        border-radius: 10px;
        text-decoration: none;
        transition: 0.2s;
    }

    .btn-ajukan:hover {
        background-color: #15803d;
    }

    .riwayat-card {
        background-color: white;
        border: 1px solid #dcfce7;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 3px 10px rgba(22, 101, 52, 0.06);
    }

    .riwayat-card-header {
        padding: 18px 24px;
        border-bottom: 1px solid #dcfce7;
    }

    .riwayat-card-title {
        color: #166534;
        font-size: 18px;
        font-weight: 700;
    }

    .riwayat-card-description {
        color: #64748b;
        font-size: 14px;
        margin-top: 5px;
    }

    .tabel-riwayat {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
    }

    .tabel-riwayat thead {
        background-color: #dcfce7;
        color: #166534;
    }

    .tabel-riwayat th {
        padding: 15px 24px;
        font-size: 14px;
        font-weight: 700;
        border-bottom: 1px solid #bbf7d0;
    }

    .tabel-riwayat td {
        padding: 17px 24px;
        border-bottom: 1px solid #e5e7eb;
        font-size: 14px;
        color: #374151;
    }

    .tabel-riwayat tbody tr:hover {
        background-color: #f0fdf4;
    }

    .tabel-riwayat tbody tr:last-child td {
        border-bottom: none;
    }

    .status-badge {
        display: inline-block;
        padding: 6px 13px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        white-space: nowrap;
    }

    .status-menunggu {
        background-color: #fef3c7;
        color: #92400e;
    }

    .status-disetujui {
        background-color: #dcfce7;
        color: #166534;
    }

    .status-ditolak {
        background-color: #fee2e2;
        color: #b91c1c;
    }

    .status-dikembalikan {
        background-color: #dcfce7;
        color: #166534;
    }

    .riwayat-footer {
        color: #64748b;
        text-align: center;
        font-size: 13px;
        margin-top: 28px;
    }

    @media (max-width: 640px) {
        .riwayat-page {
            padding: 24px 14px;
        }

        .riwayat-title {
            font-size: 22px;
        }

        .tabel-riwayat {
            min-width: 650px;
        }
    }
</style>

<div class="riwayat-page">
    <div class="riwayat-container">

        <!-- HEADER -->
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-7">

            <div>
                <h1 class="riwayat-title">
                    Riwayat Peminjaman
                </h1>

                <p class="riwayat-subtitle">
                    Pantau pengajuan dan status peminjaman buku kamu.
                </p>
            </div>

            <!-- TOMBOL AJUKAN -->
            <a href="{{ route('peminjaman.create') }}"
               class="btn-ajukan">
                + Ajukan Peminjaman
            </a>

        </div>

        <!-- NOTIFIKASI -->
        @if (session('success'))
            <div class="bg-green-100 border border-green-200 text-green-800 px-5 py-4 rounded-xl mb-6">
                {{ session('success') }}
            </div>
        @endif

        <!-- KARTU TABEL -->
        <div class="riwayat-card">

            <div class="riwayat-card-header">
                <h2 class="riwayat-card-title">
                    Daftar Peminjaman Buku
                </h2>

                <p class="riwayat-card-description">
                    Total {{ $peminjamans->count() }} pengajuan peminjaman.
                </p>
            </div>

            <div class="overflow-x-auto">

                <table class="tabel-riwayat">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul Buku</th>
                            <th>Tanggal Pinjam</th>
                            <th>Jatuh Tempo</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($peminjamans as $peminjaman)

                            <tr>

                                <td>
                                    {{ $loop->iteration }}
                                </td>

                                <td class="font-semibold">
                                    {{ $peminjaman->buku->judul ?? 'Buku tidak ditemukan' }}
                                </td>

                                <td style="white-space: nowrap;">
                                    {{ $peminjaman->tanggal_pinjam
                                        ? \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('d-m-Y')
                                        : '-' }}
                                </td>

                                <td style="white-space: nowrap;">
                                    {{ $peminjaman->tanggal_kembali
                                        ? \Carbon\Carbon::parse($peminjaman->tanggal_kembali)->format('d-m-Y')
                                        : '-' }}
                                </td>

                                <!-- STATUS PEMINJAMAN -->
                                <td>

                                    @if ($peminjaman->status == 'menunggu')

                                        <span class="status-badge status-menunggu">
                                            Menunggu
                                        </span>

                                    @elseif ($peminjaman->status == 'disetujui')

                                        <span class="status-badge status-disetujui">
                                            Disetujui
                                        </span>

                                    @elseif ($peminjaman->status == 'ditolak')

                                        <span class="status-badge status-ditolak">
                                            Ditolak
                                        </span>

                                    @elseif ($peminjaman->status == 'dikembalikan')

                                        <span class="status-badge status-dikembalikan">
                                            Dikembalikan
                                        </span>

                                    @else

                                        <span class="text-gray-500 text-xs">
                                            {{ ucfirst($peminjaman->status) }}
                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="5" class="text-center" style="padding: 55px 20px;">

                                    <p class="text-3xl mb-3">📚</p>

                                    <p class="font-semibold text-green-800">
                                        Belum ada peminjaman
                                    </p>

                                    <p class="text-sm text-gray-500 mt-1">
                                        Silakan ajukan peminjaman buku terlebih dahulu.
                                    </p>

                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>
        </div>

        <!-- FOOTER -->
        <p class="riwayat-footer">
            Sistem Informasi Perpustakaan Digital
        </p>

    </div>
</div>

@endsection
