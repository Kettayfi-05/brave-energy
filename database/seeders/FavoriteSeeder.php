<?php

namespace Database\Seeders;

use App\Models\Favorite;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class FavoriteSeeder extends Seeder
{
    public function run(): void
    {
        foreach (User::where('role','client')->get() as $user){

            $products = Product::inRandomOrder()
                ->take(rand(2,5))
                ->get();

            foreach($products as $product){

                Favorite::firstOrCreate([
                    'user_id'=>$user->id,
                    'product_id'=>$product->id,
                ]);

            }
        }
    }
}