<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\NftAsset;
use App\Models\NftAssetCategory;
use App\Models\NftCollection;
use App\Models\User;
use App\Models\UserDescription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function user_dashboard(Request $request)
    {
        $banner = User::where('id', auth()->user()->id)->first();
        $user_description = UserDescription::where('user_id', auth()->user()->id)->first();
        $live_bids = NftAsset::where('bit_time', '>', Carbon::now())->where('owner_id', Auth::user()->id)->inRandomOrder()->limit(4)->get();
        // $topsellers = User::latest()->limit(10)->get();
        $new_items = NftAsset::limit('5')->get();
        $categorys = NftAssetCategory::all();
        $collections = NftCollection::where('user_id', Auth::user()->id)->limit('4')->get();

        if (Auth::check()) {
            $mycollections = NftCollection::where('user_id', Auth::user()->id)->get(['name', 'id']);
        } else {
            $mycollections = [];
        }
        return view('users.dashboard', compact('live_bids', 'new_items', 'categorys', 'collections', 'mycollections', 'banner', 'user_description'));
    } 
    
    public function alllivebid(){
        if (Auth::check()) {
            $mycollections = NftCollection::where('user_id', Auth::user()->id)->get(['name', 'id']);
        } else {
            $mycollections = [];
        }
        $live_bids = NftAsset::where('bit_time', '>', Carbon::now())->where('owner_id', Auth::user()->id)->inRandomOrder()->get();
        return view('users.livebid',compact('mycollections','live_bids'));
    }

    public function allcollection(){
        if (Auth::check()) {
            $mycollections = NftCollection::where('user_id', Auth::user()->id)->get(['name', 'id']);
        } else {
            $mycollections = [];
        }
        $collections = NftCollection::where('user_id', Auth::user()->id)->get();
        return view('users.my_all_collection',compact('mycollections','collections'));
    }

   
}


