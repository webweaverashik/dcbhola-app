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
            'name' => 'আরিফুজ্জামান',
            'email' => 'dcbhola@mopa.gov.bd',
            'phone' => '01920869809',
            'password' => bcrypt('123456'),
            'designation' => 'জেলা প্রশাসক',
            'role' => 1,
            'photo_url' => NULL,
        ]);
    }
}
