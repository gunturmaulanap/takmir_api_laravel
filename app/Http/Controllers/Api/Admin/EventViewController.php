<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventViewResource;
use App\Models\Event; // <-- DIUBAH dari EventView ke Event
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Carbon\Carbon;

class EventViewController extends Controller implements HasMiddleware
{
    /**
     * Hanya user dengan izin 'events.index' yang bisa melihat kalender ini.
     */
    public static function middleware(): array
    {
        return [
            new Middleware(['permission:events.index'], only: ['index']),
        ];
    }

    /**
     * Menampilkan daftar event views sebagai kalender.
     * Menerima filter ?month=9&year=2025
     */
    public function index(Request $request)
    {
        // Validasi input filter bulan dan tahun
        $request->validate([
            'month' => 'nullable|integer|between:1,12',
            'year' => 'nullable|integer|min:2000',
        ]);

        // Tentukan bulan dan tahun, jika tidak ada, gunakan bulan dan tahun saat ini
        $month = $request->input('month', Carbon::now()->month);
        $year = $request->input('year', Carbon::now()->year);

        // Ambil data dari model Event, bukan EventView.
        // Trait HasMasjid pada model Event akan otomatis memfilter
        // data berdasarkan masjid user yang sedang login.
        $events = Event::with(['category', 'user', 'profileMasjid']) // <-- DIUBAH: Relasi 'event' dihapus karena tidak relevan
            ->whereYear('tanggal_event', $year)
            ->whereMonth('tanggal_event', $month)
            ->get();

        return new EventViewResource(true, 'Data Kalender Event', $events);
    }
}
