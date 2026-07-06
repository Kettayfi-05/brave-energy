<?php

namespace Database\Seeders;

use App\Models\ChatConversation;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class ChatConversationSeeder extends Seeder
{
    public function run(): void
    {
        foreach (User::where('role','client')->get() as $user){

            ChatConversation::create([

                'user_id'=>$user->id,

                'session_id' => Str::uuid(),
                'status' => 'active',

            ]);

        }
    }
}