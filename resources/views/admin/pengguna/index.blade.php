
@extends('layouts.app')

@section('content')

<style>
    .pengguna-page {
        max-width: 1200px;
        margin: 0 auto;
        padding: 32px 24px;
    }

    .pengguna-title {
        color: #166534;
        font-size: 26px;
        font-weight: 700;
        margin: 0;
    }

    .btn-tambah {
        display: inline-block;
        background-color: #16a34a;
        color: white !important;
        padding: 11px 20px;
        border-radius: 9px;
        text-decoration: none;
        font-weight: 600;
        text-align: center;
        transition: 0.2s;
    }

    .btn-tambah:hover {
        background-color: #15803d;
    }

    .tabel-pengguna {
        width: 100%;
        border-collapse: collapse;
        background-color: white;
    }

    .tabel-pengguna thead {
        background-color: #dcfce7;
        color: #166534;
    }

    .tabel-pengguna th {
        padding: 15px;
        font-weight: 700;
        border: 1px solid #bbf7d0;
        text-align: left;
    }

    .tabel-pengguna td {
        padding: 14px 15px;
        border: 1px solid #e5e7eb;
        color: #374151;
    }

    .tabel-pengguna tbody tr:hover {
        background-color: #f0fdf4;
    }

    .btn-edit {
        background-color: #16a34a;
        color: white !important;
        padding: 8px 15px;
        border-radius: 7px;
        text-decoration: none;
        font-weight: 600;
        display: inline-block;
    }

    .btn-edit:hover {
        background-color: #15803d;
    }

    .btn-hapus {
        background-color: #dc2626;
        color: white;
        padding: 8px 15px;
        border: none;
        border-radius: 7px;
        font-weight: 600;
        cursor: pointer;
    }

    .btn-hapus:hover {
        background-color: #b91c1c;
    }

    .kartu-pengguna {
        background: white;
        border: 1px solid #dcfce7;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 3px 10px rgba(22, 101, 52, 0.06);
    }

    @media (max-width: 640px) {
        .pengguna-page {
            padding: 24px 14px;
        }

        .pengguna-title {
            font-size: 22px;
        }
    }
</style>

<div class="pengguna-page">

    <!-- JUDUL DAN TOMBOL TAMBAH -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">

        <h1 class="pengguna-title">
            Kelola Data Pengguna
        </h1>

        <a href="{{ route('admin.pengguna.create') }}"
           class="btn-tambah">
            + Tambah Pengguna
        </a>

    </div>

    <!-- NOTIFIKASI BERHASIL -->
    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded-lg mb-4 border border-green-200">
            {{ session('success') }}
        </div>
    @endif

    <!-- NOTIFIKASI GAGAL -->
    @if (session('error'))
        <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-4 border border-red-200">
            {{ session('error') }}
        </div>
    @endif

    <!-- TABEL PENGGUNA -->
    <div class="kartu-pengguna overflow-x-auto">

        <table class="tabel-pengguna">

            <thead>
                <tr>
                    <th style="width: 70px;">No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th style="text-align: center; width: 180px;">Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse ($penggunas as $pengguna)

                    <tr>
                        <td>
                            {{ $loop->iteration }}
                        </td>

                        <td class="font-semibold">
                            {{ $pengguna->name }}
                        </td>

                        <td>
                            {{ $pengguna->email }}
                        </td>

                        <td>
                            <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold"
                                  style="background-color: #dcfce7; color: #166534;">
                                {{ $pengguna->getRoleNames()->first() ?? '-' }}
                            </span>
                        </td>

                        <td>
                            <div class="flex justify-center items-center gap-2">

                                <!-- TOMBOL EDIT -->
                                <a href="{{ route('admin.pengguna.edit', $pengguna->id) }}"
                                   class="btn-edit">
                                    Edit
                                </a>

                                <!-- TOMBOL HAPUS -->
                                <form action="{{ route('admin.pengguna.destroy', $pengguna->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Apakah kamu yakin ingin menghapus pengguna ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn-hapus">
                                        Hapus
                                    </button>

                                </form>

                            </div>
                        </td>
                    </tr>

                @empty

                    <tr>
                        <td colspan="5" class="text-center p-6">
                            Belum ada data pengguna.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection
