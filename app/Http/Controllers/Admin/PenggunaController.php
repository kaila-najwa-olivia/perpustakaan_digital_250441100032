<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class PenggunaController extends Controller
{
    // Menampilkan daftar seluruh pengguna
    public function index()
    {
        $penggunas = User::latest()->get();

        return view('admin.pengguna.index', compact('penggunas'));
    }

    // Menampilkan form tambah pengguna
    public function create()
    {
        return view('admin.pengguna.create');
    }

    // Menyimpan pengguna baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,petugas,siswa',
            'no_telepon' => 'required_if:role,siswa|nullable|string|max:20',
        ]);

        DB::transaction(function () use ($request) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'role' => ucfirst($request->role),
            ]);

            // Memberikan role menggunakan Spatie
            $user->assignRole($request->role);

            // Membuat data anggota jika role adalah siswa
            if ($request->role === 'siswa') {
                Anggota::create([
                    'user_id' => $user->id,
                    'nama' => $user->name,
                    'email' => $user->email,
                    'no_telepon' => $request->no_telepon,
                ]);
            }
        });

        return redirect()
            ->route('admin.pengguna.index')
            ->with('success', 'Pengguna berhasil ditambahkan.');
    }

    // Menampilkan form edit pengguna
    public function edit($id)
    {
        $pengguna = User::with('anggota')->findOrFail($id);

        return view('admin.pengguna.edit', compact('pengguna'));
    }

    // Memperbarui data pengguna
    public function update(Request $request, $id)
    {
        $pengguna = User::with('anggota')->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($pengguna->id),
            ],
            'role' => 'required|in:admin,petugas,siswa',
            'no_telepon' => 'required_if:role,siswa|nullable|string|max:20',
        ]);

        DB::transaction(function () use ($request, $pengguna) {

            $pengguna->update([
                'name' => $request->name,
                'email' => $request->email,
                'role' => ucfirst($request->role),
            ]);

            // Memperbarui role menggunakan Spatie
            $pengguna->syncRoles([$request->role]);

            // Jika role Siswa, buat atau perbarui data anggota
            if ($request->role === 'siswa') {
                Anggota::updateOrCreate(
                    ['user_id' => $pengguna->id],
                    [
                        'nama' => $pengguna->name,
                        'email' => $pengguna->email,
                        'no_telepon' => $request->no_telepon,
                    ]
                );
            } else {
                // Hapus anggota hanya jika belum memiliki riwayat peminjaman
                if ($pengguna->anggota && $pengguna->anggota->peminjamans()->doesntExist()) {
                    $pengguna->anggota->delete();
                }
            }
        });

        return redirect()
            ->route('admin.pengguna.index')
            ->with('success', 'Data pengguna berhasil diperbarui.');
    }
    // Menghapus pengguna
    public function destroy($id)
    {
    $pengguna = User::with('anggota')->findOrFail($id);

    // Mencegah penghapusan akun yang sedang digunakan
    if (auth()->id() == $pengguna->id) {
        return redirect()
            ->route('admin.pengguna.index')
            ->with('error', 'Akun yang sedang digunakan tidak bisa dihapus.');
    }

    // Memeriksa apakah anggota memiliki riwayat peminjaman
    if ($pengguna->anggota && $pengguna->anggota->peminjamans()->exists()) {
        return redirect()
            ->route('admin.pengguna.index')
            ->with('error', 'Pengguna tidak bisa dihapus karena memiliki riwayat peminjaman.');
    }

    DB::transaction(function () use ($pengguna) {
        if ($pengguna->anggota) {
            $pengguna->anggota->delete();
        }

        $pengguna->delete();
    });

    return redirect()
        ->route('admin.pengguna.index')
        ->with('success', 'Pengguna berhasil dihapus.');
}
}
