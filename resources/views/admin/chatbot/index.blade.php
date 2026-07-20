@extends('layouts.admin')
@section('title', 'Chatbot IA')
@section('page-title', 'Chatbot — Base de connaissances')

@section('content')

{{-- Flash message --}}
@if(session('success'))
<div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
     class="mb-6 flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl text-sm font-medium">
    <svg class="w-5 h-5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
    </svg>
    {{ session('success') }}
</div>
@endif

<div class="grid lg:grid-cols-[1fr_420px] gap-6">

    {{-- ===== LEFT: Knowledge Base List ===== --}}
    <div class="space-y-4">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl flex items-center justify-center" style="background:linear-gradient(135deg,#F5B301,#C9702B)">
                        <svg class="w-5 h-5 text-be-ink" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-semibold text-slate-800 text-sm">Base de connaissances</h2>
                        <p class="text-xs text-slate-400">{{ $knowledges->count() }} question(s) configurée(s)</p>
                    </div>
                </div>
                <button onclick="document.getElementById('add-modal').classList.remove('hidden')"
                        class="inline-flex items-center gap-2 bg-be-amber hover:brightness-95 text-be-ink text-xs font-semibold px-4 py-2 rounded-lg transition-colors">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                    </svg>
                    Ajouter une question
                </button>
            </div>

            @if($knowledges->isEmpty())
                <div class="flex flex-col items-center justify-center py-16 text-center">
                    <div class="w-16 h-16 rounded-2xl bg-slate-100 flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                        </svg>
                    </div>
                    <p class="font-semibold text-slate-600">Aucune question configurée</p>
                    <p class="text-sm text-slate-400 mt-1">Ajoutez votre première entrée pour entraîner le chatbot.</p>
                </div>
            @else
                <div class="divide-y divide-slate-50">
                    @foreach($knowledges as $kb)
                    <div class="px-6 py-4 hover:bg-slate-50 transition-colors group">
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="w-2 h-2 rounded-full {{ $kb->is_active ? 'bg-emerald-400' : 'bg-slate-300' }} shrink-0"></span>
                                    <span class="font-semibold text-slate-800 text-sm truncate">{{ $kb->title }}</span>
                                    @if(!$kb->is_active)
                                        <span class="text-[10px] font-mono font-bold bg-slate-100 text-slate-400 px-2 py-0.5 rounded">INACTIF</span>
                                    @endif
                                </div>
                                <p class="text-xs text-slate-500 mt-0.5 font-medium">❓ {{ $kb->question }}</p>
                                <p class="text-xs text-slate-400 mt-1 line-clamp-2">{{ $kb->answer }}</p>
                                @if($kb->keywords && count($kb->keywords) > 0)
                                <div class="flex flex-wrap gap-1 mt-2">
                                    @foreach(array_slice($kb->keywords, 0, 5) as $kw)
                                        <span class="text-[10px] font-mono bg-amber-50 text-be-copper px-2 py-0.5 rounded-full">{{ $kw }}</span>
                                    @endforeach
                                    @if(count($kb->keywords) > 5)
                                        <span class="text-[10px] text-slate-400">+{{ count($kb->keywords) - 5 }}</span>
                                    @endif
                                </div>
                                @endif
                            </div>
                            <div class="flex items-center gap-2 shrink-0 opacity-0 group-hover:opacity-100 transition-opacity">
                                <button onclick="openEdit({{ $kb->id }}, {{ json_encode($kb->title) }}, {{ json_encode($kb->question) }}, {{ json_encode($kb->answer) }}, {{ json_encode(implode(', ', $kb->keywords ?? [])) }}, {{ $kb->is_active ? 'true' : 'false' }})"
                                        class="p-2 rounded-lg hover:bg-amber-50 text-slate-400 hover:text-be-copper transition-colors" title="Modifier">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </button>
                                <form method="POST" action="{{ route('admin.chatbot.destroy', $kb) }}" onsubmit="return confirm('Supprimer cette question ?')" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-2 rounded-lg hover:bg-red-50 text-slate-400 hover:text-red-500 transition-colors" title="Supprimer">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    {{-- ===== RIGHT: Live Chat Preview ===== --}}
    <div class="space-y-4">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="px-5 py-4 border-b border-slate-100 flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center" style="background:linear-gradient(135deg,#f5b301,#c9702b)">
                    <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold text-slate-800 text-sm">Tester le chatbot</h3>
                    <p class="text-xs text-slate-400">Simulez une conversation client</p>
                </div>
            </div>

            {{-- Chat window --}}
            <div id="admin-chat-messages" class="h-72 overflow-y-auto px-4 py-4 space-y-3 bg-slate-50">
                <div class="flex gap-2">
                    <div class="w-7 h-7 rounded-full flex items-center justify-center shrink-0 text-white text-xs font-bold" style="background:linear-gradient(135deg,#f5b301,#c9702b)">BE</div>
                    <div class="bg-white border border-slate-100 rounded-2xl rounded-tl-sm px-3 py-2 text-sm text-slate-700 shadow-sm max-w-[85%]">
                        Bonjour ! Je suis l'assistant Brave Energy. Comment puis-je vous aider ?
                    </div>
                </div>
            </div>

            {{-- Input --}}
            <div class="px-4 py-3 border-t border-slate-100 flex gap-2">
                <input type="text" id="admin-chat-input" placeholder="Testez une question…"
                       class="flex-1 text-sm bg-slate-100 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-amber-400 text-slate-700 placeholder-slate-400">
                <button onclick="adminChatSend()"
                        class="w-10 h-10 rounded-xl flex items-center justify-center text-be-ink transition-colors"
                        style="background:linear-gradient(135deg,#F5B301,#C9702B)">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Quick stats --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 px-5 py-4">
            <p class="text-xs font-mono text-slate-400 uppercase tracking-wider mb-3">Statistiques</p>
            <div class="space-y-2.5">
                <div class="flex items-center justify-between">
                    <span class="text-sm text-slate-600">Questions actives</span>
                    <span class="font-mono font-bold text-slate-800">{{ $knowledges->where('is_active', true)->count() }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-slate-600">Questions inactives</span>
                    <span class="font-mono font-bold text-slate-400">{{ $knowledges->where('is_active', false)->count() }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-slate-600">Total mots-clés</span>
                    <span class="font-mono font-bold text-be-copper">{{ $knowledges->sum(fn($k) => count($k->keywords ?? [])) }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ===== MODAL: Add ===== --}}
<div id="add-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/70 backdrop-blur-sm">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg">
        <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
            <h3 class="font-bold text-slate-800">Nouvelle question</h3>
            <button onclick="document.getElementById('add-modal').classList.add('hidden')" class="text-slate-400 hover:text-slate-600">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <form method="POST" action="{{ route('admin.chatbot.store') }}" class="px-6 py-5 space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5">Titre / Sujet</label>
                <input type="text" name="title" required placeholder="ex : Horaires d'ouverture"
                       class="w-full rounded-xl bg-slate-50 border border-slate-200 px-4 py-2.5 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-amber-400">
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5">Question type</label>
                <input type="text" name="question" required placeholder="ex : Quels sont vos horaires ?"
                       class="w-full rounded-xl bg-slate-50 border border-slate-200 px-4 py-2.5 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-amber-400">
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5">Réponse du chatbot</label>
                <textarea name="answer" required rows="4" placeholder="La réponse que le chatbot donnera…"
                          class="w-full rounded-xl bg-slate-50 border border-slate-200 px-4 py-2.5 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-amber-400 resize-none"></textarea>
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5">Mots-clés déclencheurs <span class="font-normal text-slate-400">(séparés par des virgules)</span></label>
                <input type="text" name="keywords" placeholder="ex : horaires, ouverture, heure, quand"
                       class="w-full rounded-xl bg-slate-50 border border-slate-200 px-4 py-2.5 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-amber-400">
            </div>
            <div class="flex items-center gap-3">
                <input type="checkbox" name="is_active" id="add_is_active" value="1" checked
                       class="rounded border-slate-300 text-be-amber focus:ring-be-amber">
                <label for="add_is_active" class="text-sm text-slate-700 cursor-pointer">Activer immédiatement</label>
            </div>
            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="flex-1 rounded-xl bg-be-amber hover:brightness-95 text-be-ink text-sm font-semibold py-2.5 transition-colors">
                    Enregistrer
                </button>
                <button type="button" onclick="document.getElementById('add-modal').classList.add('hidden')"
                        class="flex-1 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 text-sm font-medium py-2.5 transition-colors">
                    Annuler
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ===== MODAL: Edit ===== --}}
<div id="edit-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/70 backdrop-blur-sm">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg">
        <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
            <h3 class="font-bold text-slate-800">Modifier la question</h3>
            <button onclick="document.getElementById('edit-modal').classList.add('hidden')" class="text-slate-400 hover:text-slate-600">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <form id="edit-form" method="POST" action="" class="px-6 py-5 space-y-4">
            @csrf @method('PUT')
            <div>
                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5">Titre / Sujet</label>
                <input type="text" name="title" id="edit_title" required
                       class="w-full rounded-xl bg-slate-50 border border-slate-200 px-4 py-2.5 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-amber-400">
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5">Question type</label>
                <input type="text" name="question" id="edit_question" required
                       class="w-full rounded-xl bg-slate-50 border border-slate-200 px-4 py-2.5 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-amber-400">
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5">Réponse du chatbot</label>
                <textarea name="answer" id="edit_answer" required rows="4"
                          class="w-full rounded-xl bg-slate-50 border border-slate-200 px-4 py-2.5 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-amber-400 resize-none"></textarea>
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5">Mots-clés</label>
                <input type="text" name="keywords" id="edit_keywords"
                       class="w-full rounded-xl bg-slate-50 border border-slate-200 px-4 py-2.5 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-amber-400">
            </div>
            <div class="flex items-center gap-3">
                <input type="checkbox" name="is_active" id="edit_is_active" value="1"
                       class="rounded border-slate-300 text-be-amber focus:ring-be-amber">
                <label for="edit_is_active" class="text-sm text-slate-700 cursor-pointer">Actif</label>
            </div>
            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="flex-1 rounded-xl bg-be-amber hover:brightness-95 text-be-ink text-sm font-semibold py-2.5 transition-colors">
                    Enregistrer
                </button>
                <button type="button" onclick="document.getElementById('edit-modal').classList.add('hidden')"
                        class="flex-1 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 text-sm font-medium py-2.5 transition-colors">
                    Annuler
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
function openEdit(id, title, question, answer, keywords, isActive) {
    document.getElementById('edit_title').value = title;
    document.getElementById('edit_question').value = question;
    document.getElementById('edit_answer').value = answer;
    document.getElementById('edit_keywords').value = keywords;
    document.getElementById('edit_is_active').checked = isActive;
    document.getElementById('edit-form').action = `/admin/chatbot/${id}`;
    document.getElementById('edit-modal').classList.remove('hidden');
}

// Admin chat preview
function adminChatSend() {
    const input = document.getElementById('admin-chat-input');
    const msg = input.value.trim();
    if (!msg) return;
    input.value = '';

    const chatbox = document.getElementById('admin-chat-messages');

    // User bubble
    chatbox.innerHTML += `
        <div class="flex gap-2 justify-end">
            <div class="bg-be-amber text-be-ink font-semibold rounded-2xl rounded-tr-sm px-3 py-2 text-sm max-w-[85%]">${msg}</div>
            <div class="w-7 h-7 rounded-full bg-slate-200 flex items-center justify-center shrink-0 text-xs font-bold text-slate-500">Toi</div>
        </div>`;
    chatbox.scrollTop = chatbox.scrollHeight;

    // Typing indicator
    const typingId = 'typing-' + Date.now();
    chatbox.innerHTML += `
        <div id="${typingId}" class="flex gap-2">
            <div class="w-7 h-7 rounded-full flex items-center justify-center shrink-0 text-white text-xs font-bold" style="background:linear-gradient(135deg,#f5b301,#c9702b)">BE</div>
            <div class="bg-white border border-slate-100 rounded-2xl rounded-tl-sm px-3 py-2 text-sm text-slate-400 shadow-sm">
                <span class="inline-flex gap-1">
                    <span class="w-1.5 h-1.5 rounded-full bg-slate-300 animate-bounce" style="animation-delay:0ms"></span>
                    <span class="w-1.5 h-1.5 rounded-full bg-slate-300 animate-bounce" style="animation-delay:150ms"></span>
                    <span class="w-1.5 h-1.5 rounded-full bg-slate-300 animate-bounce" style="animation-delay:300ms"></span>
                </span>
            </div>
        </div>`;
    chatbox.scrollTop = chatbox.scrollHeight;

    fetch('/chatbot/message', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ message: msg })
    })
    .then(r => r.json())
    .then(data => {
        document.getElementById(typingId)?.remove();
        chatbox.innerHTML += `
            <div class="flex gap-2">
                <div class="w-7 h-7 rounded-full flex items-center justify-center shrink-0 text-white text-xs font-bold" style="background:linear-gradient(135deg,#f5b301,#c9702b)">BE</div>
                <div class="bg-white border border-slate-100 rounded-2xl rounded-tl-sm px-3 py-2 text-sm text-slate-700 shadow-sm max-w-[85%]">${data.answer}</div>
            </div>`;
        chatbox.scrollTop = chatbox.scrollHeight;
    });
}

document.getElementById('admin-chat-input').addEventListener('keydown', e => {
    if (e.key === 'Enter') adminChatSend();
});
</script>
@endpush
