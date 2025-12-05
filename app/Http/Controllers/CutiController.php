<?php

namespace App\Http\Controllers;


use App\Models\UserModel;
use App\Models\RiwayatCuti;
use Illuminate\Http\Request;
use App\Models\JatahCutiModel;
use App\Models\JenisCutiModel;
use App\Models\AjukanCutiModel;
use App\Models\RiwayatCutiModel;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Support\Facades\Log as Log;

class CutiController extends Controller
{
    public function detail_jatah_cuti($id)
    {
        return view('detail_jatah_cuti', ['id' => $id]);
    }

    // public function detail_pengajuan_cuti($id)
    // {
    //     $data = AjukanCutiModel::with('riwayatCutis')->find($id);
    //     if (!$data) abort(404);

    //     $userRoles = auth()->user()->getRoleNames();
    //     $sudahAcc = $data->riwayatCutis->contains(function ($item) use ($userRoles) {
    //         return in_array($item->role_name, $userRoles->toArray());
    //     });

    //     return view('detail_pengajuan_cuti', compact('id', 'sudahAcc', 'data'));
    // }

    public function detail_pengajuan_cuti($id)
    {
        $data = AjukanCutiModel::with('riwayatCutis')->find($id);
        if (!$data) abort(404);

        $userRoles = auth()->user()->getRoleNames()->toArray();

        // Ambil semua role yang sudah ACC
        $roleSudahAcc = $data->riwayatCutis->pluck('role_name')->toArray();

        // Selisihkan: role user yang belum ACC
        $rolesBelumAcc = array_diff($userRoles, $roleSudahAcc);

        // dd(compact('id', 'data', 'rolesBelumAcc'));
        return view('detail_pengajuan_cuti', compact('id', 'data', 'rolesBelumAcc'));
    }



    public function list_ajukan_cuti()
    {
        return view('ajukan_cuti');
    }
    public function jatah_cuti()
    {
        return view('jatah-cuti.jatah-cuti');
    }

    public function formulir()
    {
        $user = UserModel::all();
        $jenisCuti = JenisCutiModel::all();

        return view('formulir', compact('user', 'jenisCuti'));
    }

    public function master_jenis_cuti()
    {
        return view('master-jeniscuti');
    }

    // public function getAjukanCuti()
    // {
    //     // $data = AjukanCutiModel::all();
    //     $cutis = AjukanCutiModel::with('user', 'jenisCuti')->get();
    //     return response()->json(['data' => $cutis]);
    // }

    public function getAjukanCuti()
    {
        $user = auth()->user();
        $query = AjukanCutiModel::with(['user', 'jenisCuti']);
        $golongan = trim($user->golongan); // bersihkan login user

        switch ($golongan) {
            case 'kepegawaian':
            case 'ketua':
            case 'hakim':
                // Bisa lihat semua → otomatis termasuk diri sendiri
                break;

            case 'panmud_1':
                $query->where(function ($q) use ($user) {
                    $q->whereHas(
                        'user',
                        fn($q2) =>
                        $q2->whereRaw("TRIM(REPLACE(REPLACE(golongan, '\r', ''), '\n', '')) = ?", ['staf_panitera_1'])
                    )
                        ->orWhere('user_id', $user->id);
                });
                break;

            case 'panmud_2':
                $query->where(function ($q) use ($user) {
                    $q->whereHas(
                        'user',
                        fn($q2) =>
                        $q2->whereRaw("TRIM(REPLACE(REPLACE(golongan, '\r', ''), '\n', '')) = ?", ['staf_panitera_2'])
                    )
                        ->orWhere('user_id', $user->id);
                });
                break;

            case 'panmud_3':
                $query->where(function ($q) use ($user) {
                    $q->whereHas(
                        'user',
                        fn($q2) =>
                        $q2->whereRaw("TRIM(REPLACE(REPLACE(golongan, '\r', ''), '\n', '')) = ?", ['staf_panitera_3'])
                    )
                        ->orWhere('user_id', $user->id);
                });
                break;

            case 'kasubbag_1':
                $query->where(function ($q) use ($user) {
                    $q->whereHas(
                        'user',
                        fn($q2) =>
                        $q2->whereRaw("TRIM(REPLACE(REPLACE(golongan, '\r', ''), '\n', '')) = ?", ['staf_sekretaris_1'])
                    )
                        ->orWhere('user_id', $user->id);
                });
                break;

            case 'kasubbag_2':
                $query->where(function ($q) use ($user) {
                    $q->whereHas(
                        'user',
                        fn($q2) =>
                        $q2->whereRaw("TRIM(REPLACE(REPLACE(golongan, '\r', ''), '\n', '')) = ?", ['staf_sekretaris_2'])
                    )
                        ->orWhere('user_id', $user->id);
                });
                break;

            case 'kasubbag_3':
                $query->where(function ($q) use ($user) {
                    $q->whereHas(
                        'user',
                        fn($q2) =>
                        $q2->whereRaw("TRIM(REPLACE(REPLACE(golongan, '\r', ''), '\n', '')) = ?", ['staf_sekretaris_3'])
                    )
                        ->orWhere('user_id', $user->id);
                });
                break;

            case 'panitera':
                $query->where(function ($q) use ($user) {
                    $q->whereHas(
                        'user',
                        fn($q2) =>
                        $q2->whereIn(DB::raw("TRIM(REPLACE(REPLACE(golongan, '\r', ''), '\n', ''))"), [
                            'panmud',
                            'panmud_1',
                            'panmud_2',
                            'panmud_3',
                            'staf_panitera_1',
                            'staf_panitera_2',
                            'staf_panitera_3'
                        ])
                    )
                        ->orWhere('user_id', $user->id);
                });
                break;

            case 'sekretaris':
                $query->where(function ($q) use ($user) {
                    $q->whereHas(
                        'user',
                        fn($q2) =>
                        $q2->whereIn(DB::raw("TRIM(REPLACE(REPLACE(golongan, '\r', ''), '\n', ''))"), [
                            'kasubbag_1',
                            'kasubbag_2',
                            'kasubbag_3',
                            'staf_sekretaris_1',
                            'staf_sekretaris_2',
                            'staf_sekretaris_3'
                        ])
                    )
                        ->orWhere('user_id', $user->id);
                });
                break;

            default:
                // Staf biasa hanya lihat dirinya sendiri
                $query->where('user_id', $user->id);
                break;
        }

        $data = $query->orderBy('id', 'desc')->get();

        return response()->json(['data' => $data]);
    }


    // public function getUser()
    // {
    //     $data = UserModel::all();
    //     return response()->json(['data' => $data]);
    // }
    public function getUser()
    {
        $user = auth()->user();

        // kalau dia role kepegawaian, ambil semua data
        if ($user->hasRole('kepegawaian')) {
            $data = UserModel::select('id', 'nama', 'nip')->get();
        } else {
            // selain itu, cuma data dia sendiri
            $data = UserModel::where('id', $user->id)
                ->select('id', 'nama', 'nip')
                ->get();
        }

        return response()->json(['data' => $data]);
    }


    // public function getPengajuanCutiById($id)
    // {
    //     // $data = AjukanCutiModel::find($id);
    //     $data = AjukanCutiModel::with([
    //         'user:id,nama',
    //         'jenisCuti:id,nama_cuti'
    //     ])->find($id);

    //     if ($data) {
    //         return response()->json(['data' => $data]);
    //     } else {
    //         return response()->json(['message' => 'Jenis cuti tidak ditemukan'], 404);
    //     }
    // }

    public function getPengajuanCutiById($id)
    {
        $data = AjukanCutiModel::with([
            'user:id,nama',
            'jenisCuti:id,nama_cuti',
            'riwayatCutis' => function ($q) {
                $q->with(['user:id,nama,jabatan,golongan'])
                    ->select('id', 'ajukan_cuti_id', 'user_id', 'acc', 'keterangan', 'created_at');
            }
        ])->find($id);

        if ($data) {
            return response()->json(['data' => $data]);
        } else {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
    }


    // JENIS CUTI
    public function getJenisCutiById($id)
    {
        $data = JenisCutiModel::find($id);
        if ($data) {
            return response()->json(['data' => $data]);
        } else {
            return response()->json(['message' => 'Jenis cuti tidak ditemukan'], 404);
        }
    }

    public function getJatahCutiById($id)
    {
        $jatahCuti = JatahCutiModel::with('jenisCuti')
            ->where('user_id', $id)
            ->get();

        // Selalu return 200, data bisa kosong
        return response()->json(['data' => $jatahCuti]);
    }


    public function getJenisCuti()
    {
        $data = JenisCutiModel::all();
        return response()->json(['data' => $data]);
    }

    public function getJatahCuti()
    {
        $data = JatahCutiModel::all();
        return response()->json(['data' => $data]);
    }



    public function tambah_jenis_cuti(Request $request)
    {
        $request->validate([
            'nama_cuti' => 'required|string|max:50',
            'jumlah_hari' => 'required|integer',
            'keterangan' => 'nullable|string|max:255',
        ]);

        // Tambah jenis cuti
        $jenisCuti = JenisCutiModel::create($request->all());

        // Ambil semua user
        $users = UserModel::all();

        // Buat jatah cuti untuk setiap user
        foreach ($users as $user) {
            DB::table('jatah_cutis')->insert([
                'user_id' => $user->id,
                'jenis_cuti_id' => $jenisCuti->id,
                'cuti_terpakai' => 0,
                'sisa_cuti' => $jenisCuti->jumlah_hari, // otomatis sesuai jumlah_hari
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Jenis cuti berhasil ditambahkan dan jatah cuti untuk semua user dibuat!',
            'data' => $jenisCuti
        ]);
    }


    public function edit_jenis_cuti(Request $request, $id)
    {
        $request->validate([
            'nama_cuti' => 'required|string|max:50',
            'jumlah_hari' => 'required|integer',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $data = JenisCutiModel::findOrFail($id);
        $data->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Jenis cuti berhasil diperbarui!',
            'data' => $data
        ]);
    }

    public function delete_jenis_cuti($id)
    {
        $data = JenisCutiModel::findOrFail($id);
        $data->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Jenis cuti berhasil dihapus!'
        ]);
    }

    // AJUKAN CUTI

    // public function tambah_ajukan_cuti(Request $request)
    // {
    //     $request->validate([
    //         'user_id' => 'required|exists:users,id',
    //         'jenis_cuti_id' => 'required|exists:jenis_cutis,id',
    //         'tanggal_awal' => 'required|date|before_or_equal:tanggal_akhir',
    //         'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
    //         'jumlah_hari' => 'required|integer',
    //         'status' => 'required|integer',
    //         'keterangan' => 'nullable|string|max:255',
    //     ]);


    //     $data = AjukanCutiModel::create($request->all());

    //     // dd($data);

    //     return response()->json([
    //         'status' => 'success',
    //         'message' => 'Pengajuan cuti berhasil ditambahkan!',
    //         'data' => $data
    //     ]);
    // }

    public function tambah_ajukan_cuti(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'jenis_cuti_id' => 'required|exists:jenis_cutis,id',
            'tanggal_awal' => 'required|date|before_or_equal:tanggal_akhir',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
            'jumlah_hari' => 'required|integer|min:1',
            'status' => 'required|integer',
            'alamat_cuti' => 'nullable|string|max:255',
            'ttd_pemohon' => 'required|string', // base64
            'keterangan' => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();

        try {
            // === SIMPAN TTD SEBAGAI FILE ===
            if (isset($validated['ttd_pemohon'])) {
                $ttdBase64 = $validated['ttd_pemohon'];
                // hapus prefix base64 jika ada
                $ttdBase64 = preg_replace('/^data:image\/\w+;base64,/', '', $ttdBase64);
                $ttdBase64 = str_replace(' ', '+', $ttdBase64);
                $imageData = base64_decode($ttdBase64);

                $filename = 'ttd_' . $validated['user_id'] . '_' . time() . '.png';
                $folder = public_path('uploads/ttd/');
                if (!file_exists($folder)) {
                    mkdir($folder, 0755, true);
                }
                file_put_contents($folder . $filename, $imageData);

                // ganti value ttd di DB menjadi path file
                $validated['ttd_pemohon'] = 'uploads/ttd/' . $filename;
            }

            // Cek apakah user punya jatah cuti untuk jenis cuti tersebut
            $jatahCuti = JatahCutiModel::where('user_id', $validated['user_id'])
                ->where('jenis_cuti_id', $validated['jenis_cuti_id'])
                ->first();

            if (!$jatahCuti) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'User ini tidak memiliki jatah cuti untuk jenis cuti yang dipilih.'
                ], 404);
            }

            // Cek sisa cuti
            if ($jatahCuti->sisa_cuti < $validated['jumlah_hari']) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Sisa cuti tidak mencukupi. Sisa cuti saat ini: ' . $jatahCuti->sisa_cuti
                ], 400);
            }

            // Simpan pengajuan cuti
            $data = AjukanCutiModel::create($validated);

            // Update jatah cuti
            $jatahCuti->increment('cuti_terpakai', $validated['jumlah_hari']);
            $jatahCuti->decrement('sisa_cuti', $validated['jumlah_hari']);

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Pengajuan cuti berhasil ditambahkan dan jatah cuti diperbarui!',
                'data' => $data
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }


    public function edit_ajukan_cuti(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'jenis_cuti_id' => 'required|exists:jenis_cutis,id',
            'tanggal_awal' => 'required|date|before_or_equal:tanggal_akhir',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
            'jumlah_hari' => 'required|integer',
            'status' => 'required|integer',
            'keterangan' => 'nullable|string|max:255',
            'alamat_cuti' => 'nullable|string|max:255',
        ]);


        $data = AjukanCutiModel::findOrFail($id);
        $data->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Pengajuan cuti berhasil diperbarui!',
            'data' => $data
        ]);
    }

    public function delete_ajukan_cuti($id)
    {
        $data = AjukanCutiModel::findOrFail($id);
        $data->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Pengajuan cuti berhasil dihapus!'
        ]);
    }


    //AKSI KEPEGAWAIAN

    public function aksi_kepegawaian(Request $request)
    {
        $validated = $request->validate([
            'ajukan_cuti_id' => 'required|exists:ajukan_cutis,id',
            'acc' => 'required|boolean',
            'keterangan' => 'nullable|string|max:255',
            'role_name' => 'required|string',
        ]);

        $user = auth()->user();
        $userRoles = $user->getRoleNames()->toArray();

        // Ambil role yang sudah ACC pada cuti ini
        $roleSudahAcc = RiwayatCutiModel::where('ajukan_cuti_id', $validated['ajukan_cuti_id'])
            ->pluck('role_name')
            ->toArray();

        // Cari role user yang belum ACC
        $rolesBelumAcc = array_values(array_diff($userRoles, $roleSudahAcc));

        // Tentukan role yang dipakai
        $roleNameDipakai = $validated['role_name'];

        // Kalau role dikirim FE sudah pernah dipakai, ganti role-nya
        if (in_array($roleNameDipakai, $roleSudahAcc)) {
            if (count($rolesBelumAcc) > 0) {
                $roleNameDipakai = $rolesBelumAcc[0];
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Semua role Anda sudah melakukan ACC.'
                ], 400);
            }
        }

        // Data riwayat ACC
        $data = [
            'tanggal' => now(),
            'user_id' => $user->id,
            'role_name' => $roleNameDipakai,
            'ajukan_cuti_id' => $validated['ajukan_cuti_id'],
            'acc' => $validated['acc'],
            'keterangan' => $validated['keterangan'] ?? null,
        ];

        // Simpan riwayat cuti
        $riwayat = RiwayatCutiModel::create($data);

        // Tentukan status baru berdasarkan golongan/jabatan user login
        $status = match (strtolower(trim($user->golongan ?? ''))) {
            'kepegawaian' => 2,
            'kasubbag_1', 'kasubbag_2', 'kasubbag_3',
            'panmud_1', 'panmud_2', 'panmud_3' => 3,
            'panitera', 'sekretaris' => 4,
            'ketua' => 5,
            default => 1,
        };

        // Update status ajukan cuti
        AjukanCutiModel::where('id', $validated['ajukan_cuti_id'])
            ->update(['status' => $status]);

        return response()->json([
            'status' => 'success',
            'message' => 'Aksi berhasil disimpan dan status cuti diperbarui!',
            'data' => $riwayat
        ]);
    }

    public function generate_word($id)
    {
        try {
            Log::info("Generate Word: mulai proses untuk cuti_id={$id}");

            $cuti = AjukanCutiModel::with('pegawai')->findOrFail($id);
            Log::info("Generate Word: data cuti ditemukan", [
                'nama' => $cuti->pegawai->nama,
                'nip' => $cuti->pegawai->nip
            ]);

            // path template
            $templatePath = storage_path('app/template-cuti.docx');

            if (!file_exists($templatePath)) {
                Log::error("Generate Word: template tidak ditemukan", [
                    'path' => $templatePath
                ]);
                abort(500, "Template tidak ditemukan");
            }

            Log::info("Generate Word: load template", ['path' => $templatePath]);
            $word = new TemplateProcessor($templatePath);


            // isi placeholder
            $word->setValue('nama', $cuti->pegawai->nama);
            $word->setValue('jabatan', $cuti->pegawai->jabatan);
            $word->setValue('unit_kerja', $cuti->pegawai->unit_kerja);
            $word->setValue('nip', $cuti->pegawai->nip);
            $word->setValue('masa_kerja', $cuti->pegawai->masa_kerja);

            $jenisCutis = JenisCutiModel::all();
            $selectedId = $cuti->jenis_cuti_id;
            // clone baris sesuai jumlah record
            $word->cloneRow('jenis_cuti_no', $jenisCutis->count());

            foreach ($jenisCutis as $i => $jc) {
                $idx = $i + 1;

                $word->setValue("jenis_cuti_no#{$idx}", $idx);
                $word->setValue("jenis_cuti_nama#{$idx}", $jc->nama_cuti);

                // centang hanya yang dipilih
                $word->setValue(
                    "jenis_cuti_check#{$idx}",
                    $jc->id == $selectedId ? '✔' : ''
                );
            }

            $word->setValue('alasan_cuti', $cuti->keterangan);
            $word->setValue('hari', $cuti->jumlah_hari);
            $word->setValue('tanggal_mulai', date('d-m-Y', strtotime($cuti->tanggal_awal)));
            $word->setValue('tanggal_selesai', date('d-m-Y', strtotime($cuti->tanggal_akhir)));

            $jatah = JatahCutiModel::where('user_id', $cuti->user_id)
                ->with('jenisCuti')
                ->get();

            $word->cloneRow('cat_no', $jatah->count());

            foreach ($jatah as $i => $j) {
                $idx = $i + 1;

                $nama = $j->jenisCuti->nama_cuti;
                $sisa = $j->sisa_cuti;
                $terpakai = $j->cuti_terpakai;
                $ket = "diambil {$terpakai} hari, sisa {$sisa} hari";

                $word->setValue("cat_no#{$idx}", $idx);
                $word->setValue("cat_nama#{$idx}", $nama);
                $word->setValue("cat_sisa#{$idx}", $sisa);
                $word->setValue("cat_ket#{$idx}", $ket);
            }


            $word->setValue('alamat_cuti', $cuti->pegawai->alamat_cuti ?? '-');
            $word->setValue('telp', $cuti->pegawai->no_telp ?? '-');
            $word->setValue('jenis_cuti_diambil', $cuti->jenisCuti->nama_cuti);

            // path ttd_pemohon dari DB
            $ttdPath = public_path($cuti->ttd_pemohon);

            // cek apakah file ada
            if (file_exists($ttdPath)) {
                $word->setImageValue('ttd_pemohon', array(
                    'path' => $ttdPath,
                    'width' => 150,   // sesuaikan ukuran
                    'height' => 50,
                    'ratio' => true
                ));
            } else {
                Log::warning("TTD pemohon tidak ditemukan untuk user_id={$cuti->user_id}", [
                    'path' => $ttdPath
                ]);
            }


            $atasanLangsungIds = [6, 7, 8, 10, 11, 12];

            $riwayatAtasan = RiwayatCutiModel::where('ajukan_cuti_id', $cuti->id)
                ->whereIn('user_id', $atasanLangsungIds)
                ->orderBy('tanggal', 'desc')
                ->first();
            $setuju = "";
            $tidakSetuju = "";

            if ($riwayatAtasan) {
                if ($riwayatAtasan->acc) {
                    $setuju = "✔";
                } else {
                    $tidakSetuju = "✔";
                }
            }

            $word->setValue('atasan_langsung_setuju', $setuju);
            $word->setValue('atasan_langsung_tidak_setuju', $tidakSetuju);

            $riwayatKetua = RiwayatCutiModel::where('ajukan_cuti_id', $cuti->id)
                ->where('user_id', 1)
                ->orderBy('tanggal', 'desc')
                ->first();
            $ketuaSetuju = "";
            $ketuaTidakSetuju = "";

            if ($riwayatKetua) {
                if ($riwayatKetua->acc) {
                    $ketuaSetuju = "✔";
                } else {
                    $ketuaTidakSetuju = "✔";
                }
            }

            $word->setValue('ketua_setuju', $ketuaSetuju);
            $word->setValue('ketua_tidak_setuju', $ketuaTidakSetuju);

            Log::info("DEBUG Ketua", [
                'riwayatKetua' => $riwayatKetua,
                'ketuaSetuju' => $ketuaSetuju,
                'ketuaTidakSetuju' => $ketuaTidakSetuju,
            ]);


            // tambahan
            $word->setValue('tanggal', date('d F Y'));
            $word->setValue('nomor_surat', $cuti->nomor_surat);

            Log::info("Generate Word: semua placeholder sukses terisi");

            // simpan hasil
            $fileName = 'surat-cuti-' . $id . '.docx';
            $outputPath = storage_path('app/public/' . $fileName);

            $word->saveAs($outputPath);
            Log::info("Generate Word: file berhasil disimpan", [
                'output' => $outputPath
            ]);

            return response()->download($outputPath)->deleteFileAfterSend(true);
        } catch (\Throwable $e) {
            Log::error("Generate Word: error fatal", [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return abort(500, "Gagal menghasilkan dokumen.");
        }
    }
}
