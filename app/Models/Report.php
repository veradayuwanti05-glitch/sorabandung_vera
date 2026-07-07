<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    // Mendaftarkan kolom agar diizinkan menyimpan data ke database
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'district_id',
        'status',
        'latitude',
        'longitude',
        'image_before',  // Diizinkan untuk foto laporan awal warga
        'image_success', // Diizinkan untuk foto bukti tuntas dari kecamatan
    ];

    // Relasi ke tabel User (Warga yang melapor)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke tabel District (Kecamatan wilayah aduan)
    public function district()
    {
        return $this->belongsTo(District::class);
    }

    // Relasi ke tabel Resolution (Jika ada data detail penyelesaian terpisah)
    public function resolution()
    {
        return $this->hasOne(Resolution::class);
    }
}