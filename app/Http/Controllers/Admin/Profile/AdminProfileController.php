<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Models\Log;
use App\Models\User;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Models\SocialAccount;
use App\Models\UserDescription;
use App\Http\Controllers\Controller;
use App\Services\GoogleAuthService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class AdminProfileController extends Controller
{
    public function profileSetting()
    {
        $user_id = 1;
        $user_descriptions = UserDescription::where('user_id', auth()->user()->id)
            ->join('users', 'users.id', '=', 'user_descriptions.user_id')
            ->first();
        if (isset($user_descriptions->gender)) {
            $avatar = ($user_descriptions->gender === 'Male') ? 'avater-men.png' : 'avater-lady.png'; //<----avatar url
        } else {
            $avatar = 'avater-men.png';
        }
        $country_name = Country::select('name')->where('id', $user_descriptions->country_id)->first()->name;

        // get all countries
        // --------------------------------------------------------------------------------------------------------
        $countries = Country::all();
        $country_options = '';
        foreach ($countries as $key => $value) {
            $selected = ($value->id == $user_descriptions->country_id) ? 'selected' : "";
            $country_options .= '<option value="' . $value->id . '" ' . $selected . '>' . $value->name . '</option>';
        }
        $social_link = SocialAccount::select()->where('user_id', auth()->user()->id)->first();
        // security setting
        $users = User::find(auth()->user()->id)->first();
        return view(
            'admin.profile.admin-manage-profile',
            [
                'avatar'            => $avatar,
                'country_options'   => $country_options,
                'user'              => $user_descriptions,
                'country'           => $country_name,
                'link'              => $social_link,
                'users'             => $users
            ]
        );
    }

    public function updateProfile(Request $request)
    {

        $validation_rules = [
            'name' => 'min:4|max:191',
            'email' => 'min:4|max:191',
            'phone' => 'min:10|max:20',
            'country' => 'required',
            'current_password' => 'min:6',
        ];

        $user_id = auth()->user()->id;
        $user = User::select()->where('id', $user_id)->first();
        $current_pass = $request->current_password;
        $check = Hash::check($current_pass, $user->password);

        $validator = Validator::make($request->all(), $validation_rules);
        if ($validator->fails()) {
            return Response::json([
                'status' => false,
                'errors' => $validator->errors(),
                'message' => 'Please fix the following errors'
            ]);
        } else if (!$check) {
            return Response::json([
                'status' => false,
                'errors' => $validator->errors(),
                'message' => 'Current Password Not Matched'
            ]);
        } else {

            //social info update or create
            $skype      = ($request->skype) ? $request->skype : '';
            $whatsapp   = ($request->whatsapp) ? $request->whatsapp : '';
            $linkedin   = ($request->linkedin) ? $request->linkedin : '';
            $facebook   = ($request->facebook) ? $request->facebook : '';
            $twitter    = ($request->twitter) ? $request->twitter : '';

            if (!empty($request->new_password) || !empty($request->confirm_password)) { //check validation for change  password
                $validation_rules = [
                    'new_password' => 'required|min:6|same:confirm_password',
                    'confirm_password' => 'required|min:6',
                ];
                $validator = Validator::make($request->all(), $validation_rules);
                if ($validator->fails()) {
                    return Response::json([
                        'status' => false,
                        'errors' => $validator->errors(),
                        'message' => 'Please fix the following errors'
                    ]);
                } else {
                    //pass hash and encrypted
                    $newpass = $request->new_password;
                    $hash_password = Hash::make($newpass);
                    $encrpt_password = encrypt($newpass);

                    $country = UserDescription::select()->where('user_id', $user_id)->first();
                    $user_log = Log::select()->where('user_id', $user_id)->first();

                    if (($user && $country && $user_log) !== null) {
                        //user info update
                        $user->name = $request->name;
                        $user->email = $request->email;
                        $user->phone = $request->phone;
                        $user->password = $hash_password;
                        $update = $user->save();
                        //logs table update
                        $user_log->password = $encrpt_password;
                        if (isset($user_log)) {
                            $update = $user_log->save();
                        }
                        //country update
                        $country->country_id = $request->country;
                        $update = $country->save();

                        $update     = SocialAccount::updateOrCreate(
                            [
                                'user_id' => $user_id
                            ],
                            [
                                'skype'    => $skype,
                                'whatsapp' => $whatsapp,
                                'linkedin' => $linkedin,
                                'facebook' => $facebook,
                                'twitter'  => $twitter,
                            ]
                        );

                        if ($update) {
                            return Response::json([
                                'status' => true,
                                'message' => 'Successfully Updated'
                            ]);
                        }
                    }
                }
            } else {
                $country = UserDescription::select()->where('user_id', $user_id)->first();
                $user_log = Log::select()->where('user_id', $user_id)->first();

                if (($user && $country && $user_log) !== null) {
                    //user info update
                    $user->name = $request->name;
                    $user->email = $request->email;
                    $user->phone = $request->phone;
                    $update = $user->save();
                    //logs table update
                    if (isset($user_log)) {
                        $update = $user_log->save();
                    }

                    //country update
                    $country->country_id = $request->country;
                    $update = $country->save();

                    $update     = SocialAccount::updateOrCreate(
                        [
                            'user_id' => $user_id
                        ],
                        [
                            'skype'    => $skype,
                            'whatsapp' => $whatsapp,
                            'linkedin' => $linkedin,
                            'facebook' => $facebook,
                            'twitter'  => $twitter,
                        ]
                    );

                    if ($update) {
                        return Response::json([
                            'status' => true,
                            'message' => 'Successfully Updated'
                        ]);
                    }
                }
            }
        }
    }

    // update security settings
    public function securitySettingUpdate(Request $request, $check_auth)
    {
        $update = "";
        if ($check_auth == "no_auth") {
            $update = User::where('id', auth()->user()->id)->update([
                'g_auth' => 0,
                'email_auth' => 0,
                'secret_key' => ""
            ]);
        } else if ($check_auth = "mail_auth") {
            $update = User::where('id', auth()->user()->id)->update([
                'g_auth' => 0,
                'email_auth' => 1,
                'secret_key' => ""
            ]);
        }
        if ($update) {
            if ($request->ajax()) {
                return Response::json(['success' => true, 'message' => 'Successfully Updated.']);
            } else {
                return Redirect()->back()->with(['success' => true, 'message' => 'Successfully Updated.']);
            }
        } else {
            if ($request->ajax()) {
                return Response::json(['success' => false, 'message' => 'Failed To Update!']);
            } else {
                return Redirect()->back()->with(['success' => false, 'message' => 'Failed To Update!']);
            }
        }
    }
    // update security settings
    public function googleAuthenticationUpdate(Request $request)
    {
        $user_id = $request->user_id;
        $secret_key = $request->secret_key;
        $v_code = $request->v_code;
        $ga = new GoogleAuthService();
        $checkResult = $ga->verifyCode($secret_key, $v_code, 2);
        if ($checkResult) {

            $update = User::where('id', $user_id)->update([
                'g_auth' => 1,
                'email_auth' => 0,
                'secret_key' => $secret_key
            ]);
            if ($update) {
                if ($request->ajax()) {
                    return Response::json(['success' => true, 'message' => 'Successfully Updated.']);
                } else {
                    return Redirect()->back()->with(['success' => true, 'message' => 'Successfully Updated.']);
                }
            } else {
                if ($request->ajax()) {
                    return Response::json(['success' => false, 'message' => 'Failed To Update!']);
                } else {
                    return Redirect()->back()->with(['success' => false, 'message' => 'Failed To Update!']);
                }
            }
        } else {
            if ($request->ajax()) {
                return Response::json(['success' => false, 'message' => 'Failed To Update!']);
            } else {
                return Redirect()->back()->with(['success' => false, 'message' => 'Failed To Update!']);
            }
        }
    }
}
