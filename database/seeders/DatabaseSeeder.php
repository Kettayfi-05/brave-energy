<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([

            /*
            |--------------------------------------------------------------------------
            | Données de base
            |--------------------------------------------------------------------------
            */
            CategorySeeder::class,
            BrandSeeder::class,
            UserSeeder::class,
            SiteSettingSeeder::class,

            /*
            |--------------------------------------------------------------------------
            | Catalogue
            |--------------------------------------------------------------------------
            */
            PromotionSeeder::class,
            ProductSeeder::class,
            ProductVariantSeeder::class,
            ProductImageSeeder::class,

            /*
            |--------------------------------------------------------------------------
            | Panier
            |--------------------------------------------------------------------------
            */
            CartSeeder::class,
            CartItemSeeder::class,

            /*
            |--------------------------------------------------------------------------
            | Interactions
            |--------------------------------------------------------------------------
            */
            FavoriteSeeder::class,
            ReviewSeeder::class,
            BrowsingHistorySeeder::class,

            /*
            |--------------------------------------------------------------------------
            | Demandes de commande
            |--------------------------------------------------------------------------
            */
            OrderRequestSeeder::class,
            RequestItemSeeder::class,

            /*
            |--------------------------------------------------------------------------
            | Notifications
            |--------------------------------------------------------------------------
            */
            NotificationSeeder::class,

            /*
            |--------------------------------------------------------------------------
            | Contact
            |--------------------------------------------------------------------------
            */
            ContactMessageSeeder::class,

            /*
            |--------------------------------------------------------------------------
            | Chatbot IA
            |--------------------------------------------------------------------------
            */
            ChatbotKnowledgeBaseSeeder::class,
            ChatConversationSeeder::class,
            ChatMessageSeeder::class,

        ]);
    }
}