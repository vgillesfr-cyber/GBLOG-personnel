@extends('layouts.app')

@section('title', 'Gestion des articles - Admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-4xl font-bold text-gray-800">
            <i class="fas fa-newspaper text-orange-500 mr-3"></i>Gestion des articles
        </h1>
        <a href="{{ route('admin.dashboard') }}" class="text-orange-600 hover:text-orange-700 font-semibold">
            <i class="fas fa-arrow-left mr-2"></i>Retour au tableau de bord
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="gradient-orange text-white">
                    <tr>
                        <th class="px-6 py-4 text-left font-semibold">ID</th>
                        <th class="px-6 py-4 text-left font-semibold">Titre</th>
                        <th class="px-6 py-4 text-left font-semibold">Auteur</th>
                        <th class="px-6 py-4 text-left font-semibold">Date</th>
                        <th class="px-6 py-4 text-left font-semibold">Commentaires</th>
                        <th class="px-6 py-4 text-left font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                        <tr class="border-b hover:bg-orange-50">
                            <td class="px-6 py-4 text-gray-700">{{ $post->id }}</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('posts.show', $post) }}" class="text-orange-600 hover:text-orange-700 font-semibold">
                                    {{ Str::limit($post->title, 60) }}
                                </a>
                            </td>
                            <td class="px-6 py-4 text-gray-700">{{ $post->user->name }}</td>
                            <td class="px-6 py-4 text-gray-600 text-sm">{{ $post->created_at->format('d/m/Y H:i') }}</td>
                            <td class="px-6 py-4 text-gray-700 text-center">
                                <span class="bg-orange-100 text-orange-800 px-3 py-1 rounded-full text-sm font-semibold">
                                    {{ $post->allComments->count() }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex space-x-2">
                                    <a href="{{ route('posts.show', $post) }}" class="text-blue-600 hover:text-blue-700" title="Voir">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('posts.edit', $post) }}" class="text-green-600 hover:text-green-700" title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Supprimer cet article ?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-700" title="Supprimer">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="px-6 py-4 bg-gray-50">
            {{ $posts->links() }}
        </div>
    </div>
</div>
@endsection
