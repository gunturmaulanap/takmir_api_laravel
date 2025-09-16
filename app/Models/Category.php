<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasMasjid;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Tambahkan ini



class Category extends Model
{
    use HasMasjid;
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'user_id',
        'profile_masjid_id',
        'slug'
    ];

    public function events()
    {
        return $this->hasMany(Event::class);
    }
    public function moduls()
    {
        return $this->hasMany(Modul::class);
    }
    public function takmirs()
    {
        return $this->hasMany(Takmir::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
