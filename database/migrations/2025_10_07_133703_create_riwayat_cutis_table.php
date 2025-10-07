<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('riwayat_cutis', function (Blueprint $table) {
            $table->id();
            $table->string('user');
            $table->date('tanggal');
            $table->string('posisi');
            $table->string('nama_pegawai');
            $table->string('jenis_cuti');
            $table->date('tanggal_awal');
            $table->date('tanggal_akhir');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_cutis');
    }
};