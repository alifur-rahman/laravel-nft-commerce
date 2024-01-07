<?php

namespace App\Http\Controllers\User\Explore;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NftAsset;
use App\Models\NftAssetCategory;
use App\Models\NftAssetImage;
use App\Models\AssetRating;
use App\Models\NftCollection;
use App\Services\AllfunctionService;
use App\Services\likeOperactionService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class ExploreController extends Controller
{
    public function exploreView(Request $request)
    {

        if (Auth::check()) {
            $mycollections = NftCollection::where('user_id', Auth::user()->id)->get(['name', 'id']);
        } else {
            $mycollections = [];
        }

        $NftAsset = NftAsset::paginate(9);
        if ($request->ajax()) {
            $NftAsset = NftAsset::select('nft_assets.id as id', 'nft_assets.name', 'nft_assets.base_price');

            // Price Filter  

            if ($request->free_paid == 'on') {
                $NftAsset = $NftAsset->where('nft_assets.base_price', 0);
            }
            if ($request->all_price == 'on') {
                $NftAsset = $NftAsset->orderBy('nft_assets.base_price', 'asc');
            }
            if ($request->high_to_low == 'on') {
                $NftAsset = $NftAsset->orderBy('nft_assets.base_price', 'desc');
            }
            if ($request->low_to_high == 'on') {
                $NftAsset = $NftAsset->orderBy('nft_assets.base_price', 'asc');
            }

            // sort by filter   
            if ($request->newest == 'on') {
                $NftAsset = $NftAsset->orderBy('nft_assets.id', 'desc');
            }
            if ($request->oldest == 'on') {
                $NftAsset = $NftAsset->orderBy('nft_assets.id', 'asc');
            }
            if ($request->this_month == 'on') {
                $NftAsset = $NftAsset->whereMonth('nft_assets.created_at', date('m'));
            }

            // category filter 
            if ($request->cat) {
                $NftAsset = $NftAsset->join('nft_asset_categories', 'nft_assets.category_id', '=', 'nft_asset_categories.id')->whereIn('nft_assets.category_id', $request->cat);
            } else {
                $NftAsset = $NftAsset->join('nft_asset_categories', 'nft_assets.category_id', '=', 'nft_asset_categories.id');
            }

            // range price get filter 
            $amount = explode("-", $request->amount);
            if ($amount) {
                $NftAsset = $NftAsset->select('nft_assets.*')
                    ->whereBetween('nft_assets.base_price', [$amount[0], $amount[1]]);
            }

            // ratting get data fiter 
            if ($request->star_5 == 'on') {
                $NftAsset = $NftAsset->join('asset_ratings', 'nft_assets.id', '=', 'asset_ratings.asset_id')->where('asset_ratings.rate', 5);
            }
            if ($request->star_4 == 'on') {
                $NftAsset = $NftAsset->join('asset_ratings', 'nft_assets.id', '=', 'asset_ratings.asset_id')->where('asset_ratings.rate', 4);
            }
            $NftAsset = $NftAsset->get(); 
             
            $viewRender = view('users.explore.random-explore', compact('NftAsset'))->render();
            return Response::json($viewRender);
        }
        $category = NftAsset::groupBy('category_id')
            ->selectRaw('count(category_id) as total, category_id')
            ->get();
        return view('users.explore.explore', ['NftAsset' => $NftAsset, 'category' => $category, 'mycollections' => $mycollections]);
    }
    public function exploreFilter(Request $request)
    {



        // elseif($request->oldest == 'on'){
        //     $res['result'] = NftAsset::orderBy('id', 'asc')->get();  
        // }elseif($request->populer == 'on'){
        //     $res['result'] = NftAsset::orderByDesc('id')->get();  
        // }elseif($request->this_month == 'on'){
        //     $res['result'] = NftAsset::orderByDesc('id')->get();  
        // } 
    }
}
