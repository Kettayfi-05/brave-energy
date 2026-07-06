<?php

namespace Database\Seeders;

use App\Models\OrderRequest;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderRequestSeeder extends Seeder
{
    public function run(): void
    {
        foreach (User::where('role', 'client')->get() as $user) {

            OrderRequest::create([
                'user_id' => $user->id,
                'status' => 'pending',
                'reference' => 'CMD-'.str_pad($user->id,5,'0',STR_PAD_LEFT),
                'notes' => 'Merci de confirmer ma demande.',
            ]);
        }
    }
}
