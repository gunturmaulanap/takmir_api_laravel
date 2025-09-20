<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Auth\Authenticatable;

class UpdateAktivitasJamaahRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        /** @var User|Authenticatable|null $user */
        $user = auth()->guard('api')->user();
        return $user && method_exists($user, 'getMasjidProfile') && $user->getMasjidProfile();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        /** @var User $user */
        $user = $this->user();
        $masjidProfileId = $user->getMasjidProfile()->id;
        $aktivitasJamaahId = $this->route('aktivitas_jamaah')->id;

        return [
            'nama' => [
                'required',
                'string',
                'max:255',
                'unique:aktivitas_jamaahs,nama,' . $aktivitasJamaahId . ',id,profile_masjid_id,' . $masjidProfileId,
            ],
        ];
    }
}
