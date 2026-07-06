<?php

namespace Database\Seeders;

use App\Models\BrowsingHistory;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class BrowsingHistorySeeder extends Seeder
{
    public function run(): void
    {
        foreach (User::where('role','client')->get() as $user){

            $products = Product::inRandomOrder()
                ->take(rand(5,10))
                ->get();

            foreach($products as $product){

                BrowsingHistory::create([
                    'user_id' => $user->id,
                    'product_id' => $product->id,
                ]);

            }
        }
    }
}