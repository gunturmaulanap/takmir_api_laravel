<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Auth\Authenticatable;

class StoreJamaahRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        /** @var User|Authenticatable|null $user */
        $user = auth()->guard('api')->user();

        // Pastikan user terautentikasi dan benar-benar memiliki profil masjid.
        // Method getMasjidProfile() harus ada di dalam model User Anda.
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
        $user = auth()->guard('api')->user();

        // Aman diakses karena sudah divalidasi di dalam method authorize()
        $masjidProfileId = $user->getMasjidProfile()->id;

        return [
            'nama'               => [
                'required',
                'string',
                'max:255',
                // Pastikan nama unik HANYA untuk masjid ini
                'unique:jamaahs,nama,NULL,id,profile_masjid_id,' . $masjidProfileId,
            ],
            'no_handphone'       => 'required|string|max:15',
            'alamat'             => 'required|string',
            'umur'               => 'required|integer|min:1',
            'jenis_kelamin'      => 'required|in:Laki-laki,Perempuan',
            'aktivitas_jamaah_id' => 'required|exists:aktivitas_jamaahs,id',
            'category_id'        => 'required|exists:categories,id',
        ];
    }
}
