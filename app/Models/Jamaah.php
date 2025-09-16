<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jamaah extends Model
{
    protected $fillable = [
        'user_id',
        'kode',
        'nama',
        'no_handphone',
        'alamat',
        'umur',
        'jenis_kelamin',
        'aktivitas_jamaah',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
