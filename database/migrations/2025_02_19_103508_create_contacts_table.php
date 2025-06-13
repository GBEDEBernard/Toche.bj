<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Exécuter la migration.
     */
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id(); // Clé primaire auto-incrémentée
            $table->string('nom');
            $table->string('prenom');
            $table->string('objet', 50);
            $table->string('email');
            $table->text('contenu');
            $table->timestamps(); // Ajoute created_at et updated_at
        });
    }

    /**
     * Annuler la migration.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
