<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Mini CRM') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#6366f1',
                        secondary: '#0ea5e9',
                        accent: '#22c55e',
                    }
                }
            }
        }
    </script>
    <style>
        .container { max-width: 1200px; }
    </style>
    @stack('head')
    @vite([])
</head>
<body class="bg-slate-50 text-slate-800 min-h-screen flex flex-col">
    <header class="bg-gradient-to-r from-primary to-secondary text-white shadow">
        <div class="container mx-auto px-4 py-4 flex items-center justify-between">
            <a href="/" class="text-xl font-bold">Mini CRM</a>
            <nav class="space-x-4 text-sm">
                <a class="hover:underline" href="/companies">Companies</a>
                <a class="hover:underline" href="/customers">Customers</a>
                <a class="hover:underline" href="/deals">Deals</a>
                <a class="hover:underline" href="/tasks">Tasks</a>
                <a class="hover:underline" href="/notes">Notes</a>
            </nav>
        </div>
    </header>

    <main class="container mx-auto px-4 py-8 w-full flex-1">
        @if (session('status'))
            <div class="mb-4 p-3 rounded bg-emerald-50 text-emerald-700 border border-emerald-200">{{ session('status') }}</div>
        @endif
        @yield('content')
    </main>

    <footer class="bg-slate-900 text-slate-300 mt-8">
        <div class="container mx-auto px-4 py-6 text-sm flex items-center justify-between">
            <div>&copy; {{ date('Y') }} Mini CRM</div>
            <div class="space-x-3">
                <span class="text-slate-500">Built with Laravel</span>
            </div>
        </div>
    </footer>
</body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
