<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'name',
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
}
