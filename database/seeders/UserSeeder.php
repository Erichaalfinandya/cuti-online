<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\UserModel; // Pastikan ini adalah path yang benar ke model User Anda

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
  public function run(): void
{
    $users = UserModel::all();

    foreach ($users as $user) {
        if ($user->golongan) {
            $normalized = strtolower(str_replace(' ', '_', trim($user->golongan)));
            $role = Role::where('name', $normalized)->first();

            if ($role) {
                $user->syncRoles([$role->name]);
                echo "✅ Assigned {$role->name} to {$user->nama}\n";
            } else {
                echo "⚠️ Role {$normalized} tidak ditemukan untuk user {$user->nama}\n";
            }
        }
    }
}
}
