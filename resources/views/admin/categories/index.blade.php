@extends('layouts.admin')
@section('title', 'Gestion des Catégories')
@section('page-title', 'Gestion des Catégories')

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

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
        <div>
            <h2 class="font-semibold text-slate-800 text-sm">Liste des catégories</h2>
            <p class="text-xs text-slate-400">Gérez les rayons et catégories du site</p>
        </div>
        <button onclick="document.getElementById('add-category-modal').classList.remove('hidden')"
                class="inline-flex items-center gap-2 bg-be-amber hover:brightness-95 text-be-ink text-xs font-semibold px-4 py-2 rounded-lg transition-colors">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            Ajouter une catégorie
        </button>
    </div>

    @if($categories->isEmpty())
        <div class="flex flex-col items-center justify-center py-16 text-center">
            <div class="w-16 h-16 rounded-2xl bg-slate-100 flex items-center justify-center mb-4">
                <svg class="w-8 h-8 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                </svg>
            </div>
            <p class="font-semibold text-slate-600">Aucune catégorie existante</p>
            <p class="text-sm text-slate-400 mt-1">Créez votre première catégorie pour y associer des produits.</p>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse admin-table">
                <thead>
                    <tr class="border-b border-slate-100">
                        <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase">Image</th>
                        <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase">Nom</th>
                        <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase">Slug</th>
                        <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase">Statut</th>
                        <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach($categories as $cat)
                    <tr>
                        <td class="px-6 py-4">
                            @if($cat->image)
                                <img src="{{ asset('storage/' . $cat->image) }}" class="w-12 h-12 object-cover rounded-lg border border-slate-100" alt="{{ $cat->name }}">
                            @else
                                <div class="w-12 h-12 rounded-lg bg-slate-100 flex items-center justify-center text-slate-400">
                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 font-semibold text-slate-800">{{ $cat->name }}</td>
                        <td class="px-6 py-4 font-mono text-xs text-slate-400">{{ $cat->slug }}</td>
                        <td class="px-6 py-4">
                            <span class="badge {{ $cat->is_active ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-slate-600' }}">
                                {{ $cat->is_active ? 'Actif' : 'Inactif' }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <button onclick="openEditCategory({{ $cat->id }}, {{ json_encode($cat->name) }}, {{ json_encode($cat->description) }}, {{ $cat->is_active ? 'true' : 'false' }})"
                                        class="p-2 rounded-lg hover:bg-amber-50 text-slate-400 hover:text-be-copper transition-colors" title="Modifier">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </button>
                                <form method="POST" action="{{ route('admin.categories.destroy', $cat) }}" onsubmit="return confirm('Voulez-vous vraiment supprimer cette catégorie ? Tous les produits associés seront affectés.')" class="inline">
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
    @endif
</div>

{{-- ===== MODAL: Ajouter ===== --}}
<div id="add-category-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/70 backdrop-blur-sm">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md">
        <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
            <h3 class="font-bold text-slate-800">Ajouter une catégorie</h3>
            <button onclick="document.getElementById('add-category-modal').classList.add('hidden')" class="text-slate-400 hover:text-slate-600">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <form method="POST" action="{{ route('admin.categories.store') }}" enctype="multipart/form-data" class="px-6 py-5 space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5">Nom de la catégorie</label>
                <input type="text" name="name" required placeholder="ex : Disjoncteurs bipolaires"
                       class="w-full rounded-xl bg-slate-50 border border-slate-200 px-4 py-2.5 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-amber-400">
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5">Description</label>
                <textarea name="description" rows="3" placeholder="Brève description de la catégorie..."
                          class="w-full rounded-xl bg-slate-50 border border-slate-200 px-4 py-2.5 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-amber-400 resize-none"></textarea>
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5">Image de couverture</label>
                <input type="file" name="image" accept="image/*"
                       class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-amber-50 file:text-be-copper hover:file:bg-amber-100">
            </div>
            <div class="flex items-center gap-3">
                <input type="checkbox" name="is_active" id="add_is_active" value="1" checked
                       class="rounded border-slate-300 text-be-amber focus:ring-be-amber">
                <label for="add_is_active" class="text-sm text-slate-700 cursor-pointer">Activer la catégorie</label>
            </div>
            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="flex-1 rounded-xl bg-be-amber hover:brightness-95 text-be-ink text-sm font-semibold py-2.5 transition-colors">
                    Enregistrer
                </button>
                <button type="button" onclick="document.getElementById('add-category-modal').classList.add('hidden')"
                        class="flex-1 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 text-sm font-medium py-2.5 transition-colors">
                    Annuler
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ===== MODAL: Modifier ===== --}}
<div id="edit-category-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/70 backdrop-blur-sm">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md">
        <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
            <h3 class="font-bold text-slate-800">Modifier la catégorie</h3>
            <button onclick="document.getElementById('edit-category-modal').classList.add('hidden')" class="text-slate-400 hover:text-slate-600">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <form id="edit-category-form" method="POST" action="" enctype="multipart/form-data" class="px-6 py-5 space-y-4">
            @csrf @method('PUT')
            <div>
                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5">Nom de la catégorie</label>
                <input type="text" name="name" id="edit_cat_name" required
                       class="w-full rounded-xl bg-slate-50 border border-slate-200 px-4 py-2.5 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-amber-400">
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5">Description</label>
                <textarea name="description" id="edit_cat_description" rows="3"
                          class="w-full rounded-xl bg-slate-50 border border-slate-200 px-4 py-2.5 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-amber-400 resize-none"></textarea>
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5">Remplacer l'image</label>
                <input type="file" name="image" accept="image/*"
                       class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-amber-50 file:text-be-copper hover:file:bg-amber-100">
            </div>
            <div class="flex items-center gap-3">
                <input type="checkbox" name="is_active" id="edit_cat_is_active" value="1"
                       class="rounded border-slate-300 text-be-amber focus:ring-be-amber">
                <label for="edit_cat_is_active" class="text-sm text-slate-700 cursor-pointer">Catégorie active</label>
            </div>
            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="flex-1 rounded-xl bg-be-amber hover:brightness-95 text-be-ink text-sm font-semibold py-2.5 transition-colors">
                    Enregistrer
                </button>
                <button type="button" onclick="document.getElementById('edit-category-modal').classList.add('hidden')"
                        class="flex-1 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 text-sm font-medium py-2.5 transition-colors">
                    Annuler
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
function openEditCategory(id, name, description, isActive) {
    document.getElementById('edit_cat_name').value = name;
    document.getElementById('edit_cat_description').value = description || '';
    document.getElementById('edit_cat_is_active').checked = isActive;
    document.getElementById('edit-category-form').action = `/admin/categories/${id}`;
    document.getElementById('edit-category-modal').classList.remove('hidden');
}
</script>
@endpush
