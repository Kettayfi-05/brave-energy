<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Brave Energy') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@500;600&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            :root{
                --be-bg:      #12181F;
                --be-bg-2:    #1B232C;
                --be-amber:   #F5B301;
                --be-copper:  #C9702B;
                --be-cream:   #F7F5F1;
                --be-ink:     #161B22;
                --be-green:   #2E8B57;
            }
        </style>
    </head>
    <body class="font-sans antialiased text-white bg-be-bg">
        <div class="min-h-screen flex flex-col justify-center items-center p-4">
            <!-- Logo -->
            <div class="mb-8">
                <a href="{{ url('/') }}" class="flex items-center gap-2">
                    <span class="w-10 h-10 rounded-md bg-be-amber flex items-center justify-center">
                        <svg class="w-5.5 h-5.5 text-be-ink" viewBox="0 0 24 24" fill="currentColor"><path d="M13 2 3 14h7l-1 8 11-14h-7l0-6z"/></svg>
                    </span>
                    <span class="font-display font-bold text-xl tracking-tight text-white">
                        BRAVE <span class="text-be-amber">ENERGY</span>
                    </span>
                </a>
            </div>

            <!-- Content Card -->
            <div class="w-full sm:max-w-md bg-be-bg-2 border border-white/10 rounded-2xl p-6 sm:p-8 shadow-2xl text-white">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
