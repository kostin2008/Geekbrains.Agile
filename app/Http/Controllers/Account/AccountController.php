<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use App\Models\User;

class AccountController extends Controller
{
    public function __invoke()
    {
//        $name = Auth::check() ? Auth::user()->name : "guest";
//        return "Hi, " . $name . "<br><a href=' ".route('catalog')."'>Go to catalog</a>";
//        return view('plants.lk');
        return view('plants.lk', ['user' => User::findOrFail(Auth::user()->id)]);
    }

    public function update(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $user->avatar = $request['avatar'];
        if ($request->hasFile('photo')) {
            $user->avatar = $this->store($request->file('photo'), $user->avatar);
        }
        $user->update($request->all());

        return redirect('/catalog');
    }
}