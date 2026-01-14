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
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_number')->unique();
            $table->string('kategori');
            $table->text('deskripsi');
            $table->string('nama_pelapor')->nullable();
            $table->string('kontak_pelapor')->nullable();
            $table->string('foto')->nullable();
            $table->enum('status', ['terkirim', 'dibaca', 'diproses', 'selesai'])->default('terkirim');
            $table->text('catatan_tindak_lanjut')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};
