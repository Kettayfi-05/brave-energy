<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        SiteSetting::create([
            'site_name' => 'Brave Energy',
            'email' => 'contact@braveenergy.ma',
            'phone' => '+212600000000',
            'address' => 'Casablanca, Maroc',
            'facebook' => 'https://facebook.com/braveenergy',
            'instagram' => 'https://instagram.com/braveenergy',
            'linkedin' => 'https://linkedin.com/company/braveenergy',
            'about' => 'Spécialiste du matériel électrique au Maroc.',
        ]);
    }
}