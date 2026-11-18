<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BukuController extends Controller
{
    // Menampilkan daftar buku beserta kategori.
    public function index()
    {
        $buku = Buku::with('kategori')->latest()->get();

        return view('buku', compact('buku'));
    }

    // Menampilkan detail buku.
    public function show($id)
    {
        $detail = Buku::with('kategori')->find($id);

        return view('detail', compact('detail'));
    }

    // Pencarian judul buku.
      // Pencarian judul buku - VERSI RENTAN UNTUK PENGUJIAN
    // Pencarian judul buku - VERSI AMAN
    public function cari(Request $request)
    {
    $judul = $request->query('judul', '');

    $hasil = DB::select(
        'SELECT * FROM bukus WHERE judul = ?',
        [$judul]
    );

    return response()->json($hasil);
    }
}
