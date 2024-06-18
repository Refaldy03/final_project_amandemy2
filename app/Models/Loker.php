<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loker extends Model
{
    use HasFactory;

    protected $fillable = [
        'foto_umkm',
        'nama_umkm',
        'kota_umkm',
        'lokasi_umkm',
        'posisi_loker',
        'jumlah_loker',
        'kualifikasi',
        'email',
        'user_id',
        'umkm_id',
    ];

    // Relationship dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function umkm()
    {
        return $this->belongsTo(UMKM::class);
    }
}
