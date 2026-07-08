@extends('layouts.admin')
@section('title', 'Tableau de Bord')
@section('page-title', 'Tableau de Bord')

@section('content')

{{-- ═══ Welcome Banner ══════════════════════════════════════════════════════ --}}
<div class="relative rounded-2xl overflow-hidden mb-8 p-8"
     style="background: linear-gradient(135deg, #7c3aed 0%, #6366f1 50%, #0ea5e9 100%)">
    <div class="absolute inset-0 opacity-10"
         style="background-image: radial-gradient(circle at 20% 50%, white 1px, transparent 1px),
                radial-gradient(circle at 80% 20%, white 1px, transparent 1px);
                background-size: 40px 40px;"></div>
    <div class="relative z-10 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-white">
                Bonjour, {{ auth()->user()->name }} 👋
            </h1>
            <p class="text-purple-200 mt-1 text-sm">
                Bienvenue sur votre panneau d'administration Brave Energy.
            </p>
            <div class="flex items-center gap-2 mt-3">
                <span class="inline-flex items-center gap-1.5 bg-white/20 text-white text-xs font-medium px-3 py-1 rounded-full">
                    <span class="w-1.5 h-1.5 rounded-full bg-green-400 animate-pulse"></span>
                    Système opérationnel
                </span>
                <span class="text-purple-200 text-xs">
                    {{ now()->locale('fr')->isoFormat('dddd D MMMM YYYY') }}
                </span>
            </div>
        </div>
        <div class="hidden lg:flex gap-3">
            <div class="bg-white/15 backdrop-blur-sm rounded-2xl px-5 py-3 text-center">
                <p class="text-white font-bold text-xl">{{ $stats['products'] }}</p>
                <p class="text-purple-200 text-xs">Produits</p>
            </div>
            <div class="bg-white/15 backdrop-blur-sm rounded-2xl px-5 py-3 text-center">
                <p class="text-white font-bold text-xl">{{ $stats['orders'] }}</p>
                <p class="text-purple-200 text-xs">Commandes</p>
            </div>
            <div class="bg-white/15 backdrop-blur-sm rounded-2xl px-5 py-3 text-center">
                <p class="text-white font-bold text-xl">{{ $stats['customers'] }}</p>
                <p class="text-purple-200 text-xs">Clients</p>
            </div>
        </div>
    </div>
</div>

{{-- ═══ Stats Cards ════════════════════════════════════════════════════════ --}}
<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 mb-8">

    {{-- Produits --}}
    <div class="stat-card bg-white shadow-sm border border-slate-100">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-widest text-slate-500">Produits</p>
                <p class="text-3xl font-extrabold text-slate-800 mt-1">{{ $stats['products'] }}</p>
            </div>
            <div class="w-12 h-12 rounded-2xl flex items-center justify-center flex-shrink-0"
                 style="background:linear-gradient(135deg,#7c3aed,#a855f7)">
                <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
            </div>
        </div>
        <div class="mt-4 flex items-center gap-2">
            <span class="badge bg-purple-100 text-purple-700">Catalogue</span>
        </div>
        <div class="absolute bottom-0 left-0 right-0 h-1 rounded-b-2xl" style="background:linear-gradient(90deg,#7c3aed,#a855f7)"></div>
    </div>

    {{-- Commandes --}}
    <div class="stat-card bg-white shadow-sm border border-slate-100">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-widest text-slate-500">Commandes</p>
                <p class="text-3xl font-extrabold text-slate-800 mt-1">{{ $stats['orders'] }}</p>
            </div>
            <div class="w-12 h-12 rounded-2xl flex items-center justify-center flex-shrink-0"
                 style="background:linear-gradient(135deg,#0ea5e9,#38bdf8)">
                <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
            </div>
        </div>
        <div class="mt-4 flex items-center gap-2">
            <span class="badge bg-sky-100 text-sky-700">Demandes</span>
        </div>
        <div class="absolute bottom-0 left-0 right-0 h-1 rounded-b-2xl" style="background:linear-gradient(90deg,#0ea5e9,#38bdf8)"></div>
    </div>

    {{-- Clients --}}
    <div class="stat-card bg-white shadow-sm border border-slate-100">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-widest text-slate-500">Clients</p>
                <p class="text-3xl font-extrabold text-slate-800 mt-1">{{ $stats['customers'] }}</p>
            </div>
            <div class="w-12 h-12 rounded-2xl flex items-center justify-center flex-shrink-0"
                 style="background:linear-gradient(135deg,#10b981,#34d399)">
                <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
        </div>
        <div class="mt-4 flex items-center gap-2">
            <span class="badge bg-emerald-100 text-emerald-700">Inscrits</span>
        </div>
        <div class="absolute bottom-0 left-0 right-0 h-1 rounded-b-2xl" style="background:linear-gradient(90deg,#10b981,#34d399)"></div>
    </div>

    {{-- Messages --}}
    <div class="stat-card bg-white shadow-sm border border-slate-100">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-widest text-slate-500">Messages</p>
                <p class="text-3xl font-extrabold text-slate-800 mt-1">{{ $stats['messages'] }}</p>
            </div>
            <div class="w-12 h-12 rounded-2xl flex items-center justify-center flex-shrink-0"
                 style="background:linear-gradient(135deg,#f59e0b,#fbbf24)">
                <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </div>
        </div>
        <div class="mt-4 flex items-center gap-2">
            <span class="badge bg-amber-100 text-amber-700">Contact</span>
        </div>
        <div class="absolute bottom-0 left-0 right-0 h-1 rounded-b-2xl" style="background:linear-gradient(90deg,#f59e0b,#fbbf24)"></div>
    </div>
</div>

{{-- ═══ Activity Row ════════════════════════════════════════════════════════ --}}
<div class="grid grid-cols-1 xl:grid-cols-5 gap-6">

    {{-- Recent Orders Table --}}
    <div class="xl:col-span-3 bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
            <h2 class="font-bold text-slate-800">Commandes Récentes</h2>
            <a href="{{ route('admin.orders.index') }}"
               class="text-xs font-semibold text-purple-600 hover:text-purple-800 transition-colors">
                Voir tout →
            </a>
        </div>
        @if($recentOrders->isEmpty())
            <div class="py-16 flex flex-col items-center text-slate-400">
                <svg class="w-12 h-12 mb-3 opacity-40" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                <p class="text-sm">Aucune commande pour le moment</p>
            </div>
        @else
        <table class="admin-table w-full">
            <thead class="bg-slate-50">
                <tr>
                    <th class="text-left">Client</th>
                    <th class="text-left">Statut</th>
                    <th class="text-left">Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentOrders as $order)
                <tr class="transition-colors">
                    <td>
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg flex items-center justify-center text-white text-xs font-bold flex-shrink-0"
                                 style="background:linear-gradient(135deg,#7c3aed,#6366f1)">
                                {{ strtoupper(substr($order->user->name ?? 'U', 0, 1)) }}
                            </div>
                            <div>
                                <p class="font-medium text-slate-800 text-sm">{{ $order->user->name ?? 'Client inconnu' }}</p>
                                <p class="text-slate-400 text-xs">{{ $order->user->email ?? '' }}</p>
                            </div>
                        </div>
                    </td>
                    <td>
                        @php
                            $statusMap = [
                                'pending'   => ['label'=>'En attente', 'class'=>'bg-amber-100 text-amber-700'],
                                'confirmed' => ['label'=>'Confirmée',  'class'=>'bg-blue-100 text-blue-700'],
                                'delivered' => ['label'=>'Livrée',     'class'=>'bg-emerald-100 text-emerald-700'],
                                'cancelled' => ['label'=>'Annulée',    'class'=>'bg-red-100 text-red-700'],
                            ];
                            $s = $statusMap[$order->status] ?? ['label'=>$order->status,'class'=>'bg-slate-100 text-slate-600'];
                        @endphp
                        <span class="badge {{ $s['class'] }}">{{ $s['label'] }}</span>
                    </td>
                    <td class="text-slate-500 text-xs">
                        {{ $order->created_at->diffForHumans() }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>

    {{-- Recent Users --}}
    <div class="xl:col-span-2 bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
            <h2 class="font-bold text-slate-800">Nouveaux Clients</h2>
            <a href="{{ route('admin.users.index') }}"
               class="text-xs font-semibold text-purple-600 hover:text-purple-800 transition-colors">
                Voir tout →
            </a>
        </div>
        <div class="divide-y divide-slate-100">
            @forelse($recentUsers as $user)
            <div class="flex items-center gap-3 px-6 py-3.5 hover:bg-slate-50 transition-colors">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center text-white text-sm font-bold flex-shrink-0"
                     style="background:linear-gradient(135deg,#10b981,#34d399)">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-slate-800 truncate">{{ $user->name }}</p>
                    <p class="text-xs text-slate-400 truncate">{{ $user->email }}</p>
                </div>
                <span class="text-xs text-slate-400 flex-shrink-0">{{ $user->created_at->diffForHumans() }}</span>
            </div>
            @empty
            <div class="py-12 flex flex-col items-center text-slate-400">
                <svg class="w-10 h-10 mb-2 opacity-40" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                <p class="text-sm">Aucun client inscrit</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

@endsection
