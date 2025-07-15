<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('demande_participations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('itineraire_id');
            $table->string('nom');
            $table->string('telephone');
            $table->string('email');
            $table->text('message');
            $table->timestamps();
    
            $table->foreign('itineraire_id')->references('id')->on('itineraires')->onDelete('cascade');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demande_participations');
    }
};
