@extends('layouts.app')

@section('title', 'À propos - Mon Blog')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-xl shadow-lg p-8 md:p-12">
        <h1 class="text-4xl font-bold mb-8 text-gray-800">
            <i class="fas fa-info-circle text-orange-500 mr-3"></i>À propos
        </h1>
        
        @php
            $owner = \App\Models\User::where('role', 'owner')->first();
        @endphp

        @if($owner)
            <!-- Profil du propriétaire -->
            <div class="mb-12 pb-8 border-b">
                <div class="flex flex-col md:flex-row items-center md:items-start space-y-6 md:space-y-0 md:space-x-8">
                    <!-- Avatar -->
                    <div class="flex-shrink-0">
                        @if($owner->avatar)
                            <img src="{{ asset('storage/' . $owner->avatar) }}" alt="{{ $owner->name }}" class="w-32 h-32 rounded-full object-cover border-4 border-orange-500 shadow-lg">
                        @else
                            <div class="w-32 h-32 rounded-full bg-gradient-to-br from-orange-400 to-orange-600 flex items-center justify-center border-4 border-orange-500 shadow-lg">
                                <i class="fas fa-user text-white text-5xl"></i>
                            </div>
                        @endif
                    </div>

                    <!-- Informations -->
                    <div class="flex-1 text-center md:text-left">
                        <h2 class="text-3xl font-bold text-gray-800 mb-2">VIGAN Gilles Patrick</h2>
                        <p class="text-gray-600 font-medium mb-2">
                            <i class="fas fa-graduation-cap mr-1 text-orange-500"></i>Étudiant à l'Université d'Abomey-Calavi (EPAC)
                        </p>
                        <p class="text-orange-600 font-semibold mb-4">
                            <i class="fas fa-crown mr-1"></i>Propriétaire du blog
                        </p>
                        
                        @if($owner->bio)
                            <p class="text-gray-700 leading-relaxed mb-4">{{ $owner->bio }}</p>
                        @endif

                        <!-- Réseaux sociaux -->
                        @if($owner->facebook || $owner->twitter || $owner->instagram || $owner->linkedin)
                            <div class="flex justify-center md:justify-start space-x-4 mt-4">
                                @if($owner->facebook)
                                    <a href="{{ $owner->facebook }}" target="_blank" class="text-blue-600 hover:text-blue-700 text-2xl">
                                        <i class="fab fa-facebook"></i>
                                    </a>
                                @endif
                                @if($owner->twitter)
                                    <a href="{{ $owner->twitter }}" target="_blank" class="text-blue-400 hover:text-blue-500 text-2xl">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                @endif
                                @if($owner->instagram)
                                    <a href="{{ $owner->instagram }}" target="_blank" class="text-pink-600 hover:text-pink-700 text-2xl">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                @endif
                                @if($owner->linkedin)
                                    <a href="{{ $owner->linkedin }}" target="_blank" class="text-blue-700 hover:text-blue-800 text-2xl">
                                        <i class="fab fa-linkedin"></i>
                                    </a>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endif

        <!-- À propos du blog -->
        <div class="prose prose-lg max-w-none">
            <h2 class="text-2xl font-bold mb-4 text-gray-800">
                <span class="logo-g text-sm w-8 h-8 mr-2 align-middle">G</span>À propos de ce blog
            </h2>
            <p class="text-gray-700 mb-6 text-lg leading-relaxed">
                Bienvenue sur mon blog personnel ! Je suis <strong>VIGAN Gilles Patrick</strong>, 
                étudiant à l'<strong>Université d'Abomey-Calavi (EPAC)</strong>. C'est un espace où je partage 
                mes réflexions, mes découvertes et mes expériences sur divers sujets qui me passionnent.
            </p>

            <h2 class="text-2xl font-bold mb-4 text-gray-800 mt-8">
                <i class="fas fa-bullseye text-orange-500 mr-2"></i>Ma Mission
            </h2>
            <p class="text-gray-700 mb-6 leading-relaxed">
                Je crois au pouvoir du partage de connaissances. À travers ce blog, j'espère 
                inspirer, informer et créer des échanges enrichissants avec vous, mes lecteurs.
            </p>

            <h2 class="text-2xl font-bold mb-4 text-gray-800 mt-8">
                <i class="fas fa-comments text-orange-500 mr-2"></i>Interagissez avec moi
            </h2>
            <p class="text-gray-700 mb-4 leading-relaxed">
                N'hésitez pas à :
            </p>
            <ul class="list-disc list-inside text-gray-700 mb-6 space-y-2">
                <li>Commenter mes articles pour partager votre point de vue</li>
                <li>Liker les publications qui vous plaisent</li>
                <li>Me suivre sur les réseaux sociaux</li>
                <li>Me contacter pour toute question ou suggestion</li>
            </ul>

            <div class="bg-orange-50 border-l-4 border-orange-500 p-6 mt-8">
                <p class="text-gray-700">
                    <i class="fas fa-heart text-orange-500 mr-2"></i>
                    <strong>Merci</strong> de faire partie de cette communauté et de prendre le temps 
                    de lire mes articles. Vos commentaires et votre soutien sont précieux !
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
