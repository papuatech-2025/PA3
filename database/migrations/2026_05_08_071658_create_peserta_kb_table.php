<?php
// database/migrations/xxxx_xx_xx_create_peserta_kb_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesertaKbTable extends Migration
{
    public function up()
    {
        Schema::create('peserta_kb', function (Blueprint $table) {
            $table->id('id_masyarakat');
            $table->foreignId('id_admin')->constrained('admins')->onDelete('cascade');
            $table->string('nama');
            $table->string('nik', 16)->unique();
            $table->string('jenis_kb');
            $table->date('tanggal_mulai');
            $table->enum('status', ['aktif', 'nonaktif', 'selesai', 'pindah']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('peserta_kb');
    }
}