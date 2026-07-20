@extends('layouts.admin')
@section('title', 'Gestion des Produits')
@section('page-title', 'Gestion des Produits')

@section('content')

@if(session('success'))
<div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
     class="mb-6 flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl text-sm font-medium">
    <svg class="w-5 h-5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
    </svg>
    {{ session('success') }}
</div>
@endif

{{-- Filters & Search --}}
<div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 mb-6">
    <form method="GET" action="{{ route('admin.products.index') }}" class="grid sm:grid-cols-4 gap-4 items-end">
        <div>
            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5">Rechercher</label>
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Nom, référence..."
                   class="w-full rounded-xl bg-slate-50 border border-slate-200 px-4 py-2 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-amber-400">
        </div>
        <div>
            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5">Catégorie</label>
            <select name="category" class="w-full rounded-xl bg-slate-50 border border-slate-200 px-4 py-2 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-amber-400">
                <option value="">Toutes</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5">Statut</label>
            <select name="status" class="w-full rounded-xl bg-slate-50 border border-slate-200 px-4 py-2 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-amber-400">
                <option value="">Tous</option>
                <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Actif</option>
                <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Brouillon</option>
                <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactif</option>
            </select>
        </div>
        <div class="flex gap-2">
            <button type="submit" class="flex-1 bg-be-amber hover:brightness-95 text-be-ink font-semibold text-sm px-4 py-2 rounded-xl transition-colors">
                Filtrer
            </button>
            <a href="{{ route('admin.products.index') }}" class="flex-1 bg-slate-100 hover:bg-slate-200 text-slate-600 font-semibold text-sm px-4 py-2 rounded-xl text-center transition-colors">
                Reset
            </a>
        </div>
    </form>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
        <div>
            <h2 class="font-semibold text-slate-800 text-sm">Liste des produits</h2>
            <p class="text-xs text-slate-400">Gérez le catalogue de matériel électrique</p>
        </div>
        <a href="{{ route('admin.products.create') }}"
           class="inline-flex items-center gap-2 bg-be-amber hover:brightness-95 text-be-ink text-xs font-semibold px-4 py-2 rounded-lg transition-colors">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            Ajouter un produit
        </a>
    </div>

    @if($products->isEmpty())
        <div class="flex flex-col items-center justify-center py-16 text-center">
            <div class="w-16 h-16 rounded-2xl bg-slate-100 flex items-center justify-center mb-4">
                <svg class="w-8 h-8 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
            </div>
            <p class="font-semibold text-slate-600">Aucun produit trouvé</p>
            <p class="text-sm text-slate-400 mt-1">Commencez par ajouter des produits à votre inventaire.</p>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse admin-table">
                <thead>
                    <tr class="border-b border-slate-100">
                        <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase">Image</th>
                        <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase">Détails</th>
                        <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase">Référence</th>
                        <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase">Catégorie</th>
                        <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase">Prix</th>
                        <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase">Stock</th>
                        <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase">Statut</th>
                        <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach($products as $p)
                    <tr>
                        <td class="px-6 py-4">
                            @if($p->image)
                                <img src="{{ asset('storage/' . $p->image) }}" class="w-12 h-12 object-cover rounded-lg border border-slate-100" alt="{{ $p->name }}">
                            @else
                                <div class="w-12 h-12 rounded-lg bg-slate-100 flex items-center justify-center text-slate-400">
                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <p class="font-semibold text-slate-800 text-sm leading-snug line-clamp-1">{{ $p->name }}</p>
                            <span class="text-[10px] uppercase font-bold text-be-copper font-mono tracking-wide">
                                {{ $p->brand->name ?? 'Sans marque' }}
                            </span>
                            @if($p->is_featured)
                                <span class="badge bg-amber-50 text-amber-700 ml-1">En vedette</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 font-mono text-xs text-slate-500">{{ $p->reference }}</td>
                        <td class="px-6 py-4 text-slate-500 text-xs font-semibold">{{ $p->category->name ?? 'Aucune' }}</td>
                        <td class="px-6 py-4 font-mono font-bold text-slate-800">{{ number_format($p->price, 2) }} MAD</td>
                        <td class="px-6 py-4">
                            <span class="font-mono text-xs {{ $p->stock < 10 ? 'text-red-500 font-bold' : 'text-slate-600' }}">
                                {{ $p->stock }} u.
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="badge @if($p->status === 'active') bg-emerald-50 text-emerald-700 @elseif($p->status === 'draft') bg-slate-100 text-slate-600 @else bg-red-50 text-red-700 @endif">
                                {{ $p->status === 'active' ? 'Actif' : ($p->status === 'draft' ? 'Brouillon' : 'Inactif') }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.products.edit', $p) }}"
                                   class="p-2 rounded-lg hover:bg-amber-50 text-slate-400 hover:text-be-copper transition-colors" title="Modifier">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                                <form method="POST" action="{{ route('admin.products.destroy', $p) }}" onsubmit="return confirm('Voulez-vous vraiment supprimer ce produit ?')" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-2 rounded-lg hover:bg-red-50 text-slate-400 hover:text-red-500 transition-colors" title="Supprimer">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t border-slate-100">
            {{ $products->links() }}
        </div>
    @endif
</div>

@endsection
