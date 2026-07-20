@extends('layouts.admin')
@section('title', 'Gestion des Utilisateurs')
@section('page-title', 'Gestion des Utilisateurs')

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

@if(session('error'))
<div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
     class="mb-6 flex items-center gap-3 bg-rose-50 border border-rose-200 text-rose-700 px-4 py-3 rounded-xl text-sm font-medium">
    <svg class="w-5 h-5 text-rose-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
    </svg>
    {{ session('error') }}
</div>
@endif

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 mb-6">
    <form method="GET" action="{{ route('admin.users.index') }}" class="grid sm:grid-cols-3 gap-4 items-end">
        <div>
            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5">Rechercher</label>
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Nom, email..."
                   class="w-full rounded-xl bg-slate-50 border border-slate-200 px-4 py-2 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-amber-400">
        </div>
        <div>
            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5">Rôle</label>
            <select name="role" class="w-full rounded-xl bg-slate-50 border border-slate-200 px-4 py-2 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-amber-400">
                <option value="">Tous</option>
                <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Administrateur</option>
                <option value="customer" {{ request('role') === 'customer' ? 'selected' : '' }}>Client</option>
            </select>
        </div>
        <div class="flex gap-2">
            <button type="submit" class="flex-1 bg-be-amber hover:brightness-95 text-be-ink font-semibold text-sm px-4 py-2 rounded-xl transition-colors">
                Filtrer
            </button>
            <a href="{{ route('admin.users.index') }}" class="flex-1 bg-slate-100 hover:bg-slate-200 text-slate-600 font-semibold text-sm px-4 py-2 rounded-xl text-center transition-colors">
                Reset
            </a>
        </div>
    </form>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="px-6 py-4 border-b border-slate-100">
        <h2 class="font-semibold text-slate-800 text-sm">Liste des utilisateurs</h2>
        <p class="text-xs text-slate-400">Gérez les comptes clients et attribuez les droits d'administration</p>
    </div>

    @if($users->isEmpty())
        <div class="flex flex-col items-center justify-center py-16 text-center">
            <div class="w-16 h-16 rounded-2xl bg-slate-100 flex items-center justify-center mb-4">
                <svg class="w-8 h-8 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
            <p class="font-semibold text-slate-600">Aucun utilisateur trouvé</p>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse admin-table">
                <thead>
                    <tr class="border-b border-slate-100">
                        <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase">Utilisateur</th>
                        <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase">Coordonnées</th>
                        <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase">Rôle</th>
                        <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach($users as $user)
                    <tr>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center text-be-ink text-xs font-bold"
                                     style="background:linear-gradient(135deg,#F5B301,#C9702B)">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-semibold text-slate-800 text-sm leading-snug">{{ $user->name }}</p>
                                    <span class="text-xs text-slate-400">Inscrit le {{ $user->created_at->format('d/m/Y') }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-xs font-medium text-slate-700">{{ $user->email }}</p>
                            @if($user->phone)
                                <p class="text-[11px] font-mono text-slate-400 mt-0.5">{{ $user->phone }}</p>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <form method="POST" action="{{ route('admin.users.update', $user) }}" class="inline-flex items-center gap-2">
                                @csrf @method('PUT')
                                <select name="role" onchange="this.form.submit()"
                                        class="rounded-lg bg-slate-50 border border-slate-200 text-xs px-2.5 py-1.5 font-semibold focus:outline-none focus:ring-2 focus:ring-amber-400 text-slate-700">
                                    <option value="customer" {{ $user->role === 'customer' ? 'selected' : '' }}>Client</option>
                                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Administrateur</option>
                                </select>
                            </form>
                        </td>
                        <td class="px-6 py-4">
                            <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('Voulez-vous vraiment supprimer cet utilisateur ?')" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-2 rounded-lg hover:bg-red-50 text-slate-400 hover:text-red-500 transition-colors" title="Supprimer">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t border-slate-100">
            {{ $users->links() }}
        </div>
    @endif
</div>

@endsection
