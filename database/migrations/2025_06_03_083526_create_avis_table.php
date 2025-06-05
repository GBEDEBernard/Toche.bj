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
        Schema::create('avis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->morphs('avisable'); // Pour sites touristiques, événements, etc.
            $table->text('commentaire');
            $table->tinyInteger('note')->default(0); // Note de 1 à 5
            $table->enum('statut', ['en_attente', 'approuvé', 'refusé'])->default('en_attente');
            $table->foreignId('parent_id')->nullable()->constrained('avis')->onDelete('cascade'); // Réponses
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('avis');
    }
};
