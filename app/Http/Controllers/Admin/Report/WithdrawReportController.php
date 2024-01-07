<?php

namespace App\Http\Controllers\Admin\Report;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Withdraw;
use App\Services\DataTableService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class WithdrawReportController extends Controller
{
    public function index(Request $request)
    {
        $action = $request->action;
        if ($action == 'table') {
            return $this->withdrawDT($request);
        }
        return view('admin.reports.withdraw-report');
    }

    private function withdrawDT($request)
    {
        $dts = new DataTableService($request);
        $result = Withdraw::select(
            'withdraws.id',
            'withdraws.user_id',
            'users.name',
            'users.email',
            'withdraws.transaction_type',
            'withdraws.approved_status',
            'withdraws.created_at',
            'withdraws.approved_date',
            'withdraws.amount'
        )

            ->join('users', 'withdraws.user_id', '=', 'users.id');


        // filter by user
        if ($request->user != "") {
            // dd($request->user);
            $result = $result->where('name', $request->user)->orwhere('email', $request->user)->orwhere('phone', $request->user);
        }
        // status filter
        if ($request->approved_status  != "") {
            $result = $result->where('approved_status', $request->approved_status);
        }
        if ($request->transaction_type  != "") {
            $result = $result->where('transaction_type', $request->transaction_type);
        }
        // if ($request->min != "") {
        //     $result = $result->where("amount", '>=', $request->min);
        // }
        // if ($request->max != "") {
        //     $result = $result->where("amount", '<=', $request->max);
        // }
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


        $count = $result->count();
        $result = $result->orderBy($dts->orderBy() == 'id' ? 'users.id' : $dts->orderBy(), $dts->orderDir)->skip($dts->start)->take($dts->length)->get();

        $data = [];
        $i = 0;
        foreach ($result as $withdraw) {
            // $extra = 'Name: '.$withdraw->user.'<br/>Method: '.$withdraw->method.'<br/>Transaction ID: '.$withdraw->txn_hash;

            $data[$i]['DT_RowId'] = "row_" . $withdraw->id;
            $data[$i]['id'] = $withdraw->id;

            $data[$i]['name'] = $withdraw->name;
            $data[$i]['email'] = $withdraw->email;

            $data[$i]['transaction_type'] = $withdraw->transaction_type;
            $data[$i]['approved_status'] = $withdraw->approved_status == "A" ? "Approved" : "Pending";
            $data[$i]['created_at'] = date('d F y, h:i A', strtotime($withdraw->created_at));
            $data[$i]['approved_date'] = date('d F y, h:i A', strtotime($withdraw->approved_date));
            $data[$i]['amount'] = '$ ' . $withdraw->amount;
            $data[$i]["extra"] = $this->withdraw_description($withdraw->id);
            $i++;
        }

        $res['draw'] = $dts->draw;
        $res['recordsTotal'] = $count;
        $res['recordsFiltered'] = $count;
        $res['data'] = $data;
        return json_encode($res);
    }

    public function withdraw_description($id)
    {
        $withdraw = Withdraw::with(['bankAccount', 'otherTransaction'])->find($id);

        $innerTH = "";
        $innerTD = "";
        if (strtolower($withdraw->transaction_type) === 'bank') {
            $innerTH .= <<<EOT
                <th>Amount Request</th>
                <th>Bank Name</th>
                <th>Bank Swift Code</th>
                <th>Bank IBAN</th>
                <th>Bank Address</th>
                <th>Bank Country</th>
                <th>Bank AC Name</th>
                <th>Bank AC No</th>
            EOT;
            $innerTD .= <<<EOT
                <td>{$withdraw->amount}</td>
                <td>{$withdraw->bankAccount->bank_name}</td>
                <td>{$withdraw->bankAccount->bank_swift_code}</td>
                <td>{$withdraw->bankAccount->bank_iban}</td>
                <td>{$withdraw->bankAccount->bank_address}</td>
                <td>{$withdraw->bankAccount->bank_country}</td>
                <td>{$withdraw->bankAccount->bank_ac_name}</td>
                <td>{$withdraw->bankAccount->bank_ac_number}</td>
            EOT;
        } else if (strtolower($withdraw->transaction_type) === 'crypto') {
            $innerTH .= <<<EOT
                <th>Amount Request</th>
                <th>Crypto Type</th>
                <th>Address</th>
                <th>Crypto Amount</th>
            EOT;
            $innerTD .= <<<EOT
                <th>{$withdraw->amount}</th>
                <th>{$withdraw->otherTransaction->crypto_type}</th>
                <th>{$withdraw->otherTransaction->crypto_address}</th>
                <th>{$withdraw->otherTransaction->crypto_amount}</th>
            EOT;
        } else {
            $innerTH .= <<<EOT
                <th>Amount Request</th>
                <th>Account Name</th>
                <th>Account Email</th>
            EOT;
            $innerTD .= <<<EOT
                <th>{$withdraw->amount}</th>
                <th>{$withdraw->otherTransaction->account_name}</th>
                <th>{$withdraw->otherTransaction->account_email}</th>
            EOT;
        }

        $description = <<<EOT
        <div class="px-6">
            <div class="card card-flush">
                <div class="card-body">
                    <span class="details-text fw-bold fs-6 text-gray-800">

                        {$withdraw->transaction_type} Details
                    </span>

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
            'description' => $description
        ];
        return Response::json($data);
    }
}
