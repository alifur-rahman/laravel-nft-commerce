<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Models\CompanyInfo;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use App\Models\UserDescription;
use App\Services\MailService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class GoogleController extends Controller
{
    /** 
     * Create a new controller instance. 
     *   
     * @return void 
     */ 
    public function redirectToGoogle() 
    { 
        return Socialite::driver('google')->redirect();
    } 
    /** 
     * Create a new controller instance. 
     * 
     * @return void 
     */ 
    public function handleGoogleCallback() 
    { 
        try { 
            $user = Socialite::driver('google')->stateless()->user(); 
            $finduser = User::where('google_id', $user->id)->first(); 
            if ($finduser) { 
                Auth::login($finduser); 
                return redirect()->intended('/user/dashboard');
            } else { 
                $newUser = User::create([ 
                    'name' => $user->name, 
                    'email' => $user->email, 
                    'google_id' => $user->id, 
                    'type'  => 0,
                    'password' => Hash::make('A12345'), 
                    'transaction_password' => Hash::make('A12345') 
                ]); 
                $UserDescription = UserDescription::create([
                    'user_id' => $newUser->id,
                ]);
                if($newUser AND $UserDescription){

                    $company_info = CompanyInfo::select()->first();  

                    $data = [
                        'client_name'               => $user->name,
                        'company_name'              => $company_info->com_name,  
                        'phone'                     => $user->phone,
                        'support_email'             => $company_info->support_email, 
                        'user_email'                => $user->email,   
                        'password'                  => $newUser->password
                    ];

                    MailService::mail($user->email, $data, 'Google Authencticate Login', 'google-login-email');

                    Auth::login($newUser); 
                    return redirect()->intended('/user/dashboard');
                } 
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
