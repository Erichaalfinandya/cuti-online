<?php

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\RiwayatCutiController;
use Symfony\Component\CssSelector\Node\FunctionNode;
use Symfony\Component\HttpKernel\Event\ViewEvent;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

route::get('/', [AuthController::class, 'index'])->name('login.index');
route::post('/', [AuthController::class, 'login'])->name('login.post');
route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    });
    Route::get('/formulir', function () {
        return view('formulir');
    })->name('formulir');

    //mengarah ke jatah cuti
    Route::get('/jatah-cuti', function () {
        $jatahCuti = [
            (object)[
                'jenis_cuti' => 'Cuti Tahunan',
                'total_cuti' => 12,
                'cuti_terpakai' => 4,
                'sisa_cuti' => 8,
            ],
            (object)[
                'jenis_cuti' => 'Cuti Besar',
                'total_cuti' => 6,
                'cuti_terpakai' => 2,
                'sisa_cuti' => 4,
            ],
        ];
        return view('jatah-cuti.jatah-cuti', compact('jatahCuti'));
    })->name('jatah-cuti');

    //mengarah ke riwayat cuti
    Route::get('/riwayat-cuti', function () {
        $riwayatCuti = [
            (object)[
                'user' => 'admin',
                'tanggal' => '2025-10-01',
                'posisi' => 'Sedang diverifikasi kepegawaian',
                'nama_pegawai' => 'Ericha Alfinandya',
                'jenis_cuti' => 'Cuti Tahunan',
                'tanggal_awal' => '2025-10-05',
                'tanggal_akhir' => '2025-10-10',
                'status' => 'Menunggu',
            ],
            (object)[
                'user' => 'pegawai1',
                'tanggal' => '2025-09-25',
                'posisi' => 'Sudah disetujui atasan langsung',
                'nama_pegawai' => 'Rian Saputra',
                'jenis_cuti' => 'Cuti Sakit',
                'tanggal_awal' => '2025-09-27',
                'tanggal_akhir' => '2025-09-30',
                'status' => 'Disetujui',
            ],
        ];
        return view('riwayat-cuti', compact('riwayatCuti'));
    })->name('riwayat-cuti');

    Route::get('/riwayat-cuti', [RiwayatCutiController::class, 'index'])->name('riwayat-cuti.index');
    Route::get('/riwayat-cuti/{id}', [RiwayatCutiController::class, 'show'])->name('riwayat-cuti.show');

    Route::get('/getJenisCuti', [CutiController::class, 'getJenisCuti'])->name('getJenisCuti');
    Route::get('/getJenisCutiById/{id}', [CutiController::class, 'getJenisCutiById'])->name('getJenisCutiById');

    Route::post('/tambah_jenis_cuti', [CutiController::class, 'tambah_jenis_cuti'])->name('tambah_jenis_cuti'); //tambah jenis cuti
    Route::post('/edit_jenis_cuti/{id}', [CutiController::class, 'edit_jenis_cuti'])->name('edit_jenis_cuti');
    Route::post('/delete_jenis_cuti/{id}', [CutiController::class, 'delete_jenis_cuti'])->name('delete_jenis_cuti');

    Route::post('/tambah_ajukan_cuti', [CutiController::class, 'tambah_ajukan_cuti'])->name('tambah_ajukan_cuti'); //tambah jenis cuti
    Route::post('/edit_ajukan_cuti', [CutiController::class, 'edit_ajukan_cuti'])->name('edit_ajukan_cuti'); //tambah jenis cuti
    Route::post('/delete_ajukan_cuti/{id}', [CutiController::class, 'delete_ajukan_cuti'])->name('delete_ajukan_cuti');

    //mengarah ke halaman data pegawai
    Route::get('/data-pegawai', function () {
        // Data dummy sementara biar tampilan FE bisa jalan
        $dataPegawai = [
            [
                'nama_pegawai' => 'Ericha Alfinandya',
                'nip_pegawai' => '123456789',
                'jabatan_pegawai' => 'Staff HRD',
                'role' => 'Admin',
            ],
            [
                'nama_pegawai' => 'Andi Setiawan',
                'nip_pegawai' => '987654321',
                'jabatan_pegawai' => 'Kepala Divisi',
                'role' => 'Pegawai',
            ],
            [
                'nama_pegawai' => 'Siti Lestari',
                'nip_pegawai' => '654321987',
                'jabatan_pegawai' => 'Finance',
                'role' => 'Pegawai',
            ],
        ];

        // kirim data ke view
        return view('data-pegawai', compact('dataPegawai'));
    })->name('data.pegawai');

    //mengarah ke halaman master janis cuti
    Route::get('/master-jeniscuti', function () {
        return view('master-jeniscuti');
    })->name('master.jeniscuti');
});
