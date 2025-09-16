<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Muadzin extends Model
{
    protected $fillable = [
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
