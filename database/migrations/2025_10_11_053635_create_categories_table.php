<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama kategori (Programming, Design, dll)
            $table->string('slug')->unique(); // URL-friendly name (programming, design)
            $table->text('description')->nullable(); // Deskripsi kategori
            $table->timestamps(); // created_at, updated_at
            $table->softDeletes(); // deleted_at (soft delete)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
