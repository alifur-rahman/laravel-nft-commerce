<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Bid;
use App\Models\follows;
use App\Models\NftAsset;
use App\Models\NftSale;
use App\Models\notification_showns;
use App\Models\notifications;
use App\Models\NotificationSetting;
use App\Models\User;
use App\Services\AllfunctionService;
use App\Services\likeOperactionService;
use App\Services\OthersHelperService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;

use Illuminate\Http\Request;

class UserNotificationController extends Controller
{
    public function page(Request $request){
        // $helperService = new OthersHelperService();
        // return $helperService->notificationCount();
        return view('users.notification');
       
    }

    public function notificationQuery(Request $request){
        if ($request->ajax()) {
            $mySettings = NotificationSetting::where('user_id',auth()->user()->id)->first();
            if($mySettings){
                if($mySettings->order_confirm){
                    if(isset($notification)){
                        $notification = $notification->orwhere('notification_for','order_confirm');
                    }
                    else{
                        $notification = notifications::orwhere('notification_for','order_confirm');
                    }
                }
                if($mySettings->new_item){
                    if(isset($notification)){
                        $notification = $notification->orwhere('notification_for','new_item');
                    }
                    else{
                        $notification = notifications::orwhere('notification_for','new_item');
                    }
                }
                if($mySettings->new_bid){
                    if(isset($notification)){
                        $notification = $notification->orwhere('notification_for','new_bid');
                    }
                    else{
                        $notification = notifications::orwhere('notification_for','new_bid');
                    }
                }
                if($mySettings->payment_card){
                    if(isset($notification)){
                        $notification = $notification->orwhere('notification_for','payment_card');
                    }
                    else{
                        $notification = notifications::orwhere('notification_for','payment_card');
                    }
                }
                if($mySettings->ending_bid){
                    if(isset($notification)){
                        $notification = $notification->orwhere('notification_for','ending_bid');
                    }
                    else{
                        $notification = notifications::orwhere('notification_for','ending_bid');
                    }
                }
                if($mySettings->approve_product){
                    if(isset($notification)){
                        $notification = $notification->orwhere('notification_for','approve_product');
                    }
                    else{
                        $notification = notifications::orwhere('notification_for','approve_product');
                    }
                }
                $helperService = new OthersHelperService();
                $data = array();
                if(isset($notification)){
                    
                    $total_record = $notification->limit(10)->count('id');
                    $notification = $notification->orderBy('id', 'DESC')->skip($request->current)->take($request->limit)->get();
                    $item = "";
                    foreach($notification as $single){
                        if($single['notification_for'] == 'order_confirm'){
                            // $tableData = $helperService->getSingleTableDataByCondi($single->from_table_model,'id',$single->table_id);
                            // $tableData = NftSale::where('id',$single->table_id)->where('seller_account',auth()->user()->id)->where('from_account',auth()->user()->id)->where('to_account',auth()->user()->id)->where('winner_account',auth()->user()->id)->first();

                            $tableData = NftSale::where('id',$single->table_id)->where('seller_account',auth()->user()->id);
                            if($tableData->count() == 0 ){
                                $tableData = NftSale::where('id',$single->table_id)->where('from_account',auth()->user()->id);
                            }
                            if($tableData->count() == 0 ){
                                $tableData = NftSale::where('id',$single->table_id)->where('to_account',auth()->user()->id);
                            }
                            if($tableData->count() == 0 ){
                                $tableData = NftSale::where('id',$single->table_id)->where('winner_account',auth()->user()->id);
                            }
                            
                            if($tableData->count() != 0 ){
                                $tableData = $tableData->first();
                                $assetsData = $helperService->assetDataById($tableData->asset_id);
                                $userDetails = $helperService->userDetailsById($tableData->winner_account);
                                $item = '<div class="single-activity-wrapper" update_noit="'.$single['id'].'">
                                        <div class="inner">
                                            <div class="read-content">
                                                <div class="thumbnail">
                                                    <a style="max-height: 100px; max-width: 100px;" href="/asset-details/'.$assetsData->id.'"><img src="'.asset('uploads/nft-assets').'/'.$assetsData->image.'" alt="'.$assetsData->name.'"></a>
                                                </div>
                                                <div class="content">
                                                    <a href="/asset-details/'.$assetsData->id.'">
                                                        <h6 class="title">'.$assetsData->name.'</h6>
                                                    </a>
                                                    <p>Sold out by '. $userDetails->name .' <span> '. $tableData->total_price .' '. $assetsData->price_symbol .'</span> each</p>
                                                    <div class="time-maintane">
                                                        <div class="time data">
                                                            <i data-feather="clock"></i>
                                                            <span>'.$helperService->timeis($single['created_at'],'moment').'</span>
                                                        </div>
                                                        <div class="user-area data">
                                                            <i data-feather="user"></i>
                                                            <a href="'. $userDetails->id .' ">'. $userDetails->name .' </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
                            }
                        }
                        else if($single['notification_for'] == 'new_item'){
                            $assetsData = $helperService->assetDataById($single->table_id);
                            $userDetails = $helperService->userDetailsById($assetsData->owner_id);
                            $item = '<div class="single-activity-wrapper" update_noit="'.$single['id'].'">
                                        <div class="inner">
                                            <div class="read-content">
                                                <div class="thumbnail">
                                                    <a style="max-height: 100px; max-width: 100px;" href="/asset-details/'.$assetsData->id.'"><img src="'.asset('uploads/nft-assets').'/'.$assetsData->image.'" alt="'.$assetsData->name.'"></a>
                                                </div>
                                                <div class="content">
                                                    <a href="/asset-details/'.$assetsData->id.'">
                                                        <h6 class="title">'.$assetsData->name.'</h6>
                                                    </a>
                                                    <p>'. $userDetails->name .' add a new Item , Base price is <span> '. $assetsData->base_price .' '. $assetsData->price_symbol .'</span> each</p>
                                                    <div class="time-maintane">
                                                        <div class="time data">
                                                            <i data-feather="clock"></i>
                                                            <span>'.$helperService->timeis($single['created_at'],'moment').'</span>
                                                        </div>
                                                        <div class="user-area data">
                                                            <i data-feather="user"></i>
                                                            <a href="'. $userDetails->id .' ">'. $userDetails->name .' </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
                        }
                        else if($single['notification_for'] == 'approve_product'){
                            $assetsData = $helperService->assetDataById($single->table_id);
                            $userDetails = $helperService->userDetailsById($assetsData->owner_id);
                            $item = '<div class="single-activity-wrapper" update_noit="'.$single['id'].'">
                                        <div class="inner">
                                            <div class="read-content">
                                                <div class="thumbnail">
                                                    <a style="max-height: 100px; max-width: 100px;" href="/asset-details/'.$assetsData->id.'"><img src="'.asset('uploads/nft-assets').'/'.$assetsData->image.'" alt="'.$assetsData->name.'"></a>
                                                </div>
                                                <div class="content">
                                                    <a href="/asset-details/'.$assetsData->id.'">
                                                        <h6 class="title">'.$assetsData->name.'</h6>
                                                    </a>
                                                    <p>Your NFT is live now , Base price is  <span> '. $assetsData->base_price .' '. $assetsData->price_symbol .'</span> each</p>
                                                    <div class="time-maintane">
                                                        <div class="time data">
                                                            <i data-feather="clock"></i>
                                                            <span>'.$helperService->timeis($single['created_at'],'moment').'</span>
                                                        </div>
                                                        <div class="user-area data">
                                                            <i data-feather="user"></i>
                                                            <a href="'. $userDetails->id .' ">'. $userDetails->name .' </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
                        }
                        array_push($data, $item);
                        $this->sendSeenNotification($single['id']);
                    }
                }
                else{
                    $notification = [];
                }
            }
            else{
                $notification = [];
            }

            return Response::json([
                'list' => $data,
                'totalRecord' => $total_record
            ]);
        }
    }
    public function dashboardNotificationQuery(Request $request){
        if ($request->ajax()) {
            $data = array();
            $total_record = "";
            $mySettings = NotificationSetting::where('user_id',auth()->user()->id)->first();
            if($mySettings){
                if($mySettings->order_confirm){
                    if(isset($notification)){
                        $notification = $notification->orwhere('notification_for','order_confirm');
                    }
                    else{
                        $notification = notifications::orwhere('notification_for','order_confirm');
                    }
                }
                if($mySettings->new_item){
                    if(isset($notification)){
                        $notification = $notification->orwhere('notification_for','new_item');
                    }
                    else{
                        $notification = notifications::orwhere('notification_for','new_item');
                    }
                }
                if($mySettings->new_bid){
                    if(isset($notification)){
                        $notification = $notification->orwhere('notification_for','new_bid');
                    }
                    else{
                        $notification = notifications::orwhere('notification_for','new_bid');
                    }
                }
                if($mySettings->payment_card){
                    if(isset($notification)){
                        $notification = $notification->orwhere('notification_for','payment_card');
                    }
                    else{
                        $notification = notifications::orwhere('notification_for','payment_card');
                    }
                }
                if($mySettings->ending_bid){
                    if(isset($notification)){
                        $notification = $notification->orwhere('notification_for','ending_bid');
                    }
                    else{
                        $notification = notifications::orwhere('notification_for','ending_bid');
                    }
                }
                if($mySettings->approve_product){
                    if(isset($notification)){
                        $notification = $notification->orwhere('notification_for','approve_product');
                    }
                    else{
                        $notification = notifications::orwhere('notification_for','approve_product');
                    }
                }
                $helperService = new OthersHelperService();
                
                if(isset($notification)){
                    
                    $total_record = $notification->limit(10)->count('id');
                    $notification = $notification->orderBy('id', 'DESC')->skip($request->current)->take($request->limit)->get();
                    $item = "";
                    foreach($notification as $single){
                        if($single['notification_for'] == 'order_confirm'){
                            // $tableData = $helperService->getSingleTableDataByCondi($single->from_table_model,'id',$single->table_id);
                            // $tableData = NftSale::where('id',$single->table_id)->where('seller_account',auth()->user()->id)->where('from_account',auth()->user()->id)->where('to_account',auth()->user()->id)->where('winner_account',auth()->user()->id)->first();

                            $tableData = NftSale::where('id',$single->table_id)->where('seller_account',auth()->user()->id);
                            if($tableData->count() == 0 ){
                                $tableData = NftSale::where('id',$single->table_id)->where('from_account',auth()->user()->id);
                            }
                            if($tableData->count() == 0 ){
                                $tableData = NftSale::where('id',$single->table_id)->where('to_account',auth()->user()->id);
                            }
                            if($tableData->count() == 0 ){
                                $tableData = NftSale::where('id',$single->table_id)->where('winner_account',auth()->user()->id);
                            }
                            
                            if($tableData->count() != 0 ){
                                $tableData = $tableData->first();
                                $assetsData = $helperService->assetDataById($tableData->asset_id);
                                $userDetails = $helperService->userDetailsById($tableData->winner_account);
                                $item = ' <div class="single-notice">
                                                <div class="thumbnail">
                                                    <a id="connectbtn" href="/asset-details/'.$assetsData->id.'"><img src="'.asset('uploads/nft-assets').'/'.$assetsData->image.'" alt="'.$assetsData->name.'"></a>
                                                </div>
                                                <div class="content-wrapper">
                                                    <a href="/asset-details/'.$assetsData->id.'">
                                                        <h6 class="title">'.$assetsData->name.'</h6>
                                                    </a>
                                                    <p>Sold out by '. $userDetails->name .' <span> '. $tableData->total_price .' '. $assetsData->price_symbol .'</span> each</p>
                                                    <div class="notice-time">
                                                        <span>'.$helperService->timeis($single['created_at'],'moment').' </span>
                                                        <span> <a href="'. $userDetails->id .' ">'. $userDetails->name .' </a></span>
                                                    </div>
                                                    <a href="/asset-details/'.$assetsData->id.'" class="btn btn-primary-alta">Check Out</a>
                                                </div>
                                            </div>';
                                            }
                        }
                        else if($single['notification_for'] == 'new_item'){
                            $assetsData = $helperService->assetDataById($single->table_id);
                            $userDetails = $helperService->userDetailsById($assetsData->owner_id);
                            $item = '<div class="single-notice">
                                        <div class="thumbnail">
                                            <a id="connectbtn" href="/asset-details/'.$assetsData->id.'"><img src="'.asset('uploads/nft-assets').'/'.$assetsData->image.'" alt="'.$assetsData->name.'"></a>
                                        </div>
                                        <div class="content-wrapper">
                                            <a href="/asset-details/'.$assetsData->id.'">
                                                <h6 class="title">'.$assetsData->name.'</h6>
                                            </a>
                                            <p>'. $userDetails->name .' add a new Item , Base price is <span> '. $assetsData->base_price .' '. $assetsData->price_symbol .'</span> each</p>
                                            <div class="notice-time">
                                                <span>'.$helperService->timeis($single['created_at'],'moment').' </span>
                                                <span> <a href="'. $userDetails->id .' ">'. $userDetails->name .' </a></span>
                                            </div>
                                            <a href="/asset-details/'.$assetsData->id.'" class="btn btn-primary-alta">Check Out</a>
                                        </div>
                                    </div>';
                        }
                        else if($single['notification_for'] == 'approve_product'){
                            $assetsData = $helperService->assetDataById($single->table_id);
                            $userDetails = $helperService->userDetailsById($assetsData->owner_id);
                            $item = '<div class="single-notice">
                                        <div class="thumbnail">
                                            <a id="connectbtn" href="/asset-details/'.$assetsData->id.'"><img src="'.asset('uploads/nft-assets').'/'.$assetsData->image.'" alt="'.$assetsData->name.'"></a>
                                        </div>
                                        <div class="content-wrapper">
                                            <a href="/asset-details/'.$assetsData->id.'">
                                                <h6 class="title">'.$assetsData->name.'</h6>
                                            </a>
                                            <p>Your NFT is live now , Base price is  <span> '. $assetsData->base_price .' '. $assetsData->price_symbol .'</span> each</p>
                                            <div class="notice-time">
                                                <span>'.$helperService->timeis($single['created_at'],'moment').' </span>
                                                <span> <a href="'. $userDetails->id .' ">'. $userDetails->name .' </a></span>
                                            </div>
                                            <a href="/asset-details/'.$assetsData->id.'" class="btn btn-primary-alta">Check Out</a>
                                        </div>
                                    </div> ';
                        }
                        array_push($data, $item);
                        $this->sendSeenNotification($single['id']);
                    }
                }
                else{
                    $notification = [];
                }
            }
            else{
                $notification = [];
            }

            return Response::json([
                'list' => $data,
                'totalRecord' => $total_record
            ]);
        }
    }

    public function sendSeenNotification($notificationId){
        $isAlreadyHave = notification_showns::where('user_id',auth()->user()->id)->where('notification_id',$notificationId)->count();
        
        if($isAlreadyHave == 0){
            notification_showns::create([
                'notification_id' => $notificationId,
                'user_id' => auth()->user()->id
            ]);
            return 'done';
        }
        else{
            return 'duplicate';
        }
    }

    public function topUserQuery(Request $request){
         

        $likeService = new likeOperactionService();
        if ($request->ajax()) {
          $NftSale = new NftSale;
            $data = array();  

            $total_record = $NftSale->limit(10)->count('id'); 
            
            $NftSale = $NftSale->selectRaw('asset_id, SUM(asset_id) as "total_sale", SUM(total_price) as "total_price"') 
                            ->groupBy('asset_id')
                            ->orderBy('total_sale', 'desc')
                            ->take(10);
            
            if($request->top_sales_filter == 'today'){ 
                $NftSale = $NftSale->where('created_at', '>', Carbon::now()->subMinutes(1440));
            }
            if($request->top_sales_filter == '7d'){  
                $NftSale = $NftSale->where('created_at', '>', Carbon::now()->subMinutes(10080));
            }
            if($request->top_sales_filter == '30d'){  
                $NftSale = $NftSale->where('created_at', '>', Carbon::now()->subMinutes(43800));
            } 
            if($request->top_sales_filter == '30d'){  
                $NftSale = $NftSale->where('created_at', '>', Carbon::now()->subMinutes(262800));
            } 

            $NftSale = $NftSale->get();   

            // return $NftSale;
            $item = "";
            foreach ($NftSale as $key => $value) {
                $item = '
                        <div class="top-seller-inner-one">
                        <div class="top-seller-wrapper">
                            <div class="thumbnail varified">
                                <a href="/asset-details/'.$value->asset_id.'"><img style="width:50px; height:50px" src="'.AllfunctionService::get_nft_image($value->asset_id).'" alt="'.AllfunctionService::get_nft_asset_name($value->asset_id).'"></a>
                            </div>
                            <div class="top-seller-content">
                                <a href="/asset-details/'.$value->asset_id.'">
                                    <h6 class="name">'.AllfunctionService::get_nft_asset_name($value->asset_id).'</h6>
                                </a>
                                <span class="count-number">
                                   Total Sale '.$value->total_sale.'+'.'
                                </span>
                            </div>
                        </div>
                        <a href="/asset-details/'.$value->asset_id.'" class="btn btn-primary-alta "><span class="al_fol_text">View</span></a>
                    </div>
                ';

                array_push($data, $item);
            }

                

            return Response::json([
                'list' => $data,
                'totalRecord' => $total_record
            ]);
        }
    }

   
}
