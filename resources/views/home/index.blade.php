@extends('layouts.app')

@section('content')
    {{-- ===================== HERO ===================== --}}
    <section class="relative bg-be-bg be-hero-grid overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-b from-transparent via-be-bg/40 to-be-bg"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-28 grid lg:grid-cols-2 gap-12 items-center">

            <div class="be-rise">
                <span class="inline-flex items-center gap-2 rounded-full bg-white/5 border border-white/10 px-3 py-1 text-xs font-mono text-be-amber">
                    <span class="w-1.5 h-1.5 rounded-full bg-be-amber"></span>
                    FOURNISSEUR ÉLECTRIQUE — GROS &amp; DÉTAIL
                </span>

                <h1 class="font-display font-bold text-4xl sm:text-5xl lg:text-[3.4rem] leading-[1.05] text-white mt-5">
                    L'énergie qui alimente<br class="hidden sm:block">
                    <span class="text-be-amber">vos installations.</span>
                </h1>

                <p class="mt-5 text-white/60 text-base sm:text-lg max-w-lg">
                    Câbles, rallonges, disjoncteurs, ampoules et accessoires électriques certifiés,
                    au meilleur prix, livrés partout au Maroc — pour les professionnels comme pour les particuliers.
                </p>

                <div class="mt-8 flex flex-wrap items-center gap-4">
                    <a href="#categories" class="inline-flex items-center gap-2 rounded-md bg-be-amber px-6 py-3.5 font-semibold text-be-ink hover:brightness-95 transition be-focus">
                        Découvrir le catalogue
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M13 6l6 6-6 6"/></svg>
                    </a>
                    <a href="#produits" class="inline-flex items-center gap-2 rounded-md border border-white/15 px-6 py-3.5 font-semibold text-white hover:bg-white/5 transition be-focus">
                        Voir les promotions
                    </a>
                </div>

                <div class="mt-10 flex flex-wrap gap-x-8 gap-y-3 font-mono text-xs text-white/45">
                    <span>+2 400 RÉFÉRENCES</span>
                    <span>NORMES NF / CE</span>
                    <span>LIVRAISON 24–48H</span>
                </div>
            </div>

            {{-- Illustration : "panneau de disjoncteurs" --}}
            <div class="be-rise be-rise-2 relative mx-auto w-full max-w-md">
                <div class="rounded-2xl bg-be-bg-2 border border-white/10 p-6 shadow-2xl shadow-black/40">
                    <div class="flex items-center justify-between mb-5">
                        <span class="font-mono text-[11px] text-white/40">TABLEAU — ÉTAT DU RÉSEAU</span>
                        <span class="flex items-center gap-1.5 font-mono text-[11px] text-be-green">
                            <span class="w-1.5 h-1.5 rounded-full bg-be-green be-live-dot"></span> EN LIGNE
                        </span>
                    </div>
                    <div class="grid grid-cols-4 gap-3">
                        @php $states = [1,1,0,1,1,1,0,1,1,1,1,0]; @endphp
                        @foreach ($states as $on)
                            <div class="rounded-md bg-be-bg border border-white/10 h-14 flex items-center justify-center">
                                <div class="w-4 h-8 rounded-sm {{ $on ? 'bg-be-amber' : 'bg-white/10' }} relative">
                                    <div class="absolute left-1/2 -translate-x-1/2 w-2.5 h-2.5 rounded-full bg-be-bg-2 {{ $on ? 'top-1' : 'bottom-1' }}"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <p class="mt-5 font-mono text-[11px] text-white/30 leading-relaxed">
                        10/12 CIRCUITS ACTIFS · TENSION 220V · CONFORME NF C 15-100
                    </p>
                </div>
                <div class="absolute -z-10 -inset-6 rounded-[2rem] bg-be-amber/10 blur-2xl"></div>
            </div>
        </div>
    </section>

    {{-- ===================== BANDEAU DE CONFIANCE ===================== --}}
    <section class="bg-be-ink border-t border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach ([
                ['icon' => 'M20 12V8a2 2 0 00-2-2H4a2 2 0 00-2 2v8a2 2 0 002 2h9m0-5h7m0 0-3-3m3 3-3 3', 'label' => 'Livraison rapide partout au Maroc'],
                ['icon' => 'M12 3l7 3v6c0 4.5-3 7.5-7 9-4-1.5-7-4.5-7-9V6l7-3z', 'label' => 'Matériel certifié NF / CE'],
                ['icon' => 'M12 2v4M12 18v4M4.9 4.9l2.8 2.8M16.3 16.3l2.8 2.8M2 12h4M18 12h4M4.9 19.1l2.8-2.8M16.3 7.7l2.8-2.8', 'label' => 'Paiement 100% sécurisé'],
                ['icon' => 'M9 18h6M10 21h4M12 3a6 6 0 00-4 10.5c.6.6 1 1.4 1 2.5h6c0-1.1.4-1.9 1-2.5A6 6 0 0012 3z', 'label' => 'Conseil technique dédié'],
            ] as $item)
                <div class="flex items-center gap-3">
                    <svg class="w-7 h-7 text-be-amber shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $item['icon'] }}"/></svg>
                    <span class="text-xs sm:text-sm text-white/70 font-medium leading-tight">{{ $item['label'] }}</span>
                </div>
            @endforeach
        </div>
    </section>

    {{-- ===================== CATÉGORIES — cartes "interrupteur" ===================== --}}
    <section id="categories" class="py-20 bg-be-cream">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-end justify-between flex-wrap gap-4 mb-10">
                <div>
                    <span class="font-mono text-xs text-be-copper tracking-wide">NOS RAYONS</span>
                    <h2 class="font-display font-bold text-3xl sm:text-4xl text-be-ink mt-2">
                        Tout le matériel électrique,<br class="hidden sm:block"> sous un même toit.
                    </h2>
                </div>
                <p class="text-be-ink/60 max-w-sm text-sm">
                    Survolez une catégorie : l'interrupteur s'allume — comme sur un vrai tableau électrique.
                </p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
                @php
                    $categories = [
                        ['name' => 'Câbles &amp; fils électriques', 'desc' => 'Rigides, souples, RO2V, U1000…', 'icon' => 'M4 7h3l2 10h6l2-10h3M9 7v10M15 7v10'],
                        ['name' => 'Rallonges &amp; multiprises', 'desc' => 'Enrouleurs, blocs parasurtenseurs', 'icon' => 'M4 12h6m4 0h6M10 12a2 2 0 104 0 2 2 0 00-4 0z'],
                        ['name' => 'Disjoncteurs &amp; tableaux', 'desc' => 'Différentiels, coffrets, modulaires', 'icon' => 'M6 3h12v18H6V3zM10 8h4v4h-4z'],
                        ['name' => 'Ampoules &amp; éclairage LED', 'desc' => 'Spots, rubans, projecteurs', 'icon' => 'M9 18h6M10 21h4M12 3a6 6 0 00-4 10.5c.6.6 1 1.4 1 2.5h6c0-1.1.4-1.9 1-2.5A6 6 0 0012 3z'],
                        ['name' => 'Interrupteurs &amp; prises', 'desc' => 'Va-et-vient, prises étanches', 'icon' => 'M5 12a7 7 0 1114 0 7 7 0 01-14 0zM12 9v3l2 2'],
                        ['name' => 'Outillage électricien', 'desc' => 'Pinces, testeurs, sertisseuses', 'icon' => 'M14.7 6.3a4 4 0 00-5.4 5.4L4 17l3 3 5.3-5.3a4 4 0 005.4-5.4l-2.5 2.5-2-2 2.5-2.5z'],
                    ];
                @endphp

                @foreach ($categories as $cat)
                    <a href="#" class="group relative rounded-xl bg-be-bg-2 p-6 overflow-hidden be-focus">
                        <div class="flex items-start justify-between">
                            <span class="w-12 h-12 rounded-lg bg-white/5 flex items-center justify-center text-white/70 group-hover:text-be-amber transition-colors">
                                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $cat['icon'] }}"/></svg>
                            </span>
                            {{-- Interrupteur --}}
                            <span class="w-8 h-5 rounded-full bg-white/10 group-hover:bg-be-amber/90 transition-colors relative shrink-0">
                                <span class="absolute top-0.5 left-0.5 w-4 h-4 rounded-full bg-white/70 group-hover:bg-be-ink group-hover:translate-x-3 transition-transform"></span>
                            </span>
                        </div>
                        <h3 class="font-display font-semibold text-white mt-5 text-base">{!! $cat['name'] !!}</h3>
                        <p class="text-white/40 text-sm mt-1">{{ $cat['desc'] }}</p>
                        <span class="inline-flex items-center gap-1 text-xs font-mono text-be-amber mt-4 opacity-0 group-hover:opacity-100 transition-opacity">
                            VOIR LES PRODUITS
                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M13 6l6 6-6 6"/></svg>
                        </span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ===================== PRODUITS PHARES ===================== --}}
    <section id="produits" class="py-20 bg-white border-y border-black/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-end justify-between flex-wrap gap-4 mb-10">
                <div>
                    <span class="font-mono text-xs text-be-copper tracking-wide">SÉLECTION</span>
                    <h2 class="font-display font-bold text-3xl sm:text-4xl text-be-ink mt-2">Meilleures ventes du mois</h2>
                </div>
                <a href="#" class="text-sm font-semibold text-be-copper hover:text-be-ink transition-colors be-focus rounded">
                    Voir tout le catalogue →
                </a>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @php
                    $products = [
                        ['name' => 'Câble souple H07V-K 2.5mm² (100m)', 'ref' => 'CBL-2540', 'price' => '420', 'old' => '480', 'badge' => 'PROMO'],
                        ['name' => 'Disjoncteur différentiel 30mA 40A', 'ref' => 'DJC-4030', 'price' => '265', 'old' => null, 'badge' => 'NOUVEAU'],
                        ['name' => 'Rallonge électrique 5m avec 3 prises', 'ref' => 'RAL-503P', 'price' => '89', 'old' => null, 'badge' => null],
                        ['name' => 'Ampoule LED E27 12W lumière du jour', 'ref' => 'LED-E2712', 'price' => '19', 'old' => '29', 'badge' => 'PROMO'],
                    ];
                @endphp

                @foreach ($products as $p)
                    <div class="group rounded-xl border border-black/10 hover:border-be-amber/60 hover:shadow-lg transition-all overflow-hidden be-focus">
                        <div class="relative aspect-[4/3] bg-be-cream flex items-center justify-center">
                            @if($p['badge'])
                                <span class="absolute top-3 left-3 text-[10px] font-mono font-semibold px-2 py-1 rounded {{ $p['badge'] === 'PROMO' ? 'bg-be-copper text-white' : 'bg-be-amber' }} {{ $p['badge'] === 'PROMO' ? '' : 'text-be-ink' }}">
                                    {{ $p['badge'] }}
                                </span>
                            @endif
                            <svg class="w-14 h-14 text-be-ink/15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4"><path stroke-linecap="round" stroke-linejoin="round" d="M4 7h3l2 10h6l2-10h3M9 7v10M15 7v10"/></svg>
                        </div>
                        <div class="p-4">
                            <span class="font-mono text-[10px] text-be-ink/35">{{ $p['ref'] }}</span>
                            <h3 class="font-medium text-sm text-be-ink mt-1 leading-snug">{{ $p['name'] }}</h3>
                            <div class="mt-3 flex items-center justify-between">
                                <div class="flex items-baseline gap-2">
                                    <span class="font-mono font-semibold text-be-ink">{{ $p['price'] }} MAD</span>
                                    @if($p['old'])
                                        <span class="font-mono text-xs text-be-ink/35 line-through">{{ $p['old'] }}</span>
                                    @endif
                                </div>
                                <button type="button" class="w-9 h-9 rounded-md bg-be-ink text-white flex items-center justify-center hover:bg-be-amber hover:text-be-ink transition-colors be-focus" aria-label="Ajouter au panier">
                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 4h2l2.4 12.2a2 2 0 002 1.8h7.8a2 2 0 002-1.6L21 8H6"/><circle cx="9" cy="20" r="1.4"/><circle cx="18" cy="20" r="1.4"/></svg>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ===================== MARQUES ===================== --}}
    <section class="py-14 bg-be-cream">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <p class="text-center text-xs font-mono text-be-ink/40 mb-8">DES MARQUES QUE VOUS CONNAISSEZ ET UTILISEZ</p>
            <div class="flex flex-wrap items-center justify-center gap-x-12 gap-y-6">
                @foreach (['Legrand', 'Schneider Electric', 'Hager', 'Philips', 'ABB', 'Nexans'] as $brand)
                    <span class="font-display font-semibold text-lg sm:text-xl text-be-ink/30 hover:text-be-ink/60 transition-colors">{{ $brand }}</span>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ===================== BANNIÈRE NEWSLETTER ===================== --}}
    <section class="bg-be-amber">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 grid md:grid-cols-2 gap-6 items-center">
            <div>
                <h2 class="font-display font-bold text-2xl sm:text-3xl text-be-ink">Ne manquez aucune promotion.</h2>
                <p class="text-be-ink/70 mt-2 text-sm">Recevez nos offres, nouveautés et conseils techniques par email.</p>
            </div>
            <form class="flex flex-col sm:flex-row gap-3" onsubmit="return false;">
                <input type="email" required placeholder="Votre adresse email"
                       class="flex-1 rounded-md border-0 px-4 py-3.5 text-sm text-be-ink placeholder-be-ink/40 focus:outline-none focus:ring-2 focus:ring-be-ink">
                <button type="submit" class="rounded-md bg-be-ink text-white px-6 py-3.5 text-sm font-semibold hover:bg-black transition-colors be-focus">
                    S'inscrire
                </button>
            </form>
        </div>
    </section>
@endsection
