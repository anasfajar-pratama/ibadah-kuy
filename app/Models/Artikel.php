<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Artikel extends Model
{
    protected $fillable = [
        'judul', 'slug', 'ringkasan', 'konten',
        'gambar', 'gambar_thumbnail', 'kategori',
        'penulis', 'status', 'published_at', 'views',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->judul);
            }
        });
    }

    public function getGambarUrlAttribute(): string
    {
        if ($this->gambar && file_exists(public_path('storage/' . $this->gambar))) {
            return asset('storage/' . $this->gambar);
        }
        return asset('images/placeholder/artikel-default.svg');
    }

    public function getThumbnailUrlAttribute(): string
    {
        if ($this->gambar_thumbnail && file_exists(public_path('storage/' . $this->gambar_thumbnail))) {
            return asset('storage/' . $this->gambar_thumbnail);
        }
        return asset('images/placeholder/artikel-thumb.svg');
    }

    public function getKategoriLabelAttribute(): string
    {
        return match($this->kategori) {
            'tips' => 'Tips & Trik',
            'panduan' => 'Panduan Ibadah',
            'info_visa' => 'Info Visa',
            'info_kesehatan' => 'Info Kesehatan',
            'berita' => 'Berita',
            default => 'Lainnya',
        };
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'publish');
    }
}
