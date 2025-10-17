<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use App\Models\JenisCutiModel;
use App\Models\AjukanCutiModel;
use App\Models\JatahCutiModel;
use App\Models\RiwayatCuti;
use App\Models\RiwayatCutiModel;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class CutiController extends Controller
{
    public function detail_jatah_cuti($id)
    {
        return view('detail_jatah_cuti', ['id' => $id]);
    }

    public function detail_pengajuan_cuti($id)
    {
        // cukup kirim id ke view, JS pada view akan fetch data via AJAX
        return view('detail_pengajuan_cuti', ['id' => $id]);
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

    public function getAjukanCuti()
    {
        // $data = AjukanCutiModel::all();
        $cutis = AjukanCutiModel::with('user', 'jenisCuti')->get();
        return response()->json(['data' => $cutis]);
    }

    public function getUser()
    {
        $data = UserModel::all();
        return response()->json(['data' => $data]);
    }

    public function getPengajuanCutiById($id)
    {
        // $data = AjukanCutiModel::find($id);
        $data = AjukanCutiModel::with([
            'user:id,nama',
            'jenisCuti:id,nama_cuti'
        ])->find($id);

        if ($data) {
            return response()->json(['data' => $data]);
        } else {
            return response()->json(['message' => 'Jenis cuti tidak ditemukan'], 404);
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

        if ($jatahCuti->isEmpty()) {
            return response()->json(['message' => 'Data jatah cuti tidak ditemukan'], 404);
        }

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
            'keterangan' => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();

        try {
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

            // Cek apakah sisa cuti cukup
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
        ]);

        $data = [
            'tanggal' => now(), // waktu saat ini
            'user' => auth()->user()->nama, // user login
            'ajukan_cuti_id' => $validated['ajukan_cuti_id'],
            'acc' => $validated['acc'],
            'keterangan' => $validated['keterangan'] ?? null,
        ];

        // Simpan ke tabel riwayat cuti
        $riwayat = RiwayatCutiModel::create($data);

        // Update status ajukan cuti menjadi 2
        AjukanCutiModel::where('id', $validated['ajukan_cuti_id'])
            ->update(['status' => 2]);

        return response()->json([
            'status' => 'success',
            'message' => 'Aksi kepegawaian berhasil disimpan dan status cuti diperbarui!',
            'data' => $riwayat
        ]);
    }
}
