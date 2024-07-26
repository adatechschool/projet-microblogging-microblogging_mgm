<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id(); // Crée une colonne 'id' auto-incrémentée
            $table->string('title'); // Crée une colonne 'title' de type string
            $table->text('body'); // Crée une colonne 'body' de type text
            $table->unsignedBigInteger('user_id'); // Crée une colonne 'user_id' de type bigint non signé
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Crée une clé étrangère
            $table->timestamps(); // Crée les colonnes 'created_at' et 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
