
@extends('layouts.app')

@section('content')

<style>
    .peminjaman-page {
        min-height: 100vh;
        background-color: #f0fdf4;
        padding: 32px 24px;
    }

    .peminjaman-container {
        max-width: 1400px;
        margin: 0 auto;
    }

    .peminjaman-title {
        color: #166534;
        font-size: 26px;
        font-weight: 700;
    }

    .peminjaman-subtitle {
        color: #64748b;
        margin-top: 6px;
    }

    .peminjaman-card {
        background: white;
        border: 1px solid #dcfce7;
        border-radius: 14px;
        overflow-x: auto;
        box-shadow: 0 3px 10px rgba(22, 101, 52, 0.06);
    }

    .tabel-peminjaman {
        width: 100%;
        min-width: 1000px;
        border-collapse: collapse;
        text-align: left;
    }

    .tabel-peminjaman thead {
        background-color: #dcfce7;
        color: #166534;
    }

    .tabel-peminjaman th {
        padding: 16px;
        font-weight: 700;
        border-bottom: 1px solid #bbf7d0;
    }

    .tabel-peminjaman td {
        padding: 16px;
        color: #374151;
        border-bottom: 1px solid #e5e7eb;
    }

    .tabel-peminjaman tbody tr:hover {
        background-color: #f0fdf4;
    }

    .tabel-peminjaman tbody tr:last-child td {
        border-bottom: none;
    }

    .btn-setujui {
        background-color: #16a34a;
        color: white;
        padding: 9px 17px;
        border-radius: 8px;
        font-weight: 600;
        border: none;
        cursor: pointer;
    }

    .btn-setujui:hover {
        background-color: #15803d;
    }

    .btn-tolak {
        background-color: #dc2626;
        color: white;
        padding: 9px 17px;
        border-radius: 8px;
        font-weight: 600;
        border: none;
        cursor: pointer;
    }

    .btn-tolak:hover {
        background-color: #b91c1c;
    }

    .btn-kembalikan {
        background-color: #16a34a;
        color: white;
        padding: 10px 18px;
        border-radius: 8px;
        font-weight: 600;
        border: none;
        cursor: pointer;
    }

    .btn-kembalikan:hover {
        background-color: #15803d;
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

    .status-badge {
        display: inline-block;
        padding: 6px 13px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
        white-space: nowrap;
    }

    @media (max-width: 640px) {
        .peminjaman-page {
            padding: 24px 14px;
        }

        .peminjaman-title {
            font-size: 22px;
        }
    }
</style>

<div class="peminjaman-page">
    <div class="peminjaman-container">

        <!-- JUDUL HALAMAN -->
        <div class="mb-6">
            <h2 class="peminjaman-title">
                Pengelolaan Peminjaman
            </h2>

            <p class="peminjaman-subtitle">
                Daftar pengajuan peminjaman buku dari siswa.
            </p>
        </div>

        <!-- NOTIFIKASI BERHASIL -->
        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded-lg mb-4 border border-green-200">
                {{ session('success') }}
            </div>
        @endif

        <!-- NOTIFIKASI GAGAL -->
        @if (session('error'))
            <div class="bg-red-100 text-red-700 p-3 rounded-lg mb-4 border border-red-200">
                {{ session('error') }}
            </div>
        @endif

        <!-- TABEL PEMINJAMAN -->
        <div class="peminjaman-card">

            <table class="tabel-peminjaman">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>Judul Buku</th>
                        <th>Tanggal Pinjam</th>
                        <th>Jatuh Tempo</th>
                        <th>Status</th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($peminjamans as $peminjaman)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <td class="font-medium">
                                {{ $peminjaman->anggota->nama ?? '-' }}
                            </td>

                            <td>
                                {{ $peminjaman->buku->judul ?? '-' }}
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

                            <!-- STATUS -->
                            <td>
                                @if ($peminjaman->status === 'menunggu')

                                    <span class="status-badge status-menunggu">
                                        Menunggu
                                    </span>

                                @elseif ($peminjaman->status === 'disetujui')

                                    <span class="status-badge status-disetujui">
                                        Disetujui
                                    </span>

                                @elseif ($peminjaman->status === 'ditolak')

                                    <span class="status-badge status-ditolak">
                                        Ditolak
                                    </span>

                                @elseif ($peminjaman->status === 'dikembalikan')

                                    <span class="status-badge status-dikembalikan">
                                        Dikembalikan
                                    </span>

                                @endif
                            </td>

                            <!-- AKSI -->
                            <td>
                                <div class="flex justify-center items-center gap-2 whitespace-nowrap">

                                    @if ($peminjaman->status === 'menunggu')

                                        <!-- SETUJUI -->
                                        <form action="{{ route('peminjaman.setujui', $peminjaman->id) }}"
                                              method="POST">
                                            @csrf
                                            @method('PATCH')

                                            <button type="submit" class="btn-setujui">
                                                Setujui
                                            </button>
                                        </form>

                                        <!-- TOLAK -->
                                        <form action="{{ route('peminjaman.tolak', $peminjaman->id) }}"
                                              method="POST">
                                            @csrf
                                            @method('PATCH')

                                            <button type="submit" class="btn-tolak">
                                                Tolak
                                            </button>
                                        </form>

                                    @elseif ($peminjaman->status === 'disetujui')

                                        <!-- TANDAI TELAH DIKEMBALIKAN -->
                                        <form action="{{ route('peminjaman.kembalikan', $peminjaman->id) }}"
                                              method="POST">
                                            @csrf
                                            @method('PATCH')

                                            <button type="submit" class="btn-kembalikan">
                                                Tandai Telah Dikembalikan
                                            </button>
                                        </form>

                                    @else

                                        <span class="text-gray-500 text-sm">
                                            Sudah diproses
                                        </span>

                                    @endif

                                </div>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="7" class="text-center p-6">
                                Belum ada pengajuan peminjaman.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>
</div>

@endsection
