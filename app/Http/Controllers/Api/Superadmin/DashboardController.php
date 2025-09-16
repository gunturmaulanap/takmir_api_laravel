<?php

namespace App\Http\Controllers\Api\Superadmin;


use App\Models\Aparatur;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Takmir;
use App\Models\Jamaah;
use App\Models\Imam;
use App\Models\Muadzin;
use App\Models\Khatib;
use App\Models\Asatidz;
use App\Models\Modul;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        //count categories
        $categories = Category::count();
        $takmirs = Takmir::count();
        $events = Event::count();
        $aparaturs = Aparatur::count();
        $jamaahs = Jamaah::count();
        $imams = Imam::count();
        $muadzins = Muadzin::count();
        $khatibs = Khatib::count();
        $asatidzs = Asatidz::count();
        $moduls = Modul::count();
        $users = User::count();

        //return response json
        return response()->json([
            'success'   => true,
            'message'   => 'List Data on Dashboard',
            'data'      => [
                'categories' => $categories,
                'takmirs'    => $takmirs,
                'events'     => $events,
                'aparaturs'  => $aparaturs,
                'jamaahs'    => $jamaahs,
                'imams'      => $imams,
                'muadzins'   => $muadzins,
                'khatibs'    => $khatibs,
                'asatidzs'   => $asatidzs,
                'moduls'     => $moduls,
                'users'      => $users,
            ]
        ]);
    }
}
