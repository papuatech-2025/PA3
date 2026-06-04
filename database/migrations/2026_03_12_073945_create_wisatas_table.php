<?php
// database/migrations/[timestamp]_create_wisata_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wisata', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('slug')->unique();
            $table->string('kategori');
            $table->string('lokasi');
            $table->text('deskripsi');
            $table->string('jam_operasional')->nullable();
            $table->integer('harga')->nullable();
            $table->string('gambar')->nullable();
            $table->json('galeri')->nullable();
            $table->decimal('rating', 3, 1)->default(0);
            $table->integer('total_review')->default(0);
            $table->json('fasilitas')->nullable();
            $table->json('informasi_tambahan')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wisata');
    }
};