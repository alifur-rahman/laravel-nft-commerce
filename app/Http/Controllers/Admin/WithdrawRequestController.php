<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class WithdrawRequestController extends Controller
{
    public function withdrawRequest(Request $request){
        $op = $request->input('op');
        if ($op == "data_table") {
            return $this->withdrawRequestReport($request);
        }
        return view('admin.request.withdraw-request-report');
    }
    public function withdrawRequestReport($request){
        $transaction_type = $request->input('transaction_type');
        $status = $request->input('status');
        $info=$request->input('info');
        $verification_status=$request->input('verification_status');
        $from = $request->input('from');
        $to = $request->input('to');
        $min = $request->input('min');
        $max = $request->input('max');


        $draw = $request->input('draw');
        $start = $request->input('start');
        $length = $request->input('length');
        $order = $_GET['order'][0]["column"];
        $orderDir = $_GET["order"][0]["dir"];

        $columns = ['name','email','transaction_type', 'approved_status','created_at','amount'];
        $orderby = $columns[$order];

        $result = Withdraw::select('withdraws.user_id as u_id','withdraws.transaction_type','withdraws.id as table_id','withdraws.user_id','withdraws.approved_status','withdraws.created_at','withdraws.amount',
                                    'users.name','users.email','users.type','users.email_verified_at')
                                    ->join('users','withdraws.user_id','=','users.id');


        $total_amount=Withdraw::sum('amount');

           /*<-------filter search script start here------------->*/

        if ($verification_status != "") {
            if ($verification_status == 'Verified') {
                $result = $result->where('email_verified_at', '!=', null);
                $total_amount=$result->where('email_verified_at', '!=', null)->sum('amount');
            } elseif ($verification_status == 'Unverified') {
                $result = $result->where('email_verified_at', '=', null);
                $total_amount=$result->where('email_verified_at', '=', null)->sum('amount');
            }
        }

        if($transaction_type != ""){
            $result=$result->where('transaction_type','=',$transaction_type);
            $total_amount=$result->where('transaction_type','=',$transaction_type)->sum('amount');
        }

        if($status != ""){
            $result=$result->where('approved_status','=',$status);
            $total_amount=$result->where('approved_status','=',$status)->sum('amount');
        }

        if($info != ""){
            $result=$result->where('name','=',$info)->orwhere('email','=',$info);
            $total_amount=$result->where('name','=',$info)->orwhere('email','=',$info)->sum('amount');
        }


        if ($min != "") {
            $result = $result->where("amount", '>=', $min);
            $total_amount=$result->where("amount", '>=', $min)->sum('amount');
        }
        if ($max != "") {
            $result = $result->where("amount", '<=', $max);
            $total_amount=$result->where("amount", '<=', $max)->sum('amount');
        }

        if ($from != "") {
            $result = $result->whereDate('withdraws.created_at','>=',$from);
            $total_amount=$result->whereDate("withdraws.created_at", '>=', $from)->sum('amount');
        }

        if ($to != "") {
            $result = $result->whereDate('withdraws.created_at','<=',$to);
            $total_amount=$result->whereDate("withdraws.created_at", '<=', $to)->sum('amount');
        }

           /*<-------filter search script End here------------->*/




        $count = $result->count();
        $result = $result->orderby($orderby, $orderDir)->skip($start)->take($length)->get();

           $data = array();
           $i = 0;

        foreach ($result as $user) {
            if($user->approved_status=='P'){
                $status='<span class="text-warning">Pending</span>';
            }
            elseif($user->approved_status=='A'){
                $status='<span class="text-success">Approved</span>';
            }
            elseif($user->approved_status=='D'){
                $status='<span class="text-danger">Declined</span>';
            }

            $data[$i]['name'] =  $user->name;
            $data[$i]['email'] = $user->email;
            $data[$i]['method'] = $user->transaction_type;
            $data[$i]['status'] = $status;
            $data[$i]['request_date'] = date('d F y, h:i A', strtotime($user->created_at));
            $data[$i]['amount'] = '$'.$user->amount;
            $data[$i]['action']         = '<button   data-type="button"  class="btn btn-primary waves-effect waves-float waves-light btn-small kyc-modal user-id" data-bs-toggle="modal" data-bs-target="#userDescriptionModel" class="kyc-modal user-id" data-table_id="' . $user->table_id . '" data-id="' . $user->u_id . '" style="margin-top: 5px; width: 76px; margin-left: -10px;">View</button>';

            $i++;
        }
        $output = array('draw' => $draw, 'recordsTotal' => $count, 'recordsFiltered' => $count,'total_amount' => $total_amount);
        $output['data'] = $data;

        return Response::json($output);
    }

    public function approveWithdrawRequest(Request $request, $user_id,$table_id){
        // dd($table_id);
        // $user=User::select()->where('id',$user_id)->first();
        // $support_email=SystemConfig::select('support_email')->first();
        // $support_email=($support_email)?$support_email->support_email:'support@fxcrm.net';
        // $email_data = [
        //     'name'              => ($user)?$user->name:'Fxcrm User',
        //     'account_email'     => ($user)?$user->email:'',
        //     'admin'             => Auth::user()->name,
        //     'login_url'         => route('login'),
        //     'support_email'     => $support_email,

        // ];

        $update= Withdraw::where('id', $table_id)->update(['approved_status'=>'A','approved_date'=>date('Y-m-d h:i:s', strtotime('now'))]);
            if ( $update ) {
                    return Response::json(['success' => true, 'message' => 'Mail successfully sended for Approved request', 'success_title' =>'Approve request']);
            }
            else{
                    return Response::json(['success' => false, 'message' => 'Mail sending failed, Please try again later!', 'success_title' =>'Approve request']);
            }
    }

    public function declineWithdrawRequest(Request $request){
        $id=$request->tbl_id;
        // $user=User::select()->where('id',$request->user_id)->first();
        // $support_email=SystemConfig::select('support_email')->first();
        // $support_email=($support_email)?$support_email->support_email:'support@fxcrm.net';
        // $email_data = [
        //     'name'              => ($user)?$user->name:'Fxcrm User',
        //     'account_email'     => ($user)?$user->email:'',
        //     'admin'             => Auth::user()->name,
        //     'login_url'         => route('login'),
        //     'support_email'     => $support_email,
        // ];
            $reason=$request->input('reason');
            $update= Withdraw::where('id', $id)->update(['approved_status'=>'D','note'=>$reason]);
            if ($update) {
                return Response::json(['success' => true, 'message' => 'Mail successfully sended for Declined request', 'success_title' =>'Declined request']);
            }
            else{
                return Response::json(['success' => false, 'message' => 'Mail sending failed, Please try again later!', 'success_title' =>'Declined request']);
            }
    }

}
