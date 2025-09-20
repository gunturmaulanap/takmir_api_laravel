<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Takmir;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Resources\TakmirResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use App\Http\Requests\StoreTakmirRequest;
use App\Http\Requests\UpdateTakmirRequest;

class TakmirController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware(['permission:takmirs.index'], only: ['index']),
            new Middleware(['permission:takmirs.create'], only: ['store']),
            new Middleware(['permission:takmirs.edit'], only: ['update']),
            new Middleware(['permission:takmirs.delete'], only: ['destroy']),
        ];
    }

    public function index()
    {
        $takmirs = Takmir::with(['user', 'profileMasjid', 'category'])->latest()->paginate(10);
        return new TakmirResource(true, 'List Data Takmirs', $takmirs);
    }

    public function store(StoreTakmirRequest $request)
    {
        $validated = $request->validated();
        $adminUser = $request->user();
        $masjidProfile = $adminUser->getMasjidProfile();

        $takmir = DB::transaction(function () use ($request, $validated, $masjidProfile) {
            // 1. Buat User baru untuk takmir
            $newUser = User::create([
                'name' => $validated['nama'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            // 2. Berikan role 'takmir'
            $newUser->assignRole('takmir');

            // 3. Upload gambar
            $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->storeAs('public/photos', $imageName);

            // 4. Buat data Takmir
            return Takmir::create([
                'user_id' => $newUser->id,
                'profile_masjid_id' => $masjidProfile->id,
                'image' => $imageName,
                ...$validated // Gunakan sisa data yang sudah divalidasi
            ]);
        });

        return new TakmirResource(true, 'Data takmir berhasil disimpan.', $takmir->load(['user', 'profileMasjid', 'category']));
    }

    public function show(Takmir $takmir)
    {
        return new TakmirResource(true, 'Detail data takmir berhasil dimuat.', $takmir->load(['user', 'profileMasjid', 'category']));
    }

    public function update(UpdateTakmirRequest $request, Takmir $takmir)
    {
        $validated = $request->validated();
        $imageName = $takmir->image;

        if ($request->hasFile('image')) {
            if ($takmir->image) Storage::delete('public/photos/' . $takmir->image);

            $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->storeAs('public/photos', $imageName);
        }

        DB::transaction(function () use ($takmir, $validated, $imageName) {
            // Update data takmir
            $takmir->update(array_merge($validated, ['image' => $imageName]));

            // Sinkronkan nama di tabel user jika berubah
            if ($takmir->user && $takmir->user->name !== $validated['nama']) {
                $takmir->user->update(['name' => $validated['nama']]);
            }
        });

        return new TakmirResource(true, 'Data takmir berhasil diperbarui!', $takmir->load(['user', 'profileMasjid']));
    }

    public function destroy(Takmir $takmir)
    {
        DB::transaction(function () use ($takmir) {
            if ($takmir->image) {
                Storage::delete('public/photos/' . $takmir->image);
            }

            // Hapus user terkait terlebih dahulu
            if ($takmir->user) {
                $takmir->user->delete();
            }

            // Hapus data takmir
            $takmir->delete();
        });

        return new TakmirResource(true, 'Data takmir berhasil dihapus.', null);
    }
}
