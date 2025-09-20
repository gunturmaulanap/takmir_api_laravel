<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Jamaah;
use App\Http\Resources\JamaahResource;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Str;
use App\Http\Requests\StoreJamaahRequest;
use App\Http\Requests\UpdateJamaahRequest;

class JamaahController extends Controller implements HasMiddleware
{
    // HAPUS CONSTRUCTOR DAN PROPERTI $user & $masjidProfile

    public static function middleware(): array
    {
        return [
            new Middleware(['permission:jamaahs.index'], only: ['index']),
            new Middleware(['permission:jamaahs.create'], only: ['store']),
            new Middleware(['permission:jamaahs.edit'], only: ['update']),
            new Middleware(['permission:jamaahs.delete'], only: ['destroy']),
        ];
    }

    /**
     * Menampilkan daftar jamaah (otomatis terfilter oleh Global Scope).
     */
    public function index()
    {
        $jamaahs = Jamaah::with(['aktivitasJamaah', 'category'])->latest()->paginate(10);
        return new JamaahResource(true, 'Daftar Data Jamaah', $jamaahs);
    }

    /**
     * Menyimpan data jamaah baru.
     */
    public function store(StoreJamaahRequest $request)
    {
        $validated = $request->validated();

        // Ambil user dan profil masjid langsung dari request, bukan dari properti controller
        $user = $request->user();
        $masjidProfile = $user->getMasjidProfile();

        $jamaah = Jamaah::create(array_merge($validated, [
            'user_id'           => $user->id,
            'profile_masjid_id' => $masjidProfile->id,
            'slug'              => Str::slug($validated['nama']),
        ]));

        return new JamaahResource(true, 'Data jamaah berhasil disimpan.', $jamaah);
    }

    /**
     * Menampilkan detail satu jamaah (otomatis aman).
     */
    public function show(Jamaah $jamaah)
    {
        return new JamaahResource(true, 'Detail Data Jamaah', $jamaah->load(['aktivitasJamaah', 'category']));
    }

    /**
     * Memperbarui data jamaah.
     */
    public function update(UpdateJamaahRequest $request, Jamaah $jamaah)
    {
        $validated = $request->validated();

        $jamaah->update(array_merge($validated, [
            'slug' => Str::slug($validated['nama']),
        ]));

        return new JamaahResource(true, 'Jamaah berhasil diperbarui.', $jamaah);
    }

    /**
     * Menghapus data jamaah.
     */
    public function destroy(Jamaah $jamaah)
    {
        $jamaah->delete();
        return new JamaahResource(true, 'Jamaah berhasil dihapus.', null);
    }
}
