<?php

namespace App\Http\Controllers;

use App\Models\NftAsset;
use App\Models\NftAssetCategory;
use App\Models\NftAssetDetail;
use App\Models\NftAssetImage;
use App\Models\NftCollection;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Services\AllfunctionService;
use File;

class NftController extends Controller
{
    public function create(Request $request)
    {

        $NftCollection = NftCollection::select('name', 'id')->where('user_id', auth()->user()->id)->get();

        if ($request->ajax()) {
            $validation_rules = [
                'sale_type' => 'required',
                'product_name' => 'required',
                'description' => 'required',
                'createNFTfile' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'price' => 'required',
                'properties' => 'required',
                'royality' => 'required',
                'category' => 'required'
            ];
            $validator = Validator::make($request->all(), $validation_rules);
            if ($validator->fails()) {
                return Response::json([
                    'status' => false,
                    'errors' => $validator->errors(),
                    'message' => 'Please fix the following errors!'
                ]);
            } else {

                // create nft asset 
                $NftAsset = NftAsset::create([
                    'name' => $request->product_name,
                    'base_price' => $request->price,
                    'token' => rand(999999, 6),
                    'category_id' => $request->category,
                    'bit_time' => $request->bidding_deadline,
                    'sale_type' => $request->sale_type,
                    'owner_id' => auth()->user()->id,
                ]);
                // nft asset deatils 
                if($NftAsset){
                    $NftAssetDetail = NftAssetDetail::create([
                        'description' => $request->description,
                        'properties' => json_encode($request->properties),
                        'nft_asset_id' => $NftAsset->id,
                    ]);
    
                    // create image for nft  
                    $nft_photo = $request->file('createNFTfile');
                    $nft_address = time() . '_nft_' . $nft_photo->getClientOriginalName();
                    $nft_photo->move(public_path('Uploads/nft-assets'), $nft_address);
    
                    $NftAssetImage = NftAssetImage::create([
                        'nft_asset_id' => $NftAsset->id,
                        'image'  => $nft_address,
                    ]);
    
                    // find collection item 
    
                    $collection = NftCollection::where('user_id', auth()->user()->id)->where('id', $request->collection)->select('id', 'item')->first();
    
                    if ($collection) {
                        // update collection nft item 
                        // return Response::json($NftAsset->id);
                        $collection_item = [];
                        // $collection_item = json_decode($collection->item);
                        array_push($collection_item, (int)$NftAsset->id);
                        $NftCollectionUpdate = NftCollection::where('user_id', auth()->user()->id)->where('id', $request->collection)->update([
                            'item' => json_encode($collection_item),
                        ]);
                    }
                    return Response::json([
                        'status' => true,
                        'message' => 'NFT Create Success!'
                    ]);
                }
                return Response::json([
                        'status' => false,
                        'message' => 'NFT Create Failed!'
                    ]);
                

                
            }
        }
        $category = NftAssetCategory::all();
        return view('users.nft-create', compact('NftCollection', 'category'));
    }



    public function editnft(Request $request, $id)
    {
        $nft_asset = NftAsset::find($id);
        $NftCollection = NftCollection::select('name', 'id')->where('user_id', auth()->user()->id)->get();
        $category = NftAssetCategory::all(); 
        $NftAssetImage = false;
        if ($request->ajax()) {  
            $validation_rules = [
                'sale_type' => 'required',
                'product_name' => 'required',
                'description' => 'required',
                'createNFTfile' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
                'price' => 'required',
                'properties' => 'required',
                'royality' => 'required',
                'category' => 'required'
            ];
            $validator = Validator::make($request->all(), $validation_rules);
            if ($validator->fails()) {
                return Response::json([
                    'status' => false,
                    'errors' => $validator->errors(),
                    'message' => 'Please fix the following errors!'
                ]);
            } else {

                 // create image for nft  
                 if($request->file('createNFTfile') != null){
                    $image = NftAssetImage::where('nft_asset_id', $id)->first();
                    if(file_exists(public_path('Uploads/nft-assets/'.$image->image) )) {
                        unlink(public_path('Uploads/nft-assets/'.$image->image));
                   }
                     
                    $nft_photo = $request->file('createNFTfile');
                    $nft_address = time() . '_nft_' . $nft_photo->getClientOriginalName();
                    $nft_photo->move(public_path('Uploads/nft-assets'), $nft_address);
    
                    $NftAssetImage = NftAssetImage::where('nft_asset_id', $id)->update([ 
                        'image'  => $nft_address,
                    ]);
                } 

                // create nft asset 
                $NftAsset = NftAsset::find($id)->update([
                    'name' => $request->product_name,
                    'base_price' => $request->price,
                    'token' => rand(999999, 6),
                    'category_id' => $request->category,
                    'bit_time' => $request->bidding_deadline,
                    'sale_type' => $request->sale_type, 
                ]);
                // nft asset deatils 
                $NftAssetDetail = NftAssetDetail::where('nft_asset_id',$id)->update([
                    'description' => $request->description,
                    'properties' => json_encode($request->properties)
                ]);
 
                

                $collection = NftCollection::find($request->collection);

                if ($collection) {
                    // update collection nft item 
                    $collection_item = json_decode($collection->item);
                    array_push($collection_item, (int)$NftAsset->id);
                    $NftCollectionUpdate = NftCollection::where('id', $request->collection)->update([
                        'item' => json_encode($collection_item),
                    ]);
                }

                if ($NftAsset and $NftAssetDetail OR $NftAssetImage) {
                    return Response::json([
                        'status' => true,
                        'message' => 'NFT Create Success!'
                    ]);
                } else {
                    return Response::json([
                        'status' => false,
                        'message' => 'NFT Create Failed!'
                    ]);
                }
            }
        }

        return view('users.edit_nft', compact('nft_asset', 'NftCollection', 'category'));
    }
}
