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
        Schema::create('lost_found_items', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke user yang melaporkan
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            $table->enum('type', ['lost', 'found']); // Jenis: hilang atau ditemukan
            $table->string('item_name'); // Nama barang
            $table->text('description'); // Deskripsi barang
            $table->string('category')->nullable(); // Kategori barang (elektronik, dokumen, dll)
            $table->string('photo')->nullable(); // Foto barang
            $table->dateTime('date'); // Tanggal kehilangan/penemuan
            
            // Status khusus untuk barang hilang
            $table->enum('lost_status', ['not_found', 'found'])->nullable()->default('not_found');
            
            // Status khusus untuk barang ditemukan
            $table->enum('found_status', ['not_claimed', 'claimed'])->nullable()->default('not_claimed');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lost_found_items');
    }
};
