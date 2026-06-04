// database/migrations/2026_01_01_000000_create_masyarakat_table.php

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('masyarakat', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 16)->unique(); // NIK sebagai identitas utama
            $table->string('nama_lengkap');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->text('alamat');
            $table->string('desa_kelurahan');
            $table->string('no_telepon', 15)->nullable();
            $table->text('keterangan')->nullable(); // untuk catatan tambahan
            $table->boolean('is_archived')->default(false); // untuk arsip data lama
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('masyarakat');
    }
};