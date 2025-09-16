<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Imam extends Model
{
    protected $fillable = [
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
