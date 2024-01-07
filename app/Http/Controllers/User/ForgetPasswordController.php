<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ForgetPasswordController extends Controller
{
    public function forget_password(Request $request)
    {
        return view('users.auth.forget-password');
    }
    // find existing email 
    public function findEmail(Request $request)
    {
        echo "sdfsd";
    }
}
