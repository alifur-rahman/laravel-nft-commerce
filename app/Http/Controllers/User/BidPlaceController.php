<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Bid;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class BidPlaceController extends Controller
{
    public function placeBid(Request $request){
        if(($request->ajax())){
            $bid_amount=$request->bid_value;
            $base_amount=$request->base_or_bid;
            $bidder_id=auth()->user()->id;
            $asset_id=$request->asset_id;

            $total_bid_amount=Bid::max('offer_price');

            $validation_rules = [
                'bid_value' => 'required',
            ];
            $validator = Validator::make($request->all(), $validation_rules);
              if ($validator->fails()) {
                  if ($request->ajax()) {
                      return Response::json(['success' => false, 'errors' => $validator->errors()]);
                  }
              }
              if($bid_amount < $total_bid_amount || $bid_amount < $base_amount ){
                return Response::json(['success' => false, 'message' =>'Bid Amount Should be Greatar than Max Bid amount or Base Amount']);
              }

              else{
                $create=Bid::create([
                    'asset_id'=>$asset_id,
                    'bidder_id'=>$bidder_id,
                    'offer_price'=>$bid_amount,
                    'status'=>1
                ]);

                if($create){
                    return Response::json(['status' => true, 'message' => 'Your bid placed successfully']);
                }
              }
        }

    }
}
