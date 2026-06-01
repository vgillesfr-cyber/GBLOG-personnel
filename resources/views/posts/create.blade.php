@extends('layouts.app')

@section('title', 'Créer un article - Mon Blog')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-xl shadow-lg p-8">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">
            <i class="fas fa-pen-fancy text-orange-500 mr-3"></i>Créer un nouvel article
        </h1>

        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-6">
                <label for="title" class="block text-gray-700 font-semibold mb-2">
                    <i class="fas fa-heading text-orange-500 mr-2"></i>Titre de l'article
                </label>
                <input 
                    type="text" 
                    name="title" 
                    id="title" 
                    value="{{ old('title') }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 @error('title') border-red-500 @enderror"
                    placeholder="Ex: Comment installer Laravel"
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
                    placeholder="Écrivez votre article ici..."
                    required
                >{{ old('content') }}</textarea>
                @error('content')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-3">
                    <i class="fas fa-photo-video text-orange-500 mr-2"></i>Média (optionnel - choisissez un seul type)
                </label>
                
                <!-- Image -->
                <div class="mb-4">
                    <label for="image" class="block text-gray-600 font-medium mb-2">
                        <i class="fas fa-image text-orange-400 mr-2"></i>Image
                    </label>
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
                    <p class="text-gray-500 text-sm mt-1">Formats : JPG, PNG, GIF (max 5 Mo)</p>
                </div>

                <!-- Vidéo -->
                <div class="mb-4">
                    <label for="video" class="block text-gray-600 font-medium mb-2">
                        <i class="fas fa-video text-orange-400 mr-2"></i>Vidéo
                    </label>
                    <input 
                        type="file" 
                        name="video" 
                        id="video" 
                        accept="video/*"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 @error('video') border-red-500 @enderror"
                    >
                    @error('video')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-gray-500 text-sm mt-1">Formats : MP4, AVI, MOV, WMV (max 50 Mo)</p>
                </div>

                <!-- Document -->
                <div class="mb-4">
                    <label for="document" class="block text-gray-600 font-medium mb-2">
                        <i class="fas fa-file-alt text-orange-400 mr-2"></i>Document
                    </label>
                    <input 
                        type="file" 
                        name="document" 
                        id="document" 
                        accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 @error('document') border-red-500 @enderror"
                    >
                    @error('document')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-gray-500 text-sm mt-1">Formats : PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX (max 10 Mo)</p>
                </div>
            </div>

            <div class="flex justify-between items-center">
                <a href="{{ route('posts.index') }}" class="text-gray-600 hover:text-gray-800 font-semibold">
                    <i class="fas fa-arrow-left mr-2"></i>Retour
                </a>
                <button type="submit" class="btn-orange text-white px-8 py-3 rounded-lg font-semibold shadow-lg">
                    <i class="fas fa-paper-plane mr-2"></i>Publier l'article
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
