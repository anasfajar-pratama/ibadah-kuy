<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained('bookings')->onDelete('cascade');
            $table->string('no_transaksi')->unique();
            $table->decimal('jumlah', 12, 2);
            $table->enum('jenis', ['dp', 'cicilan', 'pelunasan']);
            $table->date('tanggal_bayar');
            $table->string('metode_bayar');
            $table->string('rekening_tujuan')->nullable();
            $table->string('bukti_bayar')->nullable();
            $table->enum('status', ['pending', 'verified', 'ditolak'])->default('pending');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
