<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title', 'Laravel')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Tailwind -->
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-slate-900 text-slate-100 flex flex-col min-h-screen">

        <!-- Navbar -->
        @include('components.navbar')

        <!-- Contenu principal -->
        <main class="flex-1 m-24">
            @yield('content')
        </main>

        <!-- Footer -->
        @include('components.footer')

        <!-- Scripts -->
        <script>
            // Global scripts can go here
            document.addEventListener('DOMContentLoaded', function() {
                // Any scripts that need to run on all pages
            });
        </script>
        @yield('scripts')

    </body>
</html>
