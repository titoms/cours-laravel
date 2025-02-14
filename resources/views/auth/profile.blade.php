<!-- resources/views/auth/profile.blade.php -->

@extends('layouts.app')

@section('title', 'Profile - ' . $user->username)

@section('content')
<div class="flex flex-1 justify-center pt-24 px-4 sm:px-6 lg:px-8 mb-8">
    <div class="w-full max-w-3xl">
        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded-md mb-6">
                {{ session('success') }}
            </div>
        @endif
        
        <div class="bg-slate-800 rounded-lg shadow-lg overflow-hidden">
            <div class="p-6 sm:p-8">
                <div class="flex flex-col md:flex-row md:items-center">
                    <div class="md:w-1/3 flex justify-center mb-6 md:mb-0">
                        @if ($user->profile_picture)
                            <div class="relative w-40 h-40 rounded-full overflow-hidden border-4 border-blue-500">
                                <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Photo de profil" class="w-full h-full object-cover">
                            </div>
                        @else
                            <div class="w-40 h-40 rounded-full bg-slate-700 flex items-center justify-center border-4 border-slate-600">
                                <span class="text-5xl text-slate-500">{{ strtoupper(substr($user->username, 0, 1)) }}</span>
                            </div>
                        @endif
                    </div>
                    
                    <div class="md:w-2/3 md:pl-8">
                        <h1 class="text-3xl font-bold text-white mb-2">{{ $user->username }}</h1>
                        <div class="text-slate-300 mb-6">
                            <p class="mb-2"><span class="font-semibold text-blue-400">Email:</span> {{ $user->email }}</p>
                            <div class="mt-4">
                                <h3 class="font-semibold text-blue-400 mb-2">Bio:</h3>
                                <p class="text-slate-300 bg-slate-700 p-4 rounded-md">{{ $user->bio ?? 'Aucune bio' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-8 pt-6 border-t border-slate-700">
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('home') }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md">
                            Retour à l'accueil
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-md">
                                Se déconnecter
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection