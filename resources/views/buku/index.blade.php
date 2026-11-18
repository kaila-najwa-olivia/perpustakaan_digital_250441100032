@extends('layouts.app')

@section('title', 'Daftar Buku')

@section('content')
<div class="min-h-screen bg-slate-50 py-8 px-4 sm:px-6">
    <div class="max-w-6xl mx-auto">

        <div class="mb-8">
            <h2 class="text-3xl font-bold text-slate-800">
                Daftar Buku
            </h2>
            <p class="text-slate-500 mt-2">
                Temukan buku yang ingin kamu baca dan ajukan peminjaman.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($buku as $b)
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-4 flex flex-col">

                    <div class="flex-1">
                        <x-kartu-buku
                            :judul="$b['judul']"
                            :penulis="$b['penulis']"
                            :tahun="$b['tahun']"
                            :url="route('buku.show', $b['id'])"
                        >
                            {{ $b['kategori'] }}
                        </x-kartu-buku>
                    </div>

                    <a href="{{ route('peminjaman.create', ['buku_id' => $b['id']]) }}"
                        class="mt-4 block text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-xl transition">
                        Pinjam Buku
                    </a>

                </div>
            @empty
                <div class="col-span-full bg-white rounded-xl p-10 text-center">
                    <p class="text-slate-600">
                        Belum ada buku yang tersedia.
                    </p>
                </div>
            @endforelse
        </div>

    </div>
</div>
@endsection
