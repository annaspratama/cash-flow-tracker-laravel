<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create(attributes: [
            'first_name' => "Annas",
            'last_name' => "Pratama",
            'email' => "annaspratama@icloud.com",
            'password' => Hash::make(value: "Admin12&3")
        ]);

        User::create(attributes: [
            'first_name' => "Derek",
            'email' => "ahmad-dhani@mail.com",
            'password' => Hash::make(value: "admin123")
        ]);
    }
}
