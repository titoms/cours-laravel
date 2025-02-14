@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="flex flex-1 justify-center items-center py-10 mt-16">
    <div class="w-full max-w-md p-8 bg-slate-800 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-center mb-6">Connexion</h2>
        
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

        <form method="POST" action="{{ route('login.submit') }}" class="space-y-4">
            @csrf
            <div>
                <label for="email" class="block text-sm font-medium text-slate-300">Email</label>
                <input type="email" name="email" id="email" placeholder="Votre email" class="mt-1 block w-full px-3 py-2 bg-slate-700 border border-slate-600 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            
            <div>
                <label for="password" class="block text-sm font-medium text-slate-300">Mot de passe</label>
                <input type="password" name="password" id="password" placeholder="Votre mot de passe" class="mt-1 block w-full px-3 py-2 bg-slate-700 border border-slate-600 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            
            <div class="flex items-center">
                <input type="checkbox" name="remember" id="remember" class="h-4 w-4 bg-slate-700 border-slate-600 rounded text-blue-600 focus:ring-blue-500">
                <label for="remember" class="ml-2 block text-sm text-slate-300">Se souvenir de moi</label>
            </div>
            
            <div>
                <button type="submit" class="w-full px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                    Se connecter
                </button>
            </div>
        </form>
        
        <div class="mt-6 text-center">
            <p class="text-sm text-slate-400">
                Pas encore de compte? 
                <a href="{{ route('register') }}" class="text-blue-400 hover:text-blue-300">
                    S'inscrire
                </a>
            </p>
        </div>
    </div>
</div>
@endsection