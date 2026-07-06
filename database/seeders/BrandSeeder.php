<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            ['name'=>'Legrand','slug'=>'legrand','logo'=>'brands/legrand.png','description'=>'Matériel électrique','is_active'=>true],
            ['name'=>'Schneider Electric','slug'=>'schneider-electric','logo'=>'brands/schneider.png','description'=>'Solutions électriques','is_active'=>true],
            ['name'=>'Philips','slug'=>'philips','logo'=>'brands/philips.png','description'=>'Éclairage LED','is_active'=>true],
            ['name'=>'ABB','slug'=>'abb','logo'=>'brands/abb.png','description'=>'Produits industriels','is_active'=>true],
            ['name'=>'Siemens','slug'=>'siemens','logo'=>'brands/siemens.png','description'=>'Équipements électriques','is_active'=>true],
            ['name'=>'Hager','slug'=>'hager','logo'=>'brands/hager.png','description'=>'Installations électriques','is_active'=>true],
            ['name'=>'Nexans','slug'=>'nexans','logo'=>'brands/nexans.png','description'=>'Câbles électriques','is_active'=>true],
            ['name'=>'Osram','slug'=>'osram','logo'=>'brands/osram.png','description'=>'Éclairage','is_active'=>true],
            ['name'=>'Bticino','slug'=>'bticino','logo'=>'brands/bticino.png','description'=>'Domotique','is_active'=>true],
            ['name'=>'Brave Energy','slug'=>'brave-energy','logo'=>'brands/brave.png','description'=>'Marque interne','is_active'=>true],
        ];

        foreach ($brands as $brand) {
            Brand::create($brand);
        }
    }
}