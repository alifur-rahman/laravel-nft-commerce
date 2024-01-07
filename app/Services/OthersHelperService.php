<?php
namespace App\Services;
use App\Models\NftAsset;
use App\Models\notification_showns;
use App\Models\notifications;
use App\Models\NotificationSetting;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class OthersHelperService {
    public function getSingleTableDataByCondi($model,$con,$prove){
        if(empty($con)){
            $con = "id";
        }
        $entity = 'App\Models\\'.$model;
        return $entity::where($con,$prove)->first();
    }
    public function assetDataById($assetId){
        $assetDe = NftAsset::where('nft_assets.id',$assetId)
        ->join('nft_asset_images','nft_assets.id' , '=', 'nft_asset_images.nft_asset_id')
        ->join('nft_asset_categories', 'nft_asset_categories.id', '=', 'nft_assets.category_id')
        ->select('nft_assets.*','nft_asset_images.image','nft_asset_categories.category', 'nft_asset_categories.slug');
        return $assetDe->first();
    }
    public function timeis($ti, $type = '')
    {
        //use timeis(datetime,'moment')
        //use timeis(datetime)
        if ($type == 'moment') {
            $time = time() - strtotime($ti);
            $time = ($time < 1) ? 1 : $time;
            $tokens = array(
                31536000 => 'year',
                2592000 => 'month',
                604800 => 'week',
                86400 => 'day',
                3600 => 'hour',
                60 => 'minute',
                1 => 'second'
            );
            foreach ($tokens as $unit => $text) {
                if ($time < $unit) continue;
                $numberOfUnits = floor($time / $unit);
                return $numberOfUnits . ' ' . $text . (($numberOfUnits > 1) ? 's ago' : ' ago');
            }
        } else {
            return date_format(date_create($ti), "d F Y H:i:s A");
        }
    }
    public function userDetailsById($userID){
        return User::where('id',$userID)->select('name','email','phone','id')->first();
    }
    public function notificationCount(){
        if(Auth::check()){
            $mySettings = NotificationSetting::where('user_id',auth()->user()->id)->first();
            $count = 0;
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
                if(isset($notification)){
                    $haveSeen = notification_showns::where('user_id',auth()->user()->id)->pluck('notification_id');
                    $notification = $notification->pluck('id');
                    if(count($notification) != 0){
                        foreach ($notification as $key) {
                            if(count($haveSeen) != 0){
                                foreach ($haveSeen as $riw ) {
                                    if($key != $riw){
                                        $count++;
                                    }
                                }
                            }
                        }
                    }
                }
            }
            return $count;
        }else{
            return false;
        }
    }
}
