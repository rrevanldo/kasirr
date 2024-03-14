<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            "name" => "Admin",
            "username" => "admin",
            "password" => bcrypt("admin")
        ]);
        User::create([
            "name" => "Revannn",
            "username" => "rrevanldo",
            "password" => bcrypt("rrevanldo")
        ]);

        $adminAccount = User::where("name", "=", "Admin")->first();
        $adminAccount->assignRole("administrator");

        $petugasAccount = User::where("name", "=", "Revannn")->first();
        $petugasAccount->assignRole("petugas");
    }
}
