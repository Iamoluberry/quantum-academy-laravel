<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         Permission::create(['name' => 'edit-user-profile']);
         Permission::create(['name' => 'edit-complaints']);
         Permission::create(['name' => 'update-user']);
         Permission::create(['name' => 'delete-user']);
         Permission::create(['name' => 'delete-complaints']);

        $adminRole = Role::where('name', 'admin')->first();

        $adminRole->givePermissionTo(Permission::all());
    }
}
