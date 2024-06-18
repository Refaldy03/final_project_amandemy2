<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $fillable = [
        'email',
        'password',
        'nama',
        'alamat',
        'foto_profile',
        'ktp',
        'user_id',
    ];

    // Relationship dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
