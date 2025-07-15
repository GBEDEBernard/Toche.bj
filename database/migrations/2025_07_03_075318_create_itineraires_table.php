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
        Schema::create('itineraires', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agence_id')->constrained('agence_voyages')->onDelete('cascade');
            $table->string('titre');
            $table->text('description')->nullable();
            $table->integer('duree');
            $table->decimal('prix_estime', 8, 2);
            $table->date('date_depart');
            $table->date('date_retour');
            $table->enum('niveau_difficulte', ['facile', 'modéré', 'avancé']);
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('itineraires');
    }
};
