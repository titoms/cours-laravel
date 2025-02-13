<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Register - Laravel</title>

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
                        <a href="{{ route('home') }}">Mon Site</a>
                    </div>

                    <!-- Boutons Desktop -->
                    <div class="hidden md:flex space-x-4">
                        <a href="{{ route('login') }}" class="px-5 py-2 text-sm font-medium text-white bg-green-600 rounded-md hover:bg-green-700">
                            Login
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-5 py-2 text-sm font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-700">
                                Register
                            </a>
                        @endif
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
                <a href="{{ route('login') }}" class="block px-4 py-2 text-white hover:bg-slate-600 rounded">Login</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="block px-4 py-2 text-white hover:bg-slate-600 rounded">Register</a>
                @endif
            </div>
        </nav>

        <!-- Contenu principal -->
        <div class="flex flex-1 justify-center items-center py-10 mt-16">
            <div class="w-full max-w-md p-8 bg-slate-800 rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold text-center mb-6">Inscription</h2>
                
                @if(session('success'))
                    <div class="bg-green-500 text-white p-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="bg-red-500 text-white p-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="bg-red-500 text-white p-3 rounded mb-4">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register.submit') }}" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div>
                        <label for="username" class="block text-sm font-medium text-slate-300">Nom d'utilisateur</label>
                        <input type="text" name="username" id="username" placeholder="Votre nom d'utilisateur" class="mt-1 block w-full px-3 py-2 bg-slate-700 border border-slate-600 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    
                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-300">Email</label>
                        <input type="email" name="email" id="email" placeholder="Votre email" class="mt-1 block w-full px-3 py-2 bg-slate-700 border border-slate-600 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    
                    <div>
                        <label for="password" class="block text-sm font-medium text-slate-300">Mot de passe</label>
                        <input type="password" name="password" id="password" placeholder="Votre mot de passe" class="mt-1 block w-full px-3 py-2 bg-slate-700 border border-slate-600 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    
                    <div>
                        <label for="bio" class="block text-sm font-medium text-slate-300">Bio</label>
                        <textarea name="bio" id="bio" placeholder="Parlez-nous de vous" class="mt-1 block w-full px-3 py-2 bg-slate-700 border border-slate-600 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-blue-500" rows="3"></textarea>
                    </div>
                    
                    <div>
                        <label for="profile_picture" class="block text-sm font-medium text-slate-300">Photo de profil</label>
                        <div class="mt-1 flex items-center">
                            <label class="block w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-md text-white hover:bg-slate-600 cursor-pointer text-center">
                                <span>Choisir une image</span>
                                <input type="file" name="profile_picture" id="profile_picture" accept="image/*" class="hidden">
                            </label>
                        </div>
                        <div id="file-name" class="mt-2 text-sm text-slate-400"></div>
                    </div>
                    
                    <div>
                        <button type="submit" class="w-full px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            S'inscrire
                        </button>
                    </div>
                </form>
                
                <div class="mt-6 text-center">
                    <p class="text-sm text-slate-400">
                        Déjà inscrit? 
                        <a href="{{ route('login') }}" class="text-blue-400 hover:text-blue-300">
                            Se connecter
                        </a>
                    </p>
                </div>
            </div>
        </div>

        <!-- Script pour le menu burger -->
        <script>
            document.getElementById("menu-toggle").addEventListener("click", function() {
                var menu = document.getElementById("mobile-menu");
                menu.classList.toggle("hidden");
            });

            // Display file name when selected
            document.getElementById("profile_picture").addEventListener("change", function() {
                var fileName = this.files[0] ? this.files[0].name : "Aucun fichier sélectionné";
                document.getElementById("file-name").textContent = fileName;
            });
        </script>

    </body>
</html>