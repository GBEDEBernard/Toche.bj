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
       //il y a clé etrangère utilisateurs que j'ai notifié
      Schema::create('avis', function (Blueprint $table) {
         $table->id();
         $table->foreignId('users_id')->constrained()->onUpdate('cascade')->onDelete('cascade'); 
         $table->foreignId('site_touristique_id')->constrained()->onUpdate('cascade')->onDelete('cascade'); 
         $table->longText('message');
         $table->longText('date');
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
