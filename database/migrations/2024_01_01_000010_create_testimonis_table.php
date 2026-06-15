<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('testimonis', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('asal_kota')->nullable();
            $table->string('foto')->nullable();
            $table->foreignId('paket_id')->nullable()->constrained('pakets')->onDelete('set null');
            $table->integer('rating')->default(5);
            $table->text('isi');
            $table->year('tahun')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_aktif')->default(true);
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('testimonis');
    }
};
