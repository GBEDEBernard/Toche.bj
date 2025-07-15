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
        Schema::create('itineraire_sites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('itineraire_id')->constrained('itineraires')->onDelete('cascade');
            $table->foreignId('site_touristique_id')->constrained('site_touristiques')->onDelete('cascade');
            $table->integer('ordre');
            $table->time('temps_prevu')->nullable();
            $table->text('commentaire')->nullable();
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('itineraire_sites');
    }
};
