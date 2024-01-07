<?php

namespace App\Http\Controllers\User;

use App\Models\NftSale;
use App\Models\NftAsset;
use Illuminate\Http\Request;
use App\Models\NftAssetImage;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class SalesReportController extends Controller
{
    public function salesReportShow()
    {
        return view('users.sales_report');
    }

    public function getData(Request $request)
    {
        $draw = $request->input('draw');
        $start = $request->input('start');
        $length = $request->input('length');
        $order = $_GET['order'][0]["column"];
        $orderDir = $_GET["order"][0]["dir"];
        $columns = ['auction_type', 'contract_address', 'quantity', 'payment_symbol', 'total_price', 'time'];
        $orderby = $columns[$order];

        $nft_name = $request->nft_name;
        $payment_symbol = $request->payment_symbol;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $min_amount = $request->min_amount;
        $max_amount = $request->max_amount;

        $result = NftSale::where('seller_account', auth()->user()->id)
        ->join('nft_assets', 'nft_assets.id', '=', 'nft_sales.asset_id')
        ->join('users', 'nft_assets.owner_id', '=', 'users.id')->select(['nft_assets.name as nft_name','nft_assets.id as img_asset_id', 'payment_symbol', 'time', 'total_price', 'quantity', 'contract_address' ]);

        if (!empty($nft_name)) {
            $result = $result->where('nft_assets.name', '=', $nft_name);
        }
        if (!empty($payment_symbol)) {
            $result = $result->where('nft_sales.payment_symbol', '=', $payment_symbol);
        }
        if (!empty($from_date)) {
            $result = $result->where('nft_sales.time', '>=', $from_date);
        }
        if (!empty($to_date)) {
            $result = $result->where('nft_sales.time', '<=', $to_date);
        }
        if (!empty($min_amount)) {
            $result = $result->where('nft_sales.total_price', '>=', $min_amount);
        }
        if (!empty($max_amount)) {
            $result = $result->where('nft_sales.total_price', '<=', $max_amount);
        }


        $count = $result->count(); // <------count total rows
        $result = $result->orderby($orderby, $orderDir)->skip($start)->take($length)->get();
        $data = array();
        $i = 0;

        foreach ($result as $row) {
            // $nft = DB::table('nft_asset_images')->where('nft_asset_id', $row->img_asset_id)->first();
            $image = NftAssetImage::where('nft_asset_id', $row->img_asset_id)->first();

            // $data[$i]['nft_image'] = $nft->image;
            $data[$i]['name'] =  '<div class="product-wrapper d-flex align-items-center">
                                    <a href="product-details.html" class="thumbnail">
                                        <img src="' . asset('/Uploads/nft-assets/'.$image->image) . '" alt="Nft_Profile">
                                    </a>
                                    <span>' . $row->name . '</span>
                                </div>';
            $data[$i]['time'] = "<span>$row->time</span>";
            // $data[$i]['auction_type'] = $item['auction_type'];
            $data[$i]['contract_address'] = "<span>$row->contract_address</span>";
            $data[$i]['quantity'] = "<span>$row->quantity</span>";
            $data[$i]['total_price'] =  "<span>$$row->total_price</span>";
            $data[$i]['payment_symbol'] =  "<span>$row->payment_symbol</span>";
            $i++;
        }
        //set the array of object as name data object
        $output = array('draw' => $_REQUEST['draw'], 'recordsTotal' => $count, 'recordsFiltered' => $count);
        $output['data'] = $data;

        // return the data as json
        return Response::json($output);
    }
}
