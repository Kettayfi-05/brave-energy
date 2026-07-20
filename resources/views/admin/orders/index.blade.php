@extends('layouts.admin')
@section('title', 'Gestion des Commandes')
@section('page-title', 'Gestion des Commandes')

@section('content')

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 mb-6">
    <form method="GET" action="{{ route('admin.orders.index') }}" class="grid sm:grid-cols-3 gap-4 items-end">
        <div>
            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5">Rechercher</label>
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Référence, client..."
                   class="w-full rounded-xl bg-slate-50 border border-slate-200 px-4 py-2 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-amber-400">
        </div>
        <div>
            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5">Statut de la demande</label>
            <select name="status" class="w-full rounded-xl bg-slate-50 border border-slate-200 px-4 py-2 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-amber-400">
                <option value="">Tous</option>
                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>En attente</option>
                <option value="validated" {{ request('status') === 'validated' ? 'selected' : '' }}>Validée</option>
                <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejetée</option>
                <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Terminée</option>
            </select>
        </div>
        <div class="flex gap-2">
            <button type="submit" class="flex-1 bg-be-amber hover:brightness-95 text-be-ink font-semibold text-sm px-4 py-2 rounded-xl transition-colors">
                Filtrer
            </button>
            <a href="{{ route('admin.orders.index') }}" class="flex-1 bg-slate-100 hover:bg-slate-200 text-slate-600 font-semibold text-sm px-4 py-2 rounded-xl text-center transition-colors">
                Reset
            </a>
        </div>
    </form>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="px-6 py-4 border-b border-slate-100">
        <h2 class="font-semibold text-slate-800 text-sm">Liste des demandes de commandes</h2>
        <p class="text-xs text-slate-400">Consultez et validez les demandes d'achats de vos clients</p>
    </div>

    @if($orders->isEmpty())
        <div class="flex flex-col items-center justify-center py-16 text-center">
            <div class="w-16 h-16 rounded-2xl bg-slate-100 flex items-center justify-center mb-4">
                <svg class="w-8 h-8 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                </svg>
            </div>
            <p class="font-semibold text-slate-600">Aucune demande trouvée</p>
            <p class="text-sm text-slate-400 mt-1">Les demandes de devis ou commandes apparaîtront ici.</p>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse admin-table">
                <thead>
                    <tr class="border-b border-slate-100">
                        <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase">Référence</th>
                        <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase">Client</th>
                        <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase">Téléphone</th>
                        <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase">Date</th>
                        <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase">Statut</th>
                        <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach($orders as $order)
                    <tr>
                        <td class="px-6 py-4 font-mono text-sm font-semibold text-be-copper">{{ $order->reference }}</td>
                        <td class="px-6 py-4">
                            <p class="font-semibold text-slate-800 text-sm leading-snug">{{ $order->customer_name }}</p>
                            <span class="text-xs text-slate-400">{{ $order->customer_email }}</span>
                        </td>
                        <td class="px-6 py-4 font-mono text-xs text-slate-600">{{ $order->customer_phone }}</td>
                        <td class="px-6 py-4 text-slate-500 text-xs">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                        <td class="px-6 py-4">
                            <span class="badge @if($order->status === 'pending') bg-amber-50 text-amber-700 @elseif($order->status === 'validated') bg-blue-50 text-blue-700 @elseif($order->status === 'completed') bg-emerald-50 text-emerald-700 @else bg-rose-50 text-rose-700 @endif">
                                @if($order->status === 'pending') En attente @elseif($order->status === 'validated') Validée @elseif($order->status === 'completed') Livrée @else Rejetée @endif
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('admin.orders.show', $order) }}"
                               class="inline-flex items-center gap-1.5 bg-slate-100 hover:bg-be-amber hover:text-be-ink text-slate-700 text-xs font-semibold px-3 py-1.5 rounded-lg transition-all">
                                Voir détails
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t border-slate-100">
            {{ $orders->links() }}
        </div>
    @endif
</div>

@endsection
