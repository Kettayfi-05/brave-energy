@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-be-cream">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        
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

        <div class="lg:grid lg:grid-cols-[280px_1fr] gap-8">

            {{-- ===== SIDEBAR FILTERS ===== --}}
            <aside class="mb-8 lg:mb-0" x-data="{ filtersOpen: false }">
                <div class="bg-white rounded-2xl border border-black/5 shadow-sm overflow-hidden">

                    {{-- Mobile toggle --}}
                    <button @click="filtersOpen = !filtersOpen"
                            class="lg:hidden w-full flex items-center justify-between px-5 py-4 font-semibold text-be-ink text-sm">
                        <span class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-be-copper" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" d="M3 4h18M6 8h12M9 12h6M12 16h0"/>
                            </svg>
                            Filtres
                        </span>
                        <svg class="w-4 h-4 transition-transform" :class="filtersOpen ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <div class="hidden lg:block" :class="filtersOpen ? '!block' : ''">
                        <form method="GET" action="{{ route('promotions') }}" id="filter-form">
                            <input type="hidden" name="q" value="{{ request('q') }}">

                            {{-- Categories filter --}}
                            <div class="p-5 border-b border-black/5">
                                <h3 class="font-display font-semibold text-be-ink text-sm tracking-wide">RAYONS</h3>
                                <div class="mt-4 space-y-2">
                                    <label class="flex items-center cursor-pointer">
                                        <input type="radio" name="category" value="" class="rounded-full border-black/10 text-be-amber focus:ring-be-amber"
                                               {{ !request('category') ? 'checked' : '' }} onchange="document.getElementById('filter-form').submit()">
                                        <span class="ml-2 text-xs text-be-ink/70 font-medium">Tous les rayons</span>
                                    </label>
                                    @foreach($categories as $cat)
                                        <label class="flex items-center cursor-pointer">
                                            <input type="radio" name="category" value="{{ $cat->id }}" class="rounded-full border-black/10 text-be-amber focus:ring-be-amber"
                                                   {{ request('category') == $cat->id ? 'checked' : '' }} onchange="document.getElementById('filter-form').submit()">
                                            <span class="ml-2 text-xs text-be-ink/70 font-medium">{{ $cat->name }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            {{-- Brand filter --}}
                            <div class="p-5 border-b border-black/5">
                                <h3 class="font-display font-semibold text-be-ink text-sm tracking-wide">MARQUES</h3>
                                <div class="mt-4 space-y-2">
                                    <label class="flex items-center cursor-pointer">
                                        <input type="radio" name="brand" value="" class="rounded-full border-black/10 text-be-amber focus:ring-be-amber"
                                               {{ !request('brand') ? 'checked' : '' }} onchange="document.getElementById('filter-form').submit()">
                                        <span class="ml-2 text-xs text-be-ink/70 font-medium">Toutes les marques</span>
                                    </label>
                                    @foreach($brands as $brand)
                                        <label class="flex items-center cursor-pointer">
                                            <input type="radio" name="brand" value="{{ $brand->id }}" class="rounded-full border-black/10 text-be-amber focus:ring-be-amber"
                                                   {{ request('brand') == $brand->id ? 'checked' : '' }} onchange="document.getElementById('filter-form').submit()">
                                            <span class="ml-2 text-xs text-be-ink/70 font-medium">{{ $brand->name }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            {{-- Price range --}}
                            <div class="p-5">
                                <h3 class="font-display font-semibold text-be-ink text-sm tracking-wide">PRIX (MAD)</h3>
                                <div class="mt-4 grid grid-cols-2 gap-3">
                                    <div>
                                        <label class="block font-mono text-[10px] text-be-ink/40 uppercase mb-1">Min</label>
                                        <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="0"
                                               class="w-full rounded bg-be-cream border-0 px-2 py-1.5 font-mono text-xs text-be-ink focus:ring-1 focus:ring-be-amber">
                                    </div>
                                    <div>
                                        <label class="block font-mono text-[10px] text-be-ink/40 uppercase mb-1">Max</label>
                                        <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="10000"
                                               class="w-full rounded bg-be-cream border-0 px-2 py-1.5 font-mono text-xs text-be-ink focus:ring-1 focus:ring-be-amber">
                                    </div>
                                </div>
                                <button type="submit" class="w-full mt-4 bg-be-ink text-white font-semibold text-xs py-2 rounded hover:bg-be-amber hover:text-be-ink transition">
                                    Appliquer les filtres
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </aside>

            {{-- ===== RESULTS ===== --}}
            <main>
                {{-- Header --}}
                <div class="flex items-center justify-between flex-wrap gap-4 mb-6">
                    <div>
                        <h1 class="font-display font-bold text-2xl sm:text-3xl text-be-ink">Nos Promotions</h1>
                        <p class="text-xs text-be-ink/45 mt-1">{{ $products->total() }} produit(s) en promotion trouvé(s)</p>
                    </div>

                    {{-- Sorting --}}
                    <div>
                        <select name="sort" form="filter-form" onchange="document.getElementById('filter-form').submit()"
                                class="rounded bg-white border border-black/5 font-medium text-xs text-be-ink/70 px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-be-amber cursor-pointer">
                            <option value="relevance" {{ request('sort') == 'relevance' ? 'selected' : '' }}>Trier par pertinence</option>
                            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Prix : croissant</option>
                            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Prix : décroissant</option>
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Nouveautés</option>
                        </select>
                    </div>
                </div>

                {{-- Grid --}}
                @if($products->count() > 0)
                    <div class="grid sm:grid-cols-2 xl:grid-cols-3 gap-5">
                        @foreach($products as $product)
                        <div class="group rounded-xl border border-black/10 hover:border-be-amber/60 hover:shadow-lg transition-all overflow-hidden bg-white be-focus">
                            <div class="relative aspect-[4/3] bg-be-cream flex items-center justify-center">
                                @if($product->old_price)
                                    <span class="absolute top-3 left-3 text-[10px] font-mono font-semibold px-2 py-1 rounded bg-be-copper text-white">PROMO</span>
                                @endif
                                
                                @auth
                                    @if(Auth::user()->role !== 'admin')
                                        @php
                                            $isFav = Auth::user()->favorites->contains('product_id', $product->id);
                                        @endphp
                                        <form method="POST" action="{{ route('wishlist.toggle', $product) }}" class="absolute top-3 right-3 z-10">
                                            @csrf
                                            <button type="submit" class="w-8 h-8 rounded-full bg-white/90 border border-black/5 flex items-center justify-center text-be-ink hover:text-red-500 hover:scale-105 transition active:scale-95 shadow-sm" title="Favoris">
                                                <svg class="w-4 h-4 {{ $isFav ? 'fill-current text-red-500' : 'fill-none' }}" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                                </svg>
                                            </button>
                                        </form>
                                    @endif
                                @else
                                    <button @click="loginOpen = true" class="absolute top-3 right-3 z-10 w-8 h-8 rounded-full bg-white/90 border border-black/5 flex items-center justify-center text-be-ink hover:text-red-500 hover:scale-105 transition active:scale-95 shadow-sm" title="Favoris">
                                        <svg class="w-4 h-4 fill-none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                        </svg>
                                    </button>
                                @endauth

                                @if($product->images->first())
                                    <img src="{{ asset('storage/'.$product->images->first()->path) }}"
                                         alt="{{ $product->name }}"
                                         class="w-full h-full object-cover">
                                @else
                                    <svg class="w-14 h-14 text-be-ink/10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 7h3l2 10h6l2-10h3M9 7v10M15 7v10"/>
                                    </svg>
                                @endif
                            </div>
                            <div class="p-4">
                                <span class="font-mono text-[10px] text-be-ink/35">{{ $product->reference ?? '—' }}</span>
                                <h3 class="font-medium text-sm text-be-ink mt-1 leading-snug line-clamp-2">{{ $product->name }}</h3>
                                @if($product->category)
                                    <span class="text-[11px] text-be-copper font-mono">{{ $product->category->name }}</span>
                                @endif
                                <div class="mt-3 flex items-center justify-between">
                                    <div class="flex items-baseline gap-2">
                                        <span class="font-mono font-semibold text-be-ink">{{ number_format($product->price, 2) }} MAD</span>
                                        @if($product->old_price)
                                            <span class="font-mono text-xs text-be-ink/35 line-through">{{ number_format($product->old_price, 2) }}</span>
                                        @endif
                                    </div>
                                    @auth
                                        @if(Auth::user()->role !== 'admin')
                                            <form method="POST" action="{{ route('cart.store') }}">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <button type="submit" class="w-9 h-9 rounded-md bg-be-ink text-white flex items-center justify-center hover:bg-be-amber hover:text-be-ink transition-colors be-focus" aria-label="Ajouter au panier" title="Ajouter au panier">
                                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 4h2l2.4 12.2a2 2 0 002 1.8h7.8a2 2 0 002-1.6L21 8H6"/><circle cx="9" cy="20" r="1.4"/><circle cx="18" cy="20" r="1.4"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        @endif
                                    @else
                                        <button @click="loginOpen = true" class="w-9 h-9 rounded-md bg-be-ink text-white flex items-center justify-center hover:bg-be-amber hover:text-be-ink transition-colors be-focus" aria-label="Ajouter au panier" title="Ajouter au panier">
                                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 4h2l2.4 12.2a2 2 0 002 1.8h7.8a2 2 0 002-1.6L21 8H6"/><circle cx="9" cy="20" r="1.4"/><circle cx="18" cy="20" r="1.4"/>
                                            </svg>
                                        </button>
                                    @endauth
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-10">
                        {{ $products->links() }}
                    </div>
                @else
                    <div class="bg-white rounded-2xl border border-black/5 shadow-sm p-12 text-center flex flex-col items-center">
                        <div class="w-20 h-20 rounded-2xl bg-be-cream flex items-center justify-center mb-6">
                            <svg class="w-8 h-8 text-be-ink/30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                <circle cx="11" cy="11" r="7"/><path stroke-linecap="round" d="m21 21-4.3-4.3"/>
                            </svg>
                        </div>
                        <h2 class="font-display font-bold text-xl text-be-ink">Aucune promotion trouvée</h2>
                        <p class="text-be-ink/50 text-sm mt-2 max-w-xs">
                            Aucun produit en promotion ne correspond à vos critères de recherche.
                        </p>
                        <a href="{{ route('promotions') }}" class="mt-6 bg-be-amber text-be-ink font-semibold text-xs px-5 py-3 rounded-lg hover:brightness-95 transition">
                            Réinitialiser la recherche
                        </a>
                    </div>
                @endif
            </main>

        </div>
    </div>
</div>
@endsection
