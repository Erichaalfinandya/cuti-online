<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class CutiController extends Controller
{
    public function index()
    {
        // Contoh data sementara (nanti bisa dari database)
        $jatahCuti = collect([
            (object)[
                'id' => 1,
                'jenis_cuti' => 'Cuti Tahunan',
                'sisa_cuti' => 8,
                'cuti_terpakai' => 4,
            ],
            (object)[
                'id' => 2,
                'jenis_cuti' => 'Cuti Besar',
                'sisa_cuti' => 12,
                'cuti_terpakai' => 0,
            ],
        ]);

        return view('jatah-cuti.index', compact('jatahCuti'));
    }

    public function store(Request $request)
    {
        // Validasi form input
        $validated = $request->validate([
            'jenis_cuti' => 'required|string|max:50',
            'tanggal_mulai' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_mulai',
            'alasan' => 'required|string|max:255',
        ]);

        // Untuk saat ini, karena belum pakai database
        // kita hanya menampilkan hasil pengajuan di halaman
        // (nanti ini bisa disimpan ke tabel "cuti")
        return redirect()->route('jatah-cuti.index')->with('success', 'Pengajuan cuti berhasil dikirim!');
    }
}