<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;


class Asatidz extends Model
{
    protected $fillable = [
        'nama',
        'user_id',
        'no_handphone',
        'alamat',
        'tugas',
        'jenis_kelamin',
        'image',
    ];
    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn($image) => url('/storage/photos/' . $image),
        );
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
