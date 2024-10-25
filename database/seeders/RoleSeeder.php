<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminUser = User::where('email', 'lanre@gmail.com')->first();

        Role::create(['name' => 'admin']);
        Role::create(['name' => 'student']);

        $adminUser->assignRole('admin');
    }
}
