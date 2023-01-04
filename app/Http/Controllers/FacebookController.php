<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;

use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class FacebookController extends Controller
{
    public function facebookRedirect()
    {
        if (Auth::check()) {
            return redirect()->route('home.index');
        }
        return Socialite::driver('facebook')->redirect();
    }
    public function loginWithFacebook()
    {
        if (Auth::check()) {
            return redirect()->route('home.index');
        }
        $facebook = Socialite::driver('facebook')->user();

        if(!$facebook->email){
            return Socialite::driver('facebook')->reRequest()->redirect();
        }

        $user = User::firstOrCreate(
            ['email' => $facebook->email],
            [
                'name' =>  $facebook->name,
                'password' => Hash::make($facebook->name . '@' . $facebook->id)
            ]
        );
        Auth::login($user);
        return redirect()->route('home.index');
    }
}
