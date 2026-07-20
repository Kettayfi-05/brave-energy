@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-be-cream py-12">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Breadcrumb --}}
        <nav class="flex text-xs font-mono tracking-wider text-be-ink/40 uppercase mb-4 gap-2">
            <a href="{{ url('/') }}" class="hover:text-be-copper">Accueil</a>
            <span>/</span>
            <span class="text-be-ink">Mon Panier</span>
        </nav>

        <h1 class="font-display font-bold text-3xl text-be-ink mb-8">Votre Panier</h1>

        @if(session('success'))
            <div class="mb-6 rounded-xl bg-emerald-50 border border-emerald-200 p-4 flex gap-3 text-sm text-emerald-800 animate-none">
                <svg class="w-5 h-5 text-emerald-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div>{{ session('success') }}</div>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 rounded-xl bg-rose-50 border border-rose-200 p-4 flex gap-3 text-sm text-rose-800 animate-none">
                <svg class="w-5 h-5 text-rose-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
                <div>{{ session('error') }}</div>
            </div>
        @endif

        @if($items->isEmpty())
            <div class="bg-white rounded-2xl border border-black/5 shadow-sm p-12 text-center flex flex-col items-center">
                <div class="w-20 h-20 rounded-2xl bg-be-ink flex items-center justify-center mb-6">
                    <svg class="w-9 h-9 text-white/30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 4h2l2.4 12.2a2 2 0 002 1.8h7.8a2 2 0 002-1.6L21 8H6"/><circle cx="9" cy="20" r="1.4"/><circle cx="18" cy="20" r="1.4"/>
                    </svg>
                </div>
                <h2 class="font-display font-bold text-xl text-be-ink">Votre panier est vide</h2>
                <p class="text-be-ink/50 text-sm mt-2 max-w-xs">
                    Ajoutez des produits de notre catalogue pour effectuer une demande de commande ou de devis.
                </p>
                <a href="{{ route('search.index') }}" class="mt-8 inline-flex items-center gap-2 rounded-lg bg-be-amber px-6 py-3.5 text-sm font-semibold text-be-ink hover:brightness-95 transition be-focus">
                    Découvrir les produits
                </a>
            </div>
        @else
            <div class="grid lg:grid-cols-[1fr_320px] gap-8 items-start">
                
                {{-- Items list --}}
                <div class="bg-white rounded-2xl border border-black/5 shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-black/5 bg-slate-50/50">
                                    <th class="px-6 py-4 text-xs font-mono text-be-ink/50 uppercase">Produit</th>
                                    <th class="px-6 py-4 text-xs font-mono text-be-ink/50 uppercase text-center">Quantité</th>
                                    <th class="px-6 py-4 text-xs font-mono text-be-ink/50 uppercase text-right">Prix (MAD)</th>
                                    <th class="px-6 py-4 text-xs font-mono text-be-ink/50 uppercase"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-black/5">
                                @foreach($items as $item)
                                <tr>
                                    <td class="px-6 py-6">
                                        <div class="flex items-center gap-4">
                                            <div class="w-16 h-16 rounded-xl bg-be-cream border border-black/5 flex-shrink-0 overflow-hidden flex items-center justify-center">
                                                @if($item->product->images->first())
                                                    <img src="{{ asset('storage/' . $item->product->images->first()->path) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                                                @else
                                                    <svg class="w-7 h-7 text-be-ink/10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                                        <path d="M4 7h3l2 10h6l2-10h3M9 7v10M15 7v10"/>
                                                    </svg>
                                                @endif
                                            </div>
                                            <div>
                                                <span class="font-mono text-[10px] text-be-ink/40 block">{{ $item->product->reference }}</span>
                                                <h3 class="font-medium text-sm text-be-ink leading-snug line-clamp-2 mt-0.5">{{ $item->product->name }}</h3>
                                                @if($item->product->category)
                                                    <span class="text-[11px] text-be-copper font-mono mt-0.5 block">{{ $item->product->category->name }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-6 text-center">
                                        <form method="POST" action="{{ route('cart.update', $item) }}" class="inline-flex items-center bg-be-cream rounded-lg p-1 border border-black/5">
                                            @csrf @method('PATCH')
                                            <button type="submit" name="quantity" value="{{ max(1, $item->quantity - 1) }}" class="w-7 h-7 rounded flex items-center justify-center text-be-ink/60 hover:bg-white hover:text-be-ink transition focus:outline-none" {{ $item->quantity <= 1 ? 'disabled' : '' }}>
                                                —
                                            </button>
                                            <input type="text" readonly value="{{ $item->quantity }}" class="w-10 text-center font-mono text-sm bg-transparent border-0 p-0 text-be-ink focus:ring-0">
                                            <button type="submit" name="quantity" value="{{ $item->quantity + 1 }}" class="w-7 h-7 rounded flex items-center justify-center text-be-ink/60 hover:bg-white hover:text-be-ink transition focus:outline-none">
                                                +
                                            </button>
                                        </form>
                                    </td>
                                    <td class="px-6 py-6 text-right font-mono text-sm font-semibold text-be-ink">
                                        {{ number_format($item->product->price * $item->quantity, 2) }}
                                    </td>
                                    <td class="px-6 py-6 text-center">
                                        <form method="POST" action="{{ route('cart.destroy', $item) }}" onsubmit="return confirm('Retirer ce produit du panier ?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="p-2 rounded-lg hover:bg-red-50 text-slate-400 hover:text-red-500 transition-colors" title="Retirer">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Summary --}}
                <div class="bg-white rounded-2xl border border-black/5 shadow-sm p-6 space-y-6">
                    <h2 class="font-display font-bold text-lg text-be-ink">Estimation</h2>
                    
                    <div class="space-y-3 pb-6 border-b border-black/5 text-sm">
                        <div class="flex items-center justify-between text-be-ink/60">
                            <span>Articles ({{ $items->sum('quantity') }})</span>
                            <span class="font-mono">{{ number_format($total, 2) }} MAD</span>
                        </div>
                        <div class="flex items-center justify-between text-be-ink/60">
                            <span>TVA (Estimée)</span>
                            <span class="font-mono">Inclus</span>
                        </div>
                    </div>

                    <div class="flex items-baseline justify-between">
                        <span class="text-sm font-semibold text-be-ink">Total Estimé</span>
                        <span class="font-mono font-bold text-lg text-be-ink">{{ number_format($total, 2) }} MAD</span>
                    </div>

                    <div class="space-y-2">
                        <a href="{{ route('orders.checkout') }}" class="w-full inline-flex justify-center items-center rounded-lg bg-be-amber px-4 py-3 text-sm font-semibold text-be-ink hover:brightness-95 transition be-focus">
                            Passer la commande
                        </a>
                        <a href="{{ route('search.index') }}" class="w-full inline-flex justify-center items-center rounded-lg bg-be-cream border border-black/10 px-4 py-3 text-sm font-medium text-be-ink/60 hover:text-be-ink transition">
                            Continuer les achats
                        </a>
                    </div>
                </div>

            </div>
        @endif

    </div>
</div>
@endsection
