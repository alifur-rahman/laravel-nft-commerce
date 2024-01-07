<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Mail\OTPverificationMail;
use App\Models\admin\SystemConfig;
use App\Models\LoginAttempt;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Services\GoogleAuthenticator;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator; 

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    // use AuthenticatesUsers;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    } 
    public function showAdminLogin()
    {
        return view('admin.auth.login');
    }  
  
    // login form for trader
    public function adminLogin(Request $request)
    { 
        $input = $request->all();
        $validation_rules = [
            'email' => 'required|email',
            'password' => 'required|max:32',
        ];
        $validator = Validator::make($request->all(), $validation_rules);
        if ($validator->fails()) {
            if ($request->ajax()) {
                return Response::json(['status' => false, 'errors' => $validator->errors(),'message' => 'Please fix the following errors!']);
            } else {
                return Redirect()->back()->with(['status' => false, 'errors' => $validator->errors()]);
            }
        }
        $email = $request->email;
        $user = User::where('email', $email)->first();

            if (auth()->attempt(array('email' => $input['email'], 'password' => $input['password']))){
                return Response::json([
                    'status' => true,
                    'message' => 'You are successfully logged in.'
                ]);
            } else {
                return Response::json([
                    'status' => false,
                    'message' => 'User name or password error!'
                ]);
            }  
    } 
}
