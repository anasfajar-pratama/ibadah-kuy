<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Paket extends Model
{
    protected $fillable = [
        'nama', 'slug', 'jenis', 'deskripsi', 'detail', 'harga', 'mata_uang',
        'durasi_hari', 'kuota', 'sisa_kursi', 'maskapai', 'kelas_penerbangan',
        'hotel_makkah', 'bintang_hotel_makkah', 'hotel_madinah', 'bintang_hotel_madinah',
        'fasilitas', 'program', 'syarat', 'gambar', 'gambar_thumbnail',
        'is_featured', 'is_aktif', 'urutan',
    ];

    protected $casts = [
        'fasilitas' => 'array',
        'program' => 'array',
        'syarat' => 'array',
        'harga' => 'decimal:2',
        'is_featured' => 'boolean',
        'is_aktif' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->nama);
            }
            if ($model->sisa_kursi === 0 || $model->sisa_kursi === null) {
                $model->sisa_kursi = $model->kuota;
            }
        });
    }

    public function jadwals(): HasMany
    {
        return $this->hasMany(Jadwal::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function testimonis(): HasMany
    {
        return $this->hasMany(Testimoni::class);
    }

    public function getJenisLabelAttribute(): string
    {
        return match($this->jenis) {
            'haji_reguler' => 'Haji Reguler',
            'haji_plus' => 'Haji Plus',
            'haji_furoda' => 'Haji Furoda',
            'umrah_reguler' => 'Umrah Reguler',
            'umrah_plus' => 'Umrah Plus',
            'umrah_ramadan' => 'Umrah Ramadan',
            'umrah_custom' => 'Umrah Custom',
            default => $this->jenis,
        };
    }

    public function getHargaFormatAttribute(): string
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }

    public function getGambarUrlAttribute(): string
    {
        if ($this->gambar && file_exists(public_path('storage/' . $this->gambar))) {
            return asset('storage/' . $this->gambar);
        }
        return asset('images/placeholder/paket-default.svg');
    }

    public function getThumbnailUrlAttribute(): string
    {
        if ($this->gambar_thumbnail && file_exists(public_path('storage/' . $this->gambar_thumbnail))) {
            return asset('storage/' . $this->gambar_thumbnail);
        }
        return asset('images/placeholder/paket-thumb.svg');
    }

    public function scopeAktif($query)
    {
        return $query->where('is_aktif', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeHaji($query)
    {
        return $query->whereIn('jenis', ['haji_reguler', 'haji_plus', 'haji_furoda']);
    }

    public function scopeUmrah($query)
    {
        return $query->whereIn('jenis', ['umrah_reguler', 'umrah_plus', 'umrah_ramadan', 'umrah_custom']);
    }
}
