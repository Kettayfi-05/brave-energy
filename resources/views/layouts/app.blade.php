<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Brave Energy') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@500;600&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            :root{
                --be-bg:      #12181F;
                --be-bg-2:    #1B232C;
                --be-amber:   #F5B301;
                --be-copper:  #C9702B;
                --be-cream:   #F7F5F1;
                --be-ink:     #161B22;
                --be-green:   #2E8B57;
            }
            @keyframes be-pulse{
                0%, 100% { opacity: 1; }
                50% { opacity: .35; }
            }
            .be-live-dot{ animation: be-pulse 2s ease-in-out infinite; }

            @keyframes be-rise{
                from{ opacity:0; transform: translateY(14px); }
                to{ opacity:1; transform: translateY(0); }
            }
            .be-rise{ animation: be-rise .7s ease-out both; }
            .be-rise-1{ animation-delay: .05s; }
            .be-rise-2{ animation-delay: .15s; }
            .be-rise-3{ animation-delay: .25s; }

            @media (prefers-reduced-motion: reduce){
                .be-live-dot, .be-rise, .be-rise-1, .be-rise-2, .be-rise-3{ animation: none !important; }
            }

            .be-focus:focus-visible{
                outline: 2px solid var(--be-amber);
                outline-offset: 2px;
            }

            [x-cloak] { display: none !important; }
        </style>
    </head>
    <body class="font-sans antialiased text-be-ink bg-be-cream">
        <div class="min-h-screen flex flex-col justify-between" x-data="{ mobileOpen: false, searchOpen: false }">
            <div>
                {{-- ===================== UTILITY BAR ===================== --}}
                <div class="bg-be-ink text-be-cream/70 text-xs">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-9 flex items-center justify-between">
                        <div class="hidden sm:flex items-center gap-5">
                            <span class="flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5 text-be-amber" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h2.28a1 1 0 011 .8l1.06 5.28a1 1 0 01-.54 1.11l-1.6.8a11.04 11.04 0 006.36 6.36l.8-1.6a1 1 0 011.11-.54l5.28 1.06a1 1 0 01.8 1V19a2 2 0 01-2 2h-1C9.16 21 3 14.84 3 7V6z"/></svg>
                                +212 5 22 00 00 00
                            </span>
                            <span>Lun – Sam, 8h30 – 18h30</span>
                        </div>
                        <div class="flex items-center gap-1.5 mx-auto sm:mx-0">
                            <span class="w-1.5 h-1.5 rounded-full bg-be-green be-live-dot"></span>
                            Livraison partout au Maroc
                        </div>
                    </div>
                </div>

                {{-- ===================== NAVBAR ===================== --}}
                <header class="sticky top-0 z-50 bg-be-bg/95 backdrop-blur border-b border-white/10">
                    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="flex items-center justify-between h-18 py-3">

                            {{-- Logo --}}
                            <a href="{{ url('/') }}" class="flex items-center gap-2 shrink-0 be-focus rounded">
                                <span class="w-9 h-9 rounded-md bg-be-amber flex items-center justify-center">
                                    <svg class="w-5 h-5 text-be-ink" viewBox="0 0 24 24" fill="currentColor"><path d="M13 2 3 14h7l-1 8 11-14h-7l0-6z"/></svg>
                                </span>
                                <span class="font-display font-bold text-lg tracking-tight text-white">
                                    BRAVE <span class="text-be-amber">ENERGY</span>
                                </span>
                            </a>

                            {{-- Links desktop --}}
                            <div class="hidden lg:flex items-center gap-8 font-medium text-sm text-white/80">
                                <a href="{{ url('/') }}" class="hover:text-be-amber transition-colors be-focus rounded">Accueil</a>
                                
                                {{-- Dropdown Categories --}}
                                <div class="relative" x-data="{ open: false }">
                                    <button @click="open = !open" @click.away="open = false" type="button" class="inline-flex items-center gap-1.5 hover:text-be-amber transition-colors be-focus rounded py-2">
                                        <span>Catégories</span>
                                        <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>
                                    <div x-show="open" x-cloak x-transition
                                         class="absolute left-0 mt-2 w-72 rounded-xl bg-be-bg-2 border border-white/10 shadow-2xl p-4 z-50 grid grid-cols-1 gap-4">
                                         
                                         {{-- Section: Matériel & Équipement --}}
                                         <div>
                                             <span class="block font-mono text-[10px] text-white/40 tracking-wider uppercase mb-1.5">Matériel Électrique</span>
                                             <div class="space-y-1">
                                                 <a href="{{ url('/#categories') }}" class="flex items-center gap-2 px-2.5 py-1.5 rounded-lg text-sm text-white/80 hover:bg-white/5 hover:text-be-amber transition-colors">
                                                     <span class="w-1.5 h-1.5 rounded-full bg-be-amber"></span>
                                                     Câbles &amp; fils
                                                 </a>
                                                 <a href="{{ url('/#categories') }}" class="flex items-center gap-2 px-2.5 py-1.5 rounded-lg text-sm text-white/80 hover:bg-white/5 hover:text-be-amber transition-colors">
                                                     <span class="w-1.5 h-1.5 rounded-full bg-be-amber"></span>
                                                     Disjoncteurs
                                                 </a>
                                                 <a href="{{ url('/#categories') }}" class="flex items-center gap-2 px-2.5 py-1.5 rounded-lg text-sm text-white/80 hover:bg-white/5 hover:text-be-amber transition-colors">
                                                     <span class="w-1.5 h-1.5 rounded-full bg-be-amber"></span>
                                                     Éclairage
                                                 </a>
                                             </div>
                                         </div>

                                         <div class="border-t border-white/5 my-1"></div>

                                         {{-- Section: Mon Espace --}}
                                         <div>
                                             <span class="block font-mono text-[10px] text-white/40 tracking-wider uppercase mb-1.5">Mon Espace Client</span>
                                             <div class="space-y-1">
                                                 <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 px-2.5 py-1.5 rounded-lg text-sm text-white/80 hover:bg-white/5 hover:text-be-amber transition-colors">
                                                     <svg class="w-4 h-4 text-white/50" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path stroke-linecap="round" d="M4 20c1.6-3.6 5-5.5 8-5.5s6.4 1.9 8 5.5"/></svg>
                                                     Mon Profil
                                                 </a>
                                                 <a href="#wishlist" class="flex items-center gap-2 px-2.5 py-1.5 rounded-lg text-sm text-white/80 hover:bg-white/5 hover:text-be-amber transition-colors">
                                                     <svg class="w-4 h-4 text-white/50" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                                                     Wishlist (Favoris)
                                                 </a>
                                                 <a href="#historique" class="flex items-center gap-2 px-2.5 py-1.5 rounded-lg text-sm text-white/80 hover:bg-white/5 hover:text-be-amber transition-colors">
                                                     <svg class="w-4 h-4 text-white/50" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                     Historique de demandes
                                                 </a>
                                             </div>
                                         </div>

                                         <div class="border-t border-white/5 my-1"></div>

                                         {{-- Section: Services & Navigation --}}
                                         <div>
                                             <span class="block font-mono text-[10px] text-white/40 tracking-wider uppercase mb-1.5">Services &amp; Outils</span>
                                             <div class="space-y-1">
                                                 <a href="{{ url('/#produits') }}" class="flex items-center gap-2 px-2.5 py-1.5 rounded-lg text-sm text-white/80 hover:bg-white/5 hover:text-be-amber transition-colors">
                                                     <span class="w-1.5 h-1.5 rounded-full bg-be-copper"></span>
                                                     Promotions
                                                 </a>
                                                 <a href="#contact" class="flex items-center gap-2 px-2.5 py-1.5 rounded-lg text-sm text-white/80 hover:bg-white/5 hover:text-be-amber transition-colors">
                                                     <span class="w-1.5 h-1.5 rounded-full bg-be-amber"></span>
                                                     Contact
                                                 </a>
                                                 <button @click="searchOpen = !searchOpen" class="w-full text-left flex items-center gap-2 px-2.5 py-1.5 rounded-lg text-sm text-white/80 hover:bg-white/5 hover:text-be-amber transition-colors focus:outline-none">
                                                     <svg class="w-4 h-4 text-white/50" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7"/><path stroke-linecap="round" d="m21 21-4.3-4.3"/></svg>
                                                     Recherche
                                                 </button>
                                                 <a href="#panier" class="flex items-center justify-between px-2.5 py-1.5 rounded-lg text-sm text-white/80 hover:bg-white/5 hover:text-be-amber transition-colors">
                                                     <span class="flex items-center gap-2">
                                                         <svg class="w-4 h-4 text-white/50" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 4h2l2.4 12.2a2 2 0 002 1.8h7.8a2 2 0 002-1.6L21 8H6"/><circle cx="9" cy="20" r="1.4"/><circle cx="18" cy="20" r="1.4"/></svg>
                                                         Mon Panier
                                                     </span>
                                                     <span class="px-1.5 py-0.5 rounded-full bg-be-amber text-be-ink text-[10px] font-bold">3</span>
                                                 </a>
                                             </div>
                                         </div>

                                    </div>
                                </div>

                                <a href="{{ url('/#produits') }}" class="hover:text-be-amber transition-colors be-focus rounded">Promotions</a>
                                <a href="#contact" class="hover:text-be-amber transition-colors be-focus rounded">Contact</a>
                            </div>

                            {{-- Icons + CTA --}}
                            <div class="flex items-center gap-4">
                                <button @click="searchOpen = !searchOpen" type="button"
                                        class="hidden sm:flex w-10 h-10 items-center justify-center rounded-md text-white/80 hover:text-be-amber hover:bg-white/5 transition-colors be-focus"
                                        aria-label="Rechercher">
                                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7"/><path stroke-linecap="round" d="m21 21-4.3-4.3"/></svg>
                                </button>

                                {{-- User dropdown/auth --}}
                                @auth
                                    <div x-data="{ open: false }" class="relative">
                                        <button @click="open = !open" @click.away="open = false" type="button" class="w-10 h-10 flex items-center justify-center rounded-md text-white/80 hover:text-be-amber hover:bg-white/5 transition-colors be-focus" aria-label="Mon compte">
                                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path stroke-linecap="round" d="M4 20c1.6-3.6 5-5.5 8-5.5s6.4 1.9 8 5.5"/></svg>
                                        </button>
                                        <div x-show="open" x-cloak class="absolute right-0 mt-2 w-48 rounded-md bg-be-bg-2 border border-white/10 shadow-lg py-1 z-50">
                                            <div class="px-4 py-2 border-b border-white/5">
                                                <p class="text-xs text-white/50">Connecté en tant que</p>
                                                <p class="text-sm font-semibold text-white truncate">{{ Auth::user()->name }}</p>
                                            </div>
                                            <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-xs text-white/85 hover:bg-white/5 hover:text-be-amber">Tableau de bord</a>
                                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-xs text-white/85 hover:bg-white/5 hover:text-be-amber">Mon Profil</a>
                                            @if(Auth::user()->role === 'admin')
                                                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-xs text-white/85 hover:bg-white/5 hover:text-be-amber font-semibold text-be-amber">Administration</a>
                                            @endif
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <button type="submit" class="w-full text-left block px-4 py-2 text-xs text-white/85 hover:bg-white/5 hover:text-be-amber focus:outline-none">
                                                    Se déconnecter
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @else
                                    <a href="{{ route('login') }}" class="w-10 h-10 flex items-center justify-center rounded-md text-white/80 hover:text-be-amber hover:bg-white/5 transition-colors be-focus" aria-label="Connexion">
                                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path stroke-linecap="round" d="M4 20c1.6-3.6 5-5.5 8-5.5s6.4 1.9 8 5.5"/></svg>
                                    </a>
                                @endauth

                                <a href="#" class="relative flex w-10 h-10 items-center justify-center rounded-md text-white/80 hover:text-be-amber hover:bg-white/5 transition-colors be-focus" aria-label="Panier">
                                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 4h2l2.4 12.2a2 2 0 002 1.8h7.8a2 2 0 002-1.6L21 8H6"/><circle cx="9" cy="20" r="1.4"/><circle cx="18" cy="20" r="1.4"/></svg>
                                    <span class="absolute -top-1 -right-1 w-4 h-4 rounded-full bg-be-amber text-be-ink text-[10px] font-bold flex items-center justify-center">3</span>
                                </a>

                                <a href="#contact" class="hidden md:inline-flex ml-2 items-center rounded-md bg-be-amber px-4 py-2 text-sm font-semibold text-be-ink hover:brightness-95 transition be-focus">
                                    Demander un devis
                                </a>

                                {{-- Hamburger menu button (mobile) --}}
                                <button @click="mobileOpen = !mobileOpen" type="button"
                                        class="lg:hidden ml-1 w-10 h-10 flex items-center justify-center rounded-md text-white be-focus"
                                        :aria-expanded="mobileOpen.toString()" aria-label="Ouvrir le menu">
                                    <svg x-show="!mobileOpen" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M4 7h16M4 12h16M4 17h16"/></svg>
                                    <svg x-show="mobileOpen" x-cloak class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M6 6l12 12M18 6L6 18"/></svg>
                                </button>
                            </div>
                        </div>

                        {{-- Search dropdown (desktop) --}}
                        <div x-show="searchOpen" x-cloak x-transition class="hidden sm:block pb-4">
                            <div class="relative">
                                <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-white/40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7"/><path stroke-linecap="round" d="m21 21-4.3-4.3"/></svg>
                                <input type="text" placeholder="Rechercher un câble, un disjoncteur, une ampoule…"
                                       class="w-full rounded-md bg-white/5 border border-white/10 pl-10 pr-4 py-2.5 text-sm text-white placeholder-white/40 focus:outline-none focus:ring-2 focus:ring-be-amber">
                            </div>
                        </div>
                    </nav>

                    {{-- Mobile menu content --}}
                    <div x-show="mobileOpen" x-cloak x-transition
                         class="lg:hidden border-t border-white/10 bg-be-bg px-4 sm:px-6 py-4 space-y-1">
                        <a href="{{ url('/') }}" class="block px-2 py-2.5 rounded-md text-white/85 hover:bg-white/5 hover:text-be-amber font-medium">Accueil</a>
                        
                        {{-- Mobile categories accordion --}}
                        <div x-data="{ localOpen: false }">
                            <button @click="localOpen = !localOpen" type="button" class="w-full flex items-center justify-between px-2 py-2.5 rounded-md text-white/85 hover:bg-white/5 hover:text-be-amber font-medium focus:outline-none">
                                <span>Catégories</span>
                                <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': localOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div x-show="localOpen" x-cloak x-transition class="pl-4 space-y-1 mt-1 border-l border-white/10 ml-2">
                                <a href="{{ url('/#categories') }}" class="block px-2 py-2 rounded-md text-sm text-white/70 hover:text-be-amber">Câbles &amp; fils</a>
                                <a href="{{ url('/#categories') }}" class="block px-2 py-2 rounded-md text-sm text-white/70 hover:text-be-amber">Disjoncteurs</a>
                                <a href="{{ url('/#categories') }}" class="block px-2 py-2 rounded-md text-sm text-white/70 hover:text-be-amber">Éclairage</a>
                                <a href="{{ url('/#produits') }}" class="block px-2 py-2 rounded-md text-sm text-white/70 hover:text-be-amber">Promotions</a>
                                <a href="#contact" class="block px-2 py-2 rounded-md text-sm text-white/70 hover:text-be-amber">Contact</a>
                                <a href="#wishlist" class="block px-2 py-2 rounded-md text-sm text-white/70 hover:text-be-amber">Wishlist</a>
                                <a href="#historique" class="block px-2 py-2 rounded-md text-sm text-white/70 hover:text-be-amber">Historique de demandes</a>
                                <button @click="mobileOpen = false; searchOpen = !searchOpen" class="w-full text-left block px-2 py-2 rounded-md text-sm text-white/70 hover:text-be-amber">Recherche</button>
                                <a href="#panier" class="block px-2 py-2 rounded-md text-sm text-white/70 hover:text-be-amber">Mon Panier (3)</a>
                                <a href="{{ route('profile.edit') }}" class="block px-2 py-2 rounded-md text-sm text-white/70 hover:text-be-amber">Mon Profil</a>
                            </div>
                        </div>

                        <a href="{{ url('/#produits') }}" class="block px-2 py-2.5 rounded-md text-white/85 hover:bg-white/5 hover:text-be-amber font-medium">Promotions</a>
                        <a href="#contact" class="block px-2 py-2.5 rounded-md text-white/85 hover:bg-white/5 hover:text-be-amber font-medium">Contact</a>
                        <a href="#contact" class="mt-3 block text-center rounded-md bg-be-amber px-4 py-2.5 text-sm font-semibold text-be-ink">
                            Demander un devis
                        </a>
                    </div>
                </header>

                <!-- Page Content -->
                <main>
                    @yield('content')
                    {{ $slot ?? '' }}
                </main>
            </div>

            {{-- ===================== FOOTER ===================== --}}
            <footer id="contact" class="bg-be-bg text-white/60 mt-auto">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 grid sm:grid-cols-2 lg:grid-cols-4 gap-10">

                    <div>
                        <div class="flex items-center gap-2">
                            <span class="w-8 h-8 rounded-md bg-be-amber flex items-center justify-center">
                                <svg class="w-4.5 h-4.5 text-be-ink" viewBox="0 0 24 24" fill="currentColor"><path d="M13 2 3 14h7l-1 8 11-14h-7l0-6z"/></svg>
                            </span>
                            <span class="font-display font-bold text-white">BRAVE ENERGY</span>
                        </div>
                        <p class="text-sm mt-4 leading-relaxed">
                            Votre fournisseur de matériel électrique au Maroc : câbles, disjoncteurs,
                            éclairage et accessoires certifiés, pour professionnels et particuliers.
                        </p>
                        <div class="flex items-center gap-3 mt-5">
                            @foreach ([
                                'M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3V2z',
                                'M12 2a10 10 0 100 20 10 10 0 000-20zm3.5 7.5c-1 3-2.5 5.5-5.5 7-1-1-2-2.5-2-4.5 2 1 4 .5 5-1 .5 1 1.5 1.5 2.5 1.5-.5-1-.5-2-.2-3z',
                                'M4 4h16v16H4V4zm4 4v8m0-8h4a2 2 0 012 2v6',
                            ] as $social)
                                <a href="#" class="w-8 h-8 rounded-md bg-white/5 hover:bg-be-amber hover:text-be-ink flex items-center justify-center transition-colors be-focus">
                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $social }}"/></svg>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <h3 class="font-display font-semibold text-white text-sm tracking-wide">LIENS RAPIDES</h3>
                        <ul class="mt-4 space-y-2.5 text-sm">
                            <li><a href="{{ url('/') }}" class="hover:text-be-amber transition-colors">Accueil</a></li>
                            <li><a href="{{ url('/#produits') }}" class="hover:text-be-amber transition-colors">Promotions</a></li>
                            <li><a href="#" class="hover:text-be-amber transition-colors">À propos</a></li>
                            <li><a href="#" class="hover:text-be-amber transition-colors">Livraison &amp; retours</a></li>
                            <li><a href="#" class="hover:text-be-amber transition-colors">Devenir revendeur</a></li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="font-display font-semibold text-white text-sm tracking-wide">CATÉGORIES</h3>
                        <ul class="mt-4 space-y-2.5 text-sm">
                            <li><a href="{{ url('/#categories') }}" class="hover:text-be-amber transition-colors">Câbles &amp; fils</a></li>
                            <li><a href="{{ url('/#categories') }}" class="hover:text-be-amber transition-colors">Disjoncteurs</a></li>
                            <li><a href="{{ url('/#categories') }}" class="hover:text-be-amber transition-colors">Éclairage LED</a></li>
                            <li><a href="{{ url('/#categories') }}" class="hover:text-be-amber transition-colors">Rallonges &amp; prises</a></li>
                            <li><a href="{{ url('/#categories') }}" class="hover:text-be-amber transition-colors">Outillage</a></li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="font-display font-semibold text-white text-sm tracking-wide">CONTACT</h3>
                        <ul class="mt-4 space-y-3 text-sm">
                            <li class="flex items-start gap-2.5">
                                <svg class="w-4 h-4 mt-0.5 text-be-amber shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21s7-6.2 7-11a7 7 0 10-14 0c0 4.8 7 11 7 11zM12 13a2.5 2.5 0 100-5 2.5 2.5 0 000 5z"/></svg>
                                Zone Industrielle, Casablanca, Maroc
                            </li>
                            <li class="flex items-center gap-2.5">
                                <svg class="w-4 h-4 text-be-amber shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h2.28a1 1 0 011 .8l1.06 5.28a1 1 0 01-.54 1.11l-1.6.8a11.04 11.04 0 006.36 6.36l.8-1.6a1 1 0 011.11-.54l5.28 1.06a1 1 0 01.8 1V19a2 2 0 01-2 2h-1C9.16 21 3 14.84 3 7V6z"/></svg>
                                +212 5 22 00 00 00
                            </li>
                            <li class="flex items-center gap-2.5">
                                <svg class="w-4 h-4 text-be-amber shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4h16v16H4V4zm0 0 8 8 8-8"/></svg>
                                contact@braveenergy.ma
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="border-t border-white/10">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-white/35">
                        <p>&copy; {{ date('Y') }} Brave Energy. Tous droits réservés.</p>
                        <div class="flex items-center gap-5">
                            <a href="#" class="hover:text-white/60 transition-colors">Mentions légales</a>
                            <a href="#" class="hover:text-white/60 transition-colors">Politique de confidentialité</a>
                            <a href="#" class="hover:text-white/60 transition-colors">CGV</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>
