@extends('layouts.app')

@section('title', 'Modifier l\'article - Mon Blog')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-xl shadow-lg p-8">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">
            <i class="fas fa-edit text-orange-500 mr-3"></i>Modifier l'article
        </h1>

        <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label for="title" class="block text-gray-700 font-semibold mb-2">
                    <i class="fas fa-heading text-orange-500 mr-2"></i>Titre de l'article
                </label>
                <input 
                    type="text" 
                    name="title" 
                    id="title" 
                    value="{{ old('title', $post->title) }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 @error('title') border-red-500 @enderror"
                    required
                >
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="content" class="block text-gray-700 font-semibold mb-2">
                    <i class="fas fa-align-left text-orange-500 mr-2"></i>Contenu
                </label>
                <textarea 
                    name="content" 
                    id="content" 
                    rows="12"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 @error('content') border-red-500 @enderror"
                    required
                >{{ old('content', $post->content) }}</textarea>
                @error('content')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="image" class="block text-gray-700 font-semibold mb-2">
                    <i class="fas fa-image text-orange-500 mr-2"></i>Image (optionnelle)
                </label>
                
                @if($post->image)
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-48 h-32 object-cover rounded-lg">
                        <p class="text-sm text-gray-500 mt-1">Image actuelle</p>
                    </div>
                @endif
                
                <input 
                    type="file" 
                    name="image" 
                    id="image" 
                    accept="image/*"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 @error('image') border-red-500 @enderror"
                >
                @error('image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                <p class="text-gray-500 text-sm mt-1">Formats acceptés : JPG, PNG, GIF (max 2 Mo)</p>
            </div>

            <div class="flex justify-between items-center">
                <a href="{{ route('posts.show', $post) }}" class="text-gray-600 hover:text-gray-800 font-semibold">
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
