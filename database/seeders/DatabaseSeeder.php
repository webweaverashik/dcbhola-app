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
            'phone' => '০১৭১৫২১১৮৯৯',
            'password' => bcrypt('12345678'),
            'designation' => 'জেলা প্রশাসক',
            'role' => 1,
            'photo_url' => NULL,
        ]);

        User::create([
            'name' => 'তামিম আল ইয়ামীন',
            'email' => 'tamim.al.yiameen@gmail.com',
            'phone' => '০১৩১৮২৫৯১১৩',
            'password' => bcrypt('12345678'),
            'designation' => 'অতিরিক্ত জেলা প্রশাসক (রাজস্ব)',
            'role' => 2,
            'photo_url' => NULL,
        ]);
        
        User::create([
            'name' => 'আবুল আলা',
            'email' => 'abulala@gmail.com',
            'phone' => '০১৭২৭০৩৮২৬৮',
            'password' => bcrypt('12345678'),
            'designation' => 'উপ-সহকারী প্রশাসনিক কর্মকর্তা',
            'role' => 3,
            'photo_url' => NULL,
        ]);

        User::create([
            'name' => 'মো. আলমগীর হোসেন',
            'email' => 'mahussain07@gmail.com',
            'phone' => '০১৯২৩০৫১৯০৭',
            'password' => bcrypt('12345678'),
            'designation' => 'অতিরিক্ত জেলা ম্যাজিস্ট্রেট',
            'role' => 2,
            'photo_url' => NULL,
        ]);
        
        User::create([
            'name' => 'মোঃ নূর নবী',
            'email' => 'nabinur2001@gmail.com',
            'phone' => '০১৭১৫৩৮০১০১',
            'password' => bcrypt('12345678'),
            'designation' => 'অফিস সহকারী কাম-কম্পিউটার মুদ্রাক্ষরিক',
            'role' => 3,
            'photo_url' => NULL,
        ]);
        
        User::create([
            'name' => 'ফ্রন্ট ডেস্ক',
            'email' => 'ashikgsc170@gmail.com',
            'phone' => '০১৯২০৮৬৯৮০৯',
            'password' => bcrypt('12345678'),
            'designation' => 'ডাটা আপলোডার',
            'role' => 4,
            'photo_url' => NULL,
        ]);


        Section::create(['name' => 'রাজস্ব শাখা', 'officer_id' => 2, 'staff_id' => 3]);
        Section::create(['name' => 'আইসিটি শাখা', 'officer_id' => 4, 'staff_id' => 5]);
        Section::create(['name' => 'সাধারণ শাখা']);
        Section::create(['name' => 'গোপনীয় শাখা']);
        Section::create(['name' => 'জুডিশিয়াল মুন্সিখানা শাখা']);
        Section::create(['name' => 'ট্রেজারি শাখা']);
        Section::create(['name' => 'তথ্য ও অভিযোগ শাখা']);
        Section::create(['name' => 'নেজারত শাখা']);
        Section::create(['name' => 'ভূমি অধিগ্রহণ শাখা']);
        Section::create(['name' => 'রেকর্ডরুম শাখা']);
        Section::create(['name' => 'শিক্ষা ও কল্যাণ শাখা']);
        Section::create(['name' => 'সংস্থাপন শাখা']);
        Section::create(['name' => 'বিচার শাখা']);
        Section::create(['name' => 'স্থানীয় সরকার শাখা']);
        Section::create(['name' => 'সাধারণ সার্টিফিকেট শাখা']);
        Section::create(['name' => 'ত্রাণ শাখা']);
        Section::create(['name' => 'আরএম শাখা']);
        Section::create(['name' => 'এলএ শাখা']);
    }
}
