<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $fillable = [
        'pertanyaan', 'jawaban', 'kategori', 'is_aktif', 'urutan',
    ];

    protected $casts = [
        'is_aktif' => 'boolean',
    ];

    public function getKategoriLabelAttribute(): string
    {
        return match($this->kategori) {
            'umum' => 'Umum',
            'haji' => 'Haji',
            'umrah' => 'Umrah',
            'pembayaran' => 'Pembayaran',
            'dokumen' => 'Dokumen',
            default => 'Lainnya',
        };
    }

    public function scopeAktif($query)
    {
        return $query->where('is_aktif', true);
    }
}
