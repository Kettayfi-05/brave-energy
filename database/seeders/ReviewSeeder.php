<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        foreach(Product::all() as $product){

            $users = User::where('role','client')
                ->inRandomOrder()
                ->take(rand(2,6))
                ->get();

            foreach($users as $user){

                Review::create([

                    'user_id'=>$user->id,

                    'product_id'=>$product->id,

                    'rating'=>rand(3,5),

                    'comment'=>'Excellent produit. Très bonne qualité.',

                    'is_approved'=>true

                ]);

            }

        }
    }
}
