<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function userDashboard(){
        return view('users.dashboard');
    }
    public function adminDashboard(){
        return view('admin.dashboard.index');
    }
}
