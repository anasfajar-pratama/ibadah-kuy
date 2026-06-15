<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Testimoni extends Model
{
    protected $fillable = [
        'nama', 'asal_kota', 'foto', 'paket_id',
        'rating', 'isi', 'tahun',
        'is_featured', 'is_aktif', 'urutan',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_aktif' => 'boolean',
    ];

    public function paket(): BelongsTo
    {
        return $this->belongsTo(Paket::class);
    }

    public function getFotoUrlAttribute(): string
    {
        if ($this->foto && file_exists(public_path('storage/' . $this->foto))) {
            return asset('storage/' . $this->foto);
        }
        return asset('images/placeholder/testimoni-default.svg');
    }

    public function getBintangAttribute(): string
    {
        return str_repeat('★', $this->rating) . str_repeat('☆', 5 - $this->rating);
    }

    public function scopeAktif($query)
    {
        return $query->where('is_aktif', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
