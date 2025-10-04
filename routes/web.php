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