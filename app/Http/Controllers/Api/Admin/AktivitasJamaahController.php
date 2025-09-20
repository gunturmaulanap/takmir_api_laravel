<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;
use App\Http\Resources\AktivitasJamaahResource;
use App\Models\AktivitasJamaah;
use App\Http\Requests\StoreAktivitasJamaahRequest;
use App\Http\Requests\UpdateAktivitasJamaahRequest;

class AktivitasJamaahController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware(['permission:aktivitas_jamaahs.index'], only: ['index']),
            new Middleware(['permission:aktivitas_jamaahs.create'], only: ['store']),
            new Middleware(['permission:aktivitas_jamaahs.edit'], only: ['update']),
            new Middleware(['permission:aktivitas_jamaahs.delete'], only: ['destroy']),
        ];
    }

    public function index()
    {
        // Global scope pada model akan otomatis memfilter berdasarkan masjid
        $data = AktivitasJamaah::with(['user', 'profileMasjid'])->latest()->get();
        return new AktivitasJamaahResource(true, 'List aktivitas jamaah', $data);
    }

    public function store(StoreAktivitasJamaahRequest $request)
    {
        $user = $request->user();
        $masjidProfile = $user->getMasjidProfile();

        $aktivitasJamaah = AktivitasJamaah::create([
            'user_id'           => $user->id,
            'profile_masjid_id' => $masjidProfile->id,
            'nama'              => $request->validated('nama'),
        ]);

        return new AktivitasJamaahResource(true, 'Data aktivitas jamaah berhasil disimpan.', $aktivitasJamaah);
    }

    public function show(AktivitasJamaah $aktivitasJamaah)
    {
        // Keamanan otomatis ditangani oleh Route-Model Binding + Global Scope
        return new AktivitasJamaahResource(true, 'Detail aktivitas jamaah berhasil dimuat.', $aktivitasJamaah->load(['user', 'profileMasjid']));
    }

    public function update(UpdateAktivitasJamaahRequest $request, AktivitasJamaah $aktivitasJamaah)
    {
        $aktivitasJamaah->update($request->validated());
        return new AktivitasJamaahResource(true, 'Data aktivitas jamaah berhasil diperbarui.', $aktivitasJamaah);
    }

    public function destroy(AktivitasJamaah $aktivitasJamaah)
    {
        $aktivitasJamaah->delete();
        return new AktivitasJamaahResource(true, 'Data aktivitas jamaah berhasil dihapus.', null);
    }
}
