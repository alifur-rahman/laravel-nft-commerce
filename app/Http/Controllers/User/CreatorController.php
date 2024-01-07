<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CreatorController extends Controller
{
    public function creator(Request $request)
    {
        $creator = User::select()->get();
        return view('users.creator',['creator'=>$creator]);
    }
}
