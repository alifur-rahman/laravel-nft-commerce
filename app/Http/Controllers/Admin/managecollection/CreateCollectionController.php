<?php

namespace App\Http\Controllers\Admin\managecollection;

use Illuminate\Http\Request;
use App\Models\NftCollection;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class CreateCollectionController extends Controller
{
    public function createCollection(Request $request)
    {
        if ($request->ajax()) {
            $validation_rules = [
                'user_id' => 'required',
                'description' => 'nullable|min:15|max:191',
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
                    'user_id' => $request->user_id,
                    'name' => $request->name,
                    'details' => $request->description,
                    'cover_photo' => $cover_address,
                    'profile_photo' => $profle_address
                ]);

                if ($collection_store) {
                    return Response::json(['status' => true, 'message' => 'Your Collection Create Successfully']);
                } else {
                    return Response::json(['status' => false, 'message' => 'Fix the following errors', 'errors' => $validator->errors()]);
                }
            }
        } else {
            return view('admin.manage-collection.create-collection');
        }
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
