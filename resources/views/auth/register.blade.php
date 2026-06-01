@extends('layouts.app')

@section('title', 'Inscription - Mon Blog')

@section('content')
<div class="max-w-md mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-xl shadow-lg p-8">
        <div class="text-center mb-8">
            <div class="gradient-orange w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-user-plus text-white text-2xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-800">Inscription</h1>
            <p class="text-gray-600 mt-2">Créez votre compte gratuitement</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-6">
                <label for="name" class="block text-gray-700 font-semibold mb-2">
                    <i class="fas fa-user text-orange-500 mr-2"></i>Nom
                </label>
                <input 
                    type="text" 
                    name="name" 
                    id="name" 
                    value="{{ old('name') }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 @error('name') border-red-500 @enderror"
                    placeholder="Votre nom"
                    required
                    autofocus
                >
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="email" class="block text-gray-700 font-semibold mb-2">
                    <i class="fas fa-envelope text-orange-500 mr-2"></i>Email
                </label>
                <input 
                    type="email" 
                    name="email" 
                    id="email" 
                    value="{{ old('email') }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 @error('email') border-red-500 @enderror"
                    placeholder="votre@email.com"
                    required
                >
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password" class="block text-gray-700 font-semibold mb-2">
                    <i class="fas fa-lock text-orange-500 mr-2"></i>Mot de passe
                </label>
                <input 
                    type="password" 
                    name="password" 
                    id="password" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 @error('password') border-red-500 @enderror"
                    placeholder="••••••••"
                    required
                >
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password_confirmation" class="block text-gray-700 font-semibold mb-2">
                    <i class="fas fa-lock text-orange-500 mr-2"></i>Confirmer le mot de passe
                </label>
                <input 
                    type="password" 
                    name="password_confirmation" 
                    id="password_confirmation" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                    placeholder="••••••••"
                    required
                >
            </div>

            <button type="submit" class="w-full btn-orange text-white py-3 rounded-lg font-semibold shadow-lg mb-4">
                <i class="fas fa-user-plus mr-2"></i>S'inscrire
            </button>

            <p class="text-center text-gray-600">
                Déjà un compte ? 
                <a href="{{ route('login') }}" class="text-orange-600 hover:text-orange-700 font-semibold">
                    Se connecter
                </a>
            </p>
        </form>
    </div>
</div>
@endsection
