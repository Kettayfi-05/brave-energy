<?php

namespace Database\Seeders;

use App\Models\ChatConversation;
use App\Models\ChatMessage;
use Illuminate\Database\Seeder;

class ChatMessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (ChatConversation::all() as $conversation) {

            ChatMessage::create([
                'chat_conversation_id' => $conversation->id,
                'sender' => 'user',
                'message' => 'Bonjour',
            ]);

            ChatMessage::create([
                'chat_conversation_id' => $conversation->id,
                'sender' => 'assistant',
                'message' => 'Bonjour ! Bienvenue chez Brave Energy. Comment puis-je vous aider aujourd\'hui ?',
            ]);

            ChatMessage::create([
                'chat_conversation_id' => $conversation->id,
                'sender' => 'user',
                'message' => 'Je cherche des ampoules LED.',
            ]);

            ChatMessage::create([
                'chat_conversation_id' => $conversation->id,
                'sender' => 'assistant',
                'message' => 'Nous proposons plusieurs modèles d\'ampoules LED Philips, Osram et d\'autres marques. Vous pouvez consulter la catégorie Éclairage.',
            ]);
        }
    }
}
