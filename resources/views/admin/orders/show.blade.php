@extends('layouts.admin')
@section('title', 'Détail de la Commande')
@section('page-title', 'Détail de la Commande')

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

<div class="mb-6">
    <a href="{{ route('admin.orders.index') }}" class="text-xs font-semibold text-slate-500 hover:text-be-copper flex items-center gap-1.5 transition-colors">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        Retour aux commandes
    </a>
</div>

<div class="grid lg:grid-cols-[1fr_360px] gap-6">

    {{-- Left column: Order items --}}
    <div class="space-y-6">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
            <div class="flex items-center justify-between border-b border-slate-100 pb-4 mb-6">
                <div>
                    <h3 class="font-bold text-slate-800 text-base">Demande N° <span class="font-mono text-be-copper">{{ $order->reference }}</span></h3>
                    <p class="text-xs text-slate-400">Reçu le {{ $order->created_at->format('d/m/Y à H:i') }}</p>
                </div>
                <span class="badge @if($order->status === 'pending') bg-amber-50 text-amber-700 @elseif($order->status === 'validated') bg-blue-50 text-blue-700 @elseif($order->status === 'completed') bg-emerald-50 text-emerald-700 @else bg-rose-50 text-rose-700 @endif">
                    @if($order->status === 'pending') En attente de validation @elseif($order->status === 'validated') Commande validée @elseif($order->status === 'completed') Livrée @else Rejetée @endif
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-slate-100 font-mono text-[10px] uppercase text-slate-400 tracking-wider">
                            <th class="pb-3">Produit</th>
                            <th class="pb-3 text-right">Prix Unitaire</th>
                            <th class="pb-3 text-center">Quantité</th>
                            <th class="pb-3 text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @php $totalPrice = 0; @endphp
                        @foreach($order->items as $item)
                        @if($item->product)
                        @php
                            $subtotal = $item->product->price * $item->quantity;
                            $totalPrice += $subtotal;
                        @endphp
                        <tr>
                            <td class="py-4">
                                <div class="flex items-center gap-3">
                                    @if($item->product->image)
                                        <img src="{{ asset('storage/'.$item->product->image) }}" class="w-10 h-10 object-cover rounded-lg border border-slate-100" alt="">
                                    @else
                                        <div class="w-10 h-10 bg-slate-50 text-slate-400 rounded-lg flex items-center justify-center">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                            </svg>
                                        </div>
                                    @endif
                                    <div>
                                        <p class="font-semibold text-slate-800 text-sm leading-snug">{{ $item->product->name }}</p>
                                        <span class="font-mono text-[10px] text-slate-400">Réf : {{ $item->product->reference }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 text-right font-mono text-sm text-slate-700">{{ number_format($item->product->price, 2) }} MAD</td>
                            <td class="py-4 text-center font-mono text-sm text-slate-700">{{ $item->quantity }}</td>
                            <td class="py-4 text-right font-mono text-sm font-bold text-slate-800">{{ number_format($subtotal, 2) }} MAD</td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="border-t border-slate-100 pt-5 mt-4 flex justify-between items-baseline">
                <span class="text-sm font-semibold text-slate-500">Estimation Total :</span>
                <span class="font-mono font-extrabold text-2xl text-be-copper">{{ number_format($totalPrice, 2) }} MAD</span>
            </div>
        </div>

        @if($order->notes)
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
            <h4 class="font-bold text-slate-800 text-xs uppercase tracking-wide mb-3">Notes du client</h4>
            <div class="bg-slate-50 rounded-xl p-4 text-slate-600 text-sm italic leading-relaxed">
                " {{ $order->notes }} "
            </div>
        </div>
        @endif
    </div>

    {{-- Right column: Customer details & Action --}}
    <div class="space-y-6">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
            <h3 class="font-bold text-slate-800 text-sm uppercase tracking-wide mb-4">Informations Client</h3>
            <div class="space-y-3.5 text-sm">
                <div>
                    <span class="text-xs text-slate-400 block mb-0.5">Nom complet</span>
                    <p class="font-semibold text-slate-800">{{ $order->customer_name }}</p>
                </div>
                <div>
                    <span class="text-xs text-slate-400 block mb-0.5">Téléphone</span>
                    <p class="font-mono text-slate-800 font-medium">{{ $order->customer_phone }}</p>
                </div>
                @if($order->customer_email)
                <div>
                    <span class="text-xs text-slate-400 block mb-0.5">Adresse email</span>
                    <p class="text-slate-800 font-medium">{{ $order->customer_email }}</p>
                </div>
                @endif
                <div>
                    <span class="text-xs text-slate-400 block mb-0.5">Adresse de livraison</span>
                    <p class="text-slate-700 leading-normal">{{ $order->delivery_address }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
            <h3 class="font-bold text-slate-800 text-sm uppercase tracking-wide mb-4">Action d'administration</h3>
            <form method="POST" action="{{ route('admin.orders.update', $order) }}" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5">Modifier l'état de la commande</label>
                    <select name="status" class="w-full rounded-xl bg-slate-50 border border-slate-200 px-4 py-2.5 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-amber-400">
                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>En attente</option>
                        <option value="validated" {{ $order->status === 'validated' ? 'selected' : '' }}>Valider la commande</option>
                        <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Marquer comme livrée</option>
                        <option value="rejected" {{ $order->status === 'rejected' ? 'selected' : '' }}>Rejeter / Annuler</option>
                    </select>
                </div>
                <button type="submit" class="w-full rounded-xl bg-be-amber hover:brightness-95 text-be-ink text-sm font-semibold py-2.5 transition-colors">
                    Mettre à jour le statut
                </button>
            </form>
        </div>
    </div>

</div>

@endsection
