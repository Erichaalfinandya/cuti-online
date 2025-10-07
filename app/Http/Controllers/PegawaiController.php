<?php

namespace App\Http\Controllers;
use App\Models\Pegawai;

use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index()
    {
        $dataPegawai = Pegawai::all();
        return view('data-pegawai', compact('dataPegawai'));
    }
}