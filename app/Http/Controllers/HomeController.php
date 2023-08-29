<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

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
        $day = $request->day ?  $request->day : now()->format('Y-m-d');
        $res = Reservation::whereDate('from', $day)->orWhereDate('to', $day)->get();
        return view('home', compact(['day', 'res']));
    }
}
