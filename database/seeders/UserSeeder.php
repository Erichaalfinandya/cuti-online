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
            if ($user->jabatan) {
                $role = Role::where('name', $user->jabatan)->first();
                if ($role) {
                    $user->syncRoles([$role->name]);
                }
            }
        }
    }
}
