<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrateur',
            'email' => 'admin@braveenergy.ma',
            'password' => Hash::make('password'),
            'phone' => '0600000000',
            'address' => 'Casablanca',
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Client Test',
            'email' => 'client@braveenergy.ma',
            'password' => Hash::make('password'),
            'phone' => '0611111111',
            'address' => 'Casablanca',
            'role' => 'customer',
        ]);

        User::factory()->count(20)->create([
            'role' => 'customer',
        ]);
    }
}