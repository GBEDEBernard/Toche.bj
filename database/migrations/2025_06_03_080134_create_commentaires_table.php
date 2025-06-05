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
        Schema::create('commentaires', function (Blueprint $table) {
        $table->id();
        $table->text('contenu');
        $table->unsignedBigInteger('user_id');
        $table->unsignedBigInteger('evenement_id')->nullable(); // pour les événements
        $table->unsignedBigInteger('site_touristique_id')->nullable(); // pour les sites
        $table->timestamps();
    
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('evenement_id')->references('id')->on('evenements')->onDelete('cascade');
        $table->foreign('site_touristique_id')->references('id')->on('site_touristiques')->onDelete('cascade');
    });
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commentaires');
    }
};
