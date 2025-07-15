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
       Schema::create('site_touristiques', function (Blueprint $table) {
           $table->id();
           $table->foreignId('categorie_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade'); 
           $table->string('nom');
           $table->string('pays');
           $table->string('departement');
           $table->string('commune');
           $table->decimal('latitude', 10, 6);
           $table->decimal('longitude', 10, 6);
           $table->string('email')->unique();
           $table->string('photo');
           $table->string('contact');
           $table->string('description');
           $table->timestamps();
              });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_touristiques');
    }
};
