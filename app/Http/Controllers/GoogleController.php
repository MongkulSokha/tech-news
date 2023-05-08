<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Auth;

class GoogleController extends Controller
{
    public function googlepage(){
        return Socialite::driver('google')->redirect();
    }

    public function googlecallback(){
        try {
            $user = Socialite::driver('google')->user();
            $finduser = User::where('google_id', $user->id)->first();
            if($finduser){
                Auth::login($finduser);
                return redirect()->intended('/');
            }
            else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'type' => $user->type = 2,
                    'password' => encrypt('123456789')
                ]);
                Auth::login($newUser);
                return redirect()->intended('/');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }

    }
}