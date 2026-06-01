@extends('layouts.app')

@section('title', 'Articles - Mon Blog')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-4xl font-bold text-gray-800">
            <i class="fas fa-newspaper text-orange-500 mr-3"></i>Tous les articles
        </h1>
        <a href="{{ route('posts.create') }}" class="btn-orange text-white px-6 py-3 rounded-lg font-semibold shadow-lg">
            <i class="fas fa-plus-circle mr-2"></i>Nouvel article
        </a>
    </div>

    @if($posts->count() > 0)
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($posts as $post)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover">
                    @if($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 gradient-orange flex items-center justify-center">
                            <i class="fas fa-image text-white text-6xl"></i>
                        </div>
                    @endif
                    
                    <div class="p-6">
                        <h2 class="text-2xl font-bold mb-3 text-gray-800 hover:text-orange-600">
                            <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
                        </h2>
                        
                        <p class="text-gray-600 mb-4 line-clamp-3">
                            {{ Str::limit(strip_tags($post->content), 150) }}
                        </p>
                        
                        <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                            <div class="flex items-center">
                                <i class="fas fa-user-circle text-orange-500 mr-2"></i>
                                <span>{{ $post->user->name }}</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-calendar text-orange-500 mr-2"></i>
                                <span>{{ $post->created_at->format('d/m/Y') }}</span>
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <a href="{{ route('posts.show', $post) }}" class="text-orange-600 hover:text-orange-700 font-semibold">
                                Lire la suite <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                            <span class="text-gray-500 text-sm">
                                <i class="fas fa-comments mr-1"></i>{{ $post->allComments->count() }}
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $posts->links() }}
        </div>
    @else
        <div class="bg-white rounded-xl shadow-lg p-12 text-center">
            <i class="fas fa-inbox text-gray-300 text-6xl mb-4"></i>
            <h2 class="text-2xl font-bold text-gray-600 mb-2">Aucun article pour le moment</h2>
            <p class="text-gray-500 mb-6">Soyez le premier à publier un article !</p>
            <a href="{{ route('posts.create') }}" class="btn-orange text-white px-6 py-3 rounded-lg font-semibold inline-block shadow-lg">
                <i class="fas fa-plus-circle mr-2"></i>Créer un article
            </a>
        </div>
    @endif
</div>
@endsection
