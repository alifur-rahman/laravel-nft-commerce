<?php

namespace App\Http\Controllers\User\Finance;

use App\Http\Controllers\Controller;
use App\Models\AdminBank;
use App\Models\CompanyInfo;
use App\Models\CryptoAddress;
use App\Models\Deposit;
use App\Models\User;
use App\Services\MailService;
use App\Services\PriceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class CryptoDepositController extends Controller
{
    public function cryptoDeposit()
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
        $last_transaction = Deposit::where('user_id', auth()->user()->id)->where('transaction_type', 'crypto')->latest()->first();

        return view(
            'users.finance.crypto_deposit',
            [
                'last_transaction' => $last_transaction,
                'crypto_address' => $crypto_address,
                'block_chains' => $block_chains,
            ]
        );
    }

    // get crypto_name
    public function cryptoNameFind(Request $request)
    {
        $crypto_address = CryptoAddress::where(function ($query) {
            $query->where('verify_1', 1)
                ->where('verify_2', 1)
                ->where('status', 1);
        });

        $option = '';
        $crypto_names = $crypto_address->where('block_chain', $request->block_chain)->select('name')->get();
        $address = $crypto_address->where('block_chain', $request->block_chain)->select('address')->first();
        $option .= '<option value="">Select A Crypto Name</option>';
        foreach ($crypto_names as $value) {
            $option .= '<option value="' . $value->name . '">' . $value->name . '</option>';
        }
        return Response::json(['option' => $option, 'address' => $address->address]);
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

    // crypto deposit add
    public function cryptoDepositAdd(Request $request)
    {
        $data = [
            'status' => false,
            'message' => ''
        ];
        $validation_rules = [
            'block_chain' => 'required',
            'crypto_name' => 'required',
            // 'crypto_address' => 'required|max:191',
            'usd_amount' => 'required|numeric',
            'crypto_amount' => 'required|numeric',
            'transaction_password' => 'required',
        ];

        $validator = Validator::make($request->all(), $validation_rules);
        if ($validator->fails()) {
            return Response::json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
        if (!Hash::check($request->transaction_password, auth()->user()->transaction_password)) {
            $data['status'] = false;
            $data['message'] = 'Transaction password not matched!';
            return Response::json($data);
        }
        $transaction_id = uniqid();
        $invoice = substr(hash('sha256', mt_rand() . microtime()), 0, 16);
        $create = Deposit::create([
            'user_id'           => auth()->user()->id,
            'invoice_id'        => $invoice,
            'transaction_type'  => 'crypto',
            'transaction_id'    => $transaction_id,
            'incode'            => '',
            'block_chain'       => $request->block_chain,
            'crypto_name'       => $request->crypto_name,
            'crypto_address'    => $request->crypto_address,
            'amount'            => $request->usd_amount,
            'crypto_amount'     => $request->crypto_amount,
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
            'invoice_id'                => $invoice,
            'amount'                    => $request->usd_amount,
            'crypto_amount'             => $request->crypto_amount,
            'block_chain'               => $request->block_chain,
            'crypto_name'               => $request->crypto_name,
            'crypto_address'            => $request->crypto_address,
            'ip'                        => request()->ip(),
        ]; 

        MailService::mail($user->email, $data, 'Crypto Deposit Confirmation', 'crypto-deposit-confirm');
        
        if ($create) {
            $data['status'] = true;
            $data['message'] = 'Deposit successfully done';
        } else {
            $data['status'] = false;
            $data['message'] = 'Somthing went wrong please try again later!';
        }

        return Response::json($data);
    }
}
