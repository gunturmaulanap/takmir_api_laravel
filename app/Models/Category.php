<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Tambahkan ini



class Category extends Model
{
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'user_id',
        'slug'
    ];

    public function events()
    {
        return $this->hasMany(Event::class);
    }
    public function takmirs()
    {
        return $this->hasMany(Takmir::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function jamaahs()
    {
        return $this->hasMany(Jamaah::class);
    }
}
