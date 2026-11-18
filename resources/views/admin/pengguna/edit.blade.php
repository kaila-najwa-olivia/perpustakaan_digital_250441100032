@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-8">

    <h1 class="text-2xl font-bold mb-6">
        Edit Data Pengguna
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

        <form action="{{ route('admin.pengguna.update', $pengguna->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block font-medium mb-2">Nama</label>
                <input
                    type="text"
                    name="name"
                    value="{{ old('name', $pengguna->name) }}"
                    class="w-full border rounded-lg p-2"
                    required
                >
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-2">Email</label>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email', $pengguna->email) }}"
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
                    <option value="admin" {{ old('role', $pengguna->getRoleNames()->first()) == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="petugas" {{ old('role', $pengguna->getRoleNames()->first()) == 'petugas' ? 'selected' : '' }}>Petugas</option>
                    <option value="siswa" {{ old('role', $pengguna->getRoleNames()->first()) == 'siswa' ? 'selected' : '' }}>Siswa</option>
                </select>
            </div>

            <div class="mb-4" id="telepon-field" style="display: none;">
                <label class="block font-medium mb-2">Nomor Telepon Siswa</label>
                <input
                    type="text"
                    name="no_telepon"
                    value="{{ old('no_telepon', $pengguna->anggota->no_telepon ?? '') }}"
                    class="w-full border rounded-lg p-2"
                >
            </div>

            <div class="flex gap-3 mt-6">
                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg"
                >
                    Simpan Perubahan
                </button>

                <a
                    href="{{ route('admin.pengguna.index') }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-lg"
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
