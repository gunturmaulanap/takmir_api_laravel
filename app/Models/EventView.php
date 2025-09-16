<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventView extends Model
{
    protected $fillable = [
        'category_id',
        'user_id',
        'event_id',
        'tanggal_event',
        'aktivitas_jamaah',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
