<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;


class ProfileMasjid extends Model
{
    protected $fillable = [
        'user_id',
        'nama',
        'alamat',
        'image',
    ];
    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn($image) => url('/storage/photos/' . $image),
        );
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
