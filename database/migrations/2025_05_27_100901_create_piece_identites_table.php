<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pieces_identites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('type'); // CNI, passeport, permis
            $table->string('numero')->unique();
            $table->date('date_expiration')->nullable();
            $table->string('scan')->nullable(); // chemin vers le fichier image PDF
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pieces_identites');
    }
};
