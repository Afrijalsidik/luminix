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
        Schema::create('chapters', function (Blueprint $table) {
            $table->id();
            // Relasi ke courses
            $table->foreignId('course_id')
                ->constrained()
                ->cascadeOnDelete(); // Jika kursus dihapus, chapter ikut terhapus

            // Data chapter
            $table->string('title'); // Judul chapter
            $table->longText('content'); // Konten artikel (text panjang)
            $table->integer('order')->default(0); // Urutan chapter (1, 2, 3, dst)

            $table->timestamps(); // created_at, updated_at
            $table->softDeletes(); // deleted_at (soft delete)

            // Index untuk sorting berdasarkan order
            $table->index(['course_id', 'order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chapters');
    }
};
