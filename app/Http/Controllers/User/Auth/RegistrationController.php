<?php

namespace App\Http\Controllers\User\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Mail\TraderRegistrationMail;
use App\Models\SystemConfig;
use App\Models\Country;
use App\Models\Log;
use App\Models\Traders\SocialLink;
use App\Models\TradingAccount; 
use App\Models\UserDescription;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Providers\RouteServiceProvider;
use App\Services\Mt5WebApi;
use App\Services\OpenAccountService;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class RegistrationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    // use RegistrationsUsers;
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('guest:admin');
        $this->middleware('guest:manager');
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
 
    public function UserRegistrationForm(Request $request)
    {
        if ($request->ajax()){
            // return $request->transaction_password; 
                $validation_rules = [  
                    'full_name' => 'required|max:100',
                    'email' => 'required|unique:users|email',
                    'confirm_email' => 'required|email|same:email',
                    'phone' => 'required|max:20',
                    'password' => 'required', 
                    'confirm_password' => 'required', 
                    'transaction_password' => 'required', 
                    'confirm_transaction_password' => 'required', 
                ]; 
                $validator = Validator::make($request->all(), $validation_rules);
                if ($validator->fails()) {
                    return Response::json([
                        'status' => false,
                        'errors' => $validator->errors(),
                        'message' => 'Please fix the following errors!'
                    ]);
                }else{ 
                    if($request->email == $request->confirm_email){
                        if($request->confirm_password == $request->password){
                            if($request->confirm_transaction_password == $request->transaction_password){
                                $user_data = [
                                    'name' => $request->full_name,
                                    'email' => $request->email,
                                    'phone' => $request->phone,
                                    'password' => Hash::make($request->password),
                                    'transaction_password' => Hash::make($request->transaction_password),
                                    'active_status' =>  1, 
                                    'type' => 0, 
                                ]; 
                                $user = User::create($user_data);
                                $UserDescription = UserDescription::create([
                                    'user_id' => $user->id,
                                ]);
                                if ($user AND $UserDescription){
                                    return Response::json([
                                        'status' => true,
                                        'message' => 'You successfully created your profile',
                                        'user_id' => $user->id,
                                    ]);
                                }else{
                                    return Response::json([
                                        'status' => false,
                                        'message' => 'Registration Falied!'
                                    ]); 
                                }
                            }else{
                                return Response::json([
                                    'status' => false,
                                    'message' => 'Trasaction Password & confirm trasaction password not Match!'
                                ]); 
                            } 
                        }else{
                            return Response::json([
                                'status' => false,
                                'message' => 'Password & confirm password not Match!'
                            ]); 
                        }
                    }else{
                        return Response::json([
                            'status' => false,
                            'message' => 'Email & Confirm Email not Match!'
                        ]); 
                    } 
                    
                }    
            }  

        return view('users.auth.registration');
    }
 
}
