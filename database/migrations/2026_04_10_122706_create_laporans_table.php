<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_laporan')->unique();
            $table->string('nama_pelapor');
            $table->string('email');
            $table->string('no_telepon')->nullable();
            $table->enum('jenis_laporan', [
                'Kekerasan',
                'Pelecehan',
                'Diskriminasi',
                'Penelantaran',
                'Permintaan Bantuan',
                'Konsultasi',
                'Lainnya'
            ]);
            $table->string('judul_laporan');
            $table->text('isi_laporan');
            $table->string('lokasi_kejadian')->nullable();
            $table->date('tanggal_kejadian')->nullable();
            $table->string('foto_pendukung')->nullable();
            $table->enum('status', ['baru', 'diproses', 'selesai', 'ditolak'])->default('baru');
            $table->text('catatan_admin')->nullable();
            $table->timestamp('dibaca_pada')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('laporans');
    }
};