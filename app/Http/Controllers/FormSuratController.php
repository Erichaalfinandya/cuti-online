<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormSuratController extends Controller
{
    public function simpan(Request $request)
    {
        // Validasi
        $request->validate([
            'nomor_surat' => 'required|string',
            'ttd_ketua' => 'nullable|image',
            'ttd_panitera1' => 'nullable|image',
            'ttd_panitera2' => 'nullable|image',
            'ttd_panitera3' => 'nullable|image',
            'ttd_kasubbag1' => 'nullable|image',
            'ttd_kasubbag2' => 'nullable|image',
            'ttd_kasubbag3' => 'nullable|image',
        ]);

        // Upload file (jika ada)
        $path = [];

        foreach ($request->allFiles() as $key => $file) {
            $path[$key] = $file->store('ttd_formsurat', 'public');
        }

        // Simpan ke database (jika database sudah siap)
        // contoh:
        // FormSurat::create([
        //     'nomor_surat' => $request->nomor_surat,
        //     'ttd_ketua' => $path['ttd_ketua'] ?? null,
        //     ...
        // ]);

        return back()->with('success', 'Data form surat berhasil disimpan!');
    }
}