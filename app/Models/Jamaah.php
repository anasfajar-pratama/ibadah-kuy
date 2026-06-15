<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jamaah extends Model
{
    protected $table = 'jamaah';

    protected $fillable = [
        'no_registrasi', 'paket_id', 'jadwal_id', 'nama_lengkap', 'nik',
        'no_paspor', 'tgl_lahir', 'tempat_lahir', 'jenis_kelamin',
        'alamat', 'kota', 'provinsi', 'no_hp', 'email',
        'kontak_darurat_nama', 'kontak_darurat_hp', 'hubungan_kontak_darurat',
        'status_dokumen', 'status_pembayaran', 'total_biaya', 'total_bayar',
        'status', 'catatan', 'foto_ktp', 'foto_paspor',
    ];

    protected $casts = [
        'tgl_lahir' => 'date',
        'total_biaya' => 'decimal:2',
        'total_bayar' => 'decimal:2',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->no_registrasi)) {
                $model->no_registrasi = 'IK-' . date('Ymd') . '-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
            }
        });
    }

    public function paket(): BelongsTo
    {
        return $this->belongsTo(Paket::class);
    }

    public function jadwal(): BelongsTo
    {
        return $this->belongsTo(Jadwal::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'daftar' => 'Mendaftar',
            'konfirmasi' => 'Dikonfirmasi',
            'berangkat' => 'Berangkat',
            'selesai' => 'Selesai',
            'batal' => 'Dibatalkan',
            default => $this->status,
        };
    }

    public function getSisaBayarAttribute(): float
    {
        return $this->total_biaya - $this->total_bayar;
    }
}
