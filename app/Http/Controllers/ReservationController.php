<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReservationController extends Controller
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
     * Display a listing of the resource.
     */
    public function index()
    {
        $res = Reservation::paginate(30);
        return view('reservation.index', compact('res'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect()->route('home');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'from' => 'required|date_format:Y-m-d\TH:i',
            'to' => 'required|date_format:Y-m-d\TH:i',
            'name' => 'required|string|max:255',
            'id' => 'required|integer',
            'phone' => 'required|integer',
            'cost' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $f = Customer::where('name', $request->name)
            ->orWhere('id_number', $request->id)
            ->orWhere('phone', $request->phone)->first();

        if ($f == null) {
            $f = Customer::create([
                'name' => $request->name,
                'id_number' => $request->id,
                'phone' => $request->phone,
            ]);
        }

        Reservation::create([
            'customer_id' => $f->id,
            'user_id' => Auth::id(),
            'from' => $request->from,
            'to' => $request->to,
            'cost' => $request->cost
        ]);

        return redirect()->back()->with('success', 'process complete successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        return view('reservation.show', compact('reservation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        //
    }

    public function filter(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'from' => 'required|date',
            'to' => 'required|date',

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $res = Reservation::whereBetween('from', [$request->from, $request->to]);


        if ($request->has('end')) {
            $res->orWhereBetween('to', [$request->from, $request->to]);
        }

        $res = $res->paginate(20);

        return view('reservation.index', compact('res'));
    }
}
