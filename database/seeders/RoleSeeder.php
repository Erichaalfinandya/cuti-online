<?php

namespace Database\Seeders;

use App\Models\UserModel;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Daftar peran yang akan dibuat
        $roles = [
           'ketua',
           'hakim',
           'panitera',
           'sekretaris',
           'panmud',
           'panmud_1',
           'panmud_2',
           'panmud_3',
           'kasubbag',
           'kasubbag_1',
           'kasubbag_2',
           'kasubbag_3',
           'staf_panitera_3',
           'staf_panitera_1',
           'staf_panitera_2',
           'staf_sekretaris_1',
           'staf_sekretaris_2',
           'staf_sekretaris_3',
           'kepegawaian'
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(
                [
                    'name' => $role,
                    'guard_name' => 'api' // <-- TAMBAHKAN BARIS INI
                ]
            );
        }
          // Assign role kepegawaian ke user tertentu tanpa menghapus role lama
        $user = UserModel::where('nip', '197005031998031005')->first();
        if ($user) {
            $user->assignRole('kepegawaian'); // menambahkan role baru
            echo "Role 'kepegawaian' berhasil ditambahkan ke user {$user->nip}.\n";

            // Optional: tampilkan semua role user sekarang
            echo "User sekarang memiliki role: " . $user->getRoleNames()->join(', ') . "\n";
        } else {
            echo "User dengan NIP 197005031998031005 tidak ditemukan.\n";
        }
    }
}
