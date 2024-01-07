<?php

namespace App\Http\Controllers\User\KYC;

use App\Http\Controllers\Controller;
use App\Models\KycIdType;
use App\Models\KycVerification;
use App\Models\User;
use App\Models\UserDescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserKycUploadController extends Controller
{

    public function index(Request $request)
    {
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
        return view('users.profile-settings', [
            'avatar' => $avatar,
            'id_document_type' => $id_document_type,
            'address_document_type' => $address_document_type
        ]);
    }
    public function search_client(Request $request, $user_type, $value)
    {
        $users = User::where('type', $user_type)
            ->where('name', 'like', '%' . $value . '%')
            ->orWhere('email', 'like', '%' . $value . '%')->limit(5)
            ->get();
        $client_options = '';
        foreach ($users as $value) :
            $client_options .= '<a href="#' . $value->email . '" class="fill-input" data-value="' . $value->email . '">
                                ' . $value->email . '
                            </a>';
        endforeach;
        $data = [
            'status' => true,
            'users' => $client_options
        ];
        return Response::json($data);
    }
    public function file_upload(Request $request)
    {
        if ($request->perpose === 'address proof') {
            $validation_rules = [
                'document_type' => 'required',
                'issue_date' => 'required',
                'expire_date' => 'required',
                'file_document' => 'required',
            ];
        }
        // id proof
        else {
            $validation_rules = [
                'document_type' => 'required',
                'issue_date' => 'required',
                'expire_date' => 'required',
                'file_front_part' => 'required',
                'file_back_part' => 'required',
            ];
        }

        $validator = Validator::make($request->all(), $validation_rules);
        if ($validator->fails()) {
            return Response::json([
                'status' => false,
                'errors' => $validator->errors(),
                'message' => 'Please fix the following errors!'
            ]);
        } else {
            // address proof
            if ($request->perpose === 'address proof') {
                $check_exist = KycVerification::where('user_id', auth()->user()->id)->where('status', '!=', 2)->where('perpose', 'address proof')->exists();
                if ($check_exist) {
                    return Response::json([
                        'status' => false,
                        'message' => 'KYC already exist for address proof, Please contact your manger'
                    ]);
                } else {

                    $address_document = $request->file('file_document')[0];
                    $filename_address = time() . '_address_document_' . $address_document->getClientOriginalName();
                    $address_document->move(public_path('/Uploads/kyc'), $filename_address);


                    // $user = User::where('email', $request->client_email)->first();
                    $created = KycVerification::create([
                        'user_id' => auth()->user()->id,
                        'issue_date' => $request->issue_date,
                        'exp_date' => $request->expire_date,
                        'doc_type' => $request->document_type,
                        'perpose' => $request->perpose,
                        'document_name' => json_encode(['front_part' => $filename_address, 'back_part' => ''])
                    ])->id;
                }
            }
            // id proof
            else {
                $check_exist = KycVerification::where('user_id', auth()->user()->id)->where('status', '!=', 2)->where('perpose', 'id proof')->exists();
                if ($check_exist) {
                    return Response::json([
                        'status' => false,
                        'message' => 'KYC already exist for ID proof, Please contact your manager'
                    ]);
                } else {

                    $front_part = $request->file('file_front_part')[0];
                    $filename_front_part = time() . '_id_front_part_' . $front_part->getClientOriginalName();
                    $front_part->move(public_path('/Uploads/kyc'), $filename_front_part);

                    $back_part = $request->file('file_back_part')[0];
                    $filename_back_part = time() . '_id_back_part_' . $back_part->getClientOriginalName();
                    $back_part->move(public_path('/Uploads/kyc'), $filename_back_part);

                    $document_name = [
                        'front_part' => $filename_front_part,
                        'back_part' => $filename_back_part
                    ];

                    $created = KycVerification::create([
                        'user_id' => auth()->user()->id,
                        'issue_date' => $request->issue_date,
                        'exp_date' => $request->expire_date,
                        'doc_type' => $request->document_type,
                        'perpose' => $request->perpose,
                        'document_name' => json_encode($document_name)
                    ])->id;
                }
            }
            if ($created) {
                // insert activity-----------------
                // activity($request->perpose . " Kyc Upload")
                //     ->causedBy(1)
                //     ->withProperties(KycVerification::find($created))
                //     ->event('ib verification')
                //     // ->performedOn(auth()->user())
                //     ->log("The IP address " . request()->ip() . " has been upload kyc");
                // end activity log-----------------
                return Response::json([
                    'status' => true,
                    'message' => 'KYC Success fully uploaded'
                ]);
            }
            return Response::json([
                'status' => false,
                'message' => 'Something went wrong please try again later'
            ]);
        }
    }

    // ============================================================================
    // submit and store kyc data to dtabase
    // -------------------------------------------------------------------------------------------
    public function store(Request $request)
    {
        $multiple_submission = false;
        $validation_rules = [
            'document_type' => 'required',
            'client_type' => 'required',
            'client' => 'required',
            'status' => 'required',
            'id_type' => 'required',
        ];

        // id proof validation
        if ($request->document_type === 'id proof') {
            // front part validation
            if (Session::has('front_part')) {
                $validation_rules['front_part'] = 'nullable';
            } else {
                $validation_rules['front_part'] = 'required';
            }

            // back part validatioln
            if (Session::has('back_part')) {
                $validation_rules['back_part'] = 'nullable';
            } else {
                $validation_rules['back_part'] = 'required';
            }
        }

        // address proof validation
        if ($request->document_type === 'address proof') {
            if (Session::has('address_proof')) {
                $validation_rules['address_proof'] = 'nullable';
            } else {
                $validation_rules['address_proof'] = 'required';
            }
        }

        // note or decline validation
        if ($request->status == 2) {
            $validation_rules['decline_reason'] = 'nullable|min:10|max:100';
        }

        $validator = Validator::make($request->all(), $validation_rules);
        if ($validator->fails() || $multiple_submission == true) {
            if ($request->ajax()) {
                return Response::json(['status' => false, 'errors' => $validator->errors(), 'multiple_submission' => $multiple_submission, 'submit_wait' => submit_wait('finance-balance', 60)]);
            }
        } else {
            $document_name = [];
            if ($request->document_type === 'address proof') {
                $document_name['address_proof'] = session()->get('address_proof');
            }
            // document name for id proof
            if ($request->document_type === 'id proof') {
                $document_name['front_part'] = session()->get('front_part');
                $document_name['back_part'] = session()->get('back_part');
            }
            $data = [
                'user_id' => $request->client,
                'status' => $request->status,
                'perpose' => $request->document_type,
                'doc_type' => $request->id_type,
                'document_name' => json_encode($document_name),
                'approved_by' => auth()->user()->id
            ];
            if (isset($request->decline_reason)) {
                $data['note'] = $request->decline_reason;
            }
            if (isset($request->issue_date)) {
                $data['issue_date'] = $request->issue_date;
            }
            if (isset($request->expire_date)) {
                $data['exp_date'] = $request->exp_date;
            }
            $create = KycVerification::create($data)->id;
            if ($create) {
                $request->session()->forget('address_proof');
                $request->session()->forget('front_part');
                $request->session()->forget('back_part');
                return Response::json(['status' => true, 'kyc_decline' => ($request->status == 2) ? true : false, 'last_id' => $create, 'message' => 'KYC Uploaded successfully', 'multiple_submission' => $multiple_submission, 'submit_wait' => submit_wait('finance-balance', 60)]);
            } else {
                return Response::json(['status' => false, 'message' => 'KYC Upload failed', 'multiple_submission' => $multiple_submission, 'submit_wait' => submit_wait('finance-balance', 60)]);
            }
        }
    }

    // ================================================================================
    // sending mail for kyc decline
    // mail to users, why decline the email
    // --------------------------------------------------------------------------------
    // public function kyc_decline_mail(Request $request)
    // {
    //     $kyc = KycVerification::find($request->last_id);
    //     $user = User::find($kyc->user_id);
    //     // return $user;
    //     $support_email = SystemConfig::select('support_email')->first();
    //     $support_email = ($support_email) ? $support_email->support_email : 'support@fxcrm.net';
    //     $email_data = [
    //         'name' => ($user) ? $user->name : 'Fxcrm User',
    //         'account_email' => ($user) ? $user->email : '',
    //         'admin' => auth()->user()->name,
    //         'login_url' => route('login'),
    //         'support_email' => $support_email,
    //         'message_custom' => (isset($kyc->note)) ? $kyc->note : '',
    //         'phone' => ($user) ? $user->phone : ''
    //     ];
    //     if (Mail::to($user->email)->send(new KycDecline($email_data))) {
    //         if ($request->ajax()) {
    //             return Response::json(['status' => true, 'message' => 'Mail successfully sended for kyc decline reason', 'success_title' => 'Change password']);
    //         }
    //     } else {
    //         return Response::json(['status' => false, 'message' => 'Mail sending failed, Please try again later!', 'success_title' => 'Change password']);
    //     }
    // }
}
