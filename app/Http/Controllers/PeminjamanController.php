<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    // Menampilkan riwayat peminjaman berdasarkan role
    public function index()
    {
        $user = auth()->user();

        // Admin dan Petugas diarahkan ke halaman pengelolaan
        if ($user->hasRole('admin') || $user->hasRole('petugas')) {
            return redirect()->route('peminjaman.kelola');
        }

        // Siswa hanya melihat riwayat miliknya sendiri
        $anggota = $user->anggota;

        if (!$anggota) {
            abort(403, 'Data anggota tidak ditemukan.');
        }

        $peminjamans = Peminjaman::with('buku')
            ->where('anggota_id', $anggota->id)
            ->latest()
            ->get();

        return view('peminjaman.index', compact('peminjamans'));
    }

    // Menampilkan formulir pengajuan
    public function create()
    {
        $bukus = Buku::all();
        $bukuTerpilih = request('buku_id');

        return view('peminjaman.create', compact('bukus', 'bukuTerpilih'));
    }

    // Menyimpan pengajuan peminjaman
    public function store(Request $request)
    {
        $request->validate([
            'buku_id' => ['required', 'exists:bukus,id'],
        ]);

        $anggota = auth()->user()->anggota;

        if (!$anggota) {
            abort(403, 'Data anggota tidak ditemukan.');
        }

        Peminjaman::create([
            'anggota_id' => $anggota->id,
            'buku_id' => $request->buku_id,
            'tanggal_pinjam' => null,
            'tanggal_kembali' => null,
            'status' => 'menunggu',
        ]);

        return redirect()
            ->route('peminjaman.index')
            ->with('success', 'Pengajuan peminjaman berhasil dikirim.');
    }

    // Menampilkan semua pengajuan untuk Admin dan Petugas
    public function kelola()
    {
        $peminjamans = Peminjaman::with(['anggota', 'buku'])
            ->latest()
            ->get();

        return view('peminjaman.kelola', compact('peminjamans'));
    }

    // Menyetujui pengajuan peminjaman
    public function setujui($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->status !== 'menunggu') {
            return back()->with('error', 'Pengajuan ini sudah diproses.');
        }

        DB::transaction(function () use ($peminjaman) {
            $tanggalPinjam = now()->toDateString();

            $peminjaman->update([
                'tanggal_pinjam' => $tanggalPinjam,
                'tanggal_kembali' => now()->addDays(7)->toDateString(),
                'status' => 'disetujui',
            ]);
        });

        return back()->with('success', 'Peminjaman berhasil disetujui.');
    }

    // Menolak pengajuan peminjaman
    public function tolak($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->status !== 'menunggu') {
            return back()->with('error', 'Pengajuan ini sudah diproses.');
        }

        $peminjaman->update([
            'status' => 'ditolak',
        ]);

        return back()->with('success', 'Pengajuan peminjaman berhasil ditolak.');
    }

    // Menampilkan detail peminjaman setelah diperiksa oleh Policy.
    public function show($id)
    {
        $peminjaman = Peminjaman::with(['anggota.user', 'buku'])->findOrFail($id);

        // Policy menentukan apakah pengguna boleh melihat data ini.
        \Illuminate\Support\Facades\Gate::authorize('view', $peminjaman);

        return view('peminjaman.show', compact('peminjaman'));
    }
    
    // {
    // $peminjaman = Peminjaman::with(['anggota.user', 'buku'])->findOrFail($id);

    // return view('peminjaman.show', compact('peminjaman'));
    // }
    // Mencatat pengembalian buku
    public function kembalikan($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->status !== 'disetujui') {
            return back()->with('error', 'Buku ini belum disetujui atau sudah dikembalikan.');
        }

        $peminjaman->update([
            'status' => 'dikembalikan',
        ]);

        return back()->with('success', 'Buku berhasil dikembalikan.');
    }
}

