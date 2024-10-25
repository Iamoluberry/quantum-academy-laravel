<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            "id" => Str::uuid()->toString(),
            "first_name"=> "Lanre",
            "other_name"=> "Seun",
            "last_name"=> "Akilu",
            "date_of_birth"=> "07-10-2024",
            "country"=> "Nigeria",
            "state_of_origin"=> "Ogun",
            "gender"=> "Male",
            "mode_of_learning"=> "Online",
            "course"=> "Microbiology",
            "email"=> "lanre@gmail.com",
            "password"=> Hash::make('password'),
        ]);

        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
        ]);
    }
}
