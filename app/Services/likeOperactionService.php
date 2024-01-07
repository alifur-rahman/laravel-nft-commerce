<?php 

namespace App\Services;

use App\Models\favorites;
use App\Models\follows;

class likeOperactionService {
   

    public function like_count($assetId){
        return favorites::where('asset_id',$assetId)->count();
    }

    public function is_liked($assetId){
        $itemFav = favorites::where('asset_id',$assetId)->get();
        $status = 0;
        if(isset( auth()->user()->id)){
            foreach ($itemFav as $key ) {
                if($key['favorite_by'] == auth()->user()->id){
                     $status = 1;
                }
            }
        }
        $ret = "liked=".$status." itemid=".$assetId."";
        return $ret;
    }

    public function is_follow($userId){
        $status = 0;
        $followCount = 0; 
        if(isset( auth()->user()->id)){
            $followCount = follows::where('user_id',$userId)->where('follow_by',auth()->user()->id)->count();
        }
        if($followCount != 0){
            $status = 1;
        }
        $ret = "follow_st=".$status." followKey=".$userId."";
        return $ret;
    }

    public function followStatus($userId){
        $status = 0;
        $followCount = 0; 
        if(isset( auth()->user()->id)){
            $followCount = follows::where('user_id',$userId)->where('follow_by',auth()->user()->id)->count();
        }
        if($followCount != 0){
            $status = 1;
        }

        if($status){
            return "Unfollow";
        }
        else{
            return "Follow";
        }
        
    }

    public function followersCount($userId){
        return follows::where('user_id',$userId)->count();
    }

    public function followingCount($userId){
        return follows::where('follow_by',$userId)->count();
    }

   
}