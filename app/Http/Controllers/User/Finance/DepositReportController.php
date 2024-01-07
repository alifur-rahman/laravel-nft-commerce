<?php

namespace App\Http\Controllers\User\Finance;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\Users;
use Illuminate\Http\Request;

class DepositReportController extends Controller
{ 
    public function depositReportView(Request $request){
        $op = $request->input('op');
        if ($op == "data_table") {
            return $this->depositReportDT($request);
        }
        return view('users.finance.deposit-report');
    }

    public function depositReportDT($request){
        $draw = $request->input('draw');
        $start = $request->input('start');
        $length = $request->input('length');
        $order = $_GET['order'][0]["column"];
        $orderDir = $_GET["order"][0]["dir"]; 

        $columns = ['transaction_type','charge','approved_status', 'created_at','deposits.amount'];
        $orderby = $columns[$order];
        $result = Deposit::select('deposits.transaction_type','deposits.charge','deposits.approved_status','deposits.created_at','deposits.amount')
                        ->join('users','deposits.user_id','=','users.id')
                        ->where('users.id', auth()->user()->id);

        $total_amount=$result->sum('deposits.amount');

        $type = $request->type;
        $approved_status = $request->approve_status;  
        $from = $request->from_date;
        $to = $request->to_date;
        $min = $request->min_amount;
        $max = $request->max_amount;  

        if($type != ""){
            $result=$result->where('deposits.transaction_type','=',$type);
            $total_amount=$result->where('deposits.transaction_type','=',$type)->sum('deposits.amount');
        }
        if($approved_status != ""){
            $result=$result->where('deposits.approved_status','=',$approved_status);
            $total_amount=$result->where('deposits.approved_status','=',$approved_status)->sum('deposits.amount');
        }

        if($min != ""){
            $result=$result->where('deposits.amount','>=',$min);
            $total_amount=$result->where('deposits.amount','>=',$min)->sum('deposits.amount');
        }

        if($max != ""){
            $result=$result->where('deposits.amount','<=',$max);
            $total_amount=$result->where('deposits.amount','<=',$max)->sum('deposits.amount');
        }

        if ($from != "") {

            // dd($from);
            $result = $result->whereDate('deposits.created_at', '>=',$from);
            $total_amount=$result->whereDate('deposits.created_at','>=',$from)->sum('deposits.amount');
        }

        if ($to != "") {
            $result = $result->whereDate('deposits.created_at', '<=', $to);
            $total_amount=$result->whereDate('deposits.created_at','<=',$to)->sum('deposits.amount');
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
            $data[$i]['transaction_type'] = '<span>'.ucwords($user->transaction_type).'</span>';
            $data[$i]['charge'] = '<span>'.'$'.$user->charge.'</span>';
            $data[$i]['created_at'] = '<span>'.date('d F Y', strtotime($user->created_at)).'</span>';
            $data[$i]['update_at'] = '<span>'.date('d F Y', strtotime($user->update_at)).'</span>';
            $data[$i]['status'] = '<span class="'.$status_color.'">'.$status.'</span>';
            $data[$i]['amount'] = '<span>'.'$'.$user->amount.'</span>';
            $i++;
        }

        $res['draw'] = $draw;
        $res['recordsTotal'] = $count;
        $res['recordsFiltered'] = $count;
        $res['data'] = $data;
        $total =[$total_amount];
        $res['total']=$total;

        return json_encode($res);

    }
}
