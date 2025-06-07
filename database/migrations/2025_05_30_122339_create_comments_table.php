<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();

            // Relasi ke laporan
            $table->foreignId('report_id')->constrained()->onDelete('cascade');

            // Relasi ke user (komentator)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->text('content'); // Isi komentar
            $table->timestamps(); // created_at dan updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
