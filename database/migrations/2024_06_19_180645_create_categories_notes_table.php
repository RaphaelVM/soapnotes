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
        Schema::create('category_note', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('category_id')->constrained('categories')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignUuid('note_id')->constrained('notes')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories_notes');
    }
};
