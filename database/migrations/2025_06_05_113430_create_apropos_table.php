<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('apropos', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // 'section' or 'team_member'
            $table->string('title')->nullable(); // Title for sections (e.g., Mission), name for team members
            $table->text('content')->nullable(); // Content for sections, null for team members
            $table->string('image')->nullable(); // Image path for both
            $table->integer('order')->default(0); // Order for sections, 0 for team members
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('apropos');
    }
};