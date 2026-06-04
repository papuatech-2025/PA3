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
    Schema::create('visi_misis', function (Blueprint $table) {
        $table->id('id_visimisi'); // Nama Primary Key kustom
        $table->unsignedBigInteger('id_admin'); // Foreign Key ke tabel users
        $table->text('isi'); // Konten Visi & Misi
        $table->timestamps();

        // Relasi ke tabel users (admin)
        $table->foreign('id_admin')->references('id')->on('users')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visi_misis');
    }
};
