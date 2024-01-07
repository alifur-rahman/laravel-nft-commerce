<?php

namespace App\Http\Controllers\User\Finance;

use App\Http\Controllers\Controller;
use App\Models\CompanyInfo;
use App\Models\CryptoAddress;
use App\Models\Deposit;
use App\Models\User;
use App\Models\Withdraw;
use App\Services\MailService;
use App\Services\PriceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class CryptoWithdrawController extends Controller
{
    public function cryptoWithdraw()
    {
        $crypto_address = CryptoAddress::where(function ($query) {
            $query->where('verify_1', 1)
                ->where('verify_2', 1)
                ->where('status', 1);
        });
        // all crypto address / all active addresses
        $block_chains = $crypto_address->select('block_chain')->distinct('block_chain')->get();

        // only first active address
        $crypto_address = $crypto_address->first();

        $crypto_address = ($crypto_address) ? $crypto_address->address : '';
        $last_transaction = Withdraw::where('user_id', auth()->user()->id)->where('transaction_type', 'crypto')->latest()->first();

        // check current balance
        $total_deposit = Deposit::where('user_id', auth()->user()->id)->sum('amount');
        $total_withdraw = Withdraw::where('user_id', auth()->user()->id)->sum('amount');
        $total_balance = $total_deposit - $total_withdraw;


        return view(
            'users.finance.crypto_withdraw',
            [
                'last_transaction'  => $last_transaction,
                'crypto_address'    => $crypto_address,
                'block_chains'      => $block_chains,
                'total_balance'     => $total_balance,
            ]
        );
    }

    // find crypto address by block chain
    public function cryptoAddressFind(Request $request)
    {
        $crypto_address = CryptoAddress::where('address', $request->crypto_address)->select('name', 'address')->first();
        if ($crypto_address) {
            return Response::json(['status' => true, 'message' => "Crypto address matched", 'crypto_name' => $crypto_address->name]);
        } else {
            return Response::json(['status' => false, 'message' => "Crypto address doesn't match!"]);
        }
    }

    //calculate / convert crypto to usd amount
    public function cryptoConvert(Request $request)
    {
        $bitcoin_data = new PriceService();
        $type = $request->crypto_type;
        $all_crypto_value = $bitcoin_data->prices();
        $crypto_amount = $all_crypto_value->$type['USD'];
        $crypto_amount = ($crypto_amount * $request->usd_amount);
        return Response::json(['crypto_amount' => $crypto_amount]);
    }

    // add withdraw request
    public function cryptoWithdrawAdd(Request $request)
    {
        $data = [
            'status' => false,
            'message' => ''
        ];
        $validation_rules = [
            'block_chain' => 'required',
            'crypto_address' => 'required|max:191',
            'usd_amount' => 'required|numeric',
            'crypto_amount' => 'required|numeric',
            'transaction_password' => 'required',
        ];

        $validator = Validator::make($request->all(), $validation_rules);
        if ($validator->fails()) {
            return Response::json([
                'status' => false,
                'errors' => $validator->errors(),
                'message' => "Fix the following errors!",
            ]);
        }
        if (!Hash::check($request->transaction_password, auth()->user()->transaction_password)) {
            $data['status'] = false;
            $data['message'] = 'Transaction password not matched!';
            return Response::json($data);
        }
        $transaction_id = uniqid();
        $invoice = substr(hash('sha256', mt_rand() . microtime()), 0, 16);
        // check current balance
        $total_deposit = Deposit::where('user_id', auth()->user()->id)->sum('amount');
        $total_withdraw = Withdraw::where('user_id', auth()->user()->id)->sum('amount');
        $total_balance = $total_deposit - $total_withdraw;

        if ($total_balance < $request->usd_amount) {
            $data['status'] = false;
            $data['message'] = "You Don't have sufficient balance!";
            return Response::json($data);
        }
        $create = Withdraw::create([
            'user_id'           => auth()->user()->id,
            'transaction_type'  => 'crypto',
            'transaction_id'    => $transaction_id,
            'block_chain'       => $request->block_chain,
            'crypto_name'       => $request->crypto_name,
            'crypto_address'    => $request->crypto_address,
            'amount'            => $request->usd_amount,
            'crypto_amount'     => $request->crypto_amount,
            'approved_status'   => 'P',
            'charge'            => 0,
            'ip_address'        => request()->ip(),
        ]);

        $user = User::where('id',auth()->user()->id)->first();
        $company_info = CompanyInfo::select()->first(); 
        $data = [
            'client_name'               => $user->name,
            'company_name'              => $company_info->com_name,
            'phone'                     => $user->phone,
            'support_email'             => $company_info->support_email,
            'user_email'                => $user->email,   
            'amount'                    => $request->usd_amount,
            'crypto_amount'             => $request->crypto_amount,
            'block_chain'               => $request->block_chain,
            'crypto_name'               => $request->crypto_name,
            'crypto_address'            => $request->crypto_address,
            'ip'                        => request()->ip(),
        ]; 

        MailService::mail($user->email, $data, 'Crypto Withdraw Confirmation', 'crypto-withdraw-confirm');

        if ($create) {
            $update_balance = $total_balance - $request->usd_amount;
            $data['status'] = true;
            $data['message'] = 'Withdrawal successfully done.';
            $data['update_balance'] = $update_balance;
            return Response::json($data);
        } else {
            $data['status'] = false;
            $data['message'] = 'Somthing went wrong please try again later!';
            return Response::json($data);
        }
    }
}
