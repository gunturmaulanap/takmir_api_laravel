<?php

namespace App\Http\Controllers\Api;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\Resources\EventResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller implements HasMiddleware
{
    /**
     * middleware
     *
     * @return array
     */
    public static function middleware(): array
    {
        return [
            new Middleware(['permission:events.index'], only: ['index']),
            new Middleware(['permission:events.create'], only: ['store']),
            new Middleware(['permission:events.edit'], only: ['update']),
            new Middleware(['permission:events.delete'], only: ['destroy']),
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Kueri ini akan secara otomatis difilter oleh HasMasjid trait
        $events = Event::with('category')->latest()->paginate(5);

        $events->appends(['search' => request()->search]);

        return new EventResource(true, 'List Data Events', $events);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama'            => 'required|string|max:255',
            'slug'            => 'required|string|unique:events,slug',
            'category_id'     => 'required|exists:categories,id',
            'tanggal_event'   => 'required|date',
            'waktu_event'     => 'required',
            'deskripsi'       => 'required',
            'image'           => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi Gagal!',
                'errors'  => $validator->errors()
            ], 422);
        }

        // Gunakan guard 'api' secara eksplisit
        $user = auth()->guard('api')->user();

        if (!$user || !$user->profileMasjid) {
            return response()->json([
                'success' => false,
                'message' => 'User tidak terautentikasi atau tidak memiliki profil masjid.'
            ], 403);
        }

        $profileMasjidId = $user->profileMasjid->id;

        $imageName = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/photos', $imageName);
        }

        $event = Event::create([
            'user_id'           => $user->id,
            'profile_masjid_id' => $profileMasjidId,
            'category_id'       => $request->category_id,
            'nama'              => $request->nama,
            'slug'              => $request->slug,
            'tanggal_event'     => $request->tanggal_event,
            'waktu_event'       => $request->waktu_event,
            'deskripsi'         => $request->deskripsi,
            'image'             => $imageName,
        ]);

        if ($event) {
            return new EventResource(true, 'Data Event Berhasil Disimpan!', $event);
        }

        return new EventResource(false, 'Data Event Gagal Disimpan!', null);
    }

    /**
     * Display the specified resource.
     *
     * @param  Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return new EventResource(true, 'Detail Data Event!', $event);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $validator = Validator::make($request->all(), [
            'nama'            => 'required|string|max:255',
            'slug'            => 'required|string|unique:events,slug,' . $event->id,
            'category_id'     => 'required|exists:categories,id',
            'tanggal_event'   => 'required|date',
            'waktu_event'     => 'required',
            'deskripsi'       => 'required',
            'image'           => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi Gagal!',
                'errors'  => $validator->errors()
            ], 422);
        }

        $imageName = basename($event->image);
        if ($request->hasFile('image')) {
            if ($event->image) {
                Storage::delete('public/photos/' . $imageName);
            }
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/photos', $imageName);
        }

        $event->update([
            'category_id'       => $request->category_id,
            'nama'              => $request->nama,
            'slug'              => $request->slug,
            'tanggal_event'     => $request->tanggal_event,
            'waktu_event'       => $request->waktu_event,
            'deskripsi'         => $request->deskripsi,
            'image'             => $imageName,
        ]);

        if ($event) {
            return new EventResource(true, 'Data Event Berhasil Diupdate!', $event);
        }

        return new EventResource(false, 'Data Event Gagal Diupdate!', null);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        if ($event->delete()) {
            if ($event->image) {
                Storage::delete('public/photos/' . basename($event->image));
            }
            return new EventResource(true, 'Data Event Berhasil Dihapus!', null);
        }

        return new EventResource(false, 'Data Event Gagal Dihapus!', null);
    }
}
