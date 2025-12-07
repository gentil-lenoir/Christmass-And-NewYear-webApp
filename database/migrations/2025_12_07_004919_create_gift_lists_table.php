<?php
// database/migrations/xxxx_xx_xx_create_gift_lists_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gift_lists', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id')->unique();
            $table->string('owner');
            $table->string('title');
            $table->text('message')->nullable();
            $table->string('theme')->default('classique');
            $table->string('visibility')->default('private');
            $table->json('gifts');
            $table->integer('views')->default(0);
            $table->integer('shares')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gift_lists');
    }
};