<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Service\SocialiteService;
use Auth;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function init()
    {
        return Socialite::driver('vkontakte')->redirect();
    }

    public function callback(SocialiteService $service)
    {
        $socialiteUser = Socialite::driver('vkontakte')->user();
        $user = $service->findOrCreateUser($socialiteUser);
        if($user) {
            Auth::login($user);
        return redirect()->route('catalog');
        }
        return back(400);

    }
    public function initFb()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callbackFb(SocialiteService $service)
    {
        $socialiteUser = Socialite::driver('facebook')->user();
        $user = $service->findOrCreateUser($socialiteUser);
        if($user) {
            Auth::login($user);
            return redirect()->route('catalog');
        }
        return back(400);


    }
}

