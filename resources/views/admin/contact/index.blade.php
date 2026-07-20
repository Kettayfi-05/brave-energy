@extends('layouts.admin')
@section('title', 'Messages de Contact')
@section('page-title', 'Messages de Contact')

@section('content')

@if(session('success'))
<div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
     class="mb-6 flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl text-sm font-medium">
    <svg class="w-5 h-5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
    </svg>
    {{ session('success') }}
</div>
@endif

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-slate-100 bg-slate-50/50">
                    <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase">Date</th>
                    <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase">Expéditeur</th>
                    <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase">Sujet</th>
                    <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase">Statut</th>
                    <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($messages as $msg)
                <tr class="hover:bg-slate-50/40 transition-colors {{ $msg->status === 'new' ? 'font-semibold text-slate-900' : 'text-slate-600' }}">
                    <td class="px-6 py-4 text-sm font-mono whitespace-nowrap">
                        {{ $msg->created_at->format('d/m/Y H:i') }}
                    </td>
                    <td class="px-6 py-4 text-sm">
                        <div class="font-medium text-slate-800">{{ $msg->name }}</div>
                        <div class="text-xs text-slate-400 font-mono">{{ $msg->email }}</div>
                    </td>
                    <td class="px-6 py-4 text-sm max-w-xs truncate">
                        {{ $msg->subject }}
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold
                            @if($msg->status === 'new') bg-amber-50 text-amber-700
                            @elseif($msg->status === 'read') bg-blue-50 text-blue-700
                            @else bg-emerald-50 text-emerald-700 @endif">
                            <span class="w-1.5 h-1.5 rounded-full
                                @if($msg->status === 'new') bg-amber-500
                                @elseif($msg->status === 'read') bg-blue-500
                                @else bg-emerald-500 @endif"></span>
                            @if($msg->status === 'new') Nouveau
                            @elseif($msg->status === 'read') Lu
                            @else Répondu @endif
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm">
                        <div class="flex items-center gap-2">
                            <a href="{{ route('admin.contact-messages.show', $msg) }}" class="bg-amber-400 hover:bg-amber-500 text-be-ink font-semibold text-xs px-3 py-1.5 rounded-lg transition-colors">
                                Lire
                            </a>
                            <form method="POST" action="{{ route('admin.contact-messages.destroy', $msg) }}" onsubmit="return confirm('Supprimer définitivement ce message ?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="bg-slate-100 hover:bg-red-50 text-slate-600 hover:text-red-600 font-semibold text-xs px-3 py-1.5 rounded-lg transition-colors">
                                    Supprimer
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-slate-400">
                        <div class="w-12 h-12 rounded-xl bg-slate-50 flex items-center justify-center mx-auto mb-4">
                            <svg class="w-6 h-6 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <p class="text-sm font-medium">Aucun message de contact reçu.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($messages->hasPages())
        <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50">
            {{ $messages->links() }}
        </div>
    @endif
</div>

@endsection
