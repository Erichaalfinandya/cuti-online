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
            $table->date('tanggal');
            // $table->string('user'); // kalau mau bisa diganti user_id -> foreignId ke users
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('role_name');
            $table->foreignId('ajukan_cuti_id')->constrained('ajukan_cutis')->onDelete('cascade');
            $table->boolean('acc');
            $table->string('keterangan')->nullable();
            $table->string('ttd')->nullable();
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
