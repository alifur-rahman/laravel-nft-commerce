<?php

namespace App\Http\Controllers;

use App\Mail\VerificationMail;
use App\Models\ContactUs;
use App\Models\NftAsset;
use App\Models\Subscription;
use App\Models\User;
use App\Models\NftAssetCategory;
use App\Models\NftCollection;
use App\Models\Report;
use App\Services\AllfunctionService;
use App\Services\MailService;
use Faker\Provider\ar_EG\Company;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class CommonController extends Controller
{
    public function privacy_policy(Request $request)
    {
        return view('privacy-policy');
    }
    // about us
    public function about_us(Request $request)
    {
        return view('about-us');
    }
    // contact us
    public function contact_us(Request $request)
    {
        return view('contact-us');
    }

    public function supportMessage(Request $request)
    {
        if ($request->ajax()) {
            $validation_rules = [
                'name' => 'required|max:100',
                'email' => 'required|unique:users|email',
                'subject' => 'required|max:100',
                'message' => 'required|max:200',
            ];
            $validator = Validator::make($request->all(), $validation_rules);
            if ($validator->fails()) {
                return Response::json([
                    'status' => false,
                    'errors' => $validator->errors(),
                    'message' => 'Please fix the following errors!'
                ]);
            } else {
                $data = $request->all();
                $contact_us = ContactUs::create($data);
                if ($contact_us) {
                    return Response::json([
                        'status' => true,
                        'message' => 'Your Message Send Successfully',
                    ]);
                } else {
                    return Response::json([
                        'status' => false,
                        'message' => 'Message sent Falied!'
                    ]);
                }
            }
        }
    }
    public function all_product(Request $request)
    {
        $categorys = NftAssetCategory::all();
        $NftAsset = NftAsset::paginate(10);

        if (Auth::check()) {
            $mycollections = NftCollection::where('user_id', Auth::user()->id)->get(['name', 'id']);
        } else {
            $mycollections = [];
        }

        return view('all-products', ['nftasset'=>$NftAsset,'categorys'=>$categorys,'mycollections'=>$mycollections]);
    }
    // suppor faq
    public function support_faq(Request $request)
    {
        return view('support-faq');
    }
    // terms and condition
    public function terms_condition(Request $request)
    {
        return view('terms-condition');
    }
    // comming soon
    public function comming_soon(Request $request)
    {
        return view('comming-soon');
    }
    public function forum_details(Request $request)
    {
        return view('forum-details');
    }
    // news later
    public function news_later(Request $request)
    {
        return view('news-later');
    }
    // connect to wallet
    public function connect_to_wallet(Request $request)
    {
        return view('connect-to-wallet');
    }

    // subscribe operation
    public function subscription(Request $request)
    {
        if ($request->ajax()) {
            $validation_rules = [
                'email' => 'required|unique:users|unique:subscriptions|email'
            ];
            $validator = Validator::make($request->all(), $validation_rules);
            $exists = User::where('email', $request->email)->first();

            if ($validator->fails()) {
                return Response::json([
                    'status' => false,
                    'errors' => $validator->errors(),
                    'message' => 'Please fix the following errors!'
                ]);
            } elseif ($exists) {
                return Response::json([
                    'status' => false,
                    // 'errors' => $exists->errors(),
                    'message' => 'Your Email has already taken'
                ]);
            } else {
                $data = $request->all();
                $contact_us = Subscription::create($data);
                if ($contact_us) {
                    return Response::json([
                        'status' => true,
                        'message' => 'Subscribed Successfully',
                    ]);
                } else {
                    return Response::json([
                        'status' => false,
                        'message' => 'Subscription Failed!'
                    ]);
                }
            }
        }
    }
    // test a mail
    public function test_mail(Request $request)
    {
        MailService::mail('shakilsb4646@gmail.com','["nice"]','Google login info','google-login-email');
        return true;
    }

    // report nft

    public function report(Request $request)
    {
        if ($request->ajax()) {
            $validation_rules = [
                'message' => 'required'
            ];
            $validator = Validator::make($request->all(), $validation_rules);

            $check_exit = Report::where('user_id', auth()->user()->id)->where('asset_id', $request->asset_id)->first();

            if ($validator ->fails()) {
                return Response::json([
                    'status' => false,
                    'errors' => $validator->errors(),
                    'message' => 'Please fix the following errors!'
                ]);
            }elseif(!empty($check_exit)){
                return Response::json([
                    'status' => false,
                    // 'errors' => $validator->errors(),
                    'message' => 'Already you reported this post'
                ]);
            }else {
                $data = Report::create([
                    'user_id' => auth()->user()->id,
                    'asset_id' => $request->asset_id,
                    'message' => $request->message,
                ]);

                if ($data) {
                    return Response::json([
                        'status' => true,
                        // 'errors' => $validator->errors(),
                        'message' => 'Thank you for your feedback'
                    ]);
                }
            }
        }
    }

}
