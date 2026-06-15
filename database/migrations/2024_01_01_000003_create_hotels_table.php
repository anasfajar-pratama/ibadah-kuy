<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('slug')->unique();
            $table->enum('lokasi', ['makkah', 'madinah']);
            $table->integer('bintang')->default(3);
            $table->text('deskripsi')->nullable();
            $table->string('jarak_ke_masjid');
            $table->string('alamat')->nullable();
            $table->json('fasilitas')->nullable();
            $table->string('gambar')->nullable();
            $table->string('gambar_thumbnail')->nullable();
            $table->json('foto_tambahan')->nullable();
            $table->boolean('is_aktif')->default(true);
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hotels');
    }
};
