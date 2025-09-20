<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Khatib;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreKhatibRequest;
use App\Http\Requests\UpdateKhatibRequest;
use App\Http\Resources\KhatibResource;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Str;

class KhatibController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware(['permission:khatibs.index'], only: ['index']),
            new Middleware(['permission:khatibs.create'], only: ['store']),
            new Middleware(['permission:khatibs.edit'], only: ['update']),
            new Middleware(['permission:khatibs.delete'], only: ['destroy']),
        ];
    }

    /**
     * Menampilkan daftar khatib (otomatis terfilter oleh Global Scope).
     */
    public function index()
    {
        $khatibs = Khatib::latest()->paginate(10);
        return new KhatibResource(true, 'Daftar Data Khatib', $khatibs);
    }

    /**
     * Menyimpan data khatib baru.
     */
    public function store(StoreKhatibRequest $request)
    {
        $validated = $request->validated();
        $user = $request->user();
        $masjidProfile = $user->getMasjidProfile();

        $khatib = Khatib::create(array_merge($validated, [
            'user_id'           => $user->id,
            'profile_masjid_id' => $masjidProfile->id,
            'slug' => Str::slug($validated['nama'] . '-' . $validated['tanggal_khutbah']),
        ]));

        return new KhatibResource(true, 'Data khatib berhasil disimpan.', $khatib);
    }

    /**
     * Menampilkan detail satu khatib (otomatis aman).
     */
    public function show(Khatib $khatib)
    {
        return new KhatibResource(true, 'Detail Data Khatib', $khatib);
    }

    /**
     * Memperbarui data khatib.
     */
    public function update(UpdateKhatibRequest $request, Khatib $khatib)
    {
        $validated = $request->validated();

        $updateData = $validated;
        // Buat slug baru jika nama diubah
        if (isset($validated['nama'])) {
            $updateData['slug'] = Str::slug($validated['nama'] . '-' . $validated['tanggal_khutbah']);
        }

        $khatib->update($updateData);

        return new KhatibResource(true, 'Khatib berhasil diperbarui.', $khatib);
    }

    /**
     * Menghapus data khatib.
     */
    public function destroy(Khatib $khatib)
    {
        $khatib->delete();
        return new KhatibResource(true, 'Khatib berhasil dihapus.', null);
    }
}
