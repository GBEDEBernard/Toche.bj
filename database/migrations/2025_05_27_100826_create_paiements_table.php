<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reservation_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->integer('montant');
            $table->string('type_paiement');
            $table->string('mode'); // ex: mobile money, carte
            $table->string('reference')->unique(); // id du paiement dans le système de paiement
            $table->dateTime('date_paiement');
            $table->string('statut')->default('en_attente'); // en_attente, payé, échoué
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('paiements');
    }
};
