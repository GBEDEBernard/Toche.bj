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
        Schema::create('site_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('site_touristique_id')->constrained()->onDelete('cascade');
            $table->string('titre')->nullable();
            $table->text('contenu');
            $table->integer('ordre')->default(0); // Pour gérer l’ordre d’affichage
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_details');
    }
};
