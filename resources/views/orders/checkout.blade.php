@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-be-cream py-12">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Breadcrumb --}}
        <nav class="flex text-xs font-mono tracking-wider text-be-ink/40 uppercase mb-4 gap-2">
            <a href="{{ url('/') }}" class="hover:text-be-copper">Accueil</a>
            <span>/</span>
            <a href="{{ route('cart.index') }}" class="hover:text-be-copper">Mon Panier</a>
            <span>/</span>
            <span class="text-be-ink">Validation</span>
        </nav>

        <h1 class="font-display font-bold text-3xl text-be-ink mb-8">Valider votre demande</h1>

        <div class="grid lg:grid-cols-[1fr_360px] gap-8 items-start">
            
            {{-- Delivery and Billing Form --}}
            <div class="bg-white rounded-2xl border border-black/5 shadow-sm p-6 sm:p-8">
                <h2 class="font-display font-bold text-xl text-be-ink mb-6">Informations de livraison</h2>
                
                <form method="POST" action="{{ route('orders.store') }}" class="space-y-5">
                    @csrf

                    <div class="grid sm:grid-cols-2 gap-5">
                        <div>
                            <label for="customer_name" class="block font-mono text-[11px] text-be-ink/50 tracking-wider uppercase mb-1.5">Nom complet</label>
                            <input id="customer_name" type="text" name="customer_name" value="{{ old('customer_name', Auth::user()->name) }}" required
                                   class="w-full rounded-lg bg-be-cream border border-black/10 px-4 py-2.5 text-sm text-be-ink placeholder-be-ink/30 focus:outline-none focus:ring-2 focus:ring-be-amber">
                            @error('customer_name') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="customer_email" class="block font-mono text-[11px] text-be-ink/50 tracking-wider uppercase mb-1.5">Adresse Email</label>
                            <input id="customer_email" type="email" name="customer_email" value="{{ old('customer_email', Auth::user()->email) }}" required
                                   class="w-full rounded-lg bg-be-cream border border-black/10 px-4 py-2.5 text-sm text-be-ink placeholder-be-ink/30 focus:outline-none focus:ring-2 focus:ring-be-amber">
                            @error('customer_email') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label for="customer_phone" class="block font-mono text-[11px] text-be-ink/50 tracking-wider uppercase mb-1.5">Téléphone de contact</label>
                        <input id="customer_phone" type="text" name="customer_phone" value="{{ old('customer_phone', Auth::user()->phone) }}" required placeholder="ex : +212 600 000000"
                               class="w-full rounded-lg bg-be-cream border border-black/10 px-4 py-2.5 text-sm text-be-ink placeholder-be-ink/30 focus:outline-none focus:ring-2 focus:ring-be-amber">
                        @error('customer_phone') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="delivery_address" class="block font-mono text-[11px] text-be-ink/50 tracking-wider uppercase mb-1.5">Adresse de livraison complète</label>
                        <textarea id="delivery_address" name="delivery_address" rows="3" required placeholder="Rue, Quartier, Code postal, Ville, Province..."
                                  class="w-full rounded-lg bg-be-cream border border-black/10 px-4 py-2.5 text-sm text-be-ink placeholder-be-ink/30 focus:outline-none focus:ring-2 focus:ring-be-amber resize-none">{{ old('delivery_address', Auth::user()->address) }}</textarea>
                        @error('delivery_address') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="notes" class="block font-mono text-[11px] text-be-ink/50 tracking-wider uppercase mb-1.5">Instructions ou notes particulières <span class="text-be-ink/30 font-normal">(Optionnel)</span></label>
                        <textarea id="notes" name="notes" rows="3" placeholder="Notes complémentaires pour la livraison..."
                                  class="w-full rounded-lg bg-be-cream border border-black/10 px-4 py-2.5 text-sm text-be-ink placeholder-be-ink/30 focus:outline-none focus:ring-2 focus:ring-be-amber resize-none">{{ old('notes') }}</textarea>
                        @error('notes') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="pt-4 border-t border-black/5 flex items-center justify-between gap-4">
                        <a href="{{ route('cart.index') }}" class="text-sm font-semibold text-be-ink/60 hover:text-be-ink transition">
                            ← Retour au panier
                        </a>
                        <button type="submit" class="inline-flex items-center gap-2 rounded-lg bg-be-amber px-6 py-3.5 text-sm font-semibold text-be-ink hover:brightness-95 transition be-focus">
                            Envoyer la demande de commande
                        </button>
                    </div>
                </form>
            </div>

            {{-- Order Summary Sidebar --}}
            <div class="bg-white rounded-2xl border border-black/5 shadow-sm p-6 space-y-6">
                <h3 class="font-display font-bold text-lg text-be-ink pb-3 border-b border-black/5">Récapitulatif</h3>
                
                <div class="divide-y divide-black/5 max-h-60 overflow-y-auto">
                    @foreach($items as $item)
                        <div class="py-3 flex gap-3 text-sm">
                            <div class="w-10 h-10 rounded-lg bg-be-cream border border-black/5 shrink-0 overflow-hidden flex items-center justify-center">
                                @if($item->product->images->first())
                                    <img src="{{ asset('storage/' . $item->product->images->first()->path) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                                @else
                                    <svg class="w-5 h-5 text-be-ink/10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                        <path d="M4 7h3l2 10h6l2-10h3M9 7v10M15 7v10"/>
                                    </svg>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="font-medium text-xs text-be-ink truncate">{{ $item->product->name }}</h4>
                                <span class="font-mono text-[10px] text-be-ink/40">Qté: {{ $item->quantity }}</span>
                            </div>
                            <span class="font-mono text-xs font-semibold text-be-ink shrink-0">
                                {{ number_format($item->product->price * $item->quantity, 2) }} MAD
                            </span>
                        </div>
                    @endforeach
                </div>

                <div class="pt-4 border-t border-black/5 space-y-3 text-sm">
                    <div class="flex items-center justify-between text-be-ink/60">
                        <span>Nombre d'articles</span>
                        <span class="font-mono font-medium">{{ $items->sum('quantity') }}</span>
                    </div>
                    <div class="flex items-baseline justify-between pt-2">
                        <span class="font-semibold text-be-ink">Total Estimé</span>
                        <span class="font-mono font-bold text-base text-be-ink">{{ number_format($total, 2) }} MAD</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
