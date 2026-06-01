@extends('layouts.app')

@section('title', 'Gestion des commentaires - Admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-4xl font-bold text-gray-800">
            <i class="fas fa-comments text-orange-500 mr-3"></i>Gestion des commentaires
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
                        <th class="px-6 py-4 text-left font-semibold">Auteur</th>
                        <th class="px-6 py-4 text-left font-semibold">Commentaire</th>
                        <th class="px-6 py-4 text-left font-semibold">Article</th>
                        <th class="px-6 py-4 text-left font-semibold">Date</th>
                        <th class="px-6 py-4 text-left font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($comments as $comment)
                        <tr class="border-b hover:bg-orange-50">
                            <td class="px-6 py-4 text-gray-700">{{ $comment->id }}</td>
                            <td class="px-6 py-4 text-gray-700 font-semibold">{{ $comment->user->name }}</td>
                            <td class="px-6 py-4 text-gray-700">
                                {{ Str::limit($comment->content, 80) }}
                                @if($comment->parent_id)
                                    <span class="text-orange-600 text-sm ml-2">
                                        <i class="fas fa-reply"></i> Réponse
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('posts.show', $comment->post) }}" class="text-orange-600 hover:text-orange-700">
                                    {{ Str::limit($comment->post->title, 40) }}
                                </a>
                            </td>
                            <td class="px-6 py-4 text-gray-600 text-sm">{{ $comment->created_at->format('d/m/Y H:i') }}</td>
                            <td class="px-6 py-4">
                                <div class="flex space-x-2">
                                    <a href="{{ route('posts.show', $comment->post) }}#comment-{{ $comment->id }}" class="text-blue-600 hover:text-blue-700" title="Voir">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="{{ route('comments.destroy', $comment) }}" method="POST" onsubmit="return confirm('Supprimer ce commentaire ?')" class="inline">
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
            {{ $comments->links() }}
        </div>
    </div>
</div>
@endsection
