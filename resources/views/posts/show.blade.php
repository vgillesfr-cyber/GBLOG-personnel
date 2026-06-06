@extends('layouts.app')

@section('title', $post->title . ' - Mon Blog')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Article -->
    <article class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
        <!-- Affichage du média selon le type -->
        @if($post->media_type === 'image' && $post->image)
            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-full h-96 object-cover">
        @elseif($post->media_type === 'video' && $post->video)
            <div class="w-full bg-black">
                <video controls class="w-full max-h-96">
                    <source src="{{ asset('storage/' . $post->video) }}" type="video/mp4">
                    Votre navigateur ne supporte pas la lecture de vidéos.
                </video>
            </div>
        @elseif($post->media_type === 'document' && $post->document)
            <div class="bg-orange-50 p-6 border-b">
                <div class="flex items-center justify-center space-x-3">
                    <i class="fas fa-file-pdf text-orange-500 text-4xl"></i>
                    <div>
                        <p class="text-gray-700 font-semibold">Document joint</p>
                        <a href="{{ asset('storage/' . $post->document) }}" target="_blank" class="text-orange-600 hover:text-orange-700 font-semibold">
                            <i class="fas fa-download mr-1"></i>Télécharger le document
                        </a>
                    </div>
                </div>
            </div>
        @endif
        
        <div class="p-8">
            <h1 class="text-4xl font-bold mb-4 text-gray-800">{{ $post->title }}</h1>
            
            <div class="flex items-center justify-between mb-6 pb-6 border-b">
                <div class="flex items-center space-x-4">
                    <div class="flex items-center text-gray-600">
                        <i class="fas fa-user-circle text-orange-500 text-2xl mr-2"></i>
                        <span class="font-semibold">{{ $post->user->name }}</span>
                    </div>
                    <div class="flex items-center text-gray-500">
                        <i class="fas fa-calendar text-orange-500 mr-2"></i>
                        <span>{{ $post->created_at->format('d/m/Y à H:i') }}</span>
                    </div>
                </div>
                
                @if(auth()->id() === $post->user_id || auth()->user()->isOwner())
                    <div class="flex space-x-2">
                        <a href="{{ route('posts.edit', $post) }}" class="text-blue-600 hover:text-blue-700 px-4 py-2 rounded-lg border border-blue-600 hover:bg-blue-50">
                            <i class="fas fa-edit mr-1"></i>Modifier
                        </a>
                        <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-700 px-4 py-2 rounded-lg border border-red-600 hover:bg-red-50">
                                <i class="fas fa-trash mr-1"></i>Supprimer
                            </button>
                        </form>
                    </div>
                @endif
            </div>
            
            <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed mb-6">
                {!! nl2br(e($post->content)) !!}
            </div>

            <!-- Bouton J'aime -->
            <div class="flex items-center space-x-4 pt-6 border-t">
                <form action="{{ route('posts.like', $post) }}" method="POST" id="like-form-{{ $post->id }}">
                    @csrf
                    <button type="submit" class="flex items-center space-x-2 px-6 py-3 rounded-lg font-semibold transition-all {{ $post->isLikedBy(auth()->user()) ? 'bg-orange-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-orange-100' }}">
                        <i class="fas fa-heart {{ $post->isLikedBy(auth()->user()) ? 'text-white' : 'text-orange-500' }}"></i>
                        <span>{{ $post->isLikedBy(auth()->user()) ? 'Aimé' : 'J\'aime' }}</span>
                        <span class="bg-white text-orange-500 px-2 py-1 rounded-full text-sm font-bold">{{ $post->likesCount() }}</span>
                    </button>
                </form>
            </div>
        </div>
    </article>

    <!-- Section Commentaires -->
    <div class="bg-white rounded-xl shadow-lg p-8">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">
            <i class="fas fa-comments text-orange-500 mr-2"></i>
            Commentaires ({{ $post->allComments->count() }})
        </h2>

        <!-- Formulaire d'ajout de commentaire -->
        <form action="{{ route('comments.store', $post) }}" method="POST" class="mb-8">
            @csrf
            <textarea 
                name="content" 
                rows="4" 
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 @error('content') border-red-500 @enderror"
                placeholder="Ajoutez votre commentaire..."
                required
            ></textarea>
            @error('content')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
            <div class="mt-3 flex justify-end">
                <button type="submit" class="btn-orange text-white px-6 py-2 rounded-lg font-semibold shadow-lg">
                    <i class="fas fa-paper-plane mr-2"></i>Commenter
                </button>
            </div>
        </form>

        <!-- Liste des commentaires -->
        @if($post->comments->count() > 0)
            <div class="space-y-6">
                @foreach($post->comments as $comment)
                    <div class="border-l-4 border-orange-500 pl-4">
                        <div class="flex items-start justify-between mb-2">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-user-circle text-orange-500 text-xl"></i>
                                <span class="font-semibold text-gray-800">{{ $comment->user->name }}</span>
                                <span class="text-gray-500 text-sm">{{ $comment->created_at->diffForHumans() }}</span>
                            </div>
                            @if(auth()->id() === $comment->user_id || auth()->user()->isOwner())
                                <form action="{{ route('comments.destroy', $comment) }}" method="POST" onsubmit="return confirm('Supprimer ce commentaire ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 text-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            @endif
                        </div>
                        <p class="text-gray-700 mb-3">{{ $comment->content }}</p>
                        
                        <!-- Bouton pour répondre -->
                        <button onclick="toggleReplyForm({{ $comment->id }})" class="text-orange-600 hover:text-orange-700 text-sm font-semibold">
                            <i class="fas fa-reply mr-1"></i>Répondre
                        </button>

                        <!-- Formulaire de réponse (caché par défaut) -->
                        <div id="reply-form-{{ $comment->id }}" class="hidden mt-4 ml-8">
                            <form action="{{ route('comments.store', $post) }}" method="POST">
                                @csrf
                                <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                <textarea 
                                    name="content" 
                                    rows="3" 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                                    placeholder="Répondre à {{ $comment->user->name }}..."
                                    required
                                ></textarea>
                                <div class="mt-2 flex justify-end space-x-2">
                                    <button type="button" onclick="toggleReplyForm({{ $comment->id }})" class="text-gray-600 hover:text-gray-800 px-4 py-2 rounded-lg">
                                        Annuler
                                    </button>
                                    <button type="submit" class="btn-orange text-white px-4 py-2 rounded-lg font-semibold">
                                        <i class="fas fa-paper-plane mr-1"></i>Répondre
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Réponses au commentaire -->
                        @if($comment->replies->count() > 0)
                            <div class="ml-8 mt-4 space-y-4">
                                @foreach($comment->replies as $reply)
                                    <div class="bg-orange-50 rounded-lg p-4">
                                        <div class="flex items-start justify-between mb-2">
                                            <div class="flex items-center space-x-2">
                                                <i class="fas fa-user-circle text-orange-500"></i>
                                                <span class="font-semibold text-gray-800">{{ $reply->user->name }}</span>
                                                <span class="text-gray-500 text-sm">{{ $reply->created_at->diffForHumans() }}</span>
                                            </div>
                                            @if(auth()->id() === $reply->user_id || auth()->user()->isOwner())
                                                <form action="{{ route('comments.destroy', $reply) }}" method="POST" onsubmit="return confirm('Supprimer cette réponse ?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-500 hover:text-red-700 text-sm">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                        <p class="text-gray-700">
                                            <span class="text-orange-600 font-semibold">{{ $comment->user->name }}</span> {{ $reply->content }}
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-8 text-gray-500">
                <i class="fas fa-comment-slash text-4xl mb-3"></i>
                <p>Aucun commentaire pour le moment. Soyez le premier à commenter !</p>
            </div>
        @endif
    </div>
</div>

<script>
function toggleReplyForm(commentId) {
    const form = document.getElementById('reply-form-' + commentId);
    form.classList.toggle('hidden');
}
</script>
@endsection
