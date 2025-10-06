<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\UserModel; // Pastikan ini adalah path yang benar ke model User Anda
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Definisikan semua data pegawai dalam sebuah array
        $pegawaiData = [
            // Urutan ini SANGAT PENTING untuk menentukan ID (1, 2, 3, dst.)
            ['nip' => '198202102007042002', 'nama' => 'YUKLAYUSHI, S.H., M.H.', 'jabatan' => 'Hakim Pengadilan Negeri Pamekasan', 'golongan' => 'IV/a'],
            ['nip' => '198409242007041001', 'nama' => 'ACHMAD YANI TAMHER, S.H.', 'jabatan' => 'Hakim Pengadilan Negeri Pamekasan', 'golongan' => 'IV/a'],
            ['nip' => '196803101988031003', 'nama' => 'ABDUL KADIR DJAILANI, S.H.', 'jabatan' => 'Panitera Pengadilan Negeri Pamekasan', 'golongan' => 'IV/a'],
            ['nip' => '196908141994031001', 'nama' => 'AGUS PRIYANTO, S.H.', 'jabatan' => 'Sekretaris Pengadilan Negeri Pamekasan', 'golongan' => 'IV/a'],
            ['nip' => '197003231993031006', 'nama' => 'ABDUR RAHMAN, S.H.', 'jabatan' => 'Panitera Muda Pidana', 'golongan' => 'III/d'],
            ['nip' => '196706301990031002', 'nama' => 'MOHAMMAD EFFENDY ADRIANSJAH, S.H., M.H.', 'jabatan' => 'Panitera Muda Hukum', 'golongan' => 'III/d'],
            ['nip' => '197004011993031006', 'nama' => 'ACHMAD TRIJANTO EFFENDI, S.H.', 'jabatan' => 'Kepala Subbagian', 'golongan' => 'III/d'],
            ['nip' => '197005031998031005', 'nama' => 'ABDUL AZIS, S.H.', 'jabatan' => 'Kepala Subbagian', 'golongan' => 'III/d'],
            ['nip' => '197212252000121010', 'nama' => 'BUDI HARYONO, S.H.', 'jabatan' => 'Kepala Subbagian', 'golongan' => 'III/d'],
            ['nip' => '197208081993031004', 'nama' => 'AGUS HEKSA PRASETIJA, S.H.', 'jabatan' => 'Panitera Muda Perdata', 'golongan' => 'III/c'],
            ['nip' => '196708211993031004', 'nama' => 'KHAIRUL WAFI, S.H.', 'jabatan' => 'Panitera Pengganti', 'golongan' => 'III/d'],
            ['nip' => '196906171993031005', 'nama' => 'MOHAMMAD HARIYANTO, S.H.', 'jabatan' => 'Panitera Pengganti', 'golongan' => 'III/d'],
            ['nip' => '196706201993031006', 'nama' => 'SLAMET RIADI, S.H.', 'jabatan' => 'Panitera Pengganti', 'golongan' => 'III/d'],
            ['nip' => '196806011989032002', 'nama' => 'YATI SILAWARDANI, S.H.', 'jabatan' => 'Panitera Pengganti', 'golongan' => 'III/d'],
            ['nip' => '197001261993031002', 'nama' => 'EDI HARIS MULYONO, S.H.', 'jabatan' => 'Panitera Pengganti', 'golongan' => 'III/d'],
            ['nip' => '197010181993031005', 'nama' => 'IBNU RUSDI FAUZI, S.H.', 'jabatan' => 'Juru Sita', 'golongan' => 'III/d'],
            ['nip' => '199511172020121004', 'nama' => 'GANDHI SATRIA DHARMA, S.H.', 'jabatan' => 'Klerek - Analis Perkara Peradilan', 'golongan' => 'III/b'],
            ['nip' => '197208171993031004', 'nama' => 'AGUS ZAINI, -', 'jabatan' => 'Juru Sita', 'golongan' => 'III/b'],
            ['nip' => '199512122024052001', 'nama' => 'NOVITA SARI, S.H.', 'jabatan' => 'Klerek - Analis Perkara Peradilan', 'golongan' => 'III/a'],
            ['nip' => '200003202024052001', 'nama' => 'NOVIA INDI SUHASTI, S.H.', 'jabatan' => 'Klerek - Analis Perkara Peradilan', 'golongan' => 'III/a'],
            ['nip' => '199609022022031005', 'nama' => 'SATRIO DEWANTARA, S.E.', 'jabatan' => 'Klerek - Penelaah Teknis Kebijakan', 'golongan' => 'III/a'],
            ['nip' => '199604082025062011', 'nama' => 'SARA AYU TIVANI, S.T.', 'jabatan' => 'Teknisi Sarana dan Prasarana', 'golongan' => 'III/a'],
            ['nip' => '199306052020121004', 'nama' => 'PRADITYA PURNIKA CHANDRA, A.Md.', 'jabatan' => 'Klerek - Pengolah Data', 'golongan' => 'II/d'],
            ['nip' => '199512092022031009', 'nama' => 'DAS AMARNA SEMBIRING, A.Md', 'jabatan' => 'Klerek - Pengelola Penanganan Perkara', 'golongan' => 'II/c'],
            ['nip' => '198305112025212036', 'nama' => 'SARASSTRIA DEWI, S.E.', 'jabatan' => 'Operator', 'golongan' => 'IX'],
            ['nip' => '198701082025211035', 'nama' => 'HENDRA SISWANDI, S.H.', 'jabatan' => 'Operator', 'golongan' => 'IX'],
            ['nip' => '199309092025212066', 'nama' => 'WALIDIAH FITRIYANI, S.Kom.', 'jabatan' => 'Operator', 'golongan' => 'IX'],
            ['nip' => '199608012025211023', 'nama' => 'AKHMAD SHULTHON FATHONI, S.Kom.', 'jabatan' => 'Operator', 'golongan' => 'IX'],
            ['nip' => '198107032025211030', 'nama' => 'HENDRA PERMANA, ST.', 'jabatan' => 'Operator', 'golongan' => 'IX'],
            ['nip' => '198005162025211024', 'nama' => 'MOHAMMAD HAIRIL ANAM, S.H.', 'jabatan' => 'Operator', 'golongan' => 'IX'],
            ['nip' => '198706302025211023', 'nama' => 'TAUFIQURRAHMAN, S.H.', 'jabatan' => 'Operator', 'golongan' => 'IX'],
            ['nip' => '199402182025211035', 'nama' => 'A NURUDDIN', 'jabatan' => 'Operator', 'golongan' => 'V'],
            ['nip' => '199206262025211058', 'nama' => 'MOH. YUDHY ARDIYANSAH', 'jabatan' => 'Operator', 'golongan' => 'V'],
            ['nip' => '198111242025211020', 'nama' => 'RUSFANTO', 'jabatan' => 'Operator', 'golongan' => 'V'],
            ['nip' => '197408172025211037', 'nama' => 'ABD. RA\'UB', 'jabatan' => 'Operator', 'golongan' => 'V'],
            ['nip' => '197407012000122002', 'nama' => 'NURAINI, S.H.', 'jabatan' => 'Juru Sita Pengganti', 'golongan' => 'III/d'],
            ['nip' => '196907181991031001', 'nama' => 'KUSAIRI, S.H.', 'jabatan' => 'Juru Sita Pengganti', 'golongan' => 'III/d'],
            ['nip' => '196909121991031012', 'nama' => 'BADRUTTAMAM, S.H.', 'jabatan' => 'Juru Sita Pengganti', 'golongan' => 'III/d'],
            ['nip' => '197111191993031001', 'nama' => 'WAHYUDI, S.H.', 'jabatan' => 'Juru Sita Pengganti', 'golongan' => 'III/d'],
            ['nip' => '197204122000031005', 'nama' => 'KUSMIANTO, S.H.', 'jabatan' => 'Juru Sita Pengganti', 'golongan' => 'III/d'],
            ['nip' => '197606211997031002', 'nama' => 'HAIRIL HIDAYAT, S.H.', 'jabatan' => 'Juru Sita Pengganti', 'golongan' => 'III/d'],
            ['nip' => '196805311993031006', 'nama' => 'JUFRIADI', 'jabatan' => 'Juru Sita Pengganti', 'golongan' => 'III/b'],
            ['nip' => '196806251993031005', 'nama' => 'MUAJI', 'jabatan' => 'Juru Sita Pengganti', 'golongan' => 'III/b'],
            ['nip' => '197001071993031003', 'nama' => 'KUSNANDAR', 'jabatan' => 'Juru Sita Pengganti', 'golongan' => 'III/b'],
            ['nip' => '197403051993031002', 'nama' => 'EDIYANTO', 'jabatan' => 'Juru Sita Pengganti', 'golongan' => 'III/b'],
            ['nip' => '197412011993032001', 'nama' => 'SITI ARIS SYARKIYAH', 'jabatan' => 'Juru Sita Pengganti', 'golongan' => 'III/b'],
        ];

        // 2. Loop untuk membuat user satu per satu dan langsung assign role
        foreach ($pegawaiData as $data) {
            // Gunakan `create` agar kita mendapatkan objek user yang baru dibuat, termasuk ID-nya
            $user = UserModel::create([
                'nip'       => $data['nip'],
                'nama'      => $data['nama'],
                'jabatan'   => $data['jabatan'],
                'golongan'  => $data['golongan'],
                'password'  => Hash::make('12345678'), // Password default untuk semua
            ]);

            // 3. Logika penetapan peran berdasarkan ID pengguna yang baru dibuat
            $userId = $user->id;

            // Definisikan ID untuk peran panitera
            $paniteraIds = [3, 5, 6, 10, 11, 12, 13, 14, 15];

            if (in_array($userId, [1, 2])) {
                // Beri peran 'hakim' (Role ID 2)
                $user->assignRole('hakim');
            } elseif (in_array($userId, $paniteraIds)) {
                // Beri peran 'panitera' (Role ID 3)
                $user->assignRole('panitera');
            } elseif ($userId == 4) {
                // Beri peran 'sekretaris' (Role ID 4)
                $user->assignRole('sekretaris');
            } else {
                // Semua pengguna lain diberi peran 'pegawai' (Role ID 1)
                $user->assignRole('pegawai');
            }
        }
    }
}
