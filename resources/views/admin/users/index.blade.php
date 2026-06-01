@extends('layouts.app')

@section('title', 'Gestion des utilisateurs - Admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-4xl font-bold text-gray-800">
            <i class="fas fa-users text-orange-500 mr-3"></i>Gestion des utilisateurs
        </h1>
        <div class="flex space-x-4">
            <a href="{{ route('admin.users.create') }}" class="btn-orange text-white px-6 py-3 rounded-lg font-semibold shadow-lg">
                <i class="fas fa-user-plus mr-2"></i>Nouvel utilisateur
            </a>
            <a href="{{ route('admin.dashboard') }}" class="text-orange-600 hover:text-orange-700 font-semibold px-6 py-3">
                <i class="fas fa-arrow-left mr-2"></i>Retour
            </a>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="gradient-orange text-white">
                    <tr>
                        <th class="px-6 py-4 text-left font-semibold">ID</th>
                        <th class="px-6 py-4 text-left font-semibold">Nom</th>
                        <th class="px-6 py-4 text-left font-semibold">Email</th>
                        <th class="px-6 py-4 text-left font-semibold">Rôle</th>
                        <th class="px-6 py-4 text-left font-semibold">Date d'inscription</th>
                        <th class="px-6 py-4 text-left font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr class="border-b hover:bg-orange-50">
                            <td class="px-6 py-4 text-gray-700">{{ $user->id }}</td>
                            <td class="px-6 py-4 font-semibold text-gray-800">{{ $user->name }}</td>
                            <td class="px-6 py-4 text-gray-700">{{ $user->email }}</td>
                            <td class="px-6 py-4">
                                @if($user->role === 'admin')
                                    <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-semibold">
                                        <i class="fas fa-shield-alt mr-1"></i>Admin
                                    </span>
                                @else
                                    <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-semibold">
                                        <i class="fas fa-user mr-1"></i>User
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-gray-600 text-sm">{{ $user->created_at->format('d/m/Y H:i') }}</td>
                            <td class="px-6 py-4">
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.users.edit', $user) }}" class="text-blue-600 hover:text-blue-700" title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @if($user->id !== auth()->id())
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Supprimer cet utilisateur ?')" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-700" title="Supprimer">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-gray-400" title="Vous ne pouvez pas supprimer votre propre compte">
                                            <i class="fas fa-ban"></i>
                                        </span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="px-6 py-4 bg-gray-50">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection
