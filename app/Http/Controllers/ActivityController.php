<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\NftAsset;
use App\Models\NftSale;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function activity(Request $request)
    {
        // purchage activity
        $purchases = NftSale::where('to_account', auth()->user()->id)
            ->orWhere('winner_account', auth()->user()->id)->select('asset_id')->get();
        // sales activity
        $sales = NftSale::where('seller_account', auth()->user()->id)
            ->select('asset_id')->get();
        // like activity
        $likes = Favorite::where('favorite_by', auth()->user()->id)->select('asset_id')->get();
        $assets = NftAsset::whereIn('nft_assets.id', $purchases)
        ->orWhereIn('nft_assets.id', $likes)
        ->orWhereIn('nft_assets.id', $sales)
        ->get();
        return view('users.activity', ['assets' => $assets]);
    }
}
