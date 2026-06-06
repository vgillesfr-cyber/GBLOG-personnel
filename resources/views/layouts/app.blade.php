<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mon Blog')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .gradient-orange {
            background: linear-gradient(135deg, #ff6b35 0%, #ff8c42 25%, #ffa552 50%, #ffb366 75%, #ffc078 100%);
        }
        .gradient-orange-light {
            background: linear-gradient(135deg, #fff5f0 0%, #ffe8d9 50%, #ffd9c2 100%);
        }
        .btn-orange {
            background: linear-gradient(135deg, #ff6b35 0%, #ff8c42 100%);
            transition: all 0.3s ease;
        }
        .btn-orange:hover {
            background: linear-gradient(135deg, #ff5722 0%, #ff7733 100%);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(255, 107, 53, 0.3);
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }
        .logo-g {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 2.25rem;
            height: 2.25rem;
            background: white;
            color: #ff6b35;
            border-radius: 0.5rem;
            font-weight: 800;
            font-size: 1.25rem;
            line-height: 1;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        }
    </style>
</head>
<body class="gradient-orange-light min-h-screen">
    <!-- Navigation -->
    <nav class="gradient-orange shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="text-white text-2xl font-bold flex items-center">
                        <span class="logo-g mr-2">G</span>Mon Blog
                    </a>
                </div>
                
                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ route('posts.index') }}" class="text-white hover:text-orange-100 px-3 py-2 rounded-md">
                            <i class="fas fa-newspaper mr-1"></i>Articles
                        </a>
                        @if(auth()->user()->isOwner())
                            <a href="{{ route('posts.create') }}" class="text-white hover:text-orange-100 px-3 py-2 rounded-md">
                                <i class="fas fa-plus-circle mr-1"></i>Publier
                            </a>
                        @endif
                        <a href="{{ route('about') }}" class="text-white hover:text-orange-100 px-3 py-2 rounded-md">
                            <i class="fas fa-info-circle mr-1"></i>À propos
                        </a>
                        @if(auth()->user()->isOwner())
                            <a href="{{ route('admin.dashboard') }}" class="text-white hover:text-orange-100 px-3 py-2 rounded-md">
                                <i class="fas fa-cog mr-1"></i>Gestion
                            </a>
                        @endif
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="text-white hover:text-orange-100 px-3 py-2 rounded-md flex items-center">
                                <i class="fas fa-user-circle mr-1"></i>{{ auth()->user()->name }}
                                <i class="fas fa-chevron-down ml-1 text-xs"></i>
                            </button>
                            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10" style="display: none;">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-orange-100 rounded-md">
                                        <i class="fas fa-sign-out-alt mr-2"></i>Déconnexion
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-white hover:text-orange-100 px-3 py-2 rounded-md">
                            <i class="fas fa-sign-in-alt mr-1"></i>Connexion
                        </a>
                        <a href="{{ route('register') }}" class="bg-white text-orange-600 hover:bg-orange-50 px-4 py-2 rounded-md font-semibold">
                            <i class="fas fa-user-plus mr-1"></i>Inscription
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Messages flash -->
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        </div>
    @endif

    <!-- Contenu principal -->
    <main class="py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="gradient-orange text-white mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="text-center">
                <p class="text-lg font-semibold mb-2 flex items-center justify-center gap-2">
                    <span class="logo-g text-base w-8 h-8">G</span>Mon Blog
                </p>
                <p class="text-orange-100">© {{ date('Y') }} Tous droits réservés</p>
                <div class="mt-4 space-x-4">
                    <a href="#" class="text-white hover:text-orange-100"><i class="fab fa-facebook fa-lg"></i></a>
                    <a href="#" class="text-white hover:text-orange-100"><i class="fab fa-twitter fa-lg"></i></a>
                    <a href="#" class="text-white hover:text-orange-100"><i class="fab fa-instagram fa-lg"></i></a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
