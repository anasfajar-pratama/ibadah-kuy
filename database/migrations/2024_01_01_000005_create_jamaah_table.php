<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jamaah', function (Blueprint $table) {
            $table->id();
            $table->string('no_registrasi')->unique();
            $table->foreignId('paket_id')->nullable()->constrained('pakets')->onDelete('set null');
            $table->foreignId('jadwal_id')->nullable()->constrained('jadwals')->onDelete('set null');
            $table->string('nama_lengkap');
            $table->string('nik', 20)->nullable();
            $table->string('no_paspor')->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('alamat')->nullable();
            $table->string('kota')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('no_hp');
            $table->string('email')->nullable();
            $table->string('kontak_darurat_nama')->nullable();
            $table->string('kontak_darurat_hp')->nullable();
            $table->string('hubungan_kontak_darurat')->nullable();
            $table->enum('status_dokumen', ['belum_lengkap', 'proses', 'lengkap'])->default('belum_lengkap');
            $table->enum('status_pembayaran', ['belum_bayar', 'dp', 'cicilan', 'lunas'])->default('belum_bayar');
            $table->decimal('total_biaya', 12, 2)->default(0);
            $table->decimal('total_bayar', 12, 2)->default(0);
            $table->enum('status', ['daftar', 'konfirmasi', 'berangkat', 'selesai', 'batal'])->default('daftar');
            $table->text('catatan')->nullable();
            $table->string('foto_ktp')->nullable();
            $table->string('foto_paspor')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jamaah');
    }
};
