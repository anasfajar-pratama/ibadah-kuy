<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pakets', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('slug')->unique();
            $table->enum('jenis', ['haji_reguler', 'haji_plus', 'haji_furoda', 'umrah_reguler', 'umrah_plus', 'umrah_ramadan', 'umrah_custom']);
            $table->text('deskripsi');
            $table->longText('detail')->nullable();
            $table->decimal('harga', 12, 2);
            $table->string('mata_uang', 3)->default('IDR');
            $table->integer('durasi_hari');
            $table->integer('kuota');
            $table->integer('sisa_kursi')->default(0);
            $table->string('maskapai')->nullable();
            $table->string('kelas_penerbangan')->default('Economy');
            $table->string('hotel_makkah')->nullable();
            $table->string('bintang_hotel_makkah')->nullable();
            $table->string('hotel_madinah')->nullable();
            $table->string('bintang_hotel_madinah')->nullable();
            $table->json('fasilitas')->nullable();
            $table->json('program')->nullable();
            $table->json('syarat')->nullable();
            $table->string('gambar')->nullable();
            $table->string('gambar_thumbnail')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_aktif')->default(true);
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pakets');
    }
};
