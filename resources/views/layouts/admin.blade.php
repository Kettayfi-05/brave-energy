<!DOCTYPE html>
<html lang="fr" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Brave Energy – Panneau d'Administration">
    <title>@yield('title', 'Dashboard') – Brave Energy Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { font-family: 'Inter', sans-serif; }

        /* ── Sidebar ── */
        #sidebar {
            width: 260px;
            min-height: 100vh;
            background: linear-gradient(180deg, #0f172a 0%, #1e1b4b 60%, #0f172a 100%);
            transition: width 0.3s ease, transform 0.3s ease;
            position: fixed;
            top: 0; left: 0;
            z-index: 50;
            overflow: hidden;
        }
        #sidebar.collapsed { width: 72px; }
        #sidebar .sidebar-label { transition: opacity 0.2s ease, width 0.2s ease; }
        #sidebar.collapsed .sidebar-label { opacity: 0; width: 0; overflow: hidden; white-space: nowrap; }

        /* ── Main ── */
        #main-content {
            margin-left: 260px;
            transition: margin-left 0.3s ease;
            min-height: 100vh;
            background: #f1f5f9;
        }
        #main-content.expanded { margin-left: 72px; }

        /* ── Nav links ── */
        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 18px;
            border-radius: 10px;
            color: #94a3b8;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: background 0.2s, color 0.2s, transform 0.15s;
            white-space: nowrap;
        }
        .nav-link:hover {
            background: rgba(139,92,246,.15);
            color: #a78bfa;
            transform: translateX(3px);
        }
        .nav-link.active {
            background: linear-gradient(90deg, rgba(139,92,246,.35), rgba(99,102,241,.2));
            color: #c4b5fd;
            border-left: 3px solid #7c3aed;
        }
        .nav-link svg { flex-shrink: 0; }

        /* ── Stat card ── */
        .stat-card {
            border-radius: 16px;
            padding: 24px;
            position: relative;
            overflow: hidden;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .stat-card:hover { transform: translateY(-4px); box-shadow: 0 20px 40px rgba(0,0,0,.12); }

        /* ── Table ── */
        .admin-table th { font-size: 11px; font-weight: 600; letter-spacing:.08em; text-transform:uppercase; color:#64748b; padding:12px 16px; }
        .admin-table td { padding:14px 16px; border-bottom:1px solid #f1f5f9; font-size:14px; color:#334155; }
        .admin-table tr:last-child td { border-bottom: none; }
        .admin-table tr:hover td { background:#f8fafc; }

        /* ── Topbar ── */
        #topbar {
            position: sticky;
            top: 0;
            z-index: 40;
            background: rgba(255,255,255,.9);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid #e2e8f0;
        }

        /* ── Badge ── */
        .badge { font-size:11px; font-weight:600; padding:3px 9px; border-radius:999px; }
    </style>
</head>
<body class="h-full bg-slate-100">

    <!-- ═══ SIDEBAR ═══════════════════════════════════════════════════════════ -->
    <aside id="sidebar">

        <!-- Logo -->
        <div class="flex items-center gap-3 px-5 py-6 border-b border-white/10">
            <div class="w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0"
                 style="background:linear-gradient(135deg,#7c3aed,#6366f1)">
                <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </div>
            <div class="sidebar-label">
                <p class="text-white font-bold text-sm leading-none">Brave Energy</p>
                <p class="text-purple-300 text-xs mt-0.5">Administration</p>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="px-3 py-5 space-y-1">
            <p class="sidebar-label text-xs font-semibold uppercase tracking-widest text-slate-500 px-3 pb-2">Menu Principal</p>

            <a href="{{ route('admin.dashboard') }}"
               class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span class="sidebar-label">Tableau de Bord</span>
            </a>

            <a href="{{ route('admin.products.index') }}"
               class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
                <span class="sidebar-label">Produits</span>
            </a>

            <a href="{{ route('admin.orders.index') }}"
               class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                </svg>
                <span class="sidebar-label">Commandes</span>
            </a>

            <a href="{{ route('admin.categories.index') }}"
               class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                </svg>
                <span class="sidebar-label">Catégories</span>
            </a>

            <a href="{{ route('admin.users.index') }}"
               class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <span class="sidebar-label">Utilisateurs</span>
            </a>

            <a href="{{ route('admin.chatbot.index') }}"
               class="nav-link {{ request()->routeIs('admin.chatbot.*') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                </svg>
                <span class="sidebar-label">Chatbot</span>
            </a>
        </nav>

        <!-- Bottom: back to site -->
        <div class="absolute bottom-0 left-0 right-0 p-3 border-t border-white/10">
            <a href="{{ url('/') }}" class="nav-link text-slate-400 hover:text-white">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                <span class="sidebar-label">Retour au site</span>
            </a>
        </div>
    </aside>

    <!-- ═══ MAIN ══════════════════════════════════════════════════════════════ -->
    <div id="main-content">

        <!-- ── TOPBAR ──────────────────────────────────────────────────────── -->
        <header id="topbar">
            <div class="flex items-center justify-between px-6 py-3">

                <!-- Left: toggle + breadcrumb -->
                <div class="flex items-center gap-4">
                    <button id="sidebar-toggle"
                            class="p-2 rounded-lg hover:bg-slate-100 transition-colors text-slate-600"
                            onclick="toggleSidebar()">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                    <div>
                        <p class="text-slate-800 font-semibold text-sm">@yield('page-title', 'Tableau de Bord')</p>
                        <p class="text-slate-400 text-xs">Brave Energy &rsaquo; Administration</p>
                    </div>
                </div>

                <!-- Right: search + notifications + user -->
                <div class="flex items-center gap-3">

                    <!-- Search -->
                    <div class="relative hidden md:block">
                        <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input type="text" placeholder="Rechercher..."
                               class="pl-9 pr-4 py-2 text-sm bg-slate-100 border-0 rounded-xl text-slate-700 focus:outline-none focus:ring-2 focus:ring-purple-500 w-48 transition-all focus:w-64">
                    </div>

                    <!-- Notifications bell -->
                    <button class="relative p-2 rounded-xl hover:bg-slate-100 transition-colors">
                        <svg class="w-5 h-5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 rounded-full ring-2 ring-white"></span>
                    </button>

                    <!-- User avatar + dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                                class="flex items-center gap-2 p-1.5 rounded-xl hover:bg-slate-100 transition-colors">
                            <div class="w-8 h-8 rounded-lg flex items-center justify-center text-white text-xs font-bold"
                                 style="background:linear-gradient(135deg,#7c3aed,#6366f1)">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <div class="hidden md:block text-left">
                                <p class="text-sm font-semibold text-slate-800 leading-none">{{ auth()->user()->name }}</p>
                                <p class="text-xs text-slate-400 mt-0.5">Administrateur</p>
                            </div>
                            <svg class="w-4 h-4 text-slate-400 hidden md:block" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <div x-show="open" @click.outside="open = false"
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             class="absolute right-0 mt-2 w-52 bg-white rounded-2xl shadow-xl border border-slate-100 py-2 z-50">
                            <div class="px-4 py-3 border-b border-slate-100">
                                <p class="text-sm font-semibold text-slate-800">{{ auth()->user()->name }}</p>
                                <p class="text-xs text-slate-400 truncate">{{ auth()->user()->email }}</p>
                            </div>
                            <a href="{{ url('/') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition-colors">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                </svg>
                                Voir le site
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                        class="w-full flex items-center gap-3 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                    Déconnexion
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- ── PAGE CONTENT ────────────────────────────────────────────────── -->
        <main class="p-6 lg:p-8">
            @yield('content')
        </main>
    </div>

    <!-- Alpine.js for dropdown -->
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const main    = document.getElementById('main-content');
            sidebar.classList.toggle('collapsed');
            main.classList.toggle('expanded');
        }
    </script>
    @stack('scripts')
</body>
</html>