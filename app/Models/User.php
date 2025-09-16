<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, Notifiable, HasFactory, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getPermissionArray()
    {
        return $this->getAllPermissions()->mapWithKeys(function ($pr) {
            return [$pr['name'] => true];
        });
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function profileMasjid(): HasOne
    {
        return $this->hasOne(ProfileMasjid::class);
    }

    // Menambahkan type hinting untuk konsistensi
    public function imams(): HasMany
    {
        return $this->hasMany(Imam::class);
    }
    public function asatidzs(): HasMany
    {
        return $this->hasMany(Asatidz::class);
    }
    public function khatibs(): HasMany
    {
        return $this->hasMany(Khatib::class);
    }
    public function takmirs(): HasMany
    {
        return $this->hasMany(Takmir::class);
    }
    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }
    public function eventViews(): HasMany
    {
        return $this->hasMany(EventView::class);
    }
    public function moduls(): HasMany
    {
        return $this->hasMany(Modul::class);
    }
    public function jamaahs(): HasMany
    {
        return $this->hasMany(Jamaah::class);
    }

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }
}
