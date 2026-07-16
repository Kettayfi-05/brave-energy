<?php

namespace App\Http\Controllers;

use App\Models\ChatbotKnowledgeBase;
use Illuminate\Http\Request;

class ChatbotController extends Controller
{
    public function message(Request $request)
    {
        $message = strtolower(trim($request->input('message')));
        if (empty($message)) {
            return response()->json(['answer' => "Veuillez écrire un message."]);
        }

        // Clean message punctuation
        $cleanedMessage = preg_replace('/[^\p{L}\p{N}\s]/u', '', $message);
        $words = explode(' ', $cleanedMessage);
        $words = array_filter(array_map('trim', $words));

        // Find active knowledge base articles
        $knowledgeBases = ChatbotKnowledgeBase::where('is_active', true)->get();

        $bestMatch = null;
        $highestScore = 0;

        foreach ($knowledgeBases as $kb) {
            $score = 0;
            
            // 1. Direct matches in title/question
            if (str_contains($message, strtolower($kb->question)) || str_contains(strtolower($kb->question), $message)) {
                $score += 10;
            }
            if (str_contains($message, strtolower($kb->title)) || str_contains(strtolower($kb->title), $message)) {
                $score += 5;
            }

            // 2. Keyword matching
            if (!empty($kb->keywords)) {
                foreach ($kb->keywords as $keyword) {
                    $keyword = strtolower(trim($keyword));
                    if (empty($keyword)) continue;

                    // Exact match of keyword in message or vice versa
                    if (str_contains($message, $keyword)) {
                        $score += 3;
                    }
                    
                    // Match query words
                    foreach ($words as $word) {
                        if ($word === $keyword) {
                            $score += 2;
                        }
                    }
                }
            }

            if ($score > $highestScore) {
                $highestScore = $score;
                $bestMatch = $kb;
            }
        }

        if ($bestMatch && $highestScore > 1) {
            return response()->json(['answer' => $bestMatch->answer]);
        }

        // Fallback default response
        return response()->json([
            'answer' => "Désolé, je ne trouve pas de réponse à votre question. N'hésitez pas à nous contacter directement par téléphone au +212 5 22 00 00 00 ou via notre page contact."
        ]);
    }
}
