@extends('layouts.admin')
@section('title', 'Nouveau Produit')
@section('page-title', 'Nouveau Produit')

@section('content')

<div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-sm border border-slate-100 p-6 sm:p-8">
    <div class="mb-6">
        <a href="{{ route('admin.products.index') }}" class="text-xs font-semibold text-slate-500 hover:text-be-copper flex items-center gap-1.5 transition-colors">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Retour à la liste
        </a>
        <h2 class="font-bold text-slate-800 text-lg mt-3">Ajouter un produit au catalogue</h2>
        <p class="text-xs text-slate-400">Remplissez les informations ci-dessous pour insérer un nouvel article.</p>
    </div>

    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="grid sm:grid-cols-2 gap-5">
            <div>
                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5">Nom du produit</label>
                <input type="text" name="name" required placeholder="ex : Câble Cuivre H07V-K 2.5" value="{{ old('name') }}"
                       class="w-full rounded-xl bg-slate-50 border border-slate-200 px-4 py-2.5 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-amber-400">
                @error('name') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5">Référence unique</label>
                <input type="text" name="reference" required placeholder="ex : CBL-H07VK-2.5" value="{{ old('reference') }}"
                       class="w-full rounded-xl bg-slate-50 border border-slate-200 px-4 py-2.5 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-amber-400">
                @error('reference') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="grid sm:grid-cols-2 gap-5">
            <div>
                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5">Catégorie</label>
                <select name="category_id" required class="w-full rounded-xl bg-slate-50 border border-slate-200 px-4 py-2.5 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-amber-400">
                    <option value="">Sélectionnez une catégorie</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
                @error('category_id') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5">Marque</label>
                <select name="brand_id" required class="w-full rounded-xl bg-slate-50 border border-slate-200 px-4 py-2.5 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-amber-400">
                    <option value="">Sélectionnez une marque</option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                    @endforeach
                </select>
                @error('brand_id') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="grid sm:grid-cols-2 gap-5">
            <div>
                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5">Prix (MAD)</label>
                <input type="number" step="0.01" name="price" required placeholder="0.00" value="{{ old('price') }}"
                       class="w-full rounded-xl bg-slate-50 border border-slate-200 px-4 py-2.5 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-amber-400">
                @error('price') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5">Stock initial</label>
                <input type="number" name="stock" required placeholder="100" value="{{ old('stock', 0) }}"
                       class="w-full rounded-xl bg-slate-50 border border-slate-200 px-4 py-2.5 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-amber-400">
                @error('stock') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div>
            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5">Description</label>
            <textarea name="description" rows="5" required placeholder="Description détaillée du matériel..."
                      class="w-full rounded-xl bg-slate-50 border border-slate-200 px-4 py-2.5 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-amber-400 resize-none">{{ old('description') }}</textarea>
            @error('description') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="grid sm:grid-cols-2 gap-5 items-center">
            <div>
                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5">Image du produit</label>
                <input type="file" name="image" accept="image/*"
                       class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-amber-50 file:text-be-copper hover:file:bg-amber-100">
                @error('image') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5">Statut de publication</label>
                <select name="status" required class="w-full rounded-xl bg-slate-50 border border-slate-200 px-4 py-2.5 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-amber-400">
                    <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Brouillon</option>
                    <option value="active" {{ old('status', 'active') === 'active' ? 'selected' : '' }}>Actif / En ligne</option>
                    <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Inactif</option>
                </select>
                @error('status') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="flex items-center gap-3 border-t border-slate-100 pt-4">
            <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}
                   class="rounded border-slate-300 text-be-copper focus:ring-amber-400">
            <label for="is_featured" class="text-sm font-semibold text-slate-700 cursor-pointer">Mettre ce produit en vedette (carrousel / sélection)</label>
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button type="submit" class="flex-1 rounded-xl bg-be-amber hover:brightness-95 text-be-ink text-sm font-semibold py-3 transition-colors">
                Créer le produit
            </button>
            <a href="{{ route('admin.products.index') }}"
               class="flex-1 text-center rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 text-sm font-medium py-3 transition-colors">
                Annuler
            </a>
        </div>
    </form>
</div>

@endsection
