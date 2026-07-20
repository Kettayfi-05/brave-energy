@extends('layouts.admin')
@section('title', 'Lecture du Message')
@section('page-title', 'Message de Contact')

@section('content')

<div class="mb-6">
    <a href="{{ route('admin.contact-messages.index') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-slate-500 hover:text-slate-800 transition-colors">
        ← Retour aux messages
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 sm:p-8">
    <div class="border-b border-slate-100 pb-5 mb-6 flex flex-wrap justify-between items-start gap-4">
        <div>
            <span class="text-xs font-semibold text-slate-400 font-mono tracking-wider uppercase">Sujet</span>
            <h1 class="font-display font-bold text-xl text-slate-800 mt-1">{{ $contactMessage->subject }}</h1>
        </div>
        <span class="text-xs text-slate-400 font-mono">Reçu le {{ $contactMessage->created_at->format('d/m/Y \à H:i') }}</span>
    </div>

    <div class="grid md:grid-cols-[260px_1fr] gap-8 items-start">
        
        {{-- Sender info card --}}
        <div class="bg-slate-50 rounded-xl p-4 border border-slate-100">
            <h3 class="text-xs font-semibold text-slate-400 font-mono tracking-wider uppercase mb-3">Expéditeur</h3>
            <div class="space-y-3.5 text-sm">
                <div>
                    <span class="text-xs text-slate-400 block">Nom complet</span>
                    <span class="font-medium text-slate-800">{{ $contactMessage->name }}</span>
                </div>
                <div>
                    <span class="text-xs text-slate-400 block">Adresse Email</span>
                    <a href="mailto:{{ $contactMessage->email }}" class="font-mono text-xs text-be-copper hover:underline">{{ $contactMessage->email }}</a>
                </div>
                <div>
                    <span class="text-xs text-slate-400 block">Téléphone</span>
                    <span class="font-mono text-xs text-slate-800">{{ $contactMessage->phone ?? 'Non spécifié' }}</span>
                </div>
            </div>
        </div>

        {{-- Message body --}}
        <div>
            <h3 class="text-xs font-semibold text-slate-400 font-mono tracking-wider uppercase mb-3">Contenu du message</h3>
            <div class="bg-slate-50/50 rounded-xl p-5 border border-slate-100 text-slate-700 leading-relaxed font-sans text-sm whitespace-pre-wrap">
                {{ $contactMessage->message }}
            </div>

            <div class="mt-8 pt-6 border-t border-slate-100 flex items-center justify-between gap-4">
                <form method="POST" action="{{ route('admin.contact-messages.destroy', $contactMessage) }}" onsubmit="return confirm('Supprimer définitivement ce message ?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="bg-red-50 hover:bg-red-100 text-red-600 font-semibold text-sm px-5 py-2.5 rounded-xl transition-colors">
                        Supprimer ce message
                    </button>
                </form>
                
                <a href="mailto:{{ $contactMessage->email }}?subject=Re: {{ rawurlencode($contactMessage->subject) }}" class="bg-be-amber hover:brightness-95 text-be-ink font-semibold text-sm px-5 py-2.5 rounded-xl transition-colors">
                    Répondre par email
                </a>
            </div>
        </div>

    </div>
</div>

@endsection
