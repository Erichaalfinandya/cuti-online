<?php

namespace Database\Seeders;

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
            'Ketua Pengadilan Negeri',
            'Wakil Ketua',
            'Hakim',
            'Panitera',
            'Sekretaris',
            'Kasubbag',
            'Panmud',
            'Pegawai',
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(
                [
                    'name' => $role,
                    'guard_name' => 'api' // <-- TAMBAHKAN BARIS INI
                ]
            );
        }
    }
}
