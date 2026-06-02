<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class ChangeOwnerEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'owner:change-email {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change the email of the blog owner';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $newEmail = $this->argument('email');

        // Vérifier que l'email est valide
        if (!filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
            $this->error('Email invalide !');
            return 1;
        }

        // Trouver le propriétaire
        $owner = User::where('role', 'owner')->first();

        if (!$owner) {
            $this->error('Aucun propriétaire trouvé !');
            return 1;
        }

        $oldEmail = $owner->email;

        // Vérifier si l'email est déjà utilisé
        if (User::where('email', $newEmail)->where('id', '!=', $owner->id)->exists()) {
            $this->error('Cet email est déjà utilisé par un autre utilisateur !');
            return 1;
        }

        // Changer l'email
        $owner->email = $newEmail;
        $owner->save();

        $this->info("✅ Email du propriétaire changé avec succès !");
        $this->info("Ancien email : {$oldEmail}");
        $this->info("Nouvel email : {$newEmail}");

        return 0;
    }
}
