<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Pembimbing extends Model
{
    protected $fillable = [
        'nama', 'slug', 'gelar', 'jabatan', 'bio', 'keahlian',
        'pengalaman_tahun', 'total_jamaah',
        'foto', 'foto_thumbnail', 'is_aktif', 'urutan',
    ];

    protected $casts = [
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

    public function getNamaLengkapAttribute(): string
    {
        return trim($this->gelar . ' ' . $this->nama);
    }

    public function getFotoUrlAttribute(): string
    {
        if ($this->foto && file_exists(public_path('storage/' . $this->foto))) {
            return asset('storage/' . $this->foto);
        }
        return asset('images/placeholder/pembimbing-default.svg');
    }

    public function getThumbnailUrlAttribute(): string
    {
        if ($this->foto_thumbnail && file_exists(public_path('storage/' . $this->foto_thumbnail))) {
            return asset('storage/' . $this->foto_thumbnail);
        }
        return asset('images/placeholder/pembimbing-thumb.svg');
    }

    public function scopeAktif($query)
    {
        return $query->where('is_aktif', true);
    }
}
