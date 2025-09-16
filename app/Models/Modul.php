<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Models\Traits\HasMasjid; // Import trait
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Tambahkan ini



class Modul extends Model
{
    use HasMasjid;
    protected $fillable = [
        'nama',
        'profile_masjid_id',
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
    public function profileMasjid()
    {
        return $this->belongsTo(ProfileMasjid::class);
    }
}
