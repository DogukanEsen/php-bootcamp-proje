<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            "username" => "admin",
            'password' => Hash::make("12345"),
            "email" => "admin@admin.com",
            "profile_photo_path" => null,
            "is_admin" => true,
        ]);

        User::create([
            'name' => 'Normal User',
            'email' => 'user@user.com',
            'password' => Hash::make('12345'),
            'is_admin' => false
        ]);
    }
}
