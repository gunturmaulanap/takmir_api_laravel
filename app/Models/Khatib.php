<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Khatib extends Model
{
    protected $fillable = [
        'slug',
        'user_id',
        'nama',
        'no_handphone',
        'alamat',
        'tugas',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
