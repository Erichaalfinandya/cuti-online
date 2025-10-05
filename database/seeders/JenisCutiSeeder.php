<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JenisCutiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jenis_cutis')->insert([
            [
                'nama_cuti' => 'Cuti karena alasan penting (1 bulan)',
                'jumlah_hari' => 30,
                'keterangan' => 'Cuti diberikan karena alasan penting, maksimal 1 bulan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_cuti' => 'Cuti tahunan',
                'jumlah_hari' => 12,
                'keterangan' => 'Cuti tahunan diberikan selama 12 hari kerja setiap tahun',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_cuti' => 'Cuti sakit',
                'jumlah_hari' => 0,
                'keterangan' => 'Durasi cuti mengikuti ketentuan medis dan peraturan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_cuti' => 'Cuti karena alasan penting',
                'jumlah_hari' => 0,
                'keterangan' => 'Cuti diberikan untuk alasan penting, sesuai kebijakan instansi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_cuti' => 'Cuti melahirkan (3 bulan)',
                'jumlah_hari' => 90,
                'keterangan' => 'Cuti diberikan selama 3 bulan untuk keperluan melahirkan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
