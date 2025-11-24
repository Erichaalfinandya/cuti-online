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

    //MASTER JENIS CUTI
    Route::get('/master_jenis_cuti', [CutiController::class, 'master_jenis_cuti'])->name('master_jenis_cuti');
    Route::get('/getJenisCuti', [CutiController::class, 'getJenisCuti'])->name('getJenisCuti');
    Route::get('/getJenisCutiById/{id}', [CutiController::class, 'getJenisCutiById'])->name('getJenisCutiById');

    Route::post('/tambah_jenis_cuti', [CutiController::class, 'tambah_jenis_cuti'])->name('tambah_jenis_cuti'); //tambah jenis cuti
    Route::post('/edit_jenis_cuti/{id}', [CutiController::class, 'edit_jenis_cuti'])->name('edit_jenis_cuti');
    Route::post('/delete_jenis_cuti/{id}', [CutiController::class, 'delete_jenis_cuti'])->name('delete_jenis_cuti');


    //AJUKAN CUTI
    Route::get('/formulir', [CutiController::class, 'formulir'])->name('formulir');
    Route::get('/getAjukanCuti', [CutiController::class, 'getAjukanCuti'])->name('getAjukanCuti');
    Route::get('/list_ajukan_cuti', [CutiController::class, 'list_ajukan_cuti'])->name('list_ajukan_cuti');

    Route::post('/tambah_ajukan_cuti', [CutiController::class, 'tambah_ajukan_cuti'])->name('tambah_ajukan_cuti'); //tambah jenis cuti
    Route::post('/edit_ajukan_cuti', [CutiController::class, 'edit_ajukan_cuti'])->name('edit_ajukan_cuti'); //tambah jenis cuti
    Route::post('/delete_ajukan_cuti/{id}', [CutiController::class, 'delete_ajukan_cuti'])->name('delete_ajukan_cuti');

    //JATAH CUTI
    Route::get('/getJatahCutiById/{id}', [CutiController::class, 'getJatahCutiById'])->name('getJatahCutiById');
    Route::get('/getUser', [CutiController::class, 'getUser'])->name('getUser');
    Route::get('/getJatahCuti', [CutiController::class, 'getJatahCuti'])->name('getJatahCuti');
    Route::get('/jatah_cuti', [CutiController::class, 'jatah_cuti'])->name('jatah_cuti');


    //AKSI KEPEGAWAIAN
    Route::get('/detail_pengajuan_cuti/{id}', [CutiController::class, 'detail_pengajuan_cuti'])->name('detail_pengajuan_cuti');
    Route::get('/getPengajuanCutiById/{id}', [CutiController::class, 'getPengajuanCutiById'])->name('getPengajuanCutiById');
    route::post('/aksi_kepegawaian', [CutiController::class, 'aksi_kepegawaian'])->name('aksi_kepegawaian');
    Route::get('/cuti/generate-word/{id}', [CutiController::class, 'generate_word'])->name('cuti.generate-word');

    //TRACKING CUTI
    Route::get('/tracking', function () {
        return view('tracking');
    })->name('tracking');

});
