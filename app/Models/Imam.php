<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasMasjid; // Import trait
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Tambahkan ini



class Imam extends Model
{
    use HasMasjid;
    protected $fillable = [
        'user_id',
        'profile_masjid_id',
        'nama',
        'no_handphone',
        'alamat',
        'tugas',
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
