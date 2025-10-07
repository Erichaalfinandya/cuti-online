<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RiwayatCuti;

class RiwayatCutiController extends Controller
{
    // 🔹 Menampilkan halaman riwayat cuti (tabel utama)
    public function index()
    {
        // Ambil semua data dari database
        $riwayatCuti = RiwayatCuti::all();

        // Kirim ke view
        return view('riwayat-cuti', compact('riwayatCuti'));
    }

    // 🔹 Ambil data detail berdasarkan ID (untuk modal)
    public function show($id)
    {
        // Cari data berdasarkan id
        $cuti = RiwayatCuti::findOrFail($id);

        // Kembalikan dalam format JSON untuk AJAX
        return response()->json($cuti);
    }
}