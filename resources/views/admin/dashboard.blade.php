@extends('layouts.app')

@section('title', 'Gestion du Blog - Mon Blog')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-4xl font-bold mb-8 text-gray-800">
        <i class="fas fa-cog text-orange-500 mr-3"></i>Gestion du Blog
    </h1>

    <!-- Statistiques -->
    <div class="grid md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-lg p-6 card-hover">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-semibold mb-1">Utilisateurs</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $stats['users'] }}</p>
                </div>
                <div class="bg-orange-100 rounded-full p-4">
                    <i class="fas fa-users text-orange-500 text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6 card-hover">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-semibold mb-1">Articles</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $stats['posts'] }}</p>
                </div>
                <div class="bg-orange-100 rounded-full p-4">
                    <i class="fas fa-newspaper text-orange-500 text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6 card-hover">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-semibold mb-1">Commentaires</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $stats['comments'] }}</p>
                </div>
                <div class="bg-orange-100 rounded-full p-4">
                    <i class="fas fa-comments text-orange-500 text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation Gestion -->
    <div class="grid md:grid-cols-3 gap-6 mb-8">
        <a href="{{ route('admin.posts') }}" class="bg-white rounded-xl shadow-lg p-6 card-hover block">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Gérer les articles</h3>
                    <p class="text-gray-600">Voir et gérer tous vos articles</p>
                </div>
                <i class="fas fa-newspaper text-orange-500 text-3xl"></i>
            </div>
        </a>

        <a href="{{ route('admin.comments') }}" class="bg-white rounded-xl shadow-lg p-6 card-hover block">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Gérer les commentaires</h3>
                    <p class="text-gray-600">Modérer les commentaires des visiteurs</p>
                </div>
                <i class="fas fa-comments text-orange-500 text-3xl"></i>
            </div>
        </a>

        <a href="{{ route('admin.users.index') }}" class="bg-white rounded-xl shadow-lg p-6 card-hover block">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Gérer les visiteurs</h3>
                    <p class="text-gray-600">Créer et gérer les comptes visiteurs</p>
                </div>
                <i class="fas fa-users text-orange-500 text-3xl"></i>
            </div>
        </a>
    </div>

    <!-- Articles récents -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">
            <i class="fas fa-clock text-orange-500 mr-2"></i>Articles récents
        </h2>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-orange-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-gray-700 font-semibold">Titre</th>
                        <th class="px-4 py-3 text-left text-gray-700 font-semibold">Auteur</th>
                        <th class="px-4 py-3 text-left text-gray-700 font-semibold">Date</th>
                        <th class="px-4 py-3 text-left text-gray-700 font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentPosts as $post)
                        <tr class="border-b hover:bg-orange-50">
                            <td class="px-4 py-3">
                                <a href="{{ route('posts.show', $post) }}" class="text-orange-600 hover:text-orange-700 font-semibold">
                                    {{ Str::limit($post->title, 50) }}
                                </a>
                            </td>
                            <td class="px-4 py-3 text-gray-700">{{ $post->user->name }}</td>
                            <td class="px-4 py-3 text-gray-600 text-sm">{{ $post->created_at->format('d/m/Y H:i') }}</td>
                            <td class="px-4 py-3">
                                <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Supprimer cet article ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-700">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Commentaires récents -->
    <div class="bg-white rounded-xl shadow-lg p-6">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">
            <i class="fas fa-clock text-orange-500 mr-2"></i>Commentaires récents
        </h2>
        <div class="space-y-4">
            @foreach($recentComments as $comment)
                <div class="border-l-4 border-orange-500 pl-4 py-2 hover:bg-orange-50">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <div class="flex items-center space-x-2 mb-1">
                                <span class="font-semibold text-gray-800">{{ $comment->user->name }}</span>
                                <span class="text-gray-500 text-sm">sur</span>
                                <a href="{{ route('posts.show', $comment->post) }}" class="text-orange-600 hover:text-orange-700 text-sm">
                                    {{ Str::limit($comment->post->title, 40) }}
                                </a>
                            </div>
                            <p class="text-gray-700 text-sm">{{ Str::limit($comment->content, 100) }}</p>
                            <p class="text-gray-500 text-xs mt-1">{{ $comment->created_at->diffForHumans() }}</p>
                        </div>
                        <form action="{{ route('comments.destroy', $comment) }}" method="POST" onsubmit="return confirm('Supprimer ce commentaire ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-700 ml-4">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
