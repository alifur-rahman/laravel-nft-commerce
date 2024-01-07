<?php

namespace App\Http\Controllers;

use App\Models\AssetRating;
use App\Models\AssetView;
use App\Models\Bid;
use App\Models\Favorite;
use App\Models\NftAsset;
use App\Models\NftSale;
use App\Services\AllfunctionService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class NftRankingController extends Controller
{
    public function ranking(Request $request)
    {
        if ($request->ajax()) {
            $draw = $request->input('draw');
            $start = $request->input('start');
            $length = $request->input('length');
            $order = $_GET['order'][0]["column"];
            $orderDir = $_GET["order"][0]["dir"];
            $columns = ['name', 'owner_id', 'image', 'price', 'blockchain', 'price_symbol'];
            $orderby = $columns[$order];
            // select type= 0 for trader
            $result = NftAsset::select();
            if ($request->this_month == 'on') {
                $this_month = date('m');
                $result = $result->whereMonth('nft_assets.created_at', $this_month);
            }
            // filter by this week
            if ($request->this_week == 'on') {
                $result = $result->whereBetween('nft_assets.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
            }
            if ($request->rating && $request->rating != "") {
                $rate = AssetRating::where('rate',$request->rating)->select('asset_id')->distinct()->get();
                $result = $result->whereIn('id', $rate);
            }
            $count = $result->count(); // <------count total rows
            $result = $result->orderby($orderby, $orderDir)->skip($start)->take($length)->get();
            $data = array();
            $i = 0;
            $first_priority = []; // first priority when found all rating, view, bid, sales
            $second_priority = []; // 3 combination 
            $third_priority = []; // 2 combination
            $fourth_priority = []; // no combination
            foreach ($result as $key => $value) {
                // ranking 
                $sales = NftSale::where('asset_id', $value->id)->exists();
                $rating = AssetRating::where('asset_id', $value->id)->exists();
                $bid = Bid::where('asset_id', $value->id)->exists();
                $favorite = Favorite::where('asset_id', $value->id)->exists();
                $view = AssetView::where('asset_id', $value->id)->exists();
                if ($sales != false && $rating != false && $view != false && $favorite) {
                    // find first toper
                    array_push($first_priority, $value->id);
                } elseif (($sales != false && $view != false && $rating != false) ||   ($sales != false && $view != false && $favorite != false) || ($sales != false && $rating != false && $favorite != false)) {
                    // find second toper
                    array_push($second_priority, $value->id);
                } elseif (($sales != false && $view != false) || ($sales !== false && $rating != false) || ($sales !== false && $favorite != false)) {
                    // find thrid toper
                    array_push($third_priority, $value->id);
                } else {
                    array_push($fourth_priority, $value->id);
                }
                $i++;
            }
            // find first step toper
            // those have all 5 combination
            $first_ratio = [];
            for ($j = 0; $j < count($first_priority); $j++) {
                $first_sales = NftSale::where('asset_id', $first_priority[$j])->count();
                $first_rating = AssetRating::where('asset_id', $first_priority[$j])->count();
                $first_rating = round($first_rating / $first_sales);
                $first_view = AssetView::where('asset_id', $first_priority[$j])->count();
                $first_view = round($first_view / $first_sales);
                $ratio = ($first_sales + $first_rating + $first_view);
                $first_ratio[] = array("asset_id" => $first_priority[$j], "ratio" => $ratio);
            }
            usort($first_ratio, fn ($b, $a) => $a['ratio'] <=> $b['ratio']);
            // second second step toper
            // those have any 3 combination with salse
            $second_ratio = [];
            for ($j = 0; $j < count($second_priority); $j++) {
                $second_sales = NftSale::where('asset_id', $second_priority[$j])->count();
                $second_rating = AssetRating::where('asset_id', $second_priority[$j])->count();
                $second_rating = round($second_rating / $second_sales);
                $second_view = AssetView::where('asset_id', $second_priority[$j])->count();
                $second_view = round($second_view / $second_sales);
                $ratio = ($second_sales + $second_rating + $second_view);
                $second_ratio[] = array("asset_id" => $second_priority[$j], "ratio" => $ratio);
            }
            usort($second_ratio, fn ($b, $a) => $a['ratio'] <=> $b['ratio']);
            //  third step toper
            // those have any 2 combination with salse
            $third_ratio = [];
            for ($j = 0; $j < count($third_priority); $j++) {
                $third_sales = NftSale::where('asset_id', $third_priority[$j])->count();
                $third_rating = AssetRating::where('asset_id', $third_priority[$j])->count();
                $third_rating = round($third_rating / $third_sales);
                $third_view = AssetView::where('asset_id', $third_priority[$j])->count();
                $third_view = round($third_view / $third_sales);
                $ratio = ($third_sales + $third_rating + $third_view);
                $third_ratio[] = array("asset_id" => $third_priority[$j], "ratio" => $ratio);
            }
            usort($third_ratio, fn ($b, $a) => $a['ratio'] <=> $b['ratio']);
            //  fourth step toper
            // those have any 1 combination with salse
            $fourth_ratio = [];
            for ($j = 0; $j < count($fourth_priority); $j++) {
                $fourth_sales = NftSale::where('asset_id', $fourth_priority[$j])->count();
                $fourth_rating = AssetRating::where('asset_id', $fourth_priority[$j])->count();
                $fourth_view = AssetView::where('asset_id', $fourth_priority[$j])->count();
                $ratio = ($fourth_sales + $fourth_rating + $fourth_view);
                $fourth_ratio[] = array("asset_id" => $fourth_priority[$j], "ratio" => $ratio);
            }
            usort($fourth_ratio, fn ($b, $a) => $a['ratio'] <=> $b['ratio']);
            $total_ratio = array_merge($first_ratio, $second_ratio);
            $total_ratio = array_merge($total_ratio, $third_ratio);
            $total_ratio = array_merge($total_ratio, $fourth_ratio);

            $count = 0;
            for ($k = 0; $k < count($total_ratio); $k++) {
                $count++;
                $filtered_data = NftAsset::where('id', $total_ratio[$k]['asset_id'])->first();

                $data[$k]["sl"] = '<span>' . ($k + 1) . '.</span>';
                $data[$k]["product"] = '<div class="product-wrapper d-flex align-items-center">
                                            <a href="product-details.html" class="thumbnail">
                                                <img src="' . AllfunctionService::asset_image($filtered_data->id) . '" alt="Nft_Profile">
                                            </a>
                                            <span>' . $filtered_data->name . '</span>
                                        </div>';
                // $data[$k]["volume"]         = '<span>9,50,000</span>';
                $data[$k]["rating"]         = '<span class="color-danger">
                                            ' . AllfunctionService::rating_star($filtered_data->id) . '
                                            </span>';
                $data[$k]["views"]          = '<span class="color-green">' . AllfunctionService::views_count($filtered_data->id) . '</span>';
                $data[$k]["floor_price"]      = '<span>' . AllfunctionService::floor_price(3) . '</span>';
                $data[$k]["owners"]      = '<span>' . AllfunctionService::owner_count($filtered_data->token) . '</span>';
                $data[$k]["items"]     = '<span>' . AllfunctionService::sales_count($filtered_data->id) . '</span>';
            }

            $output = array('draw' => $_REQUEST['draw'], 'recordsTotal' => $count, 'recordsFiltered' => $count);
            $output['data'] = $data;
            return Response::json($output);
        }
        return view('users.nft-ranking');
    }
}
