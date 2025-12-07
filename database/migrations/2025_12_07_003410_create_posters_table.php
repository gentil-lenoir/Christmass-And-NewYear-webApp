<?php
// database/migrations/xxxx_xx_xx_create_posters_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posters', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id')->unique();
            $table->string('title');
            $table->text('names');
            $table->text('message')->nullable();
            $table->integer('year');
            $table->string('style');
            $table->longText('canvas_data'); // Base64 de l'image
            $table->json('elements')->nullable(); // Éléments ajoutés
            $table->string('recipient_phone')->nullable();
            $table->text('multiple_phones')->nullable();
            $table->integer('views')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posters');
    }
};