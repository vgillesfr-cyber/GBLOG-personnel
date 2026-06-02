<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class EnsureOwnerExists extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'owner:ensure';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ensure the blog owner exists with correct credentials';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = env('ADMIN_EMAIL', 'ownerblog@gmail.com');
        $password = env('ADMIN_PASSWORD', 'password');
        $name = env('ADMIN_NAME', 'Gilles');

        // Chercher si un propriétaire existe déjà
        $owner = User::where('role', 'owner')->first();

        if ($owner) {
            // Mettre à jour les informations
            $owner->update([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
            ]);
            $this->info("✅ Compte propriétaire mis à jour : {$email}");
        } else {
            // Créer le propriétaire
            User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
                'role' => 'owner',
                'bio' => 'Passionné de technologie, de développement web et de partage de connaissances. Bienvenue sur mon blog personnel !',
            ]);
            $this->info("✅ Compte propriétaire créé : {$email}");
        }

        return 0;
    }
}
