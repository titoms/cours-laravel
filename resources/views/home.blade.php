<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Tailwind -->
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-slate-900 text-slate-100 flex flex-col min-h-screen">

        <!-- Navbar -->
        <nav class="fixed top-0 left-0 w-full bg-slate-800 shadow-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">
                    
                    <!-- Logo -->
                    <div class="text-xl font-bold text-white">
                        Mon Site
                    </div>

                    <!-- Boutons Desktop -->
                    <div class="hidden md:flex space-x-4">
                        @auth
                            <a href="{{ route('profile') }}" class="px-5 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">
                                Profile
                            </a>
                            <a href="{{ url('/dashboard') }}" class="px-5 py-2 text-sm font-medium text-white bg-gray-600 rounded-md hover:bg-gray-700">
                                Dashboard
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="px-5 py-2 text-sm font-medium text-white bg-red-700 rounded-md hover:bg-red-800">
                                    Logout
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="px-5 py-2 text-sm font-medium text-white bg-green-600 rounded-md hover:bg-green-700">
                                Login
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-5 py-2 text-sm font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-700">
                                    Register
                                </a>
                            @endif
                        @endauth
                    </div>

                    <!-- Menu Burger (Mobile) -->
                    <div class="md:hidden">
                        <button id="menu-toggle" class="text-white focus:outline-none">
                            ☰
                        </button>
                    </div>
                </div>
            </div>

            <!-- Menu Mobile -->
            <div id="mobile-menu" class="hidden md:hidden bg-slate-800 p-4">
                @auth
                    <a href="{{ route('profile') }}" class="block px-4 py-2 text-white hover:bg-slate-600 rounded">Profile</a>
                    <a href="{{ url('/dashboard') }}" class="block px-4 py-2 text-white hover:bg-slate-600 rounded">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-white hover:bg-slate-600 rounded">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="block px-4 py-2 text-white hover:bg-slate-600 rounded">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="block px-4 py-2 text-white hover:bg-slate-600 rounded">Register</a>
                    @endif
                @endauth
            </div>
        </nav>

        <!-- Contenu principal -->
        <div class="flex flex-1 justify-center items-center text-4xl font-bold mt-20">
            Salut !
        </div>

        <!-- Script pour le menu burger -->
        <script>
            document.getElementById("menu-toggle").addEventListener("click", function() {
                var menu = document.getElementById("mobile-menu");
                menu.classList.toggle("hidden");
            });
        </script>

    </body>
</html>
