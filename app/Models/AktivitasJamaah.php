<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasMasjid; // Import trait
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Tambahkan ini



class AktivitasJamaah extends Model
{
    use HasMasjid; // Terapkan trait ini

    protected $fillable = [
        'user_id',
        'profile_masjid_id',
        'nama',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function profileMasjid()
    {
        return $this->belongsTo(ProfileMasjid::class);
    }
    public function jamaah()
    {
        return $this->hasMany(Jamaah::class);
    }
}
