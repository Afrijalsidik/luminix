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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            // Relasi ke users (instructor yang buat kursus)
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete(); // Jika user dihapus, kursusnya ikut terhapus

            // Relasi ke categories
            $table->foreignId('category_id')
                ->constrained()
                ->cascadeOnDelete(); // Jika kategori dihapus, kursusnya ikut terhapus

            // Data kursus
            $table->string('title'); // Judul kursus
            $table->string('slug')->unique(); // URL-friendly title
            $table->text('description'); // Deskripsi lengkap kursus
            $table->string('thumbnail')->nullable(); // Path foto thumbnail

            // Status kursus: draft atau published
            $table->enum('status', ['draft', 'published'])->default('draft');

            $table->timestamps(); // created_at, updated_at
            $table->softDeletes(); // deleted_at (soft delete)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
