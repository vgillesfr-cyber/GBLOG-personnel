@extends('layouts.app')

@section('title', 'Accueil - Mon Blog')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Hero Section -->
    <div class="gradient-orange rounded-3xl shadow-2xl p-12 mb-12 text-white">
        <div class="text-center">
            <h1 class="text-5xl font-bold mb-4 flex items-center justify-center gap-3">
                <span class="logo-g text-3xl w-14 h-14">G</span>Bienvenue sur Mon Blog
            </h1>
            <p class="text-xl mb-8 text-orange-100">
                Partagez vos idées, découvrez des articles passionnants et rejoignez notre communauté !
            </p>
            
            @guest
                <div class="flex justify-center space-x-4">
                    <a href="{{ route('register') }}" class="bg-white text-orange-600 hover:bg-orange-50 px-8 py-4 rounded-full font-bold text-lg shadow-lg transform hover:scale-105 transition">
                        <i class="fas fa-user-plus mr-2"></i>S'inscrire
                    </a>
                    <a href="{{ route('login') }}" class="bg-orange-700 text-white hover:bg-orange-800 px-8 py-4 rounded-full font-bold text-lg shadow-lg transform hover:scale-105 transition">
                        <i class="fas fa-sign-in-alt mr-2"></i>Se connecter
                    </a>
                </div>
            @else
                <div class="flex justify-center space-x-4">
                    <a href="{{ route('posts.index') }}" class="bg-white text-orange-600 hover:bg-orange-50 px-8 py-4 rounded-full font-bold text-lg shadow-lg transform hover:scale-105 transition">
                        <i class="fas fa-newspaper mr-2"></i>Voir les articles
                    </a>
                    @if(auth()->user()->isOwner())
                        <a href="{{ route('posts.create') }}" class="bg-orange-700 text-white hover:bg-orange-800 px-8 py-4 rounded-full font-bold text-lg shadow-lg transform hover:scale-105 transition">
                            <i class="fas fa-plus-circle mr-2"></i>Créer un article
                        </a>
                    @endif
                </div>
            @endguest
        </div>
    </div>

    <!-- Features Section -->
    <div class="grid md:grid-cols-3 gap-8 mb-12">
        <div class="bg-white rounded-xl shadow-lg p-8 card-hover">
            <div class="text-orange-500 text-5xl mb-4">
                <i class="fas fa-pen-fancy"></i>
            </div>
            <h3 class="text-2xl font-bold mb-3 text-gray-800">Publiez vos articles</h3>
            <p class="text-gray-600">
                Partagez vos connaissances et expériences avec la communauté. Écrivez sur vos sujets préférés !
            </p>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-8 card-hover">
            <div class="text-orange-500 text-5xl mb-4">
                <i class="fas fa-comments"></i>
            </div>
            <h3 class="text-2xl font-bold mb-3 text-gray-800">Commentez et discutez</h3>
            <p class="text-gray-600">
                Engagez des conversations enrichissantes. Répondez aux commentaires et taguez d'autres utilisateurs.
            </p>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-8 card-hover">
            <div class="text-orange-500 text-5xl mb-4">
                <i class="fas fa-users"></i>
            </div>
            <h3 class="text-2xl font-bold mb-3 text-gray-800">Rejoignez la communauté</h3>
            <p class="text-gray-600">
                Faites partie d'une communauté passionnée et respectueuse. Découvrez de nouvelles perspectives !
            </p>
        </div>
    </div>

    <!-- Call to Action -->
    @guest
        <div class="bg-white rounded-xl shadow-lg p-12 text-center">
            <h2 class="text-3xl font-bold mb-4 text-gray-800">
                Prêt à commencer ?
            </h2>
            <p class="text-gray-600 mb-6 text-lg">
                Créez votre compte gratuitement et commencez à partager vos idées dès aujourd'hui !
            </p>
            <a href="{{ route('register') }}" class="btn-orange text-white px-10 py-4 rounded-full font-bold text-lg inline-block shadow-lg">
                <i class="fas fa-rocket mr-2"></i>Commencer maintenant
            </a>
        </div>
    @endguest
</div>
@endsection
