<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jadwal extends Model
{
    protected $fillable = [
        'paket_id', 'tanggal_berangkat', 'tanggal_kembali',
        'bandara_keberangkatan', 'maskapai', 'no_penerbangan',
        'kuota', 'sisa_kursi', 'status', 'catatan',
    ];

    protected $casts = [
        'tanggal_berangkat' => 'date',
        'tanggal_kembali' => 'date',
    ];

    public function paket(): BelongsTo
    {
        return $this->belongsTo(Paket::class);
    }

    public function jamaah(): HasMany
    {
        return $this->hasMany(Jamaah::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function getDurasiAttribute(): int
    {
        return $this->tanggal_berangkat->diffInDays($this->tanggal_kembali);
    }
}
