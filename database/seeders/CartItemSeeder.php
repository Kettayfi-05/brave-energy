<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\ProductVariant;
use Illuminate\Database\Seeder;

class CartItemSeeder extends Seeder
{
    public function run(): void
    {
        foreach (Cart::all() as $cart) {

            $variants = ProductVariant::inRandomOrder()
                ->take(rand(1,3))
                ->get();

            foreach ($variants as $variant) {

                CartItem::create([
                    'cart_id' => $cart->id,
                    'product_variant_id' => $variant->id,
                    'quantity' => rand(1,5),
                ]);
            }
        }
    }
}
