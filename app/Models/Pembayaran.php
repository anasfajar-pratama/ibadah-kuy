<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pembayaran extends Model
{
    protected $fillable = [
        'booking_id', 'no_transaksi', 'jumlah', 'jenis',
        'tanggal_bayar', 'metode_bayar', 'rekening_tujuan',
        'bukti_bayar', 'status', 'catatan',
    ];

    protected $casts = [
        'tanggal_bayar' => 'date',
        'jumlah' => 'decimal:2',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->no_transaksi)) {
                $model->no_transaksi = 'TRX-' . date('YmdHis') . '-' . rand(100, 999);
            }
        });
    }

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }

    public function getBuktiBayarUrlAttribute(): ?string
    {
        if ($this->bukti_bayar) {
            return asset('storage/' . $this->bukti_bayar);
        }
        return null;
    }
}
