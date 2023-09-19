<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        Cookie::make('lang', 'ar', 60); // Cookie will expire in 60 minutes
        $day = $request->day ?  $request->day : now()->format('Y-m-d');

        $res = Reservation::where('user_id', Auth::id())
            ->where(function ($query) use ($day) {
                $query->whereDate('from', $day)
                    ->orWhereDate('to', $day);
            })->get();

        return view('home', compact(['day', 'res']));
    }
}
