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
       //il y a clé etrangère site touristique et evenements que j'ai notifié
        Schema::create('visites', function (Blueprint $table) {
        $table->id();
        $table->foreignId('site_touristique_id')->constrained()->onUpdate('cascade')->onDelete('cascade'); 
        $table->foreignId('users_id')->constrained()->onUpdate('cascade')->onDelete('cascade'); 
        $table->integer('telephone');
        $table->integer('nombre');
        $table->integer('prix');
        $table->date('date');
        $table->string('chemin_ticket');
       $table->timestamps();
    });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visites');
    }
};
