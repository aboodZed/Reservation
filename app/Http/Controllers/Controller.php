<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    public function welcome()
    {
        $users = User::paginate(20);
        return view('welcome', compact('users'));
    }

    public function search(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'search' => 'required|string|max:255',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $users = User::where('name', 'like', '%' . $request->search . '%')
        ->orWhere('address', 'like', '%' . $request->search . '%')->paginate(20);

        return view('welcome', compact('users'));
    }
}
