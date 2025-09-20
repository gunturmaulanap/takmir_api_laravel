<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
{
    /**
     * Handle user login and return a JWT token.
     */
    public function index(Request $request)
    {
        // Set validasi
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // Response error validasi
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Ambil "email" dan "password" dari input
        $credentials = $request->only('email', 'password');

        // Check jika "email" dan "password" tidak sesuai
        if (!$token = auth()->guard('api')->attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Email atau Kata Sandi salah'
            ], 400);
        }

        try {
            // Ambil user yang terautentikasi
            $user = auth()->guard('api')->user();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User tidak ditemukan'
                ], 404);
            }

            // Panggil metode getMasjidProfile() yang sudah ada di model User Anda
            $masjidProfile = $user->getMasjidProfile();

            // Ambil data user
            $userData = [
                'id'    => $user->id,
                'name'  => $user->name,
                'email' => $user->email,
                'role'  => $user->roles->isNotEmpty() ? $user->roles->first()->name : 'user'
            ];

            // Ambil semua permissions
            $permissions = $user->getAllPermissions()->pluck('name')->toArray();

            // Berikan respons yang sukses
            return response()->json([
                'success'        => true,
                'user'           => $userData,
                'profile_masjid' => $masjidProfile, // Gunakan hasil dari getMasjidProfile()
                'permissions'    => $permissions,
                'token'          => $token
            ], 200);

        } catch (\Exception $e) {
            // Tangani error umum
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data user',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Invalidate the JWT token to log the user out.
     */
    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());

        return response()->json([
            'success' => true,
        ], 200);
    }
}