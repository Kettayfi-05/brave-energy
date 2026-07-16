<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChatbotKnowledgeBase;
use Illuminate\Http\Request;

class ChatbotController extends Controller
{
    public function index()
    {
        $knowledges = ChatbotKnowledgeBase::latest()->get();
        return view('admin.chatbot.index', compact('knowledges'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'question' => 'required|string',
            'answer' => 'required|string',
            'keywords' => 'nullable|string',
        ]);

        $keywords = $request->keywords 
            ? array_filter(array_map('trim', explode(',', $request->keywords))) 
            : [];

        ChatbotKnowledgeBase::create([
            'title' => $request->title,
            'question' => $request->question,
            'answer' => $request->answer,
            'keywords' => $keywords,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.chatbot.index')->with('success', 'Question ajoutée avec succès.');
    }

    public function update(Request $request, ChatbotKnowledgeBase $chatbot)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'question' => 'required|string',
            'answer' => 'required|string',
            'keywords' => 'nullable|string',
        ]);

        $keywords = $request->keywords 
            ? array_filter(array_map('trim', explode(',', $request->keywords))) 
            : [];

        $chatbot->update([
            'title' => $request->title,
            'question' => $request->question,
            'answer' => $request->answer,
            'keywords' => $keywords,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.chatbot.index')->with('success', 'Question mise à jour avec succès.');
    }

    public function destroy(ChatbotKnowledgeBase $chatbot)
    {
        $chatbot->delete();
        return redirect()->route('admin.chatbot.index')->with('success', 'Question supprimée avec succès.');
    }
}
