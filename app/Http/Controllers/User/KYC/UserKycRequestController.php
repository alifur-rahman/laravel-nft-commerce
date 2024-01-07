<?php

namespace App\Http\Controllers\User\KYC;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\KycIdType;
use App\Models\KycVerification;
use App\Models\User;
use App\Models\UserDescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class UserKycRequestController extends Controller
{
    public function kycRequest(Request $request)
    {
        $op = $request->input('op');

        if ($op == "data_table") {
            return $this->kycRequestDT($request);
        }
        $user_status = "";
        $status = KycVerification::get();
        foreach ($status as $item) {
            $user_status = $item->status;
        }
        return view('users.kyc.user-kyc-request', ['status' => $user_status]);
    }
    public function kycRequestDT($request)
    {
        $draw = $request->input('draw');
        $start = $request->input('start');
        $length = $request->input('length');
        $order = $_GET['order'][0]["column"];
        $orderDir = $_GET["order"][0]["dir"];

        $columns = ['name', 'type', 'doc_type', 'exp_date', 'issue_date', 'status', 'created_at'];
        $orderby = $columns[$order];

        $result = KycVerification::select('kyc_verifications.*', 'kyc_verifications.id as table_id', 'users.id', 'users.type', 'users.name')
            ->join('users', 'kyc_verifications.user_id', '=', 'users.id')
            ->where('users.id',auth()->user()->id);

        $count = $result->count();
        $result = $result->orderby($orderby, $orderDir)->skip($start)->take($length)->get();
        $data = array();
        $i = 0;

        foreach ($result as $user) {
            // $edit_button = '';
            // if (auth()->user()->hasDirectPermission('edit kyc request')) {
            //     $edit_button = '<a href="#" data-bs-toggle="modal" data-bs-target="#updateProfileModal"  class="user-id" data-table_id="' . $user->table_id . '" data-id="' . $user->user_id . '" onclick="update_profile(this)"><i data-feather="edit" ></i></a>
            //     <a href="#" class="kyc-modal user-id" data-table_id="' . $user->table_id . '" data-id="' . $user->user_id . '"><i data-feather="eye" ></i></a>';
            // } else {
            //     $edit_button = '<span class="text-danger">No Permission to Access</span>';
            // }

            $document_name = KycIdType::select('id_type')->where('id', $user->doc_type)->first();


            if($user->type == 0){
                $client_type= "User";
            }
            if($user->type == 1){
                $client_type="Staff";
            }
            if($user->type == 2){
                $client_type="Admin";
            }
           $doc_type=KycIdType::select('id_type')->where('id',$user->doc_type)->first()->id_type;

            if($user->status == 0){
                $status='<td><span class="text-warning">Pending</span></td>';
            }
            elseif($user->status == 1){
                $status='<td><span class="color-green">Verified</span></td>';
            }
            elseif($user->status == 2){
                $status='<td><span class="color-danger">Declined</span></td>';
            }
            // ($user)?$user->name:'Fxcrm User';
            $data[$i]['client_name']   = '<td><span>'.$user->name.'</span></td>';
            $data[$i]['client_type']   = '<td><span>'.$client_type.'</span></td>';
            $data[$i]['document_type'] = '<td><span>'.$document_name->id_type ?: null.'</span></td>';
            $data[$i]['issue_date']    = '<td><span>'.date('d F y, h:i A', strtotime($user->issue_date)).'</span></td>';
            $data[$i]['expire_date']   = '<td><span>'.date('d F y, h:i A', strtotime($user->exp_date)).'</span></td>';
            $data[$i]['status']        = $status;
            $data[$i]['date']          = date('d F y', strtotime($user->created_at));
            $data[$i]['action']        =  '<button   data-type="button"  class="btn btn-primary waves-effect waves-float waves-light btn-small user-id" data-bs-toggle="modal" data-bs-target="#updateProfileModal"  data-loading="processing..." data-table_id="' . $user->table_id . '" data-id="' . $user->user_id . '" 
                                        style="margin-top: -17px"   onclick="update_profile(this)">Edit</button> 
            
                                        <button   data-type="button"  class="btn btn-info waves-effect waves-float waves-light btn-small kyc-modal user-id" data-bs-toggle="modal" data-bs-target="#userDescriptionModel" class="kyc-modal user-id" data-table_id="' . $user->table_id . '" data-id="' . $user->user_id . '"
                                        style="margin-top: -17px">View</button>';
                                        ;
            // '<a href="#" data-bs-toggle="modal" data-bs-target="#updateProfileModal"  class="user-id" data-table_id="' . $user->table_id . '" data-id="' . $user->user_id . '" onclick="update_profile(this)">Edit</a>
            //             <a href="#" class="kyc-modal user-id" data-table_id="' . $user->table_id . '" data-id="' . $user->user_id . '">View</a>
            //             ';

            $i++;
        }
        $output = array('draw' => $_REQUEST['draw'], 'recordsTotal' => $count, 'recordsFiltered' => $count);
        $output['data'] = $data;

        return Response::json($output);
    }
      //-------------------KYC profile Update---------------------->
      public function kycProfileUpdate(Request $request)
      {
       
          $user_id = $request->data_id;
          $user_name = $request->input('name');
          $user_state = $request->input('state');
          $country_id = $request->country;
     
          $user_zip = $request->input('zip');
          $user_city = $request->input('city');
          $user_dob = $request->input('dob');
          $user_address = $request->input('address');
          $user_issue_date = $request->input('issue_date');
          $user_expire_date = $request->input('expire_date');
  
  
          $validation_rules = [
              'name' => 'required',
              'state' => 'required',
              'country' => 'required',
              'zip' => 'required',
              'city' => 'required',
              'dob' => 'required',
              'address' => 'required',
              'expire_date' => 'required',
              'issue_date' => 'required',
          ];
          $validator = Validator::make($request->all(), $validation_rules);
          if ($validator->fails()) {
              if ($request->ajax()) {
                  return Response::json(['success' => false, 'errors' => $validator->errors()]);
              }
          } else {
              //user description update
              $user_data = User::where('id', $user_id)->update(['name' => $user_name]);
              $KycVerification = KycVerification::where('user_id', $user_id)->update(['issue_date' => $user_issue_date, 'exp_date' => $user_expire_date]);
              $Description = UserDescription::where('user_id', $user_id)
                  ->update([
                      'state' => $user_state,
                      'city' => $user_city,
                      'address' => $user_address,
                      'zip_code' => $user_zip,
                      'date_of_birth' => $user_dob
                  ]);
  
  
              //user country update
              $user_des = UserDescription::where('user_id', $request->data_id)->first();
              if(isset($user_des)){
                  // dd($user_des);
                  $user_des->country_id = $country_id;
                  $user_des->save();
              }
  
              else{
                  $user_des->country_id = $country_id;
                  $user_des->save();
              }
             
  
              //<-----------Mail Script-------------------->
              // $user = User::find($user_id);
              // $support_email = SystemConfig::select('support_email')->first();
  
              // $support_email = ($support_email) ? $support_email->support_email : 'support@fxcrm.net';
              // $email_data = [
              //     'name'              => ($user) ? $user->name : 'Fxcrm User',
              //     'account_email'     => ($user) ? $user->email : '',
              //     'admin'             => Auth::user()->name,
              //     'login_url'         => route('login'),
              //     'support_email'     => $support_email,
  
              // ];
  
              // Mail::to($user->email)->send(new UserKycUpdate($email_data));
              if ($user_data && $KycVerification && $Description) {
                  return Response::json(['success' => true, 'message' => 'Profile Successfully Updated ', 'success_title' => 'Profile Updated']);
              } else {
                  return Response::json(['success' => false, 'message' => 'Profile Update Failed, Please try again later!', 'success_title' => 'Failed To Update!']);
              }
          }
      }
  
  
      public function kycRequestDescription(Request $request, $id, $table_id)
      {
          $user_info = User::select()->where('users.id', $id)
              ->join('user_descriptions', 'users.id', '=', 'user_descriptions.user_id')->first();
          $user_kyc_sts = KycVerification::select()->where('id', $table_id)->first();
  
          $user_country = Country::select('name')->where('id', $user_info->country_id)->first();
  
          $kyc_id_type = KycIdType::select('id_type', 'group')->where('id', $user_kyc_sts->doc_type)->first();
  
          $document_images = json_decode($user_kyc_sts->document_name);
          $image_path = "uploads/kyc";
          $status = 0;
          if ($user_kyc_sts->status == 0) {
              $status = '<span class="text-warning">Pending</span>';
          }
          if ($user_kyc_sts->status == 1) {
              $status = '<span class="text-success">Verified</span>';
          }
  
          if ($user_kyc_sts->status == 2) {
              $status = '<span class="text-danger">Decliend</span>';
          }
  
          $data = [
              'dob' => date('Y-m-d', strtotime($user_info->date_of_birth)),
              'issue_date' => date('Y-m-d', strtotime($user_info->issue_date)),
              'exp_date' => date('Y-m-d', strtotime($user_info->exp_date)),
              'document_name' => $kyc_id_type->id_type,
              'group_name' => $kyc_id_type->group,
              'image_path' => $image_path,
              'images' => $document_images,
              'status' => $status,
              'country' =>  $user_country,
              'user' => $user_info,
              'user_kyc_sts' => $user_kyc_sts->status
          ];
  
          return response()->json($data);
      }
  
      public function kycApproveRequest(Request $request, $id, $table_id)
      {
         
          // return $request->$table_id;
          // $user = User::find($id);
          // $support_email = SystemConfig::select('support_email')->first();
          // $support_email = ($support_email) ? $support_email->support_email : 'support@fxcrm.net';
          // $email_data = [
          //     'name'              => ($user) ? $user->name : 'Fxcrm User',
          //     'account_email'     => ($user) ? $user->email : '',
          //     'admin'             => Auth::user()->name,
          //     'login_url'         => route('login'),
          //     'support_email'     => $support_email,
  
          // ];
  
          $update = KycVerification::where('id', $table_id)->update(['status' => 1]);
          if ($update) {
              // if (Mail::to($user->email)->send(new KycApproveRequest($email_data))) {
              return Response::json(['success' => true, 'message' => 'Mail successfully sended for Approved request', 'success_title' => 'Approve request']);
              } 
          else {
              return Response::json(['success' => false, 'message' => 'Mail sending failed, Please try again later!', 'success_title' => 'Approve request']);
          }
      }
  
  
       //-------------update form value show-------------------------
       public function kycRequestProfile(Request $request, $id)
       {
           $user_info = User::select()->where('users.id', $id)
               ->join('kyc_verifications', 'users.id', '=', 'kyc_verifications.user_id')
               ->join('user_descriptions', 'users.id', '=', 'user_descriptions.user_id')->first();
   
           $user_country = Country::select('name')->where('id', $user_info->country_id)->first();
           $date_of_birth = date('Y-m-d', strtotime($user_info->date_of_birth));
           $issue_date = date('Y-m-d', strtotime($user_info->issue_date));
           $exp_date = date('Y-m-d', strtotime($user_info->exp_date));
   
   
           $countries = Country::all();
           $country_options = '';
           foreach ($countries as $key => $value) {
               $selected = ($value->id == $user_info->country_id) ? 'selected' : "";
               $country_options .= '<option value="' . $value->id . '" ' . $selected . '>' . $value->name . '</option>';
           }
   
           $data = [
               'exp_date' => $exp_date,
               'dob' => $date_of_birth,
               'issue_date' => $issue_date,
               'user_country' =>  $user_country,
               'user_info' => $user_info,
               'country_option' => $country_options
           ];
   
           return response()->json($data);
       }
  
  
       public function kycDeclineRequest(Request $request)
       {
           $user_id = $request->kyc_decline_id;
           $tbl_id = $request->tbl_id;
           // dd($tbl_id);
           // dd($table_id);
          //  $user = User::find($user_id);
          //  $support_email = SystemConfig::select('support_email')->first();
          //  $support_email = ($support_email) ? $support_email->support_email : 'support@fxcrm.net';
          //  $email_data = [
          //      'name'              => ($user) ? $user->name : 'Fxcrm User',
          //      'account_email'     => ($user) ? $user->email : '',
          //      'admin'             => Auth::user()->name,
          //      'login_url'         => route('login'),
          //      'support_email'     => $support_email,
   
          //  ];
   
           $reason = $request->input('kyc_decline_id');
           $update = KycVerification::where('id', $tbl_id)->update(['status' => 2, 'note' => $reason]);
           if ($update) {
                   return Response::json(['success' => true, 'message' => 'Mail successfully sended for Declined request', 'success_title' => 'Declined request']);
           }
           else{
              return Response::json(['success' => false, 'message' => 'Mail sending failed, Please try again later!', 'success_title' => 'Declined request']);
           }
       }
}
