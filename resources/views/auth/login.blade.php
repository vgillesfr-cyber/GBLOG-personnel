@extends('layouts.app')

@section('title', 'Connexion - Mon Blog')

@section('content')
<div class="max-w-md mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-xl shadow-lg p-8">
        <div class="text-center mb-8">
            <div class="gradient-orange w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-sign-in-alt text-white text-2xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-800">Connexion</h1>
            <p class="text-gray-600 mt-2">Connectez-vous à votre compte</p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

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
                    autofocus
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

            <div class="flex items-center justify-between mb-6">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="rounded border-gray-300 text-orange-600 focus:ring-orange-500">
                    <span class="ml-2 text-gray-700 text-sm">Se souvenir de moi</span>
                </label>
                <a href="{{ route('password.request') }}" class="text-orange-600 hover:text-orange-700 text-sm font-semibold">
                    Mot de passe oublié ?
                </a>
            </div>

            <button type="submit" class="w-full btn-orange text-white py-3 rounded-lg font-semibold shadow-lg mb-4">
                <i class="fas fa-sign-in-alt mr-2"></i>Se connecter
            </button>

            <p class="text-center text-gray-600">
                Pas encore de compte ? 
                <a href="{{ route('register') }}" class="text-orange-600 hover:text-orange-700 font-semibold">
                    S'inscrire
                </a>
            </p>
        </form>
    </div>
</div>
@endsection
