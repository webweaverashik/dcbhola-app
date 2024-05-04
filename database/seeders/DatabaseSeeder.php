<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Section;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
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


        Section::create(['name' => 'আইসিটি শাখা']);
        Section::create(['name' => 'গোপনীয় শাখা']);
        Section::create(['name' => 'জুডিশিয়াল মুন্সিখানা শাখা']);
        Section::create(['name' => 'ট্রেজারি শাখা']);
        Section::create(['name' => 'তথ্য ও অভিযোগ শাখা']);
        Section::create(['name' => 'নেজারত শাখা']);
        Section::create(['name' => 'ভূমি অধিগ্রহণ শাখা']);
        Section::create(['name' => 'রাজস্ব শাখা']);
        Section::create(['name' => 'রেকর্ডরুম শাখা']);
        Section::create(['name' => 'শিক্ষা ও কল্যাণ শাখা']);
        Section::create(['name' => 'সাধারণ শাখা']);
        Section::create(['name' => 'সংস্থাপন শাখা']);
        Section::create(['name' => 'বিচার শাখা']);
        Section::create(['name' => 'স্থানীয় সরকার শাখা']);
        Section::create(['name' => 'সাধারণ সার্টিফিকেট শাখা']);
        Section::create(['name' => 'ত্রাণ শাখা']);
        Section::create(['name' => 'আরএম শাখা']);
        Section::create(['name' => 'এলএ শাখা']);
    }
}
