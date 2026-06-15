<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Hotel extends Model
{
    protected $fillable = [
        'nama', 'slug', 'lokasi', 'bintang', 'deskripsi',
        'jarak_ke_masjid', 'alamat', 'fasilitas',
        'gambar', 'gambar_thumbnail', 'foto_tambahan',
        'is_aktif', 'urutan',
    ];

    protected $casts = [
        'fasilitas' => 'array',
        'foto_tambahan' => 'array',
        'is_aktif' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->nama);
            }
        });
    }

    public function getLokasiLabelAttribute(): string
    {
        return match($this->lokasi) {
            'makkah' => 'Makkah Al-Mukarramah',
            'madinah' => 'Madinah Al-Munawwarah',
            default => $this->lokasi,
        };
    }

    public function getGambarUrlAttribute(): string
    {
        if ($this->gambar && file_exists(public_path('storage/' . $this->gambar))) {
            return asset('storage/' . $this->gambar);
        }
        return asset('images/placeholder/hotel-default.svg');
    }

    public function getThumbnailUrlAttribute(): string
    {
        if ($this->gambar_thumbnail && file_exists(public_path('storage/' . $this->gambar_thumbnail))) {
            return asset('storage/' . $this->gambar_thumbnail);
        }
        return asset('images/placeholder/hotel-thumb.svg');
    }

    public function getBintangSymbolAttribute(): string
    {
        return str_repeat('★', $this->bintang) . str_repeat('☆', 5 - $this->bintang);
    }

    public function scopeAktif($query)
    {
        return $query->where('is_aktif', true);
    }

    public function scopeMakkah($query)
    {
        return $query->where('lokasi', 'makkah');
    }

    public function scopeMadinah($query)
    {
        return $query->where('lokasi', 'madinah');
    }
}
