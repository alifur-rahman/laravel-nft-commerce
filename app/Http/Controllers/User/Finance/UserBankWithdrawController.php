<?php

namespace App\Http\Controllers\User\Finance;

use App\Http\Controllers\Controller;
use App\Models\BankAccount;
use App\Models\CompanyInfo;
use App\Models\Country;
use App\Models\Deposit;
use App\Models\User;
use App\Models\Withdraw;
use App\Services\MailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class UserBankWithdrawController extends Controller
{
    public function bankWithdraw()
    {
        // $last_transaction = Withdraw::where('user_id', auth()->user()->id)->where('transaction_type', 'bank')->latest()->first();
        $banks = BankAccount::where('user_id', auth()->user()->id)->select('bank_name')->distinct()->get();

        // check current balance
        $total_deposit = Deposit::where('user_id', auth()->user()->id)->sum('amount');
        $total_withdraw = Withdraw::where('user_id', auth()->user()->id)->sum('amount');
        $total_balance = $total_deposit - $total_withdraw;

        return view('users.finance.bank_withdraw', ['banks' => $banks, 'total_balance' => $total_balance]);
    }
    // find bank account numbers by bank name
    public function findBankAccounts(Request $request)
    {
        $bank_ac_numbers = BankAccount::where('bank_name', $request->bank_name)->select('bank_ac_number')->get();
        $option = '';
        $option .= '<option>Select A Bank Account</option>';
        foreach ($bank_ac_numbers as $value) {
            $option .= '<option value="' . $value->bank_ac_number . '">' . $value->bank_ac_number . '</option>';
        }
        return Response::json(['option' => $option]);
    }
    // find bank account details by account number
    public function findBankAccountDetails(Request $request)
    {
        $bank_ac_numbers = BankAccount::where('bank_ac_number', $request->bank_ac_number)->first();
        $country = Country::where('id', $bank_ac_numbers->bank_country)->select('name')->first();
        return Response::json([
            'bank_account_id' => $bank_ac_numbers->id,
            'bank_name' => $bank_ac_numbers->bank_name,
            'bank_acc_name' => $bank_ac_numbers->bank_ac_name,
            'bank_swift_code' => $bank_ac_numbers->bank_swift_code,
            'bank_iban' => $bank_ac_numbers->bank_iban,
            'bank_address' => $bank_ac_numbers->bank_address,
            'bank_country' => $country->name,
        ]);
    }
    public function bankWithdrawAdd(Request $request)
    {
        $data = [
            'status' => false,
            'message' => ''
        ];
        $validation_rules = [ 
            'usd_amount' => 'required|numeric',
            'transaction_password' => 'required',
        ];
        $validator = Validator::make($request->all(), $validation_rules);
        if ($validator->fails()) {
            return Response::json([
                'status' => false,
                'message' => "Fix the following error!",
                'errors' => $validator->errors()
            ]);
        }
        if (!Hash::check($request->transaction_password, auth()->user()->transaction_password)) {
            $data['status'] = false;
            $data['message'] = 'Transaction password not matched!';
            return Response::json($data);
        }

        // check current balance
        $total_deposit = Deposit::where('user_id', auth()->user()->id)->sum('amount');
        $total_withdraw = Withdraw::where('user_id', auth()->user()->id)->sum('amount');
        $total_balance = $total_deposit - $total_withdraw;

        if ($total_balance < $request->usd_amount) {
            $data['status'] = false;
            $data['message'] = "You Don't have sufficient balance!";
            return Response::json($data);
        }
        $transaction_id = uniqid(); 
        $create = Withdraw::create([
            'user_id'           => auth()->user()->id,
            'transaction_type'  => 'bank',
            'transaction_id'    => $transaction_id,
            'bank_account_id'   => $request->bank_account_id,
            'amount'            => $request->usd_amount,
            'approved_status'   => 'P',
            'charge'            => 0,
            'ip_address'        => request()->ip()
        ]);

        $user = User::where('id',auth()->user()->id)->first();
        $company_info = CompanyInfo::select()->first(); 
        $data = [
            'client_name'               => $user->name,
            'company_name'              => $company_info->com_name,
            'phone'                     => $user->phone,
            'support_email'             => $company_info->support_email,
            'user_email'                => $user->email,  
            'bank_account_id'           => $request->bank_account_id,
            'amount'                    => $request->usd_amount,
            'ip'                        => request()->ip(),
        ]; 

        MailService::mail($user->email, $data, 'Bank Withdraw Confirmation', 'bank-withdraw-confirm');


        if ($create) {
            $data['status'] = true;
            $data['message'] = 'Withdrawal successfully done.';
            return Response::json($data);
        } else {
            $data['status'] = false;
            $data['message'] = 'Somthing went wrong please try again later!';
            return Response::json($data);
        }
    }
}
