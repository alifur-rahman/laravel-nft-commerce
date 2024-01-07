<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\AssetView;
use App\Models\Bid;
use App\Models\NftAsset;
use App\Models\NftAssetCategory;
use App\Models\NftCollection;
use App\Models\NftSale;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index()
    {
        $topsellers = User::latest()->limit(10)->get(); 
 
        $live_bids = NftAsset::where('bit_time', '>', Carbon::now())->inRandomOrder()->get();
        $new_items = NftAsset::limit('5')->get();
        $categorys = NftAssetCategory::all();
        $collections = NftCollection::whereNotNull('item')->limit('4')->get();

        if (Auth::check()) {
            $mycollections = NftCollection::where('user_id', Auth::user()->id)->get(['name', 'id']);
        } else {
            $mycollections = [];
        }
        return view('users/index', compact('live_bids', 'new_items', 'categorys', 'collections', 'mycollections','topsellers'));
    }

    public function explorProduct(Request $request)
    {
        $datas = new NftAsset;
        // if ($request->like != '') {
        //     $datas = $datas->where('txnid', $request->tnx_ID);
        // }
        if ($request->category != '') {
            $datas = $datas->where('category_id', $request->category);
        }
        // if ($request->collection) {
        //     $datas = $datas->where('status', $request->status);
        // }
        if ($request->sale_type != '') {
            $datas = $datas->where('sale_type',  $request->sale_type);
        }

        $amount = explode("-", $request->price);
        if ($amount) {
            $datas = $datas->whereBetween('base_price', [$amount[0], $amount[1]]);
        }


        $datas = $datas->get();

        $viewRender = view('users/random_explor', compact('datas'))->render();
        return response(['success' => true, 'html' => $viewRender]);
    }

    public function assetDetails($id)
    {
        $thisCollection = NftCollection::whereJsonContains('item',(int)$id)->first();
        
        $data = NftAsset::find($id);
        $last_views = AssetView::limit(5)->get();
        $related_views = NftAsset::limit(5)->where('category_id', $data->category_id)->get();
        $total_bid_ammount = Bid::max('offer_price');
        if(Auth::check()){
            $mycollections = NftCollection::where('user_id', Auth::user()->id)->get(['name', 'id']);
            $views = AssetView::where('viewed_by','<>',Auth::user()->id)->where('asset_id', $id)->limit('5')->get();
        }else{
            $mycollections = [];
            $views = AssetView::where('asset_id', $id)->limit(5)->get();
        }
        $bids = Bid::where('asset_id',$id)->orderBy('offer_price','DESC')->limit(5)->get();
        $categorys = NftAssetCategory::all(); 
        return view('users.asset-details', compact('data', 'last_views', 'related_views', 'total_bid_ammount','mycollections','bids','categorys','views','thisCollection'));
    }
}
