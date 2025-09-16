<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasMasjid; // Import trait
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Tambahkan ini



class EventView extends Model
{
    use HasMasjid;
    protected $fillable = [
        'category_id',
        'profile_masjid_id',
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
    public function profileMasjid()
    {
        return $this->belongsTo(ProfileMasjid::class);
    }
}
