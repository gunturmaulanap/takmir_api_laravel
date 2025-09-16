<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AktivitasJamaah extends Model
{
    protected $fillable = [
        'user_id',
        'profile_masjid_id',
        'nama',
        'detail_aktivitas',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function profileMasjid()
    {
        return $this->belongsTo(ProfileMasjid::class);
    }
}
