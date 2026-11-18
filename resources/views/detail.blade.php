@extends('layouts.app')

@section('title', 'Detail Buku')

@section('content')

<div style="
    max-width: 900px;
    margin: 40px auto;
    padding: 0 20px;
    box-sizing: border-box;
">

    @if ($detail)

    <div style="
        background: white;
        border-radius: 16px;
        padding: 35px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        border: 1px solid #e5e7eb;
    ">

        <div style="
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 25px;
        ">
            <div style="
                width: 50px;
                height: 50px;
                background: #ccfbf1;
                color: #0f766e;
                border-radius: 12px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 25px;
            ">
                📖
            </div>

            <div>
                <h2 style="
                    font-size: 25px;
                    font-weight: bold;
                    color: #134e4a;
                    margin: 0;
                ">
                    Detail Buku
                </h2>

                <p style="
                    color: #6b7280;
                    font-size: 14px;
                    margin: 4px 0 0;
                ">
                    Informasi lengkap buku perpustakaan
                </p>
            </div>
        </div>

        <div style="
            background: #f0fdfa;
            border-left: 5px solid #0f766e;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 25px;
        ">
            <p style="
                color: #0f766e;
                font-size: 13px;
                font-weight: 600;
                margin: 0 0 8px;
            ">
                JUDUL BUKU
            </p>

            <h3 style="
                color: #134e4a;
                font-size: 23px;
                font-weight: bold;
                margin: 0;
            ">
                {{ $detail->judul }}
            </h3>
        </div>

        <h3 style="
            font-size: 17px;
            font-weight: bold;
            color: #374151;
            margin-bottom: 15px;
        ">
            Informasi Buku
        </h3>

        <div style="
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 15px;
        ">

            <div style="
                background: #f9fafb;
                padding: 18px;
                border-radius: 10px;
                border: 1px solid #e5e7eb;
            ">
                <p style="color:#6b7280; font-size:13px; margin:0 0 8px;">
                    ID Buku
                </p>

                <p style="font-size:18px; font-weight:bold; color:#1f2937; margin:0;">
                    #{{ $detail->id }}
                </p>
            </div>

            <div style="
                background: #f9fafb;
                padding: 18px;
                border-radius: 10px;
                border: 1px solid #e5e7eb;
            ">
                <p style="color:#6b7280; font-size:13px; margin:0 0 8px;">
                    Penulis
                </p>

                <p style="font-size:18px; font-weight:bold; color:#1f2937; margin:0;">
                    {{ $detail->penulis }}
                </p>
            </div>

            <div style="
                background: #f9fafb;
                padding: 18px;
                border-radius: 10px;
                border: 1px solid #e5e7eb;
            ">
                <p style="color:#6b7280; font-size:13px; margin:0 0 8px;">
                    Tahun Terbit
                </p>

                <p style="font-size:18px; font-weight:bold; color:#1f2937; margin:0;">
                    {{ $detail->tahun_terbit }}
                </p>
            </div>

            <div style="
                background: #f9fafb;
                padding: 18px;
                border-radius: 10px;
                border: 1px solid #e5e7eb;
            ">
                <p style="color:#6b7280; font-size:13px; margin:0 0 8px;">
                    Kategori
                </p>

                <p style="font-size:18px; font-weight:bold; color:#1f2937; margin:0;">
                    {{ $detail->kategori->nama ?? 'Tidak ada kategori' }}
                </p>
            </div>

        </div>

        <div style="
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
        ">
            <a href="{{ route('buku.index') }}" style="
                display: inline-block;
                background: #0f766e;
                color: white;
                text-decoration: none;
                padding: 12px 22px;
                border-radius: 8px;
                font-size: 14px;
                font-weight: 600;
            ">
                ← Kembali ke Daftar Buku
            </a>
        </div>

    </div>

    @else

    <div style="
        background: white;
        padding: 40px;
        border-radius: 15px;
        text-align: center;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    ">
        <div style="font-size:45px; margin-bottom:15px;">
            📚
        </div>

        <h2 style="
            font-size: 23px;
            font-weight: bold;
            color: #374151;
            margin-bottom: 10px;
        ">
            Buku Tidak Ditemukan
        </h2>

        <p style="color:#6b7280; margin-bottom:20px;">
            Maaf, data buku yang kamu cari tidak tersedia.
        </p>

        <a href="{{ route('buku.index') }}" style="
            display: inline-block;
            background: #0f766e;
            color: white;
            text-decoration: none;
            padding: 12px 22px;
            border-radius: 8px;
            font-weight: 600;
        ">
            ← Kembali ke Daftar Buku
        </a>
    </div>

    @endif

</div>

@endsection
