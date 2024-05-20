<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seeting = [
            [
                'phone'=> '01402313786',
                'email'=> 'seyamjh@gmail.com',
                'address' => 'Dhaka, Banglades',
                'facebook' => 'https://www.facebook.com/',
                'twitter' => 'https://twitter.com/',
                'instagram' => 'https://www.instagram.com/',
                'youtube' => 'https://www.youtube.com/',
                'logo'=> 'logo.png',
            ],
            
        ];

        Setting::insert($seeting);
    }
}
