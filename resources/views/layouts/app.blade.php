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
    <body id="top" class="font-sans antialiased text-be-ink bg-be-cream">
        <div class="min-h-screen flex flex-col justify-between" x-data="{ mobileOpen: false, searchOpen: false, loginOpen: {{ old('auth_form') === 'login' ? 'true' : 'false' }}, registerOpen: {{ old('auth_form') === 'register' ? 'true' : 'false' }} }">
            <div>
                {{-- ===================== UTILITY BAR ===================== --}}
                <div class="bg-be-ink text-be-cream/70 text-xs">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-9 flex items-center justify-between">
                        <div class="hidden sm:flex items-center gap-5">
                            <span class="flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5 text-be-amber" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h2.28a1 1 0 011 .8l1.06 5.28a1 1 0 01-.54 1.11l-1.6.8a11.04 11.04 0 006.36 6.36l.8-1.6a1 1 0 011.11-.54l5.28 1.06a1 1 0 01.8 1V19a2 2 0 01-2 2h-1C9.16 21 3 14.84 3 7V6z"/></svg>
                                +212 5 23 37 39 99        
                            </span>
                            <span>Lun – Sam, 9h00 – 17h00</span>
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
                                <a href="{{ route('home') }}#top" class="hover:text-be-amber transition-colors be-focus rounded">Accueil</a>
                                
                                {{-- Dropdown Categories --}}
                                <div class="relative" x-data="{ open: false }">
                                    <button @click="open = !open" @click.away="open = false" type="button" class="inline-flex items-center gap-1.5 hover:text-be-amber transition-colors be-focus rounded py-2">
                                        <span>Catégories</span>
                                        <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>
                                    <div x-show="open" x-cloak x-transition
                                         class="absolute left-0 mt-2 w-56 rounded-xl bg-be-bg-2 border border-white/10 shadow-2xl p-2 z-50">
                                         <a href="{{ url('/#categories') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm text-white/80 hover:bg-white/5 hover:text-be-amber transition-colors">
                                             <span class="w-1.5 h-1.5 rounded-full bg-be-amber"></span>
                                             Câbles &amp; fils
                                         </a>
                                         <a href="{{ url('/#categories') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm text-white/80 hover:bg-white/5 hover:text-be-amber transition-colors">
                                             <span class="w-1.5 h-1.5 rounded-full bg-be-amber"></span>
                                             Disjoncteurs
                                         </a>
                                         <a href="{{ url('/#categories') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm text-white/80 hover:bg-white/5 hover:text-be-amber transition-colors">
                                             <span class="w-1.5 h-1.5 rounded-full bg-be-amber"></span>
                                             Éclairage
                                         </a>
                                    </div>
                                </div>

                                <a href="{{ route('promotions') }}" class="hover:text-be-amber transition-colors be-focus rounded">Promotions</a>
                                @if(!Auth::check() || Auth::user()->role !== 'admin')
                                    <a href="{{ route('contact') }}" class="hover:text-be-amber transition-colors be-focus rounded">Contact</a>
                                @endif
                                @auth
                                    @if(Auth::user()->role !== 'admin')
                                        <a href="{{ route('wishlist.index') }}" class="hover:text-be-amber transition-colors be-focus rounded">Wishlist</a>
                                        <a href="{{ route('orders.index') }}" class="hover:text-be-amber transition-colors be-focus rounded">Historique de demandes</a>
                                    @endif
                                @endauth
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
                                            @if(Auth::user()->role === 'admin')
                                                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-xs text-white/85 hover:bg-white/5 hover:text-be-amber font-semibold text-be-amber">Administration</a>
                                            @else
                                                <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-xs text-white/85 hover:bg-white/5 hover:text-be-amber">Tableau de bord</a>
                                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-xs text-white/85 hover:bg-white/5 hover:text-be-amber">Mon Profil</a>
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
                                    <button @click="loginOpen = true" type="button" class="w-10 h-10 flex items-center justify-center rounded-md text-white/80 hover:text-be-amber hover:bg-white/5 transition-colors be-focus" aria-label="Connexion">
                                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path stroke-linecap="round" d="M4 20c1.6-3.6 5-5.5 8-5.5s6.4 1.9 8 5.5"/></svg>
                                    </button>
                                @endauth

                                @auth
                                    @if(Auth::user()->role !== 'admin')
                                        <a href="{{ route('cart.index') }}" class="relative flex w-10 h-10 items-center justify-center rounded-md text-white/80 hover:text-be-amber hover:bg-white/5 transition-colors be-focus" aria-label="Panier">
                                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 4h2l2.4 12.2a2 2 0 002 1.8h7.8a2 2 0 002-1.6L21 8H6"/><circle cx="9" cy="20" r="1.4"/><circle cx="18" cy="20" r="1.4"/></svg>
                                            @php
                                                $cartCount = Auth::user()->cart?->cartItems()->sum('quantity') ?? 0;
                                            @endphp
                                            @if($cartCount > 0)
                                                <span class="absolute -top-1 -right-1 w-4 h-4 rounded-full bg-be-amber text-be-ink text-[10px] font-bold flex items-center justify-center">{{ $cartCount }}</span>
                                            @endif
                                        </a>
                                    @endif
                                @endauth

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
                            <form method="GET" action="{{ route('search.index') }}" class="relative">
                                <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-white/40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7"/><path stroke-linecap="round" d="m21 21-4.3-4.3"/></svg>
                                <input type="text" name="q" placeholder="Rechercher un câble, un disjoncteur, une ampoule…"
                                       class="w-full rounded-md bg-white/5 border border-white/10 pl-10 pr-28 py-2.5 text-sm text-white placeholder-white/40 focus:outline-none focus:ring-2 focus:ring-be-amber">
                                <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 bg-be-amber text-be-ink text-xs font-semibold px-3 py-1.5 rounded hover:brightness-95 transition">
                                    Rechercher
                                </button>
                            </form>
                        </div>
                    </nav>

                    {{-- Mobile menu content --}}
                    <div x-show="mobileOpen" x-cloak x-transition
                         class="lg:hidden border-t border-white/10 bg-be-bg px-4 sm:px-6 py-4 space-y-1">
                        <a href="{{ route('home') }}#top" class="block px-2 py-2.5 rounded-md text-white/85 hover:bg-white/5 hover:text-be-amber font-medium">Accueil</a>
                        
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
                            </div>
                        </div>

                        <a href="{{ route('promotions') }}" class="block px-2 py-2.5 rounded-md text-white/85 hover:bg-white/5 hover:text-be-amber font-medium">Promotions</a>
                        @if(!Auth::check() || Auth::user()->role !== 'admin')
                            <a href="{{ route('contact') }}" class="block px-2 py-2.5 rounded-md text-white/85 hover:bg-white/5 hover:text-be-amber font-medium">Contact</a>
                        @endif
                        @auth
                            @if(Auth::user()->role !== 'admin')
                                <a href="{{ route('wishlist.index') }}" class="block px-2 py-2.5 rounded-md text-white/85 hover:bg-white/5 hover:text-be-amber font-medium">Wishlist</a>
                                <a href="{{ route('orders.index') }}" class="block px-2 py-2.5 rounded-md text-white/85 hover:bg-white/5 hover:text-be-amber font-medium">Historique de demandes</a>
                            @endif
                        @endauth
                        <button @click="mobileOpen = false; searchOpen = !searchOpen" class="w-full text-left block px-2 py-2.5 rounded-md text-white/85 hover:bg-white/5 hover:text-be-amber font-medium">Recherche</button>
                        @auth
                            @if(Auth::user()->role !== 'admin')
                                <a href="{{ route('cart.index') }}" class="block px-2 py-2.5 rounded-md text-white/85 hover:bg-white/5 hover:text-be-amber font-medium">Mon Panier ({{ Auth::user()->cart?->cartItems()->sum('quantity') ?? 0 }})</a>
                                <a href="{{ route('dashboard') }}" class="block px-2 py-2.5 rounded-md text-white/85 hover:bg-white/5 hover:text-be-amber font-medium">Tableau de bord</a>
                                <a href="{{ route('profile.edit') }}" class="block px-2 py-2.5 rounded-md text-white/85 hover:bg-white/5 hover:text-be-amber font-medium">Mon Profil</a>
                            @else
                                <a href="{{ route('admin.dashboard') }}" class="block px-2 py-2.5 rounded-md text-be-amber hover:bg-white/5 font-semibold">Administration</a>
                            @endif
                            <form method="POST" action="{{ route('logout') }}" class="block">
                                @csrf
                                <button type="submit" class="w-full text-left block px-2 py-2.5 rounded-md text-white/85 hover:bg-white/5 hover:text-be-amber font-medium focus:outline-none">
                                    Se déconnecter
                                </button>
                            </form>
                        @else
                            <button @click="mobileOpen = false; loginOpen = true" type="button" class="w-full text-left block px-2 py-2.5 rounded-md text-white/85 hover:bg-white/5 hover:text-be-amber font-medium">Connexion / Inscription</button>
                        @endauth
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
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 grid sm:grid-cols-2 lg:grid-cols-3 gap-10">

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
                    </div>

                    <div>
                        <h3 class="font-display font-semibold text-white text-sm tracking-wide">LIENS RAPIDES</h3>
                        <ul class="mt-4 space-y-2.5 text-sm">
                            <li><a href="{{ url('/') }}" class="hover:text-be-amber transition-colors">Accueil</a></li>
                            <li><a href="{{ url('/#produits') }}" class="hover:text-be-amber transition-colors">Promotions</a></li>
                            <li><a href="{{ route('about') }}" class="hover:text-be-amber transition-colors">À propos</a></li>
                            <li><a href="{{ route('contact') }}" class="hover:text-be-amber transition-colors">Contact</a></li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="font-display font-semibold text-white text-sm tracking-wide">CONTACT</h3>
                        <ul class="mt-4 space-y-3 text-sm">
                            <li class="flex items-start gap-2.5">
                                <svg class="w-4 h-4 mt-0.5 text-be-amber shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21s7-6.2 7-11a7 7 0 10-14 0c0 4.8 7 11 7 11zM12 13a2.5 2.5 0 100-5 2.5 2.5 0 000 5z"/></svg>
                                Zone Industrielle, El Jadida, Maroc
                            </li>
                            <li class="flex items-center gap-2.5">
                                <svg class="w-4 h-4 text-be-amber shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h2.28a1 1 0 011 .8l1.06 5.28a1 1 0 01-.54 1.11l-1.6.8a11.04 11.04 0 006.36 6.36l.8-1.6a1 1 0 011.11-.54l5.28 1.06a1 1 0 01.8 1V19a2 2 0 01-2 2h-1C9.16 21 3 14.84 3 7V6z"/></svg>
                                +212 5 23 37 39 99
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

            {{-- ===================== CHATBOT WIDGET ===================== --}}
            <div x-data="braveChat()" class="fixed bottom-5 right-5 z-[90] flex flex-col items-end gap-3">
                {{-- Chat window --}}
                <div x-show="open" x-cloak
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4 scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                     x-transition:leave-end="opacity-0 translate-y-4 scale-95"
                     class="w-80 sm:w-96 rounded-2xl shadow-2xl bg-be-bg-2 border border-white/10 overflow-hidden flex flex-col"
                     style="max-height: 480px;">
                    <div class="flex items-center justify-between px-4 py-3 bg-be-bg border-b border-white/10">
                        <div class="flex items-center gap-2.5">
                            <span class="w-8 h-8 rounded-full bg-be-amber flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4 text-be-ink" viewBox="0 0 24 24" fill="currentColor"><path d="M13 2 3 14h7l-1 8 11-14h-7l0-6z"/></svg>
                            </span>
                            <div>
                                <p class="text-white font-semibold text-sm leading-none">Assistant Brave Energy</p>
                                <p class="text-be-green text-[10px] font-mono flex items-center gap-1 mt-0.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-be-green inline-block be-live-dot"></span> En ligne
                                </p>
                            </div>
                        </div>
                        <button @click="open = false" class="text-white/40 hover:text-white transition-colors p-1 rounded-md hover:bg-white/5">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                    <div id="be-chat-messages" class="flex-1 overflow-y-auto px-4 py-4 space-y-3">
                        <div class="flex gap-2">
                            <span class="w-6 h-6 rounded-full bg-be-amber flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-3 h-3 text-be-ink" viewBox="0 0 24 24" fill="currentColor"><path d="M13 2 3 14h7l-1 8 11-14h-7l0-6z"/></svg>
                            </span>
                            <div class="bg-white/5 border border-white/10 rounded-2xl rounded-tl-sm px-3 py-2 text-sm text-white/85 max-w-[85%]">
                                Bonjour ! Je suis l'assistant Brave Energy. Comment puis-je vous aider aujourd'hui ?
                            </div>
                        </div>
                    </div>
                    <div class="px-3 py-3 border-t border-white/10 flex gap-2">
                        <input type="text" x-model="input" @keydown.enter="send()"
                               placeholder="Posez votre question..."
                               class="flex-1 rounded-xl bg-white/5 border border-white/10 px-3 py-2 text-sm text-white placeholder-white/30 focus:outline-none focus:ring-2 focus:ring-be-amber">
                        <button @click="send()" class="w-9 h-9 rounded-xl bg-be-amber text-be-ink flex items-center justify-center hover:brightness-95 transition-all shrink-0">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <button @click="open = !open; if(open) unread = 0"
                        class="w-14 h-14 rounded-2xl bg-be-amber text-be-ink shadow-xl flex items-center justify-center hover:brightness-95 hover:scale-105 transition-all relative">
                    <svg x-show="!open" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                    </svg>
                    <svg x-show="open" x-cloak class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    <span x-show="!open && unread > 0" x-cloak class="absolute -top-1.5 -right-1.5 w-5 h-5 rounded-full bg-red-500 text-white text-[10px] font-bold flex items-center justify-center" x-text="unread"></span>
                </button>
            </div>
            <script>
            function braveChat() {
                return {
                    open: false,
                    input: '',
                    unread: 0,
                    send() {
                        const msg = this.input.trim();
                        if (!msg) return;
                        this.input = '';
                        const chatbox = document.getElementById('be-chat-messages');
                        chatbox.innerHTML += `<div class="flex gap-2 justify-end"><div class="bg-be-amber text-be-ink rounded-2xl rounded-tr-sm px-3 py-2 text-sm font-medium max-w-[85%]">${msg}</div></div>`;
                        chatbox.scrollTop = chatbox.scrollHeight;
                        const typingId = 'typing-' + Date.now();
                        chatbox.innerHTML += `<div id="${typingId}" class="flex gap-2"><span class="w-6 h-6 rounded-full bg-be-amber flex items-center justify-center shrink-0 mt-0.5"><svg class="w-3 h-3 text-be-ink" viewBox="0 0 24 24" fill="currentColor"><path d="M13 2 3 14h7l-1 8 11-14h-7l0-6z"/></svg></span><div class="bg-white/5 border border-white/10 rounded-2xl rounded-tl-sm px-3 py-2 text-sm text-white/50"><span class="inline-flex gap-1"><span class="w-1.5 h-1.5 rounded-full bg-white/30 animate-bounce" style="animation-delay:0ms"></span><span class="w-1.5 h-1.5 rounded-full bg-white/30 animate-bounce" style="animation-delay:150ms"></span><span class="w-1.5 h-1.5 rounded-full bg-white/30 animate-bounce" style="animation-delay:300ms"></span></span></div></div>`;
                        chatbox.scrollTop = chatbox.scrollHeight;
                        fetch('/chatbot/message', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
                            body: JSON.stringify({ message: msg })
                        }).then(r => r.json()).then(data => {
                            document.getElementById(typingId)?.remove();
                            chatbox.innerHTML += `<div class="flex gap-2"><span class="w-6 h-6 rounded-full bg-be-amber flex items-center justify-center shrink-0 mt-0.5"><svg class="w-3 h-3 text-be-ink" viewBox="0 0 24 24" fill="currentColor"><path d="M13 2 3 14h7l-1 8 11-14h-7l0-6z"/></svg></span><div class="bg-white/5 border border-white/10 rounded-2xl rounded-tl-sm px-3 py-2 text-sm text-white/85 max-w-[85%]">${data.answer}</div></div>`;
                            chatbox.scrollTop = chatbox.scrollHeight;
                            if (!this.open) this.unread++;
                        });
                    }
                }
            }
            </script>

            {{-- ===================== MODAL DE CONNEXION ===================== --}}
            <div x-show="loginOpen" x-cloak class="fixed inset-0 z-[100] flex items-center justify-center p-4">
                <!-- Backdrop with blur -->
                <div x-show="loginOpen" 
                     x-transition:enter="transition ease-out duration-300" 
                     x-transition:enter-start="opacity-0" 
                     x-transition:enter-end="opacity-100" 
                     x-transition:leave="transition ease-in duration-200" 
                     x-transition:leave-start="opacity-100" 
                     x-transition:leave-end="opacity-0" 
                     @click="loginOpen = false" 
                     class="absolute inset-0 bg-be-ink/80 backdrop-blur-md"></div>

                <!-- Modal Content -->
                <div x-show="loginOpen" 
                     x-transition:enter="transition ease-out duration-300" 
                     x-transition:enter-start="opacity-0 scale-95" 
                     x-transition:enter-end="opacity-100 scale-100" 
                     x-transition:leave="transition ease-in duration-200" 
                     x-transition:leave-start="opacity-100 scale-100" 
                     x-transition:leave-end="opacity-0 scale-95" 
                     class="relative bg-be-bg-2 border border-white/10 rounded-2xl p-6 sm:p-8 max-w-md w-full shadow-2xl z-10 text-white">
                    
                    <!-- Close Button -->
                    <button @click="loginOpen = false" class="absolute top-4 right-4 text-white/40 hover:text-white transition-colors animate-none" aria-label="Fermer">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>

                    <!-- Header -->
                    <div class="mb-6">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="w-8 h-8 rounded-md bg-be-amber flex items-center justify-center">
                                <svg class="w-5 h-5 text-be-ink" viewBox="0 0 24 24" fill="currentColor"><path d="M13 2 3 14h7l-1 8 11-14h-7l0-6z"/></svg>
                            </span>
                            <span class="font-display font-bold text-lg tracking-tight text-white">
                                BRAVE <span class="text-be-amber">ENERGY</span>
                            </span>
                        </div>
                        <h3 class="font-display font-bold text-xl sm:text-2xl mt-4">Connexion</h3>
                        <p class="text-white/60 text-xs sm:text-sm mt-1">Accédez à votre espace client pour gérer vos demandes.</p>
                    </div>

                    <!-- Session Status -->
                    @if (session('status'))
                        <div class="mb-4 font-mono text-xs text-be-green">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}" class="space-y-4">
                        @csrf
                        <input type="hidden" name="auth_form" value="login">

                        <!-- Email Address -->
                        <div>
                            <label for="login_email" class="block font-mono text-[11px] text-white/50 tracking-wider uppercase mb-1.5">Adresse Email</label>
                            <input id="login_email" type="email" name="email" value="{{ old('auth_form') === 'login' ? old('email') : '' }}" required autofocus autocomplete="username"
                                   class="w-full rounded-lg bg-white/5 border border-white/10 px-4 py-2.5 text-sm text-white placeholder-white/30 focus:outline-none focus:ring-2 focus:ring-be-amber focus:border-be-amber">
                            @if (old('auth_form') === 'login')
                                @error('email')
                                    <p class="mt-1.5 font-mono text-[10px] text-red-500">{{ $message }}</p>
                                @enderror
                            @endif
                        </div>

                        <!-- Password -->
                        <div>
                            <div class="flex items-center justify-between mb-1.5">
                                <label for="login_password" class="block font-mono text-[11px] text-white/50 tracking-wider uppercase">Mot de passe</label>
                                @if (Route::has('password.request'))
                                    <a class="font-mono text-[10px] text-white/40 hover:text-be-amber transition-colors" href="{{ route('password.request') }}">
                                        Mot de passe oublié ?
                                    </a>
                                @endif
                            </div>
                            <input id="login_password" type="password" name="password" required autocomplete="current-password"
                                   class="w-full rounded-lg bg-white/5 border border-white/10 px-4 py-2.5 text-sm text-white placeholder-white/30 focus:outline-none focus:ring-2 focus:ring-be-amber focus:border-be-amber">
                            @if (old('auth_form') === 'login')
                                @error('password')
                                    <p class="mt-1.5 font-mono text-[10px] text-red-500">{{ $message }}</p>
                                @enderror
                            @endif
                        </div>

                        <!-- Remember Me -->
                        <div class="flex items-center justify-between">
                            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                                <input id="remember_me" type="checkbox" name="remember" class="rounded border-white/10 bg-white/5 text-be-amber focus:ring-be-amber focus:ring-offset-be-bg-2">
                                <span class="ms-2 text-xs text-white/60">Se souvenir de moi</span>
                            </label>
                        </div>

                        <!-- Action Button -->
                        <button type="submit" class="w-full mt-2 inline-flex justify-center items-center rounded-lg bg-be-amber px-4 py-3 text-sm font-semibold text-be-ink hover:brightness-95 transition be-focus">
                            Se connecter
                        </button>
                    </form>

                    <!-- Footer link to Register -->
                    <div class="mt-6 text-center text-xs text-white/55 border-t border-white/5 pt-4">
                        Pas encore de compte ?
                        <button @click="loginOpen = false; registerOpen = true" class="text-be-amber hover:underline font-medium focus:outline-none">S'inscrire</button>
                    </div>
                </div>
            </div>

            {{-- ===================== MODAL D'INSCRIPTION ===================== --}}
            <div x-show="registerOpen" x-cloak class="fixed inset-0 z-[100] flex items-center justify-center p-4">
                <!-- Backdrop with blur -->
                <div x-show="registerOpen" 
                     x-transition:enter="transition ease-out duration-300" 
                     x-transition:enter-start="opacity-0" 
                     x-transition:enter-end="opacity-100" 
                     x-transition:leave="transition ease-in duration-200" 
                     x-transition:leave-start="opacity-100" 
                     x-transition:leave-end="opacity-0" 
                     @click="registerOpen = false" 
                     class="absolute inset-0 bg-be-ink/80 backdrop-blur-md"></div>

                <!-- Modal Content -->
                <div x-show="registerOpen" 
                     x-transition:enter="transition ease-out duration-300" 
                     x-transition:enter-start="opacity-0 scale-95" 
                     x-transition:enter-end="opacity-100 scale-100" 
                     x-transition:leave="transition ease-in duration-200" 
                     x-transition:leave-start="opacity-100 scale-100" 
                     x-transition:leave-end="opacity-0 scale-95" 
                     class="relative bg-be-bg-2 border border-white/10 rounded-2xl p-6 sm:p-8 max-w-md w-full shadow-2xl z-10 text-white">
                    
                    <!-- Close Button -->
                    <button @click="registerOpen = false" class="absolute top-4 right-4 text-white/40 hover:text-white transition-colors animate-none" aria-label="Fermer">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>

                    <!-- Header -->
                    <div class="mb-6">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="w-8 h-8 rounded-md bg-be-amber flex items-center justify-center">
                                <svg class="w-5 h-5 text-be-ink" viewBox="0 0 24 24" fill="currentColor"><path d="M13 2 3 14h7l-1 8 11-14h-7l0-6z"/></svg>
                            </span>
                            <span class="font-display font-bold text-lg tracking-tight text-white">
                                BRAVE <span class="text-be-amber">ENERGY</span>
                            </span>
                        </div>
                        <h3 class="font-display font-bold text-xl sm:text-2xl mt-4">Créer un compte</h3>
                        <p class="text-white/60 text-xs sm:text-sm mt-1">Rejoignez-nous pour suivre vos commandes et devis.</p>
                    </div>

                    <form method="POST" action="{{ route('register') }}" class="space-y-4">
                        @csrf
                        <input type="hidden" name="auth_form" value="register">

                        <!-- Name -->
                        <div>
                            <label for="register_name" class="block font-mono text-[11px] text-white/50 tracking-wider uppercase mb-1.5">Nom complet</label>
                            <input id="register_name" type="text" name="name" value="{{ old('auth_form') === 'register' ? old('name') : '' }}" required autofocus autocomplete="name"
                                   class="w-full rounded-lg bg-white/5 border border-white/10 px-4 py-2.5 text-sm text-white placeholder-white/30 focus:outline-none focus:ring-2 focus:ring-be-amber focus:border-be-amber">
                            @if (old('auth_form') === 'register')
                                @error('name')
                                    <p class="mt-1.5 font-mono text-[10px] text-red-500">{{ $message }}</p>
                                @enderror
                            @endif
                        </div>

                        <!-- Email Address -->
                        <div>
                            <label for="register_email" class="block font-mono text-[11px] text-white/50 tracking-wider uppercase mb-1.5">Adresse Email</label>
                            <input id="register_email" type="email" name="email" value="{{ old('auth_form') === 'register' ? old('email') : '' }}" required autocomplete="username"
                                   class="w-full rounded-lg bg-white/5 border border-white/10 px-4 py-2.5 text-sm text-white placeholder-white/30 focus:outline-none focus:ring-2 focus:ring-be-amber focus:border-be-amber">
                            @if (old('auth_form') === 'register')
                                @error('email')
                                    <p class="mt-1.5 font-mono text-[10px] text-red-500">{{ $message }}</p>
                                @enderror
                            @endif
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="register_password" class="block font-mono text-[11px] text-white/50 tracking-wider uppercase mb-1.5">Mot de passe</label>
                            <input id="register_password" type="password" name="password" required autocomplete="new-password"
                                   class="w-full rounded-lg bg-white/5 border border-white/10 px-4 py-2.5 text-sm text-white placeholder-white/30 focus:outline-none focus:ring-2 focus:ring-be-amber focus:border-be-amber">
                            @if (old('auth_form') === 'register')
                                @error('password')
                                    <p class="mt-1.5 font-mono text-[10px] text-red-500">{{ $message }}</p>
                                @enderror
                            @endif
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="register_password_confirmation" class="block font-mono text-[11px] text-white/50 tracking-wider uppercase mb-1.5">Confirmer le mot de passe</label>
                            <input id="register_password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                                   class="w-full rounded-lg bg-white/5 border border-white/10 px-4 py-2.5 text-sm text-white placeholder-white/30 focus:outline-none focus:ring-2 focus:ring-be-amber focus:border-be-amber">
                            @if (old('auth_form') === 'register')
                                @error('password_confirmation')
                                    <p class="mt-1.5 font-mono text-[10px] text-red-500">{{ $message }}</p>
                                @enderror
                            @endif
                        </div>

                        <!-- Action Button -->
                        <button type="submit" class="w-full mt-2 inline-flex justify-center items-center rounded-lg bg-be-amber px-4 py-3 text-sm font-semibold text-be-ink hover:brightness-95 transition be-focus">
                            S'inscrire
                        </button>
                    </form>

                    <!-- Footer link to Login -->
                    <div class="mt-6 text-center text-xs text-white/55 border-t border-white/5 pt-4">
                        Déjà inscrit ?
                        <button @click="registerOpen = false; loginOpen = true" class="text-be-amber hover:underline font-medium focus:outline-none">Se connecter</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
