<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [
        'judul', 'subjudul', 'gambar', 'gambar_thumbnail',
        'link', 'teks_tombol', 'is_aktif', 'urutan',
    ];

    protected $casts = [
        'is_aktif' => 'boolean',
    ];

    public function getGambarUrlAttribute(): string
    {
        if ($this->gambar && file_exists(public_path('storage/' . $this->gambar))) {
            return asset('storage/' . $this->gambar);
        }
        return asset('images/placeholder/banner-default.svg');
    }

    public function scopeAktif($query)
    {
        return $query->where('is_aktif', true);
    }
}
