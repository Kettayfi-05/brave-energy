@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-be-cream py-12">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Breadcrumb --}}
        <nav class="flex text-xs font-mono tracking-wider text-be-ink/40 uppercase mb-4 gap-2">
            <a href="{{ url('/') }}" class="hover:text-be-copper">Accueil</a>
            <span>/</span>
            <span class="text-be-ink">Ma Wishlist</span>
        </nav>

        <h1 class="font-display font-bold text-3xl text-be-ink mb-8">Vos produits favoris</h1>

        @if(session('success'))
            <div class="mb-6 rounded-xl bg-emerald-50 border border-emerald-200 p-4 flex gap-3 text-sm text-emerald-800 animate-none">
                <svg class="w-5 h-5 text-emerald-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div>{{ session('success') }}</div>
            </div>
        @endif

        @if($favorites->isEmpty())
            <div class="bg-white rounded-2xl border border-black/5 shadow-sm p-12 text-center flex flex-col items-center">
                <div class="w-20 h-20 rounded-2xl bg-be-ink flex items-center justify-center mb-6">
                    <svg class="w-9 h-9 text-white/30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                </div>
                <h2 class="font-display font-bold text-xl text-be-ink">Votre liste est vide</h2>
                <p class="text-be-ink/50 text-sm mt-2 max-w-xs">
                    Ajoutez des produits en favoris depuis le catalogue pour les retrouver et les commander facilement plus tard.
                </p>
                <a href="{{ route('search.index') }}" class="mt-8 inline-flex items-center gap-2 rounded-lg bg-be-amber px-6 py-3.5 text-sm font-semibold text-be-ink hover:brightness-95 transition be-focus">
                    Découvrir les produits
                </a>
            </div>
        @else
            <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach($favorites as $fav)
                    @php $product = $fav->product; @endphp
                    <div class="group rounded-xl border border-black/10 hover:border-be-amber/60 hover:shadow-lg transition-all overflow-hidden bg-white be-focus">
                        <div class="relative aspect-[4/3] bg-be-cream flex items-center justify-center">
                            @if($product->old_price)
                                <span class="absolute top-3 left-3 text-[10px] font-mono font-semibold px-2 py-1 rounded bg-be-copper text-white">PROMO</span>
                            @endif
                            
                            {{-- Toggle Favorite Form (Delete) --}}
                            <form method="POST" action="{{ route('wishlist.toggle', $product) }}" class="absolute top-3 right-3 z-10">
                                @csrf
                                <button type="submit" class="w-8 h-8 rounded-full bg-white/95 border border-black/5 flex items-center justify-center text-red-500 hover:scale-105 transition active:scale-95 shadow-sm" title="Retirer des favoris">
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                    </svg>
                                </button>
                            </form>

                            @if($product->images->first())
                                <img src="{{ asset('storage/' . $product->images->first()->path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                            @else
                                <svg class="w-12 h-12 text-be-ink/10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path d="M4 7h3l2 10h6l2-10h3M9 7v10M15 7v10"/>
                                </svg>
                            @endif
                        </div>
                        <div class="p-4">
                            <span class="font-mono text-[9px] text-be-ink/35">{{ $product->reference }}</span>
                            <h3 class="font-medium text-xs text-be-ink mt-0.5 line-clamp-2 min-h-[32px] leading-snug">{{ $product->name }}</h3>
                            
                            <div class="mt-4 flex items-center justify-between gap-4">
                                <div class="flex items-baseline gap-1.5">
                                    <span class="font-mono font-semibold text-sm text-be-ink">{{ number_format($product->price, 2) }} MAD</span>
                                    @if($product->old_price)
                                        <span class="font-mono text-[10px] text-be-ink/30 line-through">{{ number_format($product->old_price, 2) }}</span>
                                    @endif
                                </div>
                                
                                {{-- Add to Cart Form --}}
                                <form method="POST" action="{{ route('cart.store') }}">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button type="submit" class="inline-flex items-center gap-1.5 rounded-lg bg-be-amber px-3 py-2 text-xs font-semibold text-be-ink hover:brightness-95 transition be-focus" title="Ajouter au panier">
                                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M3 4h2l2.4 12.2a2 2 0 002 1.8h7.8a2 2 0 002-1.6L21 8H6"/><circle cx="9" cy="20" r="1.4"/><circle cx="18" cy="20" r="1.4"/>
                                        </svg>
                                        Ajouter
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
@endsection
