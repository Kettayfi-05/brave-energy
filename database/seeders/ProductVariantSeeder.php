<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Seeder;

class ProductVariantSeeder extends Seeder
{
    public function run(): void
    {

        foreach(Product::all() as $product){

            ProductVariant::create([

                'product_id'=>$product->id,

                'name'=>'Standard',

                'sku'=>'SKU-'.$product->id.'-STD',

                'price'=>$product->price,

                'stock'=>$product->stock,

                'attributes'=>json_encode([
                    'couleur'=>'Blanc',
                    'garantie'=>'2 ans'
                ])

            ]);

        }

    }
}
