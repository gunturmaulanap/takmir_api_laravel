<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Models\Traits\HasMasjid; // Import trait
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Tambahkan ini




class Asatidz extends Model
{
    use HasMasjid;

    protected $fillable = [
        'nama',
        'profile_masjid_id',
        'user_id',
        'no_handphone',
        'category_id',
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
    public function profileMasjid()
    {
        return $this->belongsTo(ProfileMasjid::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
