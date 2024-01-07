<?php

namespace App\Http\Controllers;

use App\Models\CompanyInfo;
use App\Models\NftAsset;
use App\Models\Country;
use App\Models\favorites;
use App\Models\KycIdType;
use App\Models\NftCollection;
use App\Models\NftSale;
use App\Models\NotificationSetting;
use App\Models\User;
use App\Models\UserDescription;
use App\Services\MailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class UserProfileController extends Controller
{

    public function profile_settings(Request $request)
    {
        if ($request->ajax()) {
            if ($request->op === 'profile-upload') {
                $address_document = $request->file('file_document');
                // return substr($address_document->getMimeType(), 0, 5);
                if (substr($address_document->getMimeType(), 0, 5) != 'image') {
                    return Response::json([
                        'status' => false,
                        'errors' => [
                            'file_document' => 'The file is not an image/pdf'
                        ],
                        'message' => 'Please fix the following errors!'
                    ]);
                }


                $check_exist = User::where('id', auth()->user()->id)->where('profile_photo', '!=', '');
                $address_document = $request->file('file_document');
                $filename_address = time() . '_profile_' . $address_document->getClientOriginalName();
                $address_document->move(public_path('/Uploads/profile'), $filename_address);
                if ($check_exist->exists()) {
                    $check_exist = $check_exist->first();
                    $deleteable_file = public_path() . '/Uploads/profile/' . $check_exist->profile_photo;
                    File::delete($deleteable_file);
                    User::where('id', auth()->user()->id)->update([
                        'profile_photo' => $filename_address
                    ]);

                    return Response::json([
                        'status' => true,
                        'message' => 'Profile changes'
                    ]);
                }
                User::where('id', auth()->user()->id)->update([
                    'profile_photo' => $filename_address
                ]);

                return Response::json([
                    'status' => true,
                    'message' => 'Profile changes'
                ]);
            }
            // upload / chnage cover photo
            if ($request->op === 'cover-upload') {
                $address_document = $request->file('file_document');

                if (substr($address_document->getMimeType(), 0, 5) != 'image') {
                    return Response::json([
                        'status' => false,
                        'errors' => [
                            'file_document' => 'The file is not an image'
                        ],
                        'message' => 'Please fix the following errors!'
                    ]);
                }


                $check_exist = User::where('id', auth()->user()->id)->where('cover_photo', '!=', '');
                $address_document = $request->file('file_document');
                $filename_address = time() . '_cover_' . $address_document->getClientOriginalName();
                $address_document->move(public_path('/Uploads/cover'), $filename_address);
                if ($check_exist->exists()) {
                    $check_exist = $check_exist->first();
                    $deleteable_file = public_path() . '/Uploads/cover/' . $check_exist->cover_photo;
                    File::delete($deleteable_file);
                    User::where('id', auth()->user()->id)->update([
                        'cover_photo' => $filename_address
                    ]);

                    return Response::json([
                        'status' => true,
                        'message' => 'Cover photo changes'
                    ]);
                }
                User::where('id', auth()->user()->id)->update([
                    'cover_photo' => $filename_address
                ]);

                return Response::json([
                    'status' => true,
                    'message' => 'Cover photo changes'
                ]);
            }
            // persional information
            if ($request->op === 'persional-info') {
                $validation_rules = [
                    'name' => 'required|max:100',
                    'bio' => 'nullable|max:191',
                    'phone' => 'required|max:15',
                    'gender' => 'required',
                    'country' => 'required',
                    'state' => 'required|max:50',
                    'city' => 'required|max:60',
                    'zipcode' => 'required|max:60',
                    'date_of_birth' => 'required|date'
                ];
                $validator = Validator::make($request->all(), $validation_rules);
                if ($validator->fails()) {
                    return Response::json([
                        'status' => false,
                        'errors' => $validator->errors(),
                        'message' => 'Please fix the following errors!'
                    ]);
                }
                $update = User::where('id', auth()->user()->id)->update([
                    'name' => $request->name,
                    'phone' => $request->phone,
                ]);
                if (UserDescription::where('user_id', auth()->user()->id)->exists()) {
                    $d_update = UserDescription::where('user_id', auth()->user()->id)->update([
                        'country_id' => $request->country,
                        'state' => $request->state,
                        'city' => $request->city,
                        'address' => $request->address,
                        'zip_code' => $request->zipcode,
                        'date_of_birth' => $request->date_of_birth,
                        'about_user' => $request->bio,
                        'gender' => $request->gender,
                    ]);
                } else {
                    $d_update = UserDescription::create([
                        'user_id' => auth()->user()->id,
                        'country_id' => $request->country,
                        'state' => $request->state,
                        'city' => $request->city,
                        'address' => $request->address,
                        'zip_code' => $request->zipcode,
                        'date_of_birth' => $request->date_of_birth,
                        'about_user' => $request->bio,
                        'gender' => $request->gender,
                    ]);
                }

                if ($update == true && $d_update == true) {
                    return Response::json([
                        'status' => true,
                        'message' => 'Persional info successfully updated!'
                    ]);
                }
                return Response::json([
                    'status' => false,
                    'message' => 'Somthing went wrong, please try again later!'
                ]);
            }
            // change password
            if ($request->op === 'change-password') {
                $validation_rules = [
                    'old_password' => 'required|max:32|min:6',
                    'password' => 'required|max:32|min:6',
                    'confirm_password' => 'required|same:password',
                ];
                $validator = Validator::make($request->all(), $validation_rules);
                if ($validator->fails()) {
                    return Response::json([
                        'status' => false,
                        'errors' => $validator->errors(),
                        'message' => 'Please fix the following errors!'
                    ]);
                }
                $user = User::where('id', auth()->user()->id)->first();
                if (!Hash::check($request->old_password, $user->password)) {
                    return Response::json([
                        'status' => false,
                        'errors' => ['old_password' => 'Old password not matched'],
                        'message' => 'Please fix the following errors!'
                    ]);
                }
                $user->password = Hash::make($request->password);
                $update = $user->save();

                $company_info = CompanyInfo::select()->first();  

                $data = [
                    'client_name'               => $user->name,
                    'company_name'              => $company_info->com_name,  
                    'phone'                     => $user->phone,
                    'support_email'             => $company_info->support_email, 
                    'user_email'                => $user->email,   
                    'password'                  => $request->password
                ];

                MailService::mail($user->email, $data, 'Password Change', 'change-password');

                if ($update) {
                    return Response::json([
                        'status' => true,
                        'message' => 'Password successfully updated!'
                    ]);
                }
                return Response::json([
                    'status' => false,
                    'message' => 'Somthing went wrong please try again later!'
                ]);
            }
            // change transaction password
            if ($request->op === 'change-transaction-password') {
                $validation_rules = [
                    'acc_password' => 'required',
                    'password' => 'required|max:32|min:6',
                    'confirm_password' => 'required|same:password',
                ];
                $validator = Validator::make($request->all(), $validation_rules);
                if ($validator->fails()) {
                    return Response::json([
                        'status' => false,
                        'errors' => $validator->errors(),
                        'message' => 'Please fix the following errors!'
                    ]);
                }
                $user = User::where('id', auth()->user()->id)->first();
                if (!Hash::check($request->acc_password, $user->password)) {
                    return Response::json([
                        'status' => false,
                        'errors' => ['acc_password' => 'Account password not matched'],
                        'message' => 'Please fix the following errors!'
                    ]);
                }
                $user->transaction_password = Hash::make($request->password);
                $update = $user->save();

                $company_info = CompanyInfo::select()->first();  

                $data = [
                    'client_name'               => $user->name,
                    'company_name'              => $company_info->com_name,  
                    'phone'                     => $user->phone,
                    'support_email'             => $company_info->support_email, 
                    'user_email'                => $user->email,   
                    'password'                  => $request->password
                ];

                MailService::mail($user->email, $data, 'Transaction Password Change', 'change-trasaction-password');

                if ($update) {
                    return Response::json([
                        'status' => true,
                        'message' => 'Password successfully updated!'
                    ]);
                }
                return Response::json([
                    'status' => false,
                    'message' => 'Somthing went wrong please try again later!'
                ]);
            }
            // notification settings
            if ($request->op === 'notification-settings') {
                if (NotificationSetting::where('user_id', auth()->user()->id)->exists()) {
                    $update = NotificationSetting::where('user_id', auth()->user()->id)->update([
                        'order_confirm' => ($request->order_confirm) ? $request->order_confirm : 0,
                        'new_item' => ($request->new_item) ? $request->new_item : 0,
                        'new_bid' => ($request->new_bid) ? $request->new_bid : 0,
                        'payment_card' => ($request->payment_card) ? $request->payment_card : 0,
                        'ending_bid' => ($request->ending_bid) ? $request->ending_bid : 0,
                        'approve_product' => ($request->approve_product) ? $request->approve_product : 0,
                    ]);
                } else {
                    $update = NotificationSetting::create([
                        'user_id' => auth()->user()->id,
                        'order_confirm' => ($request->order_confirm) ? $request->order_confirm : 0,
                        'new_item' => ($request->new_item) ? $request->new_item : 0,
                        'new_bid' => ($request->new_bid) ? $request->new_bid : 0,
                        'payment_card' => ($request->payment_card) ? $request->payment_card : 0,
                        'ending_bid' => ($request->ending_bid) ? $request->ending_bid : 0,
                        'approve_product' => ($request->approve_product) ? $request->approve_product : 0,
                    ]);
                }
                if ($update) {
                    return Response::json([
                        'status' => true,
                        'message' => 'Notification settings successfully updated'
                    ]);
                }
                return Response::json([
                    'status' => false,
                    'message' => 'Somthing went wrong please try again later!'
                ]);
            }
        }

        // get profile dat
        $user_data = User::where('id', auth()->user()->id)->first();
        $user_description = UserDescription::where('user_id', auth()->user()->id)->first();
        $country = Country::all();
        $notification_settings = NotificationSetting::where('user_id', auth()->user()->id)->first();

        $user_descriptions = UserDescription::where('user_id', auth()->user()->id)
            ->join('users', 'users.id', '=', 'user_descriptions.user_id')
            ->first();
        if (isset($user_descriptions->gender)) {
            $avatar = ($user_descriptions->gender === 'Male') ? 'avater-men.png' : 'avater-lady.png'; //<----avatar url
        } else {
            $avatar = 'avater-men.png';
        }
        $address_document_type = KycIdType::where('group', 'address proof')->get();
        $id_document_type = KycIdType::where('group', 'id proof')->get();
        return view(
            'users.profile-settings',
            [
                'profile' => $user_data,
                'user_description' => $user_description,
                'country' => $country,
                'notification_settings' => $notification_settings,
                'avatar' => $avatar,
                'id_document_type' => $id_document_type,
                'address_document_type' => $address_document_type
            ]
        );
    }
    public function login_profile(Request $request)
    {
        $mycollections = NftCollection::where('user_id', Auth::user()->id)->get(['name', 'id']);
        $user_data = User::where('id', auth()->user()->id)->first(); // login user details
        $SalesNFT = NftSale::select('asset_id', 'id')->where('seller_account', auth()->user()->id); //sales table NFT
        $mySalesNFT = $SalesNFT->join('nft_assets', 'nft_assets.id', '=', 'nft_sales.asset_id')
            ->join('nft_asset_images', 'nft_asset_images.nft_asset_id', '=', 'nft_assets.id')
            ->join('nft_asset_categories', 'nft_asset_categories.id', '=', 'nft_assets.category_id')
            ->select('nft_assets.*', 'nft_asset_images.image', 'nft_asset_categories.category', 'nft_asset_categories.slug');

        $MynftAssets = NftAsset::where('owner_id', auth()->user()->id)  // my own NFT
            ->join('nft_asset_images', 'nft_asset_images.nft_asset_id', '=', 'nft_assets.id')
            ->join('nft_asset_categories', 'nft_asset_categories.id', '=', 'nft_assets.category_id')
            ->select('nft_assets.*', 'nft_asset_images.image', 'nft_asset_categories.category', 'nft_asset_categories.slug');


        $myFavoriteNFT = favorites::where('favorite_by', auth()->user()->id) // my Favorites NFT
            ->join('nft_assets', 'nft_assets.id', '=', 'favorites.asset_id')
            ->join('nft_asset_images', 'nft_asset_images.nft_asset_id', '=', 'nft_assets.id')
            ->join('nft_asset_categories', 'nft_asset_categories.id', '=', 'nft_assets.category_id')
            ->select('nft_assets.*', 'nft_asset_images.image', 'nft_asset_categories.category', 'nft_asset_categories.slug');



        $myCreatedNFT = NftAsset::where('owner_id', auth()->user()->id)->where('sales_status', '!=', 'sold') // my Created NFT
            ->join('nft_asset_images', 'nft_asset_images.nft_asset_id', '=', 'nft_assets.id')
            ->join('nft_asset_categories', 'nft_asset_categories.id', '=', 'nft_assets.category_id')
            ->select('nft_assets.*', 'nft_asset_images.image', 'nft_asset_categories.category', 'nft_asset_categories.slug');

        $myCollection = NftCollection::where('user_id', auth()->user()->id)->get();



        return view('users.login-profile', [
            'user_data' => $user_data,
            'MynftAssets' => $MynftAssets->get(),
            'mySalesNFT' => $mySalesNFT->get(),
            'myFavoriteNFT' => $myFavoriteNFT->get(),
            'myCreatedNFT' => $myCreatedNFT->get(),
            'myCollection' => $myCollection,
            'mycollections' => $mycollections,
            'doct_folder' => 'Uploads/nft-assets/'
        ]);
    }

    public function profile(Request $request)
    {
        $user_id = $request->id;
        $user = User::where('id', $user_id);
        if ($user->count() != 0) {
            $user_data = $user->first(); // login user details
            $SalesNFT = NftSale::select('asset_id', 'id')->where('seller_account', $user_id); //sales table NFT
            $mySalesNFT = $SalesNFT->join('nft_assets', 'nft_assets.id', '=', 'nft_sales.asset_id')
                ->join('nft_asset_images', 'nft_asset_images.nft_asset_id', '=', 'nft_assets.id')
                ->join('nft_asset_categories', 'nft_asset_categories.id', '=', 'nft_assets.category_id')
                ->select('nft_assets.*', 'nft_asset_images.image', 'nft_asset_categories.category', 'nft_asset_categories.slug');

            $MynftAssets = NftAsset::where('owner_id', $user_id)  // my own NFT
                ->join('nft_asset_images', 'nft_asset_images.nft_asset_id', '=', 'nft_assets.id')
                ->join('nft_asset_categories', 'nft_asset_categories.id', '=', 'nft_assets.category_id')
                ->select('nft_assets.*', 'nft_asset_images.image', 'nft_asset_categories.category', 'nft_asset_categories.slug');


            $myFavoriteNFT = favorites::where('favorite_by', $user_id) // my Favorites NFT
                ->join('nft_assets', 'nft_assets.id', '=', 'favorites.asset_id')
                ->join('nft_asset_images', 'nft_asset_images.nft_asset_id', '=', 'nft_assets.id')
                ->join('nft_asset_categories', 'nft_asset_categories.id', '=', 'nft_assets.category_id')
                ->select('nft_assets.*', 'nft_asset_images.image', 'nft_asset_categories.category', 'nft_asset_categories.slug');



            $myCreatedNFT = NftAsset::where('owner_id', $user_id)->where('sales_status', '!=', 'sold') // my Created NFT
                ->join('nft_asset_images', 'nft_asset_images.nft_asset_id', '=', 'nft_assets.id')
                ->join('nft_asset_categories', 'nft_asset_categories.id', '=', 'nft_assets.category_id')
                ->select('nft_assets.*', 'nft_asset_images.image', 'nft_asset_categories.category', 'nft_asset_categories.slug');

            $myCollection = NftCollection::where('user_id', $user_id)->get();



            return view('users.profile', [
                'user_data' => $user_data,
                'MynftAssets' => $MynftAssets->get(),
                'mySalesNFT' => $mySalesNFT->get(),
                'myFavoriteNFT' => $myFavoriteNFT->get(),
                'myCreatedNFT' => $myCreatedNFT->get(),
                'myCollections' => $myCollection,
                'doct_folder' => 'Uploads/nft-assets/'
            ]);
        } else {
            $referer = request()->headers->get('referer');
            if (empty($referer)) {
                return redirect('/');
            } else {
                return redirect($referer);
            }
        }
    }
}
