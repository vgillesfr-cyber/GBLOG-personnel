@extends('layouts.app')

@section('title', 'Modifier un utilisateur - Admin')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-xl shadow-lg p-8">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">
            <i class="fas fa-user-edit text-orange-500 mr-3"></i>Modifier l'utilisateur
        </h1>

        <form action="{{ route('admin.users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label for="name" class="block text-gray-700 font-semibold mb-2">
                    <i class="fas fa-user text-orange-500 mr-2"></i>Nom
                </label>
                <input 
                    type="text" 
                    name="name" 
                    id="name" 
                    value="{{ old('name', $user->name) }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 @error('name') border-red-500 @enderror"
                    required
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
                    value="{{ old('email', $user->email) }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 @error('email') border-red-500 @enderror"
                    required
                >
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="role" class="block text-gray-700 font-semibold mb-2">
                    <i class="fas fa-shield-alt text-orange-500 mr-2"></i>Rôle
                </label>
                <select 
                    name="role" 
                    id="role" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 @error('role') border-red-500 @enderror"
                    required
                >
                    <option value="user" {{ old('role', $user->role) === 'user' ? 'selected' : '' }}>Utilisateur</option>
                    <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Administrateur</option>
                </select>
                @error('role')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="bg-orange-50 border-l-4 border-orange-500 p-4 mb-6">
                <p class="text-sm text-gray-700">
                    <i class="fas fa-info-circle text-orange-500 mr-2"></i>
                    Laissez les champs de mot de passe vides si vous ne souhaitez pas le modifier.
                </p>
            </div>

            <div class="mb-6">
                <label for="password" class="block text-gray-700 font-semibold mb-2">
                    <i class="fas fa-lock text-orange-500 mr-2"></i>Nouveau mot de passe (optionnel)
                </label>
                <input 
                    type="password" 
                    name="password" 
                    id="password" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 @error('password') border-red-500 @enderror"
                    placeholder="••••••••"
                >
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password_confirmation" class="block text-gray-700 font-semibold mb-2">
                    <i class="fas fa-lock text-orange-500 mr-2"></i>Confirmer le nouveau mot de passe
                </label>
                <input 
                    type="password" 
                    name="password_confirmation" 
                    id="password_confirmation" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                    placeholder="••••••••"
                >
            </div>

            <div class="flex justify-between items-center">
                <a href="{{ route('admin.users.index') }}" class="text-gray-600 hover:text-gray-800 font-semibold">
                    <i class="fas fa-arrow-left mr-2"></i>Retour
                </a>
                <button type="submit" class="btn-orange text-white px-8 py-3 rounded-lg font-semibold shadow-lg">
                    <i class="fas fa-save mr-2"></i>Enregistrer les modifications
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
