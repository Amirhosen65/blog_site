<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class SocialiteController extends Controller
{
    public function redirect($provider){
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider){
        $user = Socialite::driver($provider)->user();

        $password = encrypt($user->password);
        $old_user = User::where("email", $user->email)->orWhere("password", $password)->first();
        if($old_user){
            if($old_user->approve_status == 1){
                Auth::login($old_user);
                return redirect()->route('home');
            }else{
                return redirect()->route('author.login.view')->with('error','Your request is pending approval from the administrator.');
            }
        }else{

            $getUser = User::create([
                'email'=> $user->email,
                'name'=> $user->name,
                'image'=> $user->avatar,
                'role'=> 'user',
                'attempt'=> 'social',
                'password'=> encrypt('123456'),


            ]);
            Auth::login($getUser);
            return redirect()->route('home');
        }
    }
}
