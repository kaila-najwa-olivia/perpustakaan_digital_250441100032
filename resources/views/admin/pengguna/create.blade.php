@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-8">

    <h1 class="text-2xl font-bold mb-6">
        Tambah Pengguna
    </h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white shadow rounded-lg p-6 max-w-xl">

        <form action="{{ route('admin.pengguna.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block font-medium mb-2">Nama</label>
                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    class="w-full border rounded-lg p-2"
                    required
                >
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-2">Email</label>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    class="w-full border rounded-lg p-2"
                    required
                >
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-2">Password</label>
                <input
                    type="password"
                    name="password"
                    class="w-full border rounded-lg p-2"
                    required
                >
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-2">Konfirmasi Password</label>
                <input
                    type="password"
                    name="password_confirmation"
                    class="w-full border rounded-lg p-2"
                    required
                >
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-2">Role</label>
                <select
                    name="role"
                    id="role"
                    class="w-full border rounded-lg p-2"
                    required
                >
                    <option value="">-- Pilih Role --</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="petugas" {{ old('role') == 'petugas' ? 'selected' : '' }}>Petugas</option>
                    <option value="siswa" {{ old('role') == 'siswa' ? 'selected' : '' }}>Siswa</option>
                </select>
            </div>

            <div class="mb-4" id="telepon-field" style="display: none;">
                <label class="block font-medium mb-2">Nomor Telepon Siswa</label>
                <input
                    type="text"
                    name="no_telepon"
                    value="{{ old('no_telepon') }}"
                    class="w-full border rounded-lg p-2"
                >
            </div>

            <div class="flex gap-3 mt-6">
                <button
                    type="submit"
                    class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700"
                >
                    Simpan
                </button>

                <a
                    href="{{ route('admin.pengguna.index') }}"
                    class="bg-gray-500 text-white px-5 py-2 rounded-lg"
                >
                    Kembali
                </a>
            </div>

        </form>
    </div>
</div>

<script>
    const roleSelect = document.getElementById('role');
    const teleponField = document.getElementById('telepon-field');

    function tampilkanTelepon() {
        teleponField.style.display =
            roleSelect.value === 'siswa' ? 'block' : 'none';
    }

    roleSelect.addEventListener('change', tampilkanTelepon);
    tampilkanTelepon();
</script>
@endsection
