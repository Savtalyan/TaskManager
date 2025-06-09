<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            "name" => "admin",
            "email" => "admin@gmail.com",
            "password" => bcrypt("adminadmin"),
        ]);

        $user = User::create([
            "name" => "user",
            "email" => "user@gmail.com",
            "password" => bcrypt("useruser"),
        ]);
        $admin->assignRole('admin');
        $user->assignRole('user');
    }
}
