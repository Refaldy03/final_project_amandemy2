<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
{
    use HasFactory;

    protected $fillable = [
        'foto_umkm',
        'nama_umkm',
        'kota_umkm',
        'lokasi_umkm',
        'deskripsi',
        'kontak',
        'user_id',
    ];

    // Relationship dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function loker()
    {
        return $this->hasOne(Loker::class);
    }

    public function produk()
    {
        return $this->hasMany(Produk::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }
}
