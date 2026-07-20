@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-be-cream py-12">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Breadcrumb --}}
        <nav class="flex text-xs font-mono tracking-wider text-be-ink/40 uppercase mb-4 gap-2">
            <a href="{{ url('/') }}" class="hover:text-be-copper">Accueil</a>
            <span>/</span>
            <span class="text-be-ink">Contact</span>
        </nav>

        <h1 class="font-display font-bold text-3xl text-be-ink mb-2">Contactez-nous</h1>
        <p class="text-be-ink/50 text-sm max-w-xl mb-10">
            Une question technique, une demande de partenariat ou besoin d'assistance ? Notre équipe d'El Jadida est à votre écoute.
        </p>

        @if(session('success'))
            <div class="mb-8 rounded-xl bg-emerald-50 border border-emerald-200 p-4 flex gap-3 text-sm text-emerald-800 animate-none">
                <svg class="w-5 h-5 text-emerald-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div>{{ session('success') }}</div>
            </div>
        @endif

        <div class="grid lg:grid-cols-[1fr_360px] gap-12 items-start">
            
            {{-- Contact Form --}}
            <div class="bg-white rounded-2xl border border-black/5 shadow-sm p-6 sm:p-8">
                <h2 class="font-display font-bold text-xl text-be-ink mb-6">Envoyer un message</h2>
                
                <form method="POST" action="{{ route('contact.store') }}" class="space-y-5">
                    @csrf

                    <div class="grid sm:grid-cols-2 gap-5">
                        <div>
                            <label for="name" class="block font-mono text-[11px] text-be-ink/50 tracking-wider uppercase mb-1.5">Nom complet</label>
                            <input id="name" type="text" name="name" value="{{ old('name', Auth::check() ? Auth::user()->name : '') }}" required
                                   class="w-full rounded-lg bg-be-cream border border-black/10 px-4 py-2.5 text-sm text-be-ink placeholder-be-ink/30 focus:outline-none focus:ring-2 focus:ring-be-amber">
                            @error('name') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="email" class="block font-mono text-[11px] text-be-ink/50 tracking-wider uppercase mb-1.5">Adresse Email</label>
                            <input id="email" type="email" name="email" value="{{ old('email', Auth::check() ? Auth::user()->email : '') }}" required
                                   class="w-full rounded-lg bg-be-cream border border-black/10 px-4 py-2.5 text-sm text-be-ink placeholder-be-ink/30 focus:outline-none focus:ring-2 focus:ring-be-amber">
                            @error('email') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="grid sm:grid-cols-2 gap-5">
                        <div>
                            <label for="phone" class="block font-mono text-[11px] text-be-ink/50 tracking-wider uppercase mb-1.5">Téléphone <span class="text-be-ink/30 font-normal">(Optionnel)</span></label>
                            <input id="phone" type="text" name="phone" value="{{ old('phone', Auth::check() ? Auth::user()->phone : '') }}" placeholder="ex : +212 600 000000"
                                   class="w-full rounded-lg bg-be-cream border border-black/10 px-4 py-2.5 text-sm text-be-ink placeholder-be-ink/30 focus:outline-none focus:ring-2 focus:ring-be-amber">
                            @error('phone') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="subject" class="block font-mono text-[11px] text-be-ink/50 tracking-wider uppercase mb-1.5">Sujet du message</label>
                            <input id="subject" type="text" name="subject" value="{{ old('subject') }}" required placeholder="ex : Demande de tarif de gros"
                                   class="w-full rounded-lg bg-be-cream border border-black/10 px-4 py-2.5 text-sm text-be-ink placeholder-be-ink/30 focus:outline-none focus:ring-2 focus:ring-be-amber">
                            @error('subject') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label for="message" class="block font-mono text-[11px] text-be-ink/50 tracking-wider uppercase mb-1.5">Votre message</label>
                        <textarea id="message" name="message" rows="5" required placeholder="Rédigez votre message ici..."
                                  class="w-full rounded-lg bg-be-cream border border-black/10 px-4 py-2.5 text-sm text-be-ink placeholder-be-ink/30 focus:outline-none focus:ring-2 focus:ring-be-amber resize-none">{{ old('message') }}</textarea>
                        @error('message') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="pt-2 flex justify-end">
                        <button type="submit" class="inline-flex items-center gap-2 rounded-lg bg-be-amber px-6 py-3.5 text-sm font-semibold text-be-ink hover:brightness-95 transition be-focus">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                            </svg>
                            Envoyer le message
                        </button>
                    </div>
                </form>
            </div>

            {{-- Sidebar Contact Info --}}
            <div class="bg-be-bg-2 rounded-2xl border border-white/10 p-6 space-y-6 text-white">
                <h3 class="font-display font-bold text-lg border-b border-white/5 pb-3">Nos coordonnées</h3>
                
                <ul class="space-y-5 text-sm">
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-be-amber shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 21s7-6.2 7-11a7 7 0 10-14 0c0 4.8 7 11 7 11zM12 13a2.5 2.5 0 100-5 2.5 2.5 0 000 5z"/>
                        </svg>
                        <div>
                            <h4 class="font-semibold text-xs text-white/50 uppercase font-mono tracking-wider">Adresse</h4>
                            <p class="mt-1 text-white/80 leading-relaxed font-sans text-xs">
                                Zone Industrielle, El Jadida, Maroc
                            </p>
                        </div>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-be-amber shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h2.28a1 1 0 011 .8l1.06 5.28a1 1 0 01-.54 1.11l-1.6.8a11.04 11.04 0 006.36 6.36l.8-1.6a1 1 0 011.11-.54l5.28 1.06a1 1 0 01.8 1V19a2 2 0 01-2 2h-1C9.16 21 3 14.84 3 7V6z"/>
                        </svg>
                        <div>
                            <h4 class="font-semibold text-xs text-white/50 uppercase font-mono tracking-wider">Téléphone</h4>
                            <p class="mt-1 text-white/80 font-mono text-xs">+212 5 23 37 39 99</p>
                        </div>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-be-amber shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 4h16v16H4V4zm0 0 8 8 8-8"/>
                        </svg>
                        <div>
                            <h4 class="font-semibold text-xs text-white/50 uppercase font-mono tracking-wider">Email</h4>
                            <p class="mt-1 text-white/80 font-mono text-xs">contact@braveenergy.ma</p>
                        </div>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</div>
@endsection
