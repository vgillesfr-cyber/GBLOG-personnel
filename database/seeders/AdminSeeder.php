<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Créer le propriétaire du blog (unique)
        User::create([
            'name' => env('ADMIN_NAME', 'VIGAN Gilles Patrick'),
            'email' => env('ADMIN_EMAIL', 'ownerblog@gmail.com'),
            'password' => env('ADMIN_PASSWORD', 'password'),
            'role' => 'owner',
            'bio' => 'Étudiant à l\'Université d\'Abomey-Calavi (EPAC). Passionné de technologie, de développement web et de partage de connaissances.',
            'facebook' => 'https://facebook.com',
            'twitter' => 'https://twitter.com',
            'instagram' => 'https://instagram.com',
            'linkedin' => 'https://linkedin.com',
        ]);

        // Créer des visiteurs de test
        User::create([
            'name' => 'Visiteur Test 1',
            'email' => 'visitor1@blog.com',
            'password' => 'password',
            'role' => 'visitor',
        ]);

        User::create([
            'name' => 'Visiteur Test 2',
            'email' => 'visitor2@blog.com',
            'password' => 'password',
            'role' => 'visitor',
        ]);
    }
}
