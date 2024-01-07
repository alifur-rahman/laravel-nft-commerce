<?php

namespace App\Http\Controllers\Admin\managenft;

use App\Models\User;
use App\Models\NftAsset;
use Illuminate\Http\Request;
use App\Models\NftAssetImage;
use App\Models\NftCollection;
use App\Models\NftAssetDetail;
use App\Models\NftAssetCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class NftGeneratController extends Controller
{
    public function getCollection(Request $request){

        $user_collections = NftCollection::where('user_id', $request->user_id)->select('name', 'id')->get();
        // dd($user_collections);
        // return $user_collections;


        if (count($user_collections)>0) {
            $viewRender = view('admin.manage-nft.random-collection', compact('user_collections'))->render();
                return Response::json($viewRender);
        }

    }
    public function nftGenerator(Request $request)
    {
        if ($request->ajax()) {
            $validation_rules = [
                'user_id' => 'required',
                'product_name' => 'required',
                'sale_type' => 'required',
                'description' => 'nullable|min:15|max:191',
                'createNFTfile' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'price' => 'required',
                'properties' => 'nullable|min:10|max:191',
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
                    'owner_id' => $request->user_id,
                ]);

                $asset_id = $NftAsset->id;
               // nft asset deatils
                $NftAssetDetail = NftAssetDetail::create([
                    'description' => $request->description,
                    'properties' => json_encode($request->properties),
                    'nft_asset_id' => $asset_id,
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

                $collection = NftCollection::where('user_id', $request->user_id)->where('id', $request->collection)->select('id', 'item')->first();

                if ($collection) {
                    // update collection nft item
                    // $collection_item = [];
                    $collection_item = json_decode($collection->item);
                    array_push($collection_item, (int)$NftAsset->id);
                    $NftCollectionUpdate = NftCollection::where('user_id', $request->user_id)->where('id', $request->collection)->update([
                        'item' => json_encode($collection_item),
                    ]);
                }

                if ($NftAsset and $NftAssetDetail and $NftAssetImage) {
                    return Response::json([
                        'status' => true,
                        'message' => 'Your Nft created Successfully'
                    ]);
                } else {
                    return Response::json([
                        'status' => false,
                        'message' => 'NFT Create Failed!'
                    ]);
                }
            }
        }

        return view('admin.manage-nft.generate-nft');
    }

    public function getUser(Request $request)
    {
        $search = $request->search;

        $users = User::select('id', 'name')->where('name', 'like', '%' .$search . '%')->limit(2)->get();

        $response = array();
        foreach ($users as $user) {
            $response[] = array(
                 "id"=>$user->id,
                 "text"=>$user->name
            );
        }
        return response()->json($response);
    }
}
