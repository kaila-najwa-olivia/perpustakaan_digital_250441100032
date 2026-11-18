@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-8 px-4">

    <div class="bg-white rounded-xl shadow-md p-6">
        <h2 class="text-2xl font-bold mb-2">
            Form Pengajuan Peminjaman Buku
        </h2>

        <p class="text-gray-500 mb-6">
            Pilih buku yang ingin kamu pinjam. Tanggal pinjam dan
            jatuh tempo akan ditentukan setelah petugas menyetujui pengajuan.
        </p>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('peminjaman.store') }}" method="POST">
            @csrf

            <div class="mb-6">
                <label class="block font-semibold mb-2">
                    Pilih Buku
                </label>

                <select name="buku_id"
                    class="w-full border rounded-lg p-3"
                    required>

                    <option value="">-- Pilih Buku --</option>

                    @foreach ($bukus as $buku)
                        <option value="{{ $buku->id }}"
                            {{ old('buku_id', $bukuTerpilih) == $buku->id ? 'selected' : '' }}>
                            {{ $buku->judul }}
                        </option>
                    @endforeach

                </select>
            </div>

            <div class="flex gap-3">
                <a href="{{ route('buku.index') }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-lg">
                    Kembali
                </a>

                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">
                    Ajukan Peminjaman
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
