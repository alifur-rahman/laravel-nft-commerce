<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Mail\OTPverificationMail;
use App\Models\admin\SystemConfig;
use App\Models\CompanyInfo;
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
    // view trader login form
    public function UserLoginForm(Request $request)
    {
        if($request->ajax()){
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
 
            if(!empty($user->email)){
                if ($user->active_status === 1) {
                    if (auth()->attempt(array('email' => $input['email'], 'password' => $input['password']), isset($request->remember_me)) && auth()->user()->type == 0){
                        $request->session()->regenerate();
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
                }else {
                    return Response::json([
                        'status' => false,
                        'message' => 'The User Is Temporarily Blocked!',
                    ]);
                }
            }else {
                return Response::json([
                    'status' => false,
                    'message' => 'Access Denied! Invalid Email.'
                ]);
            } 
        }
        $company_info = CompanyInfo::select()->first();
        return view(
            'users.auth.login',
            [
                'company_infos'            => $company_info

            ]
        );

    }
    public function showAdminLogin(Request $request)
    {
        if($request->ajax()){
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

            if (auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])) && $user->type == 2){
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
        return view('admin.auth.login');
    }
    
    public function logout(){
        if(auth()->user()->type == 0){
            Auth::logout();
            return redirect('/login');
        } elseif(auth()->user()->type == 2){
            Auth::logout();
            return redirect('/admin');
        }
    }
}
