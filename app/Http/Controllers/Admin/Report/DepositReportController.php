<?php

namespace App\Http\Controllers\Admin\Report;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\User;
use App\Services\DataTableService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class DepositReportController extends Controller
{
    public function index(Request $request)
    {
        $action = $request->action;
        if ($action == 'table') {
            return $this->depositDT($request);
        }
        return view('admin.reports.deposit-report');
    }

    public function depositDT($request)
    {
        $dts = new DataTableService($request);
        $result = Deposit::select(
            'deposits.id',
            'deposits.user_id',
            'users.name',
            'users.email',
            'deposits.transaction_type',
            'deposits.approved_status',
            'deposits.created_at',
            'deposits.approved_date',
            'users.email_verified_at',
            'deposits.amount'
        )
            ->join('users', 'deposits.user_id', '=', 'users.id');

        // filter by user
        if ($request->user != "") {
            // dd($request->user);
            $result = $result->where('name', $request->user)->orwhere('email', $request->user)->orwhere('phone', $request->user);
        }
        // status filter
        if ($request->approved_status != "") {
            $result = $result->where('approved_status', $request->approved_status);
        }
        if ($request->transaction_type != "") {
            $result = $result->where('transaction_type', $request->transaction_type);
        }
        if ($request->min != "") {
            $result = $result->where("amount", '>=', $request->min);

        }
        if ($request->max != "") {
            $result = $result->where("amount", '<=', $request->max);
        }
            if ($request->from != "") {
                $result = $result->whereDate("approved_date", '>=', Carbon::parse($request->from)->format('Y-m-d'));
            }
            if ($request->to != "") {
                $result = $result->whereDate("approved_date", '<=', Carbon::parse($request->to)->format('Y-m-d'));
            }

        // if ($result->from != "") {
        //     $result = $result->whereDate("deposits.created_at", '>=',$result->from);
        // }
        // if ($result->to != "") {
        //     $result = $result->whereDate("deposits.created_at", '<=', $result->to);

        // }

        $count = $result->count();
        $result = $result->orderBy($dts->orderBy() == 'id' ? 'users.id' : $dts->orderBy(), $dts->orderDir)->skip($dts->start)->take($dts->length)->get();

        $data = [];
        $i = 0;
        foreach ($result as $deposit) {
            // $extra = 'Name: '.$deposit->user.'<br/>Method: '.$deposit->method.'<br/>Transaction ID: '.$deposit->txn_hash;

            $data[$i]['DT_RowId'] = "row_" . $deposit->id;
            $data[$i]['id'] = $deposit->id;

            $data[$i]['name'] = $deposit->name;
            $data[$i]['email'] = $deposit->email;

            $data[$i]['transaction_type'] = $deposit->transaction_type;
            $data[$i]['approved_status'] = $deposit->approved_status == "A" ? "Approved" : "Pending";
            $data[$i]['created_at'] = date('d F y, h:i A', strtotime($deposit->created_at));
            $data[$i]['approved_date'] = date('d F y, h:i A', strtotime($deposit->approved_date));
            $data[$i]['amount'] = '$ ' . $deposit->amount;
            $data[$i]["extra"] = $this->deposit_description($deposit->id);
            $i++;
        }

        $res['draw'] = $dts->draw;
        $res['recordsTotal'] = $count;
        $res['recordsFiltered'] = $count;
        $res['data'] = $data;
        return json_encode($res);

    }

    public function deposit_description($id)
    {
        $deposit = Deposit::select('*')->find($id);

        $innerTH = "";
        $innerTD = "";

        $innerTH .= <<<EOT
                <th>Amount Request</th>
                <th>Method</th>
                <th>Note</th>

            EOT;
        $innerTD .= <<<EOT
                <td>{$deposit->amount}</td>
                <td>{$deposit->transaction_type}</td>
                <td>{$deposit->note}</td>

            EOT;

        $description = <<<EOT
        <div class="px-6">
            <div class="card card-flush">
                <div class="card-body ">
                    <table class="table align-middle table-row-dashed fs-6 gy-5 gx-7 text-gray-800" id="deposit-details">
                        <!--begin::Table head-->
                        <thead class="bg-light">
                            <!--begin::Table row-->
                            <tr class="text-start fw-bold fs-7 text-uppercase">
                                $innerTH
                            </tr>
                            <!--end::Table row-->
                        </thead>
                        <!--end::Table head-->

                        <tbody>
                            <!--begin::Table row-->
                            <tr class="text-start fs-7 text-uppercase">
                                $innerTD
                            </tr>
                            <!--end::Table row-->
                        </tbody>
                    </table>
                </div>
                <!--end::Card body-->
            </div>
        </div>
        EOT;

        $data = [
            'status' => true,
            'description' => $description,
        ];
        return Response::json($data);
    }
}
