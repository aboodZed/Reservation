<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class UserController extends ImageController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::find(Crypt::decryptString($id));
        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $user = User::find(Auth::id());
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string',
            'address' => 'required|string|max:255',
            'link' => 'required|string|max:255',
            'defult_reservation_hours' => 'required|integer|max:750',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'pic1' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'pic2' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'pic3' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'pic4' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        // return $request;

        $user = User::find(Auth::id());
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->link = $request->link;
        $user->defult_reservation_hours = $request->defult_reservation_hours;
        $user->save();

        $profile = $user->profile;

        if ($request->has('avatar')) {
            $profile->avatar = $this->uploadImage($request->avatar, 'user');
        }

        if ($request->has('pic1')) {
            $profile->pic1 = $this->uploadImage($request->pic1, 'user');
        }

        if ($request->has('pic2')) {
            $profile->pic2 = $this->uploadImage($request->pic2, 'user');
        }

        if ($request->has('pic3')) {
            $profile->pic3 = $this->uploadImage($request->pic3, 'user');
        }

        if ($request->has('pic4')) {
            $profile->pic4 = $this->uploadImage($request->pic4, 'user');
        }
        $profile->save();

        return redirect()->back()->with('success', 'process complete successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $id)
    {
        //
    }

    public function filter(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'from' => 'required|date_format:Y-m-d\TH:i',
            'to' => 'required|date_format:Y-m-d\TH:i',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $users = User::whereDoesntHave('reservations', function ($query) use ($request) {
            $query->where(function ($query) use ($request) {
                $query->whereBetween('from', [$request->from, $request->to])
                    ->orWhereBetween('to', [$request->from, $request->to]);
            })->orWhere(function ($query) use ($request) {
                $query->where('from', '<', $request->from)
                    ->where('to', '>', $request->to);
            });
        })->paginate(30);

        return view('welcome', compact('users'));
    }
}
