<?php

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\DashboardController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

//mengarah ke jatahcuti
Route::get('/jatah-cuti', function () {
    return view('jatah_cuti');
})->name('jatah.cuti');

//mengarah ke halaman riwayat cuti
Route::get('/riwayat-cuti', function () {
    return view('riwayat_cuti');
})->name('riwayat.cuti');

//formulir pengajuan cuti
Route::get('/formulir-cuti', function () {
    return view('jatah-cuti.formulir');
})->name('formulir.cuti');

Route::get('/jatah-cuti', [CutiController::class, 'index'])->name('jatah-cuti');
Route::post('/jatah-cuti/store', [CutiController::class, 'store'])->name('cuti.store'); //tambah data

Route::post('/tambah_jenis_cuti', [CutiController::class, 'tambah_jenis_cuti'])->name('tambah_jenis_cuti'); //tambah jenis cuti
Route::post('/edit_jenis_cuti', [CutiController::class, 'edit_jenis_cuti'])->name('edit_jenis_cuti'); //tambah jenis cuti
Route::post('/delete_jenis_cuti/{id}', [CutiController::class, 'delete_jenis_cuti'])->name('delete_jenis_cuti');

Route::post('/tambah_ajukan_cuti', [CutiController::class, 'tambah_ajukan_cuti'])->name('tambah_ajukan_cuti'); //tambah jenis cuti
Route::post('/edit_ajukan_cuti', [CutiController::class, 'edit_ajukan_cuti'])->name('edit_ajukan_cuti'); //tambah jenis cuti
Route::post('/delete_ajukan_cuti/{id}', [CutiController::class, 'delete_ajukan_cuti'])->name('delete_ajukan_cuti');
