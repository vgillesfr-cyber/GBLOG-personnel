<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Modifier la colonne role pour accepter les nouveaux rôles
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('owner', 'visitor') DEFAULT 'visitor'");
        
        // Mettre à jour les rôles existants
        DB::table('users')->where('role', 'admin')->update(['role' => 'owner']);
        DB::table('users')->where('role', 'user')->update(['role' => 'visitor']);
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('user', 'admin') DEFAULT 'user'");
        
        DB::table('users')->where('role', 'owner')->update(['role' => 'admin']);
        DB::table('users')->where('role', 'visitor')->update(['role' => 'user']);
    }
};
