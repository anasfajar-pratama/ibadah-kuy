<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Booking extends Model
{
    protected $fillable = [
        'no_booking', 'jamaah_id', 'paket_id', 'jadwal_id',
        'total_biaya', 'dp_amount', 'total_bayar', 'sisa_bayar',
        'status_pembayaran', 'status', 'catatan',
    ];

    protected $casts = [
        'total_biaya' => 'decimal:2',
        'dp_amount' => 'decimal:2',
        'total_bayar' => 'decimal:2',
        'sisa_bayar' => 'decimal:2',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->no_booking)) {
                $model->no_booking = 'BK-' . date('Ymd') . '-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
            }
        });
    }

    public function jamaah(): BelongsTo
    {
        return $this->belongsTo(Jamaah::class);
    }

    public function paket(): BelongsTo
    {
        return $this->belongsTo(Paket::class);
    }

    public function jadwal(): BelongsTo
    {
        return $this->belongsTo(Jadwal::class);
    }

    public function pembayarans(): HasMany
    {
        return $this->hasMany(Pembayaran::class);
    }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'pending' => 'Menunggu',
            'konfirmasi' => 'Dikonfirmasi',
            'aktif' => 'Aktif',
            'selesai' => 'Selesai',
            'batal' => 'Dibatalkan',
            default => $this->status,
        };
    }
}
