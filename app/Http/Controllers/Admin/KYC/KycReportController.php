<?php

namespace App\Http\Controllers\Admin\KYC;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\KycIdType;
use App\Models\KycVerification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class KycReportController extends Controller
{
    public function kycReport(Request $request){
        $op = $request->input('op');

        if ($op == "data_table") {
            return $this->kycReportDT($request);
        }
        return view('admin.kyc.kyc-report');
    }

    public function kycReportDT($request){
        $id_type = $request->input('type');
        $client_type = $request->input('client_type');
        $status = $request->input('status');
        $info = $request->input('info');
        $from = $request->input('from');
        $to = $request->input('to');
        $issue_from = $request->input('issue_from');
        $issue_to = $request->input('issue_to');
        $expire_from = $request->input('expire_from');
        $expire_to = $request->input('expire_to');

        $draw = $request->input('draw');
        $start = $request->input('start');
        $length = $request->input('length');
        $order = $_GET['order'][0]["column"];
        $orderDir = $_GET["order"][0]["dir"];

        $columns = ['name','type','doc_type','exp_date', 'issue_date','status','created_at'];
        $orderby = $columns[$order];
      
       
        $result =KycVerification::select('kyc_verifications.*','users.type','users.name','kyc_id_type.id_type')
                        ->join('users','kyc_verifications.user_id','=','users.id')
                        ->join('kyc_id_type','kyc_verifications.doc_type','=','kyc_id_type.id');
                        
                       
        /*<-------filter search script start here------------->*/
        if ($id_type != "") {
            $result = $result->where('id_type', '=', $id_type);
        }
        if ($status != "") {
            $result = $result->where('status', '=', $status);
        }


        if ($info != "") {
            $result = $result->where('name', 'LIKE', '%' . $info . '%')->orwhere('email', 'LIKE', '%' . $info . '%');
        }

        if ($issue_from != "") {
            $result = $result->whereDate("kyc_verifications.issue_date", '>=', $issue_from);
        }

        if ($issue_to != "") {
            $result = $result->whereDate("kyc_verifications.issue_date", '<=', $issue_to);
        }

        if ($expire_from != "") {
            $result = $result->whereDate("kyc_verifications.exp_date", '>=', $expire_from);
        }

        if ($expire_to != "") {
            $result = $result->whereDate("kyc_verifications.exp_date", '<=', $expire_to);
        }

        if ($from != "") {
            $result = $result->whereDate("kyc_verifications.created_at", '>=', $from);
        }

        if ($to != "") {
            $result = $result->whereDate("kyc_verifications.created_at", '<=', $to);
        }

        /*<-------filter search script End here------------->*/
        $count = $result->count();
        $result = $result->orderby($orderby, $orderDir)->skip($start)->take($length)->get();
        $data = array();
        $i = 0;

        foreach ($result as $user) {
            // dd($user);
            if($user->type == 0){
                $client_type= "User";
            }
            if($user->type == 1){
                $client_type="Staff";
            }
            if($user->type == 2){
                $client_type="Admin";
            }
        //    $doc_type=KycIdType::select('id_type')->where('id',$user->doc_type)->first()->id_type;

            if($user->status == 0){
                $status='Pending';
            }
            elseif($user->status == 1){
                $status='Verified';
            }
            elseif($user->status == 2){
                $status='Declined';
            }
    
            $data[$i]['client_name']   = $user->name;
            $data[$i]['client_type']   = $client_type;
            $data[$i]['document_type'] = $user->id_type;
            $data[$i]['issue_date']    = date('d F y, h:i A', strtotime($user->issue_date));
            $data[$i]['expire_date']   = date('d F y, h:i A', strtotime($user->exp_date));
            $data[$i]['status']        = $status;
            $data[$i]['date']          = date('d F y, h:i A', strtotime($user->created_at));;
            $data[$i]['action']        = '<button   data-type="button"  class="btn btn-primary waves-effect waves-float waves-light" data-bs-toggle="modal" data-bs-target="#kt_modal_upgrade_plan"  data-loading="processing..."  data-id="'.$user->user_id.'"   data-table_id="'.$user->id.'"  onclick="view_document(this)">View</button>';
            $i++;
        }
        $res['draw'] = $draw;
        $res['recordsTotal'] = $count;
        $res['recordsFiltered'] = $count;
        $res['data'] = $data;
        return Response::json($res);
    }

    public function viewDescription(Request $request, $id,$table_id){
    
        $user_info = User::select()->where('users.id', $id)
        ->join('user_descriptions', 'users.id', '=', 'user_descriptions.user_id')->first();
        $user_kyc_sts = KycVerification::select()->where('id', $table_id)->first();

        $user_country = Country::select('name')->where('id', $user_info->country_id)->first();

        $kyc_id_type = KycIdType::select('id_type', 'group')->where('id', $user_kyc_sts->doc_type)->first();

        $document_images = json_decode($user_kyc_sts->document_name);
        $image_path = "Uploads/kyc";
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
}
