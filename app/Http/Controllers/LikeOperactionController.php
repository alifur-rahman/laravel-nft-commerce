<?php

namespace App\Http\Controllers;

use App\Models\favorites;
use App\Models\follows;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;

class LikeOperactionController extends Controller
{
    public function likeOperation(Request $Request){
        $optype = $Request->optype;
        $itemId = $Request->itemId;
       

        if(isset(auth()->user()->id)){
            $before = favorites::where('asset_id',$itemId)->where('favorite_by',auth()->user()->id)->count();
            if($optype == 0){
                if($before == 0){
                    $create = favorites::create([
                        'asset_id' => $itemId,
                        'favorite_by' => auth()->user()->id
                    ]);
                }
                else{
                    $create = true;
                }
               
                if($create){
                    $count = favorites::where('asset_id',$itemId)->count();
                    return Response::json([
                        'status' => true,
                        'return_type' => 1,
                        'count' => $count
                    ]);
                }
            }
            else if($optype == 1){
                if($before != 0){
                    $delete = favorites::where('asset_id',$itemId)->delete();
                }
                else{
                    $delete = true;
                }
                
                if($delete){
                    $count = favorites::where('asset_id',$itemId)->count();
                    return Response::json([
                        'status' => true,
                        'return_type' => 0,
                        'count' => $count
                    ]);
                }
            }
        }
        else{
            return Response::json([
                'status' => false,
                'message' => 'Please Login to do like operaction',
                'return_type' => 'login'
            ]);
        }
        
    }

    public function followOperation(Request $Request){

        $optype = $Request->optype;
        $userID = $Request->followkey;
        
        if(isset(auth()->user()->id)){
            $before = follows::where('user_id',$userID)->where('follow_by',auth()->user()->id)->count();
            if($optype == 0){
                if($before == 0){
                    $create = follows::create([
                        'user_id' => $userID,
                        'follow_by' => auth()->user()->id
                    ]);
                }
                else{
                    $create = true;
                }
               
                if($create){
                    return Response::json([
                        'status' => true,
                        'return_type' => 1
                    ]);
                }
            }
            else if($optype == 1){
                if($before != 0){
                    $delete = follows::where('user_id',$userID)->where('follow_by',auth()->user()->id)->delete();
                }
                else{
                    $delete = true;
                }
                
                if($delete){
                    return Response::json([
                        'status' => true,
                        'return_type' => 0
                    ]);
                }
            }
        }
        else{
            return Response::json([
                'status' => false,
                'message' => 'Please Login do follow operaction',
                'return_type' => 'login'
            ]);
        }
    }
   
}
