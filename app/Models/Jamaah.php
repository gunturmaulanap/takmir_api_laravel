<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasMasjid; // Import trait
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Tambahkan ini


class Jamaah extends Model
{
    use HasMasjid;
    protected $fillable = [
        'user_id',
        'profile_masjid_id',
        'nama',
        'no_handphone',
        'category_id',
        'alamat',
        'umur',
        'slug',
        'jenis_kelamin',
        'aktivitas_jamaah_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function profileMasjid()
    {
        return $this->belongsTo(ProfileMasjid::class);
    }
    public function aktivitasJamaah()
    {
        return $this->belongsTo(AktivitasJamaah::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
