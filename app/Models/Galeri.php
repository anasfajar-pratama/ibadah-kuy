<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    protected $fillable = [
        'judul', 'deskripsi', 'gambar', 'gambar_thumbnail',
        'kategori', 'lokasi', 'tahun',
        'is_featured', 'is_aktif', 'urutan',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_aktif' => 'boolean',
    ];

    public function getGambarUrlAttribute(): string
    {
        if ($this->gambar && file_exists(public_path('storage/' . $this->gambar))) {
            return asset('storage/' . $this->gambar);
        }
        return asset('images/placeholder/galeri-default.svg');
    }

    public function getThumbnailUrlAttribute(): string
    {
        if ($this->gambar_thumbnail && file_exists(public_path('storage/' . $this->gambar_thumbnail))) {
            return asset('storage/' . $this->gambar_thumbnail);
        }
        return asset('images/placeholder/galeri-thumb.svg');
    }

    public function scopeAktif($query)
    {
        return $query->where('is_aktif', true);
    }
}
