<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [

            [
                'name' => 'Ampoule LED 12W',
                'description' => 'Ampoule LED économique 12W.',
                'price' => 45.00,
                'stock' => 120,
                'category' => 'Éclairage',
                'brand' => 'Philips',
            ],

            [
                'name' => 'Projecteur LED 100W',
                'description' => 'Projecteur extérieur IP65.',
                'price' => 320.00,
                'stock' => 40,
                'category' => 'Éclairage',
                'brand' => 'Osram',
            ],

            [
                'name' => 'Prise Murale Double',
                'description' => 'Prise murale 220V.',
                'price' => 65.00,
                'stock' => 90,
                'category' => 'Prises & Interrupteurs',
                'brand' => 'Legrand',
            ],

            [
                'name' => 'Interrupteur Va-et-Vient',
                'description' => 'Interrupteur moderne.',
                'price' => 55.00,
                'stock' => 110,
                'category' => 'Prises & Interrupteurs',
                'brand' => 'Bticino',
            ],

            [
                'name' => 'Disjoncteur 20A',
                'description' => 'Protection électrique.',
                'price' => 180.00,
                'stock' => 60,
                'category' => 'Disjoncteurs',
                'brand' => 'Schneider Electric',
            ],

            [
                'name' => 'Câble 2.5mm²',
                'description' => 'Câble électrique vendu au mètre.',
                'price' => 12.00,
                'stock' => 1000,
                'category' => 'Câbles & Fils',
                'brand' => 'Nexans',
            ],

            [
                'name' => 'Tableau électrique 18 modules',
                'description' => 'Tableau électrique complet.',
                'price' => 890.00,
                'stock' => 25,
                'category' => 'Disjoncteurs',
                'brand' => 'Hager',
            ],

            [
                'name' => 'Détecteur de mouvement',
                'description' => 'Capteur infrarouge.',
                'price' => 260.00,
                'stock' => 35,
                'category' => 'Domotique',
                'brand' => 'ABB',
            ],

        ];

        foreach ($products as $index => $item) {

            $category = Category::where('name', $item['category'])->first();

            $brand = Brand::where('name', $item['brand'])->first();

            Product::create([
                'category_id' => $category->id,
                'brand_id' => $brand->id,
                'promotion_id' => null,

                'name' => $item['name'],
                'slug' => Str::slug($item['name']),

                'reference' => 'REF-' . str_pad($index + 1, 5, '0', STR_PAD_LEFT),

                'description' => $item['description'],
                'price' => $item['price'],
                'stock' => $item['stock'],

                'image' => null,

                'is_featured' => false,

                'status' => 'active',
            ]);
        }
    }
}