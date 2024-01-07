<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\NftAsset;
use App\Models\NftAssetImage;
use App\Models\NftCollection;
use App\Models\User;
use App\Services\AllfunctionService;
use App\Services\likeOperactionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class CollectionController extends Controller
{
    public function collections(Request $request, $name, $id)
    {
        $nft_collection = NftCollection::find($id);
        $asset_item = json_decode($nft_collection->item);
        if (empty($asset_item)) {
            $not_found = "Not found data";
            return view('users.single_collections', compact('nft_collection', 'not_found'));
        } else {
            $NftAsset = NftAsset::whereIn('id', $asset_item)->paginate(9);

            if ($request->ajax()) {
                $nft_collection = NftCollection::find($id);
                $asset_item = json_decode($nft_collection->item);
                $NftAsset = NftAsset::whereIn('nft_assets.id', $asset_item);

                // Price Filter
                if ($request->free_paid == 'on') {
                    $NftAsset = $NftAsset->where('nft_assets.base_price', 0);
                }
                if ($request->all_price == 'on') {
                    $NftAsset = $NftAsset->orderBy('nft_assets.base_price', 'asc');
                }
                if ($request->high_to_low == 'on') {
                    $NftAsset = $NftAsset->orderBy('nft_assets.base_price', 'desc');
                }
                if ($request->low_to_high == 'on') {
                    $NftAsset = $NftAsset->orderBy('nft_assets.base_price', 'asc');
                }

                // sort by filter
                if ($request->oldest == 'on') {
                    $NftAsset = $NftAsset->orderBy('nft_assets.id', 'asc');
                }
                if ($request->newest == 'on') {
                    $NftAsset = $NftAsset->orderBy('nft_assets.id', 'desc');
                }
                if ($request->this_month == 'on') {
                    $NftAsset = $NftAsset->whereMonth('nft_assets.created_at', date('m'));
                }

                // category filter
                if ($request->cat) {
                    $NftAsset = $NftAsset->join('nft_asset_categories', 'nft_assets.category_id', '=', 'nft_asset_categories.id')->whereIn('nft_assets.category_id', $request->cat);
                } else {
                    $NftAsset = $NftAsset->join('nft_asset_categories', 'nft_assets.category_id', '=', 'nft_asset_categories.id');
                }

                // range price get filter
                $amount = explode("-", $request->amount);
                if ($amount) {
                    $NftAsset = $NftAsset->select('nft_assets.*')
                        ->whereBetween('nft_assets.base_price', [$amount[0], $amount[1]]);
                }

                // ratting get data fiter
                if ($request->star_5 == 'on') {
                    $NftAsset = $NftAsset->join('asset_ratings', 'nft_assets.id', '=', 'asset_ratings.asset_id')->where('asset_ratings.rate', 5);
                }
                if ($request->star_4 == 'on') {
                    $NftAsset = $NftAsset->join('asset_ratings', 'nft_assets.id', '=', 'asset_ratings.asset_id')->where('asset_ratings.rate', 4);
                }


                $NftAsset = $NftAsset->get();

                $viewRender = view('users.explore.random-explore', compact('NftAsset'))->render();
                return Response::json($viewRender);
            }
        }
        $category = NftAsset::groupBy('category_id')
            ->selectRaw('count(category_id) as total, category_id')
            ->whereIn('id', $asset_item)
            ->get();


        return view('users.single_collections', compact('NftAsset', 'nft_collection', 'category'));
    }
    // create collections
    public function create(Request $request)
    {
        if ($request->ajax()) {
            $validation_rules = [
                'name' => 'required|max:100',
                'profile_photo' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'cover_photo' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ];
            $validator = Validator::make($request->all(), $validation_rules);

            if ($validator->fails()) {
                if ($request->ajax()) {
                    return Response::json(['success' => false, 'message' => 'Fix the following errors', 'errors' => $validator->errors()]);
                }
            } else {
                $profile_photo = $request->file('profile_photo');
                $profle_address = time() . '_cover_' . $profile_photo->getClientOriginalName();
                $profile_photo->move(public_path('Uploads/profile'), $profle_address);

                $cover_photo = $request->file('cover_photo');
                $cover_address = time() . '_cover_' . $cover_photo->getClientOriginalName();
                $cover_photo->move(public_path('Uploads/cover'), $cover_address);

                $collection_store = NftCollection::create([
                    'user_id' => Auth::user()->id,
                    'name' => $request->name,
                    'details' => $request->description,
                    'cover_photo' => $cover_address,
                    'profile_photo' => $profle_address
                ]);

                if ($collection_store) {
                    return response(['success' => true, 'message' => 'Collection Create Success', 'errors' => $validator->errors()]);
                } else {
                    return Response::json(['success' => false, 'message' => 'Fix the following errors', 'errors' => $validator->errors()]);
                }
            }
        } else {
            return view('users.create-collection');
        }
    }

    public function addCollection(Request $request)
    {
        $collection_item = [];
        $collection = NftCollection::find($request->collection_id);
        $collection_item = json_decode($collection->item);
        if ($collection_item != "") {
            $isIsset= array_search((int)$request->asset_id, $collection_item);
            if ($isIsset) {
                return response(['success' => true, 'message' => 'This NFT already added']);
            }
        }
        else {
            $collection_item = [];
        }
        
        array_push($collection_item, (int)$request->asset_id);
        
        
        $addcolection = NftCollection::find($request->collection_id)->update([
            'user_id' => Auth::user()->id,
            'item'=> json_encode($collection_item),
        ]);
        if ($addcolection) {
            return response(['success' => true, 'message' => 'Add Success']);
        }
    }
    public function all_collections(Request $request)
    {
        $collections = NftCollection::whereNotNull('item')->select()->get();
        return view('users.all-collections', ['collections'=>$collections]);
    }

    // edit existing collections
    public function edit_collection_page()
    {
        return view('users.edit-collection');
    }

    public function editCollection(Request $request)
    {
        $collection_profile_store= false;
        $collection_cover_store = false;
        if ($request->ajax()) {
            $validation_rules = [
                'name' => 'required|max:100',
                'profile_photo' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'cover_photo' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ];
            $validator = Validator::make($request->all(), $validation_rules);

            if ($validator->fails()) {
                if ($request->ajax()) {
                    return Response::json(['success' => false, 'message' => 'Fix the following errors', 'errors' => $validator->errors()]);
                }
            } else {
                if ($request->file('profile_photo') != null) {
                    $image = NftCollection::where('id', $request->collection_id)->first();
                    if (file_exists(public_path('Uploads/profile/'.$image->profile_photo))) {
                        unlink(public_path('Uploads/profile/'.$image->profile_photo));
                    }
                    $profile_photo = $request->file('profile_photo');
                    $profle_address = time() . '_profile_' . $profile_photo->getClientOriginalName();
                    $profile_photo->move(public_path('Uploads/profile'), $profle_address);

                    $collection_profile_store = NftCollection::where('id', $request->collection_id)->update([
                        'profile_photo' => $profle_address
                    ]);
                }

                if ($request->file('cover_photo') != null) {
                    $image = NftCollection::where('id', $request->collection_id)->first();
                    if (file_exists(public_path('Uploads/cover/'.$image->cover_photo))) {
                        unlink(public_path('Uploads/cover/'.$image->cover_photo));
                    }
                    $cover_photo = $request->file('cover_photo');
                    $cover_address = time() . '_cover_' . $cover_photo->getClientOriginalName();
                    $cover_photo->move(public_path('Uploads/cover'), $cover_address);

                    $collection_cover_store = NftCollection::where('id', $request->collection_id)->update([
                        'cover_photo' => $cover_address
                    ]);
                }

                $collection_store = NftCollection::where('id', $request->collection_id)->update([
                    'name' => $request->name,
                    'details' => $request->description,
                ]);

                if ($collection_store || ($collection_cover_store) || $collection_profile_store) {
                    return response(['success' => true, 'message' => 'Collection Update Success']);
                } else {
                    return Response::json(['success' => false, 'message' => 'Fix the following errors', 'errors' => $validator->errors()]);
                }
            }
        }
    }
}
