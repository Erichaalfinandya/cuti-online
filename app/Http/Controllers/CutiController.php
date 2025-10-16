<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use App\Models\JenisCutiModel;
use App\Models\AjukanCutiModel;
use App\Models\JatahCutiModel;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

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

    public function getJenisCuti()
    {
        $data = JenisCutiModel::all();
        return response()->json(['data' => $data]);
    }

    // public function tambah_jenis_cuti(Request $request)
    // {
    //     $request->validate([
    //         'nama_cuti' => 'required|string|max:50',
    //         'jumlah_hari' => 'required|integer',
    //         'keterangan' => 'nullable|string|max:255',
    //     ]);

    //     $data = JenisCutiModel::create($request->all());

    //     return response()->json([
    //         'status' => 'success',
    //         'message' => 'Jenis cuti berhasil ditambahkan!',
    //         'data' => $data
    //     ]);
    // }

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

    public function tambah_ajukan_cuti(Request $request)
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


        $data = AjukanCutiModel::create($request->all());

        // dd($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Pengajuan cuti berhasil ditambahkan!',
            'data' => $data
        ]);
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

    //JATAH CUTI

    public function getJatahCuti()
    {
        $data = JatahCutiModel::all();
        return response()->json(['data' => $data]);
    }
}
