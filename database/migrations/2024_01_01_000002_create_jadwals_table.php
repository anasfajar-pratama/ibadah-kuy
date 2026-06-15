<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paket_id')->constrained('pakets')->onDelete('cascade');
            $table->date('tanggal_berangkat');
            $table->date('tanggal_kembali');
            $table->string('bandara_keberangkatan');
            $table->string('maskapai');
            $table->string('no_penerbangan')->nullable();
            $table->integer('kuota');
            $table->integer('sisa_kursi');
            $table->enum('status', ['tersedia', 'hampir_penuh', 'penuh', 'selesai'])->default('tersedia');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwals');
    }
};
