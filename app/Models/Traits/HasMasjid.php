<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

trait HasMasjid
{
    /**
     * The "booting" method of the trait.
     */
    protected static function bootHasMasjid()
    {
        static::addGlobalScope('masjid', function (Builder $builder) {
            $user = Auth::user();

            if ($user && $user->profileMasjid) {
                $builder->where('profile_masjid_id', $user->profileMasjid->id);
            }
        });
    }
}
