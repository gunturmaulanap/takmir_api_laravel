<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasMasjid;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Khatib extends Model
{
    use HasMasjid;

    /**
     * The attributes that are mass assignable.
     * Disesuaikan dengan migrasi terbaru.
     */
    protected $fillable = [
        'slug',
        'user_id',
        'profile_masjid_id',
        'nama',
        'no_handphone',
        'alamat',
        'tanggal_khutbah', // <-- Ditambahkan
        'judul_khutbah',   // <-- Ditambahkan
    ];

    /**
     * The attributes that should be cast to native types.
     * Ini penting agar tanggal bisa diolah dengan benar.
     */
    protected $casts = [
        'tanggal_khutbah' => 'date', // <-- Ditambahkan
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function profileMasjid(): BelongsTo
    {
        return $this->belongsTo(ProfileMasjid::class);
    }
}
