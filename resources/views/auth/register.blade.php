@extends('layouts.app')

@section('title', 'Register')

@section('content')
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
@endsection

@section('scripts')
<script>
    // Display file name when selected
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById("profile_picture").addEventListener("change", function() {
            var fileName = this.files[0] ? this.files[0].name : "Aucun fichier sélectionné";
            document.getElementById("file-name").textContent = fileName;
        });
    });
</script>
@endsection