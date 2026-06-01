@extends('layouts.app')

@section('title', 'Mot de passe oublié - Mon Blog')

@section('content')
<div class="max-w-md mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-xl shadow-lg p-8">
        <div class="text-center mb-8">
            <div class="gradient-orange w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-key text-white text-2xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-800">Mot de passe oublié</h1>
            <p class="text-gray-600 mt-2">Entrez votre email pour réinitialiser votre mot de passe</p>
        </div>

        @if (session('status'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
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

            <button type="submit" class="w-full btn-orange text-white py-3 rounded-lg font-semibold shadow-lg mb-4">
                <i class="fas fa-paper-plane mr-2"></i>Envoyer le lien de réinitialisation
            </button>

            <p class="text-center text-gray-600">
                <a href="{{ route('login') }}" class="text-orange-600 hover:text-orange-700 font-semibold">
                    <i class="fas fa-arrow-left mr-1"></i>Retour à la connexion
                </a>
            </p>
        </form>
    </div>
</div>
@endsection
