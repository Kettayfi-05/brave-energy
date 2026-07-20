@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-be-cream py-12">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Breadcrumb --}}
        <nav class="flex text-xs font-mono tracking-wider text-be-ink/40 uppercase mb-4 gap-2">
            <a href="{{ url('/') }}" class="hover:text-be-copper">Accueil</a>
            <span>/</span>
            <span class="text-be-ink">Historique de demandes</span>
        </nav>

        <h1 class="font-display font-bold text-3xl text-be-ink mb-8">Vos demandes de devis</h1>

        @if($orders->isEmpty())
            <div class="bg-white rounded-2xl border border-black/5 shadow-sm p-12 text-center flex flex-col items-center">
                <div class="w-20 h-20 rounded-2xl bg-be-ink flex items-center justify-center mb-6">
                    <svg class="w-9 h-9 text-white/30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <h2 class="font-display font-bold text-xl text-be-ink">Aucune demande enregistrée</h2>
                <p class="text-be-ink/50 text-sm mt-2 max-w-xs">
                    Vous n'avez pas encore effectué de demandes d'estimation ou de devis de matériel.
                </p>
                <a href="{{ route('search.index') }}" class="mt-8 inline-flex items-center gap-2 rounded-lg bg-be-amber px-6 py-3.5 text-sm font-semibold text-be-ink hover:brightness-95 transition be-focus">
                    Découvrir les produits
                </a>
            </div>
        @else
            <div class="bg-white rounded-2xl border border-black/5 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-black/5 bg-slate-50/50">
                                <th class="px-6 py-4 text-xs font-mono text-be-ink/50 uppercase">Référence</th>
                                <th class="px-6 py-4 text-xs font-mono text-be-ink/50 uppercase">Date</th>
                                <th class="px-6 py-4 text-xs font-mono text-be-ink/50 uppercase">Adresse</th>
                                <th class="px-6 py-4 text-xs font-mono text-be-ink/50 uppercase">Statut</th>
                                <th class="px-6 py-4 text-xs font-mono text-be-ink/50 uppercase"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-black/5">
                            @foreach($orders as $order)
                            <tr class="hover:bg-slate-50/40 transition-colors">
                                <td class="px-6 py-5 font-mono text-sm font-semibold text-be-copper">
                                    {{ $order->reference }}
                                </td>
                                <td class="px-6 py-5 text-sm text-be-ink/70">
                                    {{ $order->created_at->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-6 py-5 text-sm text-be-ink/60 max-w-xs truncate">
                                    {{ $order->delivery_address }}
                                </td>
                                <td class="px-6 py-5">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold
                                        @if($order->status === 'pending') bg-amber-50 text-amber-700
                                        @elseif($order->status === 'validated') bg-blue-50 text-blue-700
                                        @elseif($order->status === 'completed') bg-emerald-50 text-emerald-700
                                        @else bg-rose-50 text-rose-700 @endif">
                                        <span class="w-1.5 h-1.5 rounded-full
                                            @if($order->status === 'pending') bg-amber-500
                                            @elseif($order->status === 'validated') bg-blue-500
                                            @elseif($order->status === 'completed') bg-emerald-500
                                            @else bg-rose-500 @endif"></span>
                                        @if($order->status === 'pending') En attente
                                        @elseif($order->status === 'validated') Validée
                                        @elseif($order->status === 'completed') Livrée
                                        @else Rejetée @endif
                                    </span>
                                </td>
                                <td class="px-6 py-5 text-right">
                                    <a href="{{ route('orders.show', $order) }}" class="inline-flex items-center gap-1 text-xs font-semibold text-be-ink hover:text-be-copper transition">
                                        Détails →
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                {{-- Pagination --}}
                @if($orders->hasPages())
                    <div class="px-6 py-4 border-t border-black/5 bg-slate-50/50">
                        {{ $orders->links() }}
                    </div>
                @endif
            </div>
        @endif

    </div>
</div>
@endsection
