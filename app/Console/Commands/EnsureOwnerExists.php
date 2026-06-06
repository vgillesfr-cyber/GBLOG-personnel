<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class EnsureOwnerExists extends Command
{
    protected $signature = 'owner:ensure';

    protected $description = 'Ensure the blog owner exists with correct credentials';

    public function handle()
    {
        $email = env('ADMIN_EMAIL', 'ownerblog@gmail.com');
        $password = env('ADMIN_PASSWORD', 'password');
        $name = env('ADMIN_NAME', 'Gilles');

        $owner = User::where('role', 'owner')->first()
            ?? User::where('email', $email)->first();

        if ($owner) {
            $owner->update([
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'role' => 'owner',
            ]);
            $this->info("✅ Compte propriétaire mis à jour : {$email}");
        } else {
            User::create([
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'role' => 'owner',
                'bio' => 'Passionné de technologie, de développement web et de partage de connaissances. Bienvenue sur mon blog personnel !',
            ]);
            $this->info("✅ Compte propriétaire créé : {$email}");
        }

        return 0;
    }
}
