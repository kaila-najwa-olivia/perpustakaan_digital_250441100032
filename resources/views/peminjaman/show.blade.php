@extends('layouts.app')

@section('title', 'Detail Peminjaman')

@section('content')
<div style="max-width:900px; margin:35px auto; padding:0 18px;">
    <div style="background:white; border:1px solid #dcfce7; border-radius:14px; padding:28px; box-shadow:0 3px 12px rgba(22,101,52,.06);">
        <h1 style="font-size:25px; font-weight:700; color:#166534; margin-bottom:8px;">
            Detail Peminjaman
        </h1>
        <p style="color:#64748b; margin-bottom:24px;">
            Informasi peminjaman buku di Perpustakaan Digital.
        </p>

        <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(220px,1fr)); gap:16px;">
            <div style="background:#f0fdf4; padding:16px; border-radius:10px;">
                <p style="color:#64748b; font-size:13px;">ID Peminjaman</p>
                <p style="font-weight:700; color:#14532d;">#{{ $peminjaman->id }}</p>
            </div>

            <div style="background:#f0fdf4; padding:16px; border-radius:10px;">
                <p style="color:#64748b; font-size:13px;">Nama Siswa</p>
                <p style="font-weight:700; color:#14532d;">
                    {{ $peminjaman->anggota->nama ?? '-' }}
                </p>
            </div>

            <div style="background:#f0fdf4; padding:16px; border-radius:10px;">
                <p style="color:#64748b; font-size:13px;">Email</p>
                <p style="font-weight:700; color:#14532d;">
                    {{ $peminjaman->anggota->email ?? '-' }}
                </p>
            </div>

            <div style="background:#f0fdf4; padding:16px; border-radius:10px;">
                <p style="color:#64748b; font-size:13px;">Judul Buku</p>
                <p style="font-weight:700; color:#14532d;">
                    {{ $peminjaman->buku->judul ?? '-' }}
                </p>
            </div>

            <div style="background:#f0fdf4; padding:16px; border-radius:10px;">
                <p style="color:#64748b; font-size:13px;">Tanggal Pinjam</p>
                <p style="font-weight:700; color:#14532d;">
                    {{ $peminjaman->tanggal_pinjam
                        ? \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('d-m-Y')
                        : '-' }}
                </p>
            </div>

            <div style="background:#f0fdf4; padding:16px; border-radius:10px;">
                <p style="color:#64748b; font-size:13px;">Tanggal Kembali</p>
                <p style="font-weight:700; color:#14532d;">
                    {{ $peminjaman->tanggal_kembali
                        ? \Carbon\Carbon::parse($peminjaman->tanggal_kembali)->format('d-m-Y')
                        : '-' }}
                </p>
            </div>

            <div style="background:#f0fdf4; padding:16px; border-radius:10px;">
                <p style="color:#64748b; font-size:13px;">Status</p>
                <p style="font-weight:700; color:#14532d;">
                    {{ ucfirst($peminjaman->status ?? 'Belum tersedia') }}
                </p>
            </div>
        </div>

        <div style="margin-top:26px;">
            @if (auth()->user()->hasRole('siswa'))
                <a href="{{ route('peminjaman.index') }}"
                   style="display:inline-block; background:#15803d; color:white; padding:11px 18px; border-radius:8px; text-decoration:none; font-weight:600;">
                    Kembali ke Riwayat
                </a>
            @else
                <a href="{{ route('peminjaman.kelola') }}"
                   style="display:inline-block; background:#15803d; color:white; padding:11px 18px; border-radius:8px; text-decoration:none; font-weight:600;">
                    Kembali ke Pengelolaan
                </a>
            @endif
        </div>
    </div>
</div>
@endsection
