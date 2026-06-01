<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->string('video')->nullable()->after('image');
            $table->string('document')->nullable()->after('video');
            $table->enum('media_type', ['image', 'video', 'document', 'none'])->default('none')->after('document');
        });
    }

    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn(['video', 'document', 'media_type']);
        });
    }
};
