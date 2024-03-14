<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(attributes: [
            'email' => "annaspratama@outlook.com"
        ], values: [
            'first_name' => "Annas",
            'last_name' => "Pratama",
            'email' => "annaspratama@outlook.com",
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make(value: "Admin12&3")
        ]);

        User::updateOrCreate(attributes: [
            'email' => "ahmad-dhani@mail.com"
        ], values: [
            'first_name' => "Ahmad",
            'last_name' => "Dhani",
            'email' => "ahmad-dhani@mail.com",
            'password' => Hash::make(value: "Admin12&3")
        ]);
    }
}
