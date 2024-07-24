<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Section;
use App\Models\User;
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
            'photo_url' => null,
        ]);

        User::create([
            'name' => 'তামিম আল ইয়ামীন',
            'email' => 'tamim.al.yiameen@gmail.com',
            'phone' => '০১৩১৮২৫৯১১৩',
            'password' => bcrypt('12345678'),
            'designation' => 'অতিরিক্ত জেলা প্রশাসক (রাজস্ব)',
            'role' => 2,
            'photo_url' => null,
        ]);

        User::create([
            'name' => 'মো. আলমগীর হুসাইন',
            'email' => 'mahussain07@gmail.com',
            'phone' => '০১৯২৩০৫১৯০৭',
            'password' => bcrypt('12345678'),
            'designation' => 'অতিরিক্ত জেলা ম্যাজিস্ট্রেট',
            'role' => 2,
            'photo_url' => null,
        ]);

        User::create([
            'name' => 'মোহাম্মদ কায়সার খসরু',
            'email' => 'kaiserkhasroo@yahoo.com',
            'phone' => '০১৭১৯০০৬০৫০',
            'password' => bcrypt('12345678'),
            'designation' => 'অতিরিক্ত জেলা প্রশাসক (সার্বিক)',
            'role' => 2,
            'photo_url' => null,
        ]);

        User::create([
            'name' => 'নাদির শাহ',
            'email' => 'econadim@gmail.com',
            'phone' => '০১৬৭৬৪০৭১৩৯',
            'password' => bcrypt('12345678'),
            'designation' => 'সিনিয়র সহকারী কমিশনার (রেভিনিউ ডেপুটি কালেক্টর)',
            'role' => 3,
            'photo_url' => null,
        ]);

        User::create([
            'name' => 'যায়েদ হোছাইন',
            'email' => 'zaid.padu@gmail.com',
            'phone' => '০১৬৭৬৪০৭১৩৯',
            'password' => bcrypt('12345678'),
            'designation' => 'সহকারী কমিশনার',
            'role' => 3,
            'photo_url' => null,
        ]);

        User::create([
            'name' => 'রহমত উল্যাহ',
            'email' => 'rahamat1110142@gmail.com',
            'phone' => '০১৮৭৫২১৬৮৭৮',
            'password' => bcrypt('12345678'),
            'designation' => 'সহকারী কমিশনার',
            'role' => 3,
            'photo_url' => null,
        ]);

        User::create([
            'name' => 'সামছুজ্জামান',
            'email' => 'sumsuzzamansobuz@gmail.com',
            'phone' => '০১৭৮৬৫৮৬১০১',
            'password' => bcrypt('12345678'),
            'designation' => 'সহকারী কমিশনার',
            'role' => 3,
            'photo_url' => null,
        ]);

        User::create([
            'name' => 'সাইফুল ইসলাম ভূঞা',
            'email' => 'saiful40ac@gmail.com',
            'phone' => '০১৮৪১৭০৭৪৪৫',
            'password' => bcrypt('12345678'),
            'designation' => 'সহকারী কমিশনার',
            'role' => 3,
            'photo_url' => null,
        ]);

        User::create([
            'name' => 'মোহাম্মদ জিয়াউল হক',
            'email' => 'zeaul40ac@gmail.com',
            'phone' => '০১৭১৬৩৯৫৯৪১',
            'password' => bcrypt('12345678'),
            'designation' => 'সহকারী কমিশনার',
            'role' => 3,
            'photo_url' => null,
        ]);

        User::create([
            'name' => 'তাজবীউল ইসলাম ইসকেম',
            'email' => 'eskem.buet@gmail.com',
            'phone' => '০১৬১১৩১০০৯৮',
            'password' => bcrypt('12345678'),
            'designation' => 'সহকারী কমিশনার',
            'role' => 3,
            'photo_url' => null,
        ]);

        User::create([
            'name' => 'সাইয়েদ মাহমুদ বুলবুল',
            'email' => 'sayyeedmahmudb959@gmail.com',
            'phone' => '০১৯৪৭৭২৪৬৫৮',
            'password' => bcrypt('12345678'),
            'designation' => 'সহকারী কমিশনার',
            'role' => 3,
            'photo_url' => null,
        ]);

        User::create([
            'name' => 'মোহাম্মদ আজম',
            'email' => 'mhmazam11135185@gmail.com',
            'phone' => '০১৭২২৮৭২৮১৮',
            'password' => bcrypt('12345678'),
            'designation' => 'সহকারী কমিশনার',
            'role' => 3,
            'photo_url' => null,
        ]);

        User::create([
            'name' => 'মোঃ সোলাইমান হোসেন',
            'email' => 'solaimanhossain1920@gmail.com',
            'phone' => '০১৫৩৮১৮৫২৪৫',
            'password' => bcrypt('12345678'),
            'designation' => 'সহকারী কমিশনার',
            'role' => 3,
            'photo_url' => null,
        ]);

        // serial number 15
        User::create([
            'name' => 'আবুল আলম মোঃ ছিবগাতুল্যাহ',
            'email' => 'abulalam@gmail.com',
            'phone' => '০১৭২৭০৩৮২৬৮',
            'password' => bcrypt('12345678'),
            'designation' => 'উপ-সহকারী প্রশাসনিক কর্মকর্তা',
            'role' => 4,
            'photo_url' => null,
        ]);

        User::create([
            'name' => 'মোঃ নূর নবী',
            'email' => 'nabinur2001@gmail.com',
            'phone' => '০১৭১৫৩৮০১০১',
            'password' => bcrypt('12345678'),
            'designation' => 'অফিস সহকারী কাম-কম্পিউটার মুদ্রাক্ষরিক',
            'role' => 4,
            'photo_url' => null,
        ]);

        User::create([
            'name' => 'মোঃ মোকাম্মেল হক',
            'email' => 'mokammel@gmail.com',
            'phone' => '০১৭১০৬২১৮৪২',
            'password' => bcrypt('12345678'),
            'designation' => 'অফিস সহকারী কাম-কম্পিউটার মুদ্রাক্ষরিক',
            'role' => 4,
            'photo_url' => null,
        ]);

        User::create([
            'name' => 'গৌতম কুমার সিংহ',
            'email' => 'goutamjm@gmail.com',
            'phone' => '০১৭১২২৬৬৩১৮',
            'password' => bcrypt('12345678'),
            'designation' => 'অফিস সহকারী কাম-কম্পিউটার মুদ্রাক্ষরিক',
            'role' => 4,
            'photo_url' => null,
        ]);

        User::create([
            'name' => 'মোঃ আরিফুল ইসলাম',
            'email' => 'arifbepary1983@gmail.com',
            'phone' => '০১৭১১-২৪৩৮৫৩',
            'password' => bcrypt('12345678'),
            'designation' => 'অফিস সহকারী কাম-কম্পিউটার মুদ্রাক্ষরিক',
            'role' => 4,
            'photo_url' => null,
        ]);

        // Adding All Section Name and Officer ID
        Section::create(['name' => 'গোপনীয় শাখা']);
        Section::create(['name' => 'সাধারণ শাখা']);
        Section::create(['name' => 'নেজারত শাখা']);
        Section::create(['name' => 'সংস্থাপন শাখা']);
        Section::create(['name' => 'ত্রাণ শাখা']);
        Section::create(['name' => 'ট্রেজারি শাখা']);
        Section::create(['name' => 'প্রবাসী কল্যাণ শাখা']);
        Section::create(['name' => 'আইসিটি শাখা', 'officer_id' => 6, 'staff_id' => 16]);
        Section::create(['name' => 'রাজস্ব শাখা', 'officer_id' => 5, 'staff_id' => 15]);
        Section::create(['name' => 'সাধারণ সার্টিফিকেট শাখা']);
        Section::create(['name' => 'আরএম শাখা']);
        Section::create(['name' => 'রেকর্ডরুম শাখা']);
        Section::create(['name' => 'রাজস্ব (এসএ) শাখা']);
        Section::create(['name' => 'এডিএম শাখা']);
        Section::create(['name' => 'জুডিশিয়াল মুন্সিখানা শাখা']);
        Section::create(['name' => 'স্থানীয় সরকার শাখা']);
        Section::create(['name' => 'ভূমি অধিগ্রহণ শাখা']);
        Section::create(['name' => 'লাইব্রেরী শাখা']);
        Section::create(['name' => 'শিক্ষা ও কল্যাণ শাখা']);
        Section::create(['name' => 'বিচার শাখা', 'officer_id' => 7, 'staff_id' => 18]);
        Section::create(['name' => 'এলএ শাখা']);
    }
}
