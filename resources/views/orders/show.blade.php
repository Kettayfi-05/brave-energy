@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-be-cream py-12">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Breadcrumb --}}
        <nav class="flex text-xs font-mono tracking-wider text-be-ink/40 uppercase mb-4 gap-2">
            <a href="{{ url('/') }}" class="hover:text-be-copper">Accueil</a>
            <span>/</span>
            <a href="{{ route('orders.index') }}" class="hover:text-be-copper">Historique de demandes</a>
            <span>/</span>
            <span class="text-be-ink">Détails de demande</span>
        </nav>

        @if(session('success'))
            <div class="mb-6 rounded-xl bg-emerald-50 border border-emerald-200 p-4 flex gap-3 text-sm text-emerald-800 animate-none">
                <svg class="w-5 h-5 text-emerald-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div>{{ session('success') }}</div>
            </div>
        @endif

        <div class="bg-white rounded-2xl border border-black/5 shadow-sm overflow-hidden mb-8">
            <div class="px-6 py-6 border-b border-black/5 bg-slate-50/50 flex flex-wrap items-center justify-between gap-4">
                <div>
                    <h1 class="font-display font-bold text-xl text-be-ink">Demande N° <span class="font-mono text-be-copper font-semibold">{{ $orderRequest->reference }}</span></h1>
                    <p class="text-xs text-be-ink/40 mt-1">Enregistrée le {{ $orderRequest->created_at->format('d/m/Y \à H:i') }}</p>
                </div>
                <div>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold
                        @if($orderRequest->status === 'pending') bg-amber-50 text-amber-700
                        @elseif($orderRequest->status === 'validated') bg-blue-50 text-blue-700
                        @elseif($orderRequest->status === 'completed') bg-emerald-50 text-emerald-700
                        @else bg-rose-50 text-rose-700 @endif">
                        <span class="w-1.5 h-1.5 rounded-full
                            @if($orderRequest->status === 'pending') bg-amber-500
                            @elseif($orderRequest->status === 'validated') bg-blue-500
                            @elseif($orderRequest->status === 'completed') bg-emerald-500
                            @else bg-rose-500 @endif"></span>
                        @if($orderRequest->status === 'pending') En attente de validation
                        @elseif($orderRequest->status === 'validated') Demande validée
                        @elseif($orderRequest->status === 'completed') Commande livrée
                        @else Demande rejetée @endif
                    </span>
                </div>
            </div>

            <div class="p-6 sm:p-8 grid sm:grid-cols-2 gap-8 border-b border-black/5">
                <div>
                    <h3 class="font-mono text-[11px] text-be-ink/50 tracking-wider uppercase mb-3">Informations de livraison</h3>
                    <p class="text-sm font-semibold text-be-ink">{{ $orderRequest->customer_name }}</p>
                    <p class="text-sm text-be-ink/80 mt-1">{{ $orderRequest->customer_phone }}</p>
                    <p class="text-sm text-be-ink/80">{{ $orderRequest->customer_email }}</p>
                    <p class="text-sm text-be-ink/70 mt-3 bg-be-cream/60 rounded-xl p-3 border border-black/5 leading-relaxed font-sans">{{ $orderRequest->delivery_address }}</p>
                </div>
                <div>
                    <h3 class="font-mono text-[11px] text-be-ink/50 tracking-wider uppercase mb-3">Notes ou instructions</h3>
                    @if($orderRequest->notes)
                        <p class="text-sm text-be-ink/70 bg-be-cream/60 rounded-xl p-3 border border-black/5 leading-relaxed italic">
                            "{{ $orderRequest->notes }}"
                        </p>
                    @else
                        <p class="text-sm text-be-ink/30 italic">Aucune note particulière fournie.</p>
                    @endif
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-black/5 bg-slate-50/50">
                            <th class="px-6 py-4 text-xs font-mono text-be-ink/50 uppercase">Article</th>
                            <th class="px-6 py-4 text-xs font-mono text-be-ink/50 uppercase text-center">Quantité</th>
                            <th class="px-6 py-4 text-xs font-mono text-be-ink/50 uppercase text-right">Prix Unitaire</th>
                            <th class="px-6 py-4 text-xs font-mono text-be-ink/50 uppercase text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-black/5">
                        @foreach($orderRequest->items as $item)
                        <tr>
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-lg bg-be-cream border border-black/5 overflow-hidden flex items-center justify-center shrink-0">
                                        @if($item->product->images->first())
                                            <img src="{{ asset('storage/' . $item->product->images->first()->path) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                                        @else
                                            <svg class="w-5 h-5 text-be-ink/10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                                <path d="M4 7h3l2 10h6l2-10h3M9 7v10M15 7v10"/>
                                            </svg>
                                        @endif
                                    </div>
                                    <div>
                                        <span class="font-mono text-[9px] text-be-ink/40 block">{{ $item->product->reference }}</span>
                                        <h4 class="font-medium text-xs text-be-ink mt-0.5">{{ $item->product->name }}</h4>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-5 text-center font-mono text-xs text-be-ink font-semibold">
                                {{ $item->quantity }}
                            </td>
                            <td class="px-6 py-5 text-right font-mono text-xs text-be-ink/75">
                                {{ number_format($item->product->price, 2) }} MAD
                            </td>
                            <td class="px-6 py-5 text-right font-mono text-sm font-semibold text-be-ink">
                                {{ number_format($item->product->price * $item->quantity, 2) }} MAD
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-6 bg-slate-50/60 border-t border-black/5 flex items-baseline justify-between">
                <span class="text-sm font-semibold text-be-ink">Total de l'estimation</span>
                <span class="font-mono font-bold text-xl text-be-ink">{{ number_format($total, 2) }} MAD</span>
            </div>
        </div>

        <div class="flex">
            <a href="{{ route('orders.index') }}" class="inline-flex justify-center items-center rounded-lg bg-be-cream border border-black/10 px-5 py-2.5 text-sm font-medium text-be-ink/70 hover:text-be-ink transition">
                ← Retour à l'historique
            </a>
        </div>

    </div>
</div>
@endsection
