@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-be-cream">

    {{-- ===== HEADER ===== --}}
    <div class="bg-be-bg border-b border-white/10 py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <span class="font-mono text-xs text-be-amber tracking-widest">RECHERCHE</span>
            <h1 class="font-display font-bold text-3xl sm:text-4xl text-white mt-2">
                Trouvez votre matériel électrique
            </h1>

            {{-- Search bar --}}
            <form method="GET" action="{{ route('search.index') }}" id="search-form" class="mt-6 flex gap-3">
                <div class="relative flex-1 max-w-2xl">
                    <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-white/40" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="7"/><path stroke-linecap="round" d="m21 21-4.3-4.3"/>
                    </svg>
                    <input type="text" name="q" id="q" value="{{ request('q') }}"
                           placeholder="Câble, disjoncteur, ampoule, référence…"
                           class="w-full pl-12 pr-4 py-3.5 rounded-xl bg-white/5 border border-white/10 text-white placeholder-white/35 text-sm focus:outline-none focus:ring-2 focus:ring-be-amber">
                </div>
                <button type="submit" class="inline-flex items-center gap-2 rounded-xl bg-be-amber px-6 py-3.5 text-sm font-semibold text-be-ink hover:brightness-95 transition">
                    Rechercher
                </button>
            </form>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
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
                        <form method="GET" action="{{ route('search.index') }}" id="filter-form">
                            <input type="hidden" name="q" value="{{ request('q') }}">

                            <div class="px-5 py-4 border-b border-black/5">
                                <p class="font-display font-semibold text-be-ink text-sm flex items-center gap-2">
                                    <svg class="w-4 h-4 text-be-copper" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" d="M3 4h18M6 8h12M9 12h6M12 16h0"/>
                                    </svg>
                                    Filtrer les résultats
                                </p>
                            </div>

                            {{-- Catégorie --}}
                            <div class="px-5 py-4 border-b border-black/5">
                                <label class="block font-mono text-[11px] text-be-ink/50 tracking-wider uppercase mb-3">Catégorie</label>
                                <select name="category" onchange="document.getElementById('filter-form').submit()"
                                        class="w-full rounded-lg bg-be-cream border border-black/10 px-3 py-2 text-sm text-be-ink focus:outline-none focus:ring-2 focus:ring-be-amber">
                                    <option value="">Toutes les catégories</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Marque --}}
                            <div class="px-5 py-4 border-b border-black/5">
                                <label class="block font-mono text-[11px] text-be-ink/50 tracking-wider uppercase mb-3">Marque</label>
                                <select name="brand" onchange="document.getElementById('filter-form').submit()"
                                        class="w-full rounded-lg bg-be-cream border border-black/10 px-3 py-2 text-sm text-be-ink focus:outline-none focus:ring-2 focus:ring-be-amber">
                                    <option value="">Toutes les marques</option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}" {{ request('brand') == $brand->id ? 'selected' : '' }}>
                                            {{ $brand->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Prix --}}
                            <div class="px-5 py-4 border-b border-black/5">
                                <label class="block font-mono text-[11px] text-be-ink/50 tracking-wider uppercase mb-3">Prix (MAD)</label>
                                <div class="flex items-center gap-2">
                                    <input type="number" name="price_min" value="{{ request('price_min') }}" placeholder="Min"
                                           min="0" class="w-full rounded-lg bg-be-cream border border-black/10 px-3 py-2 text-sm text-be-ink focus:outline-none focus:ring-2 focus:ring-be-amber">
                                    <span class="text-be-ink/30 shrink-0">—</span>
                                    <input type="number" name="price_max" value="{{ request('price_max') }}" placeholder="Max"
                                           min="0" class="w-full rounded-lg bg-be-cream border border-black/10 px-3 py-2 text-sm text-be-ink focus:outline-none focus:ring-2 focus:ring-be-amber">
                                </div>
                            </div>

                            {{-- Promotions --}}
                            <div class="px-5 py-4 border-b border-black/5">
                                <label class="flex items-center gap-3 cursor-pointer">
                                    <input type="checkbox" name="promo" value="1" onchange="document.getElementById('filter-form').submit()"
                                           {{ request('promo') ? 'checked' : '' }}
                                           class="rounded border-black/10 text-be-amber focus:ring-be-amber">
                                    <span class="text-sm font-medium text-be-ink">Promotions uniquement</span>
                                    <span class="ml-auto px-2 py-0.5 rounded-full bg-be-copper text-white text-[10px] font-mono font-bold">PROMO</span>
                                </label>
                            </div>

                            {{-- Trier --}}
                            <div class="px-5 py-4 border-b border-black/5">
                                <label class="block font-mono text-[11px] text-be-ink/50 tracking-wider uppercase mb-3">Trier par</label>
                                <select name="sort" onchange="document.getElementById('filter-form').submit()"
                                        class="w-full rounded-lg bg-be-cream border border-black/10 px-3 py-2 text-sm text-be-ink focus:outline-none focus:ring-2 focus:ring-be-amber">
                                    <option value="relevance" {{ request('sort','relevance') === 'relevance' ? 'selected' : '' }}>Pertinence</option>
                                    <option value="newest"    {{ request('sort') === 'newest'    ? 'selected' : '' }}>Nouveautés</option>
                                    <option value="price_asc" {{ request('sort') === 'price_asc' ? 'selected' : '' }}>Prix croissant</option>
                                    <option value="price_desc"{{ request('sort') === 'price_desc'? 'selected' : '' }}>Prix décroissant</option>
                                </select>
                            </div>

                            {{-- Apply & reset --}}
                            <div class="px-5 py-4 flex gap-2">
                                <button type="submit" class="flex-1 rounded-lg bg-be-amber px-4 py-2.5 text-sm font-semibold text-be-ink hover:brightness-95 transition">
                                    Appliquer
                                </button>
                                <a href="{{ route('search.index', ['q' => request('q')]) }}"
                                   class="flex-1 text-center rounded-lg bg-be-cream border border-black/10 px-4 py-2.5 text-sm font-medium text-be-ink/60 hover:text-be-ink transition">
                                    Effacer
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </aside>

            {{-- ===== RESULTS ===== --}}
            <main>

                {{-- Results header --}}
                <div class="flex items-center justify-between mb-6">
                    <p class="text-sm text-be-ink/60">
                        @if(request('q'))
                            <span class="font-semibold text-be-ink">{{ $products->total() }}</span> résultat(s) pour
                            <span class="font-semibold text-be-amber">"{{ request('q') }}"</span>
                        @else
                            <span class="font-semibold text-be-ink">{{ $products->total() }}</span> produit(s)
                        @endif
                    </p>

                    {{-- Active filter pills --}}
                    <div class="flex flex-wrap gap-2">
                        @if(request('category') && $categories->find(request('category')))
                            <span class="inline-flex items-center gap-1.5 text-xs font-medium bg-be-ink text-white/80 px-3 py-1 rounded-full">
                                {{ $categories->find(request('category'))->name }}
                                <a href="{{ request()->fullUrlWithoutQuery('category') }}" class="hover:text-be-amber">✕</a>
                            </span>
                        @endif
                        @if(request('brand') && $brands->find(request('brand')))
                            <span class="inline-flex items-center gap-1.5 text-xs font-medium bg-be-ink text-white/80 px-3 py-1 rounded-full">
                                {{ $brands->find(request('brand'))->name }}
                                <a href="{{ request()->fullUrlWithoutQuery('brand') }}" class="hover:text-be-amber">✕</a>
                            </span>
                        @endif
                        @if(request('promo'))
                            <span class="inline-flex items-center gap-1.5 text-xs font-bold bg-be-copper text-white px-3 py-1 rounded-full">
                                PROMO
                                <a href="{{ request()->fullUrlWithoutQuery('promo') }}" class="hover:text-white/60">✕</a>
                            </span>
                        @endif
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
                                    <a href="#" class="w-9 h-9 rounded-md bg-be-ink text-white flex items-center justify-center hover:bg-be-amber hover:text-be-ink transition-colors" aria-label="Voir le produit">
                                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M13 6l6 6-6 6"/>
                                        </svg>
                                    </a>
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
                    {{-- Empty state --}}
                    <div class="flex flex-col items-center justify-center py-24 text-center">
                        <div class="w-20 h-20 rounded-2xl bg-be-ink flex items-center justify-center mb-6">
                            <svg class="w-9 h-9 text-white/30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <circle cx="11" cy="11" r="7"/><path stroke-linecap="round" d="m21 21-4.3-4.3"/>
                            </svg>
                        </div>
                        <h2 class="font-display font-bold text-xl text-be-ink">Aucun résultat trouvé</h2>
                        <p class="text-be-ink/50 text-sm mt-2 max-w-xs">
                            Essayez avec d'autres mots-clés ou supprimez certains filtres.
                        </p>
                        <a href="{{ route('search.index') }}" class="mt-6 inline-flex items-center gap-2 rounded-lg bg-be-amber px-5 py-2.5 text-sm font-semibold text-be-ink hover:brightness-95 transition">
                            Voir tous les produits
                        </a>
                    </div>
                @endif
            </main>
        </div>
    </div>
</div>
@endsection
