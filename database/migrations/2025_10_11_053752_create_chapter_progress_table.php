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
        Schema::create('chapter_progress', function (Blueprint $table) {
            $table->id();
            // Relasi ke users (student)
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete(); // Jika user dihapus, progress ikut terhapus

            // Relasi ke chapters
            $table->foreignId('chapter_id')
                ->constrained()
                ->cascadeOnDelete(); // Jika chapter dihapus, progress ikut terhapus

            // Status completion
            $table->boolean('is_completed')->default(false);
            $table->timestamp('completed_at')->nullable(); // Waktu selesai membaca chapter

            $table->timestamps(); // created_at, updated_at

            // Unique constraint: 1 student hanya punya 1 record progress per chapter
            $table->unique(['user_id', 'chapter_id']);

            // Index untuk query cepat
            $table->index(['user_id', 'is_completed']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chapter_progress');
    }
};
