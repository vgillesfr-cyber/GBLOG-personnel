<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Créer le propriétaire du blog (unique)
        User::create([
            'name' => 'Propriétaire du Blog',
            'email' => 'owner@blog.com',
            'password' => Hash::make('password'),
            'role' => 'owner',
            'bio' => 'Passionné de technologie, de développement web et de partage de connaissances. Bienvenue sur mon blog personnel !',
            'facebook' => 'https://facebook.com',
            'twitter' => 'https://twitter.com',
            'instagram' => 'https://instagram.com',
            'linkedin' => 'https://linkedin.com',
        ]);

        // Créer des visiteurs de test
        User::create([
            'name' => 'Visiteur Test 1',
            'email' => 'visitor1@blog.com',
            'password' => Hash::make('password'),
            'role' => 'visitor',
        ]);

        User::create([
            'name' => 'Visiteur Test 2',
            'email' => 'visitor2@blog.com',
            'password' => Hash::make('password'),
            'role' => 'visitor',
        ]);
    }
}
