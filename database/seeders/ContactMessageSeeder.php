<?php

namespace Database\Seeders;

use App\Models\ContactMessage;
use Illuminate\Database\Seeder;

class ContactMessageSeeder extends Seeder
{
    public function run(): void
    {
        ContactMessage::create([
            'name' => 'Ahmed Benali',
            'email' => 'ahmed@gmail.com',
            'subject' => 'Demande de devis',
            'message' => 'Bonjour, je souhaite obtenir un devis pour plusieurs produits.',
        ]);

        ContactMessage::create([
            'name' => 'Sara El Amrani',
            'email' => 'sara@gmail.com',
            'subject' => 'Disponibilité',
            'message' => 'Le produit est-il disponible en stock ?',
        ]);

        ContactMessage::create([
            'name' => 'Youssef Alaoui',
            'email' => 'youssef@gmail.com',
            'subject' => 'Information',
            'message' => 'Quels sont vos délais de livraison ?',
        ]);
    }
}
