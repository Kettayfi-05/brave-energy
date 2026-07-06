<?php

namespace Database\Seeders;

use App\Models\OrderRequest;
use App\Models\ProductVariant;
use App\Models\RequestItem;
use Illuminate\Database\Seeder;

class RequestItemSeeder extends Seeder
{
    public function run(): void
    {
        foreach (OrderRequest::all() as $order) {

            $variants = ProductVariant::inRandomOrder()
                ->take(rand(1,4))
                ->get();

            foreach ($variants as $variant) {

                RequestItem::create([
                    'order_request_id' => $order->id,
                    'product_variant_id' => $variant->id,
                    'quantity' => rand(1,5),
                    
                ]);
            }
        }
    }
}