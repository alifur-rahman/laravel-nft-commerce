<?php

namespace App\Http\Controllers\User\Finance;

use App\Http\Controllers\Controller;
use App\Models\AdminBank;
use App\Models\CompanyInfo;
use App\Models\Deposit;
use App\Models\User;
use App\Services\MailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class UserBankDepositController extends Controller
{
    public function bankDeposit()
    {
        $admin_bank = AdminBank::all();
        return view('users.finance.bank_deposit', ['admin_bank' => $admin_bank]);
    }

    public function bankDepositAdd(Request $request)
    {
        $validation_rules = [
            'account_number'  => 'required',
            'amount'        => 'required|numeric',
            'bank_proof' => 'required',
        ];
        $validator = Validator::make($request->all(), $validation_rules);
        if ($validator->fails()) {
            return Response::json([
                'status' => false,
                'errors' => $validator->errors(),
                'message' => 'Please fix the following errors!'
            ]);
        }

        $bank_proof = $request->file('bank_proof');
        if (substr($bank_proof->getMimeType(), 0, 5) != 'image') {
            return Response::json([
                'status' => false,
                'errors' => [
                    'bank_proof' => 'The file is not an image/pdf'
                ],
                'message' => 'Please fix the following errors!'
            ]);
        }

        $bank = AdminBank::where('account_number', $request->account_number)->first();
        if ($bank->minimum_deposit > $request->amount) {
            return Response::json([
                'status' => false,
                'errors' => ['amount' => "Minimum Deposit $bank->minimum_deposit required for bank deposit"],
                'message' => 'Please fix the following errors!'
            ]);
        }
        $invoice = substr(hash('sha256', mt_rand() . microtime()), 0, 16);
        $bank_proof = $request->file('bank_proof');
        $filename = time() . '_bank_proof_' . $bank_proof->getClientOriginalName();
        $bank_proof->move(public_path('/Uploads/deposit'), $filename);
        $created = Deposit::create([
            'user_id' => auth()->user()->id,
            'invoice_id' => $invoice,
            'transaction_type' => 'bank',
            'amount' => $request->amount,
            'charge' =>  0,
            'approved_status' => 'P',
            'ip_address' => request()->ip(),
            'bank_proof' => $filename
        ])->id;

        $user = User::where('id',auth()->user()->id)->first();
        $company_info = CompanyInfo::select()->first(); 
        $data = [
            'client_name'               => $user->name,
            'company_name'              => $company_info->com_name,
            'phone'                     => $user->phone,
            'support_email'             => $company_info->support_email,
            'user_email'                => $user->email,
            'deposit_amount'            => $request->amount,
            'invoice'                   => $invoice,
            'ip'                        => request()->ip(),
        ]; 

        MailService::mail($user->email, $data, 'Bank Deposit Confirmation', 'bank-deposit-confirm');

        if ($created) {
            return Response::json([
                'status' => true,
                'message' => 'Deposit Request successfully submited.'
            ]);
        } else {
            return Response::json([
                'status' => false,
                'message' => 'Somthing went wrong, please try agian later!.'
            ]);
        }
    }
}
