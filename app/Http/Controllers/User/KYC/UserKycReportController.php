<?php

namespace App\Http\Controllers\User\KYC;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\KycIdType;
use App\Models\KycVerification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class UserKycReportController extends Controller
{
    public function UserkycReport(Request $request){
        $op = $request->input('op');

        if ($op == "data_table") {
            return $this->kycReportDT($request);
        }
        return view('users.kyc.user-kyc-report');
    }
    public function kycReportDT($request){
        $draw = $request->input('draw');
        $start = $request->input('start');
        $length = $request->input('length');
        $order = $_GET['order'][0]["column"];
        $orderDir = $_GET["order"][0]["dir"];

        $columns = ['name','doc_type','exp_date', 'issue_date','status','created_at'];
        $orderby = $columns[$order];
      
       
        $result =KycVerification::select('kyc_verifications.*','users.name')
                        ->join('users','kyc_verifications.user_id','=','users.id')
                        ->where('users.id',auth()->user()->id);
                       
       
        $count = $result->count();
        $result = $result->orderby($orderby, $orderDir)->skip($start)->take($length)->get();
        $data = array();
        $i = 0;

        foreach ($result as $user) {
   
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
    
            $data[$i]['issue_date']    = '<td><span>'.date('d F y, h:i A', strtotime($user->issue_date)).'</span></td>';
            $data[$i]['expire_date']   = '<td><span>'.date('d F y, h:i A', strtotime($user->exp_date)).'</span></td>';
            $data[$i]['status']        = $status;
            // $data[$i]['date']          = '<td><span>'.date('d F y, h:i A', strtotime($user->created_at)).'</span></td>';
            $data[$i]['action']        = '<button   data-type="button"  class="btn btn-primary waves-effect waves-float waves-light btn-small mt-0" data-bs-toggle="modal" data-bs-target="#kt_modal_upgrade_plan"  data-loading="processing..."  data-id="'.$user->user_id.'"   data-table_id="'.$user->id.'" 
                                            style="margin-top: -10px; width: 65px"  onclick="view_document(this)" >View</button>';
            
            $i++;
        }
        $res['draw'] = $draw;
        $res['recordsTotal'] = $count;
        $res['recordsFiltered'] = $count;
        $res['data'] = $data;
        return Response::json($res);
    }

    public function UserviewDescription(Request $request, $id,$table_id){
    
            $user_info = User::select()->where('users.id', $id)
            ->join('user_descriptions', 'users.id', '=', 'user_descriptions.user_id')->first();
        $user_kyc_sts = KycVerification::select()->where('id', $table_id)->first();

        $user_country = Country::select('name')->where('id', $user_info->country_id)->first();

        $kyc_id_type = KycIdType::select('id_type', 'group')->where('id', $user_kyc_sts->doc_type)->first();

        $document_images = json_decode($user_kyc_sts->document_name);
        $front_part = asset('Uploads/kyc/'.$document_images->front_part);
        $back_part = asset('Uploads/kyc/'.$document_images->back_part);
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
            'front_part' => $front_part,
            'back_part' => $back_part,
            'images' => $document_images,
            'status' => $status,
            'country' =>  $user_country,
            'user' => $user_info,
            'user_kyc_sts' => $user_kyc_sts->status
        ];

        return response()->json($data);
        }

}
