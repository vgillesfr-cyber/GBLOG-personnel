@extends('layouts.app')

@section('title', 'Réinitialiser le mot de passe - Mon Blog')

@section('content')
<div class="max-w-md mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-xl shadow-lg p-8">
        <div class="text-center mb-8">
            <div class="gradient-orange w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-key text-white text-2xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-800">Réinitialiser le mot de passe</h1>
            <p class="text-gray-600 mt-2">Entrez votre nouveau mot de passe</p>
        </div>

        <form method="POST" action="{{ route('password.store') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="mb-6">
                <label for="email" class="block text-gray-700 font-semibold mb-2">
                    <i class="fas fa-envelope text-orange-500 mr-2"></i>Email
                </label>
                <input 
                    type="email" 
                    name="email" 
                    id="email" 
                    value="{{ old('email', $request->email) }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 @error('email') border-red-500 @enderror"
                    required
                    autofocus
                >
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password" class="block text-gray-700 font-semibold mb-2">
                    <i class="fas fa-lock text-orange-500 mr-2"></i>Nouveau mot de passe
                </label>
                <input 
                    type="password" 
                    name="password" 
                    id="password" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 @error('password') border-red-500 @enderror"
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
                    required
                >
            </div>

            <button type="submit" class="w-full btn-orange text-white py-3 rounded-lg font-semibold shadow-lg">
                <i class="fas fa-check mr-2"></i>Réinitialiser le mot de passe
            </button>
        </form>
    </div>
</div>
@endsection
