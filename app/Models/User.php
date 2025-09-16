<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject; // <-- import JWTSubject

class User extends Authenticatable implements JWTSubject // <-- tambahkan ini
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, Notifiable, HasFactory, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * getPermissionArray
     *
     * @return void
     */
    public function getPermissionArray()
    {
        return $this->getAllPermissions()->mapWithKeys(function ($pr) {
            return [$pr['name'] => true];
        });
    }

    /**
     * getJWTIdentifier
     *
     * @return void
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * getJWTCustomClaims
     *
     * @return void
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function imams()
    {
        return $this->hasMany(Imam::class);
    }
    public function asatidzs()
    {
        return $this->hasMany(Asatidz::class);
    }
    public function khatibs()
    {
        return $this->hasMany(Khatib::class);
    }
    public function takmirs()
    {
        return $this->hasMany(Takmir::class);
    }
    public function events()
    {
        return $this->hasMany(Event::class);
    }
    public function eventViews()
    {
        return $this->hasMany(EventView::class);
    }
    public function moduls()
    {
        return $this->hasMany(Modul::class);
    }
    public function jamaahs()
    {
        return $this->hasMany(Jamaah::class);
    }
    public function profileMasjids()
    {
        return $this->belongsToMany(ProfileMasjid::class);
    }
}
