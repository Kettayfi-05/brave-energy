<?php

namespace Database\Seeders;

use App\Models\ChatbotKnowledgeBase;
use Illuminate\Database\Seeder;

class ChatbotKnowledgeBaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ChatbotKnowledgeBase::create([
            'title' => 'Horaires d\'ouverture',
            'question' => 'Quels sont vos horaires ?',
            'answer' => 'Nous sommes ouverts du lundi au samedi de 9h00 à 18h00.',
            'keywords' => [
                'horaires',
                'ouverture',
                'heure',
                'magasin',
            ],
            'is_active' => true,
        ]);

        ChatbotKnowledgeBase::create([
            'title' => 'Adresse',
            'question' => 'Où êtes-vous situés ?',
            'answer' => 'Nous sommes situés à Casablanca.',
            'keywords' => [
                'adresse',
                'localisation',
                'casablanca',
            ],
            'is_active' => true,
        ]);

        ChatbotKnowledgeBase::create([
            'title' => 'Commande',
            'question' => 'Comment passer une commande ?',
            'answer' => 'Ajoutez les produits à votre panier puis envoyez votre demande de commande. Notre équipe vous contactera pour la confirmation.',
            'keywords' => [
                'commande',
                'panier',
                'acheter',
            ],
            'is_active' => true,
        ]);

        ChatbotKnowledgeBase::create([
            'title' => 'Livraison',
            'question' => 'Livrez-vous partout au Maroc ?',
            'answer' => 'Oui, nous assurons la livraison dans toutes les villes du Maroc.',
            'keywords' => [
                'livraison',
                'maroc',
                'expédition',
            ],
            'is_active' => true,
        ]);

        ChatbotKnowledgeBase::create([
            'title' => 'Paiement',
            'question' => 'Quels moyens de paiement acceptez-vous ?',
            'answer' => 'Le paiement est validé directement avec notre équipe commerciale après confirmation de votre demande.',
            'keywords' => [
                'paiement',
                'règlement',
                'paiement à la livraison',
            ],
            'is_active' => true,
        ]);
    }
}