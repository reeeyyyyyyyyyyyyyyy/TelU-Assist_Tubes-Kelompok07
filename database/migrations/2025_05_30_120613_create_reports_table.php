<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();

            // Relasi ke pelapor (users)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Relasi ke kategori laporan: kebersihan, barang hilang, barang ditemukan
            $table->foreignId('report_category_id')->constrained()->onDelete('cascade');

            // Relasi ke lokasi
            $table->foreignId('location_id')->constrained()->onDelete('cascade');

            $table->string('title'); // Judul laporan
            $table->text('description'); // Isi laporan
            $table->string('photo')->nullable(); // Opsional, path ke file gambar
            $table->enum('status', ['pending', 'diproses', 'selesai'])->default('pending');
            $table->timestamp('reported_at')->useCurrent(); // Waktu laporan dibuat
            $table->timestamp('handled_at')->nullable(); // Waktu laporan selesai (jika ada)

            $table->timestamps(); // created_at dan updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
