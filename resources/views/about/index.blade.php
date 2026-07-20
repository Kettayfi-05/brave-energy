@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-be-cream py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Breadcrumb --}}
        <nav class="flex text-xs font-mono tracking-wider text-be-ink/40 uppercase mb-4 gap-2">
            <a href="{{ url('/') }}" class="hover:text-be-copper">Accueil</a>
            <span>/</span>
            <span class="text-be-ink">À propos</span>
        </nav>

        <h1 class="font-display font-bold text-3xl sm:text-4xl text-be-ink mb-6">À propos de Brave Energy</h1>
        
        <div class="prose prose-slate max-w-none text-be-ink/75 leading-relaxed space-y-6 text-sm">
            <p class="text-base font-semibold text-be-copper">
                Brave Energy est le partenaire de référence pour la distribution de matériel électrique haute performance au Maroc.
            </p>

            <div class="grid sm:grid-cols-2 gap-8 my-10 bg-white p-6 rounded-2xl border border-black/5 shadow-sm">
                <div>
                    <h3 class="font-display font-bold text-base text-be-ink mb-2">Notre Mission</h3>
                    <p class="text-xs text-be-ink/65 leading-relaxed">
                        Fournir aux professionnels et aux particuliers des solutions électriques sûres, certifiées (NF, CE) et au meilleur prix. Nous simplifions vos approvisionnements grâce à notre catalogue complet en ligne et nos devis rapides.
                    </p>
                </div>
                <div>
                    <h3 class="font-display font-bold text-base text-be-ink mb-2">Notre Implantation</h3>
                    <p class="text-xs text-be-ink/65 leading-relaxed">
                        Basés à **El Jadida**, nous disposons d'un centre logistique moderne nous permettant de stocker et d'expédier vos commandes partout au Maroc dans des délais record de 24 à 48 heures.
                    </p>
                </div>
            </div>

            <h2 class="font-display font-bold text-xl text-be-ink pt-4">Pourquoi choisir Brave Energy ?</h2>
            
            <ul class="space-y-3 list-disc pl-5">
                <li>
                    <strong>Qualité Certifiée :</strong> Tous nos câbles, disjoncteurs et composants d'éclairage LED répondent aux normes nationales et internationales les plus exigeantes (conformité NF C 15-100).
                </li>
                <li>
                    <strong>Proximité &amp; Logistique :</strong> Depuis notre entrepôt d'El Jadida, nous assurons des livraisons rapides à Casablanca, Rabat, Marrakech, Agadir, Tanger, et toutes les autres villes marocaines.
                </li>
                <li>
                    <strong>Service Client Intelligent :</strong> Un assistant virtuel (Chatbot) entraîné sur notre base de connaissances est disponible 24h/24 pour répondre à vos questions techniques et vous guider dans vos choix.
                </li>
            </ul>

            <div class="pt-6 border-t border-black/5 flex items-center justify-between flex-wrap gap-4">
                <p class="text-xs font-mono text-be-ink/40">Brave Energy S.A.R.L · Zone Industrielle, El Jadida, Maroc</p>
                <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 rounded-lg bg-be-amber px-5 py-2.5 text-xs font-semibold text-be-ink hover:brightness-95 transition">
                    Nous contacter
                </a>
            </div>
        </div>

    </div>
</div>
@endsection
