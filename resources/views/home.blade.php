@extends('layouts.app')

@section('title', 'Accueil')

@section('content')
<div class="pt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="text-center">
            <h1 class="text-4xl font-bold text-white mb-6">Bienvenue sur Mon Site</h1>
            <p class="text-xl text-slate-300 mb-8">Une plateforme pour partager et découvrir du contenu</p>
            
            <div class="flex flex-wrap justify-center gap-4">
                @auth
                    <a href="{{ route('profile') }}" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md">
                        Voir mon profil
                    </a>
                @else
                    <a href="{{ route('login') }}" class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-md">
                        Se connecter
                    </a>
                    <a href="{{ route('register') }}" class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-md">
                        S'inscrire
                    </a>
                @endauth
            </div>
        </div>
        
        <div class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-slate-800 p-6 rounded-lg shadow-lg">
                <h2 class="text-xl font-semibold text-white mb-4">Fonctionnalité 1</h2>
                <p class="text-slate-300">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in dui mauris.</p>
            </div>
            
            <div class="bg-slate-800 p-6 rounded-lg shadow-lg">
                <h2 class="text-xl font-semibold text-white mb-4">Fonctionnalité 2</h2>
                <p class="text-slate-300">Vivamus pellentesque tellus arcu, sit amet congue elit placerat eget.</p>
            </div>
            
            <div class="bg-slate-800 p-6 rounded-lg shadow-lg">
                <h2 class="text-xl font-semibold text-white mb-4">Fonctionnalité 3</h2>
                <p class="text-slate-300">Praesent convallis, libero quis congue elementum, nunc ante faucibus sapien.</p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Home page specific scripts can go here
</script>
@endsection