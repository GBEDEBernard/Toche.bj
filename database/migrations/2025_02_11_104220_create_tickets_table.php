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
       // cle etrangère evenement ou site 
            Schema::create('tickets', function (Blueprint $table) {
              $table->id(); 
              $table->foreignId('evenement_id')->constrained()->onUpdate('cascade')->onDelete('cascade'); 
              $table->string('type');
              $table->integer('nombres');
              $table->string('prix');
              $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
