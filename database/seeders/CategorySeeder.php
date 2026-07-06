<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Éclairage',
                'slug' => 'eclairage',
                'description' => 'Ampoules, spots, projecteurs et luminaires.',
                'image' => 'categories/eclairage.jpg',
                'is_active' => true,
            ],
            [
                'name' => 'Prises & Interrupteurs',
                'slug' => 'prises-interrupteurs',
                'description' => 'Prises, interrupteurs et accessoires.',
                'image' => 'categories/prises.jpg',
                'is_active' => true,
            ],
            [
                'name' => 'Câbles & Fils',
                'slug' => 'cables-fils',
                'description' => 'Câbles électriques et gaines.',
                'image' => 'categories/cables.jpg',
                'is_active' => true,
            ],
            [
                'name' => 'Disjoncteurs',
                'slug' => 'disjoncteurs',
                'description' => 'Protection électrique.',
                'image' => 'categories/disjoncteurs.jpg',
                'is_active' => true,
            ],
            [
                'name' => 'Domotique',
                'slug' => 'domotique',
                'description' => 'Maison intelligente.',
                'image' => 'categories/domotique.jpg',
                'is_active' => true,
            ],
            [
                'name' => 'Outillage',
                'slug' => 'outillage',
                'description' => 'Outils pour électriciens.',
                'image' => 'categories/outillage.jpg',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}