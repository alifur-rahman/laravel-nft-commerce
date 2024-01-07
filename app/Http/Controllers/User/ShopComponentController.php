<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\NftAsset;
use App\Models\NftSale;
use App\Models\Order;
use App\Models\OrderInvoice;
use App\Models\User;
use Illuminate\Http\Request;
use Cart;
use Facade\FlareClient\Http\Response;
use App\Services\AllfunctionService;
use Illuminate\Support\Facades\Validator; 

class ShopComponentController extends Controller
{ 
    public function store(Request $request)
    {  
        $result = Cart::add($request->data_id, $request->data_name, 1, $request->data_price);       
        $product_img =  AllfunctionService::get_nft_image($result->id) ;
        if ($result){ 
            return response(['success' => true, 'message' => 'Product added to cart Succesfully', 'cartInfo' => $result, 'product_img' =>$product_img]);
        } else{
            return response(['success' => false, 'message' => 'something went to wrong']);
        }    
    }
    public function cartRemove(Request $request)
    {   
        Cart::remove($request->rowId); 
        return response(['success' => true, 'message' => 'Remove Done']);
    }
    public function cartDetails(Request $request)
    {   
        return view('users.cart-details-page');
    }
    public function buyNowNft(Request $request)
    {   
        $validation_rules = [ 
            'meta_amount_input' => 'required', 
        ];
        $validator = Validator::make($request->all(), $validation_rules);
        if ($validator->fails()) {
            if ($request->ajax()) {
                return response(['status' => false, 'errors' => $validator->errors(),'message' => 'Please fix the following errors!']);
            } else {
                return Redirect()->back()->with(['status' => false, 'errors' => $validator->errors()]);
            }
        }else{    

            $meta_amount_input = round((int)$request->meta_amount_input);
            $meta_amount_val = round((int)$request->meta_amount_val);
            $total_amount = round((int)$request->total_amount); 
            $cart_tax = round((int)$request->cart_tax); 
 

            if($meta_amount_val < $meta_amount_input){ 
                return response(['status' => false, 'message' => "You don't have enough balance!"]); 
            }elseif($total_amount != $meta_amount_input ){
                return response(['status' => false, 'message' => "Less or more than the total amount, Please write exact amount!"]); 
            }else{
                
                $nft_asset = []; 
                for ($i=0; $i < count($request->asset_id); $i++) { 
                    $nft_assets = NftAsset::where('id',$request->asset_id[$i])->first(); 
                    array_push($nft_asset, $nft_assets->id); 
                }  
                $orders = Order::create([
                    'user_id'    =>  auth()->user()->id,
                    'products'   => json_encode($nft_asset),
                    'status'     => 'pending'
                ]);  
 
                $invoice_number = rand(999999, 99);
                for ($i=0; $i < count($nft_asset); $i++) { 
                    $sallers_id = User::join('nft_assets', 'nft_assets.owner_id', '=', 'users.id')
                                        ->where('nft_assets.id', $nft_asset[$i]) 
                                        ->first();
                                         
                    $Invoice = OrderInvoice::create([ 
                        'order_id' => $orders->id,
                        'saller_id' => $sallers_id->owner_id,
                        'buyer_id' => auth()->user()->id,
                        'amount' => $sallers_id->base_price,
                        'invoice_number' => $invoice_number
                    ]);
                }      

                $createNFTsalearray = [];
                $nft_asset_name = [];
                for ($i=0; $i < count($request->asset_id); $i++) { 
                    $nft_assets = NftAsset::where('id',$request->asset_id[$i])->first();
                    $NftSale = NftSale::create([
                        'asset_id' => $nft_assets->id,
                        'quantity' => 1, 
                        'time' => date("Y/m/d"), 
                        'total_price' => $nft_assets->base_price,
                        'order_status' => 'Pending',
                        'order_id' => $orders->id
                    ]);    
                    array_push($createNFTsalearray, $NftSale);
                    array_push($nft_asset_name, $nft_assets->name);
                }

                if($NftSale == true AND $Invoice == true){   
                    return response(['status' => true, 'message' => "Checkout Successfully!", 'invoiceData' => $Invoice, 'nft_asset' => $nft_assets, 'nftSaleData' => $createNFTsalearray,'paid_amount' => $meta_amount_input, 'nft_asset_name' => $nft_asset_name, 'cart_tax' => $cart_tax, 'total_amount' => $total_amount] ); 
                } else{ 
                    return response(['status' => false, 'message' => "Something went to wrong!"]);
                }  
            }
        }
    }
    public function destroy(Request $request){
        Cart::destroy();
        return true;
    }
}
