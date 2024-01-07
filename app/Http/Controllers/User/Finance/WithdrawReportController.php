<?php

namespace App\Http\Controllers\User\Finance;

use App\Http\Controllers\Controller;
use App\Models\TransactionSetting;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use App\Models\WithdrawReport;

class WithdrawReportController extends Controller
{ 

    public function WithdrawReportView(Request $request){
        $op = $request->input('op');
        if ($op == "data_table") {
            return $this->withdrawReportDT($request);
        }
        return view('users.finance.withdraw-report');
    }


    public function withdrawReportDT($request){
        $draw = $request->input('draw');
        $start = $request->input('start');
        $length = $request->input('length');
        $order = $_GET['order'][0]["column"];
        $orderDir = $_GET["order"][0]["dir"];

        $columns = ['transaction_type','charge_id','approved_status', 'created_at','withdraws.approved_status','withdraws.amount'];
        $orderby = $columns[$order];
        $result = Withdraw::select('withdraws.transaction_type','withdraws.charge_id','withdraws.approved_status','withdraws.created_at','withdraws.amount','charge')
                        // ->join('transaction_settings','withdraws.charge_id','=','transaction_settings.id')
                        ->join('users','withdraws.user_id','=','users.id')
                        ->where('users.id',auth()->user()->id);

        // $total_amount=$result->where('users.type',0)->sum('withdraws.amount');
        $total_amount=$result->sum('withdraws.amount');  

        
        $type = $request->type;
        $approved_status = $request->approve_status;  
        $from = $request->from_date;
        $to = $request->to_date;
        $min = $request->min_amount;
        $max = $request->max_amount; 

        if($type != ""){
            $result=$result->where('withdraws.transaction_type','=',$type);
            $total_amount=$result->where('withdraws.transaction_type','=',$type)->sum('withdraws.amount');
        }
        if($approved_status != ""){
            $result=$result->where('withdraws.approved_status','=',$approved_status);
            $total_amount=$result->where('withdraws.approved_status','=',$approved_status)->sum('withdraws.amount');
        }

        if($min != ""){
            $result=$result->where('withdraws.amount','>=',$min);
            $total_amount=$result->where('withdraws.amount','>=',$min)->sum('withdraws.amount');
        }

        if($max != ""){
            $result=$result->where('withdraws.amount','<=',$max);
            $total_amount=$result->where('withdraws.amount','<=',$max)->sum('withdraws.amount');
        }

        if ($from != "") {

            // dd($from);
            $result = $result->whereDate('withdraws.created_at', '>=',$from);
            $total_amount=$result->whereDate('withdraws.created_at','>=',$from)->sum('withdraws.amount');
        }

        if ($to != "") {
            $result = $result->whereDate('withdraws.created_at', '<=', $to);
            $total_amount=$result->whereDate('withdraws.created_at','<=',$to)->sum('withdraws.amount');
        }  

        $count = $result->count();
        $result = $result->orderby($orderby, $orderDir)->skip($start)->take($length)->get();
        $data = array();
        $i = 0;
        foreach ($result as $user) {
            if($user->approved_status=='P'){
                $status='Pending';
                $status_color = 'text-warning';
            }
            elseif($user->approved_status=='A'){
                $status='Approved';
                $status_color = 'text-success';
            }
            elseif($user->approved_status=='D'){
                $status='Declined';
                $status_color = 'text-danger';
            }
            $data[$i]['transaction_type'] = '<span>'.$user->transaction_type.'</span>';
            $data[$i]['charge'] = '<span>'.'$ '.$user->charge.'</span>';
            $data[$i]['created_at'] ='<span>'. date('d F Y', strtotime($user->created_at)).'</span>';
            $data[$i]['update_at'] = '<span>'.date('d F Y', strtotime($user->update_at)).'</span>';
            $data[$i]['status'] = '<span class="'.$status_color.'">'.$status.'</span>';
            $data[$i]['amount'] = '<span>'.'$ '.$user->amount.'</span>';
            $i++;
        }

        $res['draw'] = $draw;
        $res['recordsTotal'] = $count;
        $res['recordsFiltered'] = $count;
        $res['data'] = $data;
        $res['total_amount']=$total_amount;

        return json_encode($res);

    }
}
