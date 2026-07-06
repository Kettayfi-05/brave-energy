<?php

namespace Database\Seeders;

use App\Models\Promotion;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PromotionSeeder extends Seeder
{
    public function run(): void
    {
        Promotion::create([
            'title' => 'Soldes d\'été',
            'description' => 'Réduction exceptionnelle sur plusieurs produits.',
            'discount_percentage' => 15.00 ,
            'discount_type' => 'percentage',
            'discount_value' => 15,
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now()->addDays(30),
            'is_active' => true,
        ]);

        Promotion::create([
            'title' => 'Promotion Éclairage',
            'description' => 'Offre spéciale sur les luminaires.',
            'discount_percentage' => 20.45 ,
            'discount_type' => 'percentage',
            'discount_value' => 25,
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now()->addDays(20),
            'is_active' => true,
        ]);

        Promotion::create([
            'title' => 'Remise Fixe',
            'description' => '100 DH de réduction.',
            'discount_percentage' => 18.00 ,
            'discount_type' => 'fixed',
            'discount_value' => 100,
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now()->addDays(15),
            'is_active' => true,
        ]);
    }
}