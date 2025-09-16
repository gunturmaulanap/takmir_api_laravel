<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Models\Traits\HasMasjid; // Import trait
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Tambahkan ini



class Aparatur extends Model
{
    use HasMasjid; // Terapkan trait ini

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'role',
        'image',
    ];

    /**
     * image
     *
     * @return Attribute
     */
    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn($image) => url('/storage/aparaturs/' . $image),
        );
    }
}
