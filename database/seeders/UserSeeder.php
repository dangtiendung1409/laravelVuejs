<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("users")->insert([
            "username" => "admin",
             "name" => "Admin",
             "email" => "admin@gmail.com",
             "password" => Hash::make("admin123"),
            "department_id" => "1",
            "status_id" => "1"

        ]);
    }
}
