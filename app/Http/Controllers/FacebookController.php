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

        $user = User::firstOrCreate(
            ['email' => $facebook->getEmail()],
            [
                'name' =>  $facebook->getName(),
                'password' => Hash::make($facebook->getName() . '@' . $facebook->getId())
            ]
        );
        Auth::login($user);
        return redirect()->route('home.index');
    }
}