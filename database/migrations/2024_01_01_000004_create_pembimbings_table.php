<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembimbings', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('slug')->unique();
            $table->string('gelar')->nullable();
            $table->string('jabatan')->nullable();
            $table->text('bio')->nullable();
            $table->text('keahlian')->nullable();
            $table->integer('pengalaman_tahun')->default(0);
            $table->integer('total_jamaah')->default(0);
            $table->string('foto')->nullable();
            $table->string('foto_thumbnail')->nullable();
            $table->boolean('is_aktif')->default(true);
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembimbings');
    }
};
