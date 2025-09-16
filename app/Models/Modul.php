<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;


class Modul extends Model
{
    protected $fillable = [
        'nama',
        'category_id',
        'user_id',
        'slug',
        'kode',
        'image',
    ];
    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn($image) => url('/storage/photos/' . $image),
        );
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
