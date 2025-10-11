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
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            // Relasi ke users (student)
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete(); // Jika user dihapus, enrollment ikut terhapus

            // Relasi ke courses
            $table->foreignId('course_id')
                ->constrained()
                ->cascadeOnDelete(); // Jika kursus dihapus, enrollment ikut terhapus

            // Status enrollment
            $table->enum('status', ['active', 'completed'])->default('active');

            // Tracking progress
            $table->integer('progress_percentage')->default(0); // 0-100%

            // Timestamp
            $table->timestamp('enrolled_at')->useCurrent(); // Waktu enroll
            $table->timestamp('completed_at')->nullable(); // Waktu selesai (otomatis saat 100%)

            $table->timestamps(); // created_at, updated_at

            // Unique constraint: 1 student hanya bisa enroll 1 kali per kursus
            $table->unique(['user_id', 'course_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};
