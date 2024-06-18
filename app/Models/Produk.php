<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'foto_produk',
        'nama_produk',
        'harga',
        'umkm_id',
    ];

    public function umkm()
    {
        return $this->belongsTo(UMKM::class);
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
