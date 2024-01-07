<?php

namespace App\Http\Controllers\User\Finance;

use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BankAccount;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class AddBankController extends Controller
{
    public function addBank(Request $request)
    {
        if ($request->ajax()) {
            $validation_rules = [
                'bank_name' => 'required|max:100',
                'bank_ac_name' => 'required|max:100',
                'bank_ac_number' => 'required|max:100',
                'bank_swift_code' => 'required|max:100',
                'bank_iban' => 'required|max:20',
                'bank_address' => 'required|max:100',
                'bank_country' => 'required|max:50',

            ];
            $validator = Validator::make($request->all(), $validation_rules);

            if ($validator->fails()) {
                return Response::json([
                    'status' => false,
                    'errors' => $validator->errors(),
                    'message' => 'Please fix the following errors!'
                ]);
            }else {
                $add_bank = BankAccount::create($request->all());
                return Response::json([
                    'status' => True,
                    'message' => 'Your Bank Added Successfully'
                ]);
            }
        }

        $bank_country = Country::all();
       return view('users.finance.add-bank-account', compact('bank_country'));
    }
}
