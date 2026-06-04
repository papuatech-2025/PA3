<?php
// database/migrations/2024_01_15_000001_create_pengumuman_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengumuman', function (Blueprint $table) {
            $table->id('id_pengumuman'); // auto increment, primary key
            $table->unsignedBigInteger('id_admin');
            $table->string('judul', 200);
            $table->text('isi');
            $table->timestamp('tanggal')->useCurrent(); // otomatis saat insert
            $table->timestamps(); // created_at, updated_at (opsional)
            
            // foreign key ke tabel admins (jika ada)
            $table->foreign('id_admin')
                  ->references('id')
                  ->on('admins')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengumuman');
    }
};