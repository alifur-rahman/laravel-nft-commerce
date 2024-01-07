<?php

// namespace App\Http\Controllers\User\Auth;

namespace App\Http\Controllers\User\Auth;
 
// use App\Http\Controllers\Controller;
// use Socialite; 
// use Exception;
// use Illuminate\Support\Facades\Auth;
// use App\Models\User;
// use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use App\Models\UserDescription;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class FaceBookController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToFB()
    {
        return Socialite::driver('facebook')->redirect();
    }
       
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleCallback()
    {
        try {
            $user = Socialite::driver('facebook')->user();  
            $finduser = User::where('facebook_id', $user->id)->first();  

            if($finduser){
                Auth::login($finduser);
                return redirect('/user/dashboard');
            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'facebook_id'=> $user->id, 
                    'type'  => 0,
                    'password' => Hash::make('A12345'), 
                    'transaction_password' => Hash::make('A12345') 
                ]);
                $UserDescription = UserDescription::create([
                    'user_id' => $newUser->id,
                ]);
                if($newUser AND $UserDescription){
                    Auth::login($newUser);
                    return redirect('/user/dashboard');
                }
                
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}