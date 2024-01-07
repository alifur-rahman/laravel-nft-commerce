<?php

namespace App\Http\Controllers\Admin\ManageClient;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Country;
use App\Models\Deposit;
use App\Models\KycVerification;
use App\Models\NftAccount;
use App\Models\NftSale;
use App\Models\PasswordReset;
use App\Models\User;
use App\Models\Withdraw;
use App\Services\DataTableService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ManageClientController extends Controller
{
    public function index(Request $request)
    {
        $action = $request->action;
        if ($action == 'table') {
            return $this->manageClientDT($request);
        }
        if ($action == 'nft-exchange-table') {
            return $this->nftExchangeDT($request);
        }
        if ($action == 'withdraw-table') {
            return $this->withdrawDT($request);
        }
        if ($action == 'deposit-table') {
            return $this->depositDT($request);
        }
        if ($action == 'kyc-table') {
            return $this->kycDT($request);
        }
        if ($action == 'comment-table') {
            return $this->commentDT($request);
        }
        if ($action == 'add-comment') {
            return $this->addComment($request);
        }
        if ($action == 'update-comment') {
            return $this->updateComment($request);
        }
        if ($action == 'delete-comment') {
            return $this->deleteComment($request);
        }
        if ($action == 'block-unblock') {
            return $this->blockUnblock($request);
        }
        if ($action == 'two-step-auth') {
            return $this->twoStepAuthED($request);
        }
        if ($action == 'email-auth') {
            return $this->emailAuthED($request);
        }
        if ($action == 'email-verify') {
            return $this->emailVarifyED($request);
        }
        if ($action == 'withdraw-operation') {
            return $this->withdrawOperation($request);
        }
        if ($action == 'deposit-operation') {
            return $this->depositOperation($request);
        }
        if ($action == 'reset-password') {
            return $this->resetPassword($request);
        }
        if ($action == 'reset-transaction-pin') {
            return $this->resetTransactionPin($request);
        }
        if ($action == 'change-password') {
            return $this->changePassword($request);
        }
        if ($action == 'change-transaction-pin') {
            return $this->changeTransactionPin($request);
        }
        if ($action == 'manage-client_filter') {
            return $this->manageClient_filter($request);
        }
        return view('admin.manage-client.index');
    }

    private function manageClientDT($request)
    {
        $dts = new DataTableService($request);
        $result = User::select('*');

        //filter by nft_account
        if ($request->user_id != "") {

            $user_account_id = NftAccount::where('nft_accounts.address', $request->user_id)->get();
            $user_id = [];

            foreach ($user_account_id as $value) {
                array_push($user_id, $value->user_id);
            }
            if ($request->user_id = 0) {
                $result = $result->whereNotIn("id", $user_id);
            } else {
                $result = $result->whereIn("id", $user_id);
            }
        }

        // filter by user
        if ($request->user != "") {
            $result = $result->where('name', $request->user)->orwhere('email', $request->user)->orwhere('phone', $request->user);
        }

        // filter by finance
        if ($request->finance != "") {
            // Filter by withdraw
            if (strtolower($request->finance) === 'withdraw') {
                $userIDs = Withdraw::pluck('user_id');
                $result = $result->whereIn("id", $userIDs);
            }

            // Filter by Deposits
            if (strtolower($request->finance) === 'deposit') {
                $userIDs = Deposit::pluck('user_id');
                $result = $result->whereIn("id", $userIDs);
            }

        }

        // Filter by verfification status
        if ($request->verification_status != "") {
            $userIDs = KycVerification::where('kyc_verifications.status', $request->verification_status)->pluck('user_id');
            $result = $result->join('kyc_verifications', 'users.id', '=', 'kyc_verifications.user_id')
            ->where('status', $request->verification_status)->whereIn('users.id', $userIDs);
        }
        
        $count = $result->count();
        $result = $result->orderBy($dts->orderBy()=='id'?'users.id':$dts->orderBy(), $dts->orderDir)->skip($dts->start)->take($dts->length)->get();

        $data = [];
        $i = 0;
        foreach ($result as $row) {
            $status = "";
            if ($row->active_status) {
                $status = "<span class='badge badge-light-success'>Active</span>";
            } else {
                $status = "<span class='badge badge-light-danger'>Deactive</span>";
            }
            $data[$i]['DT_RowId'] = "row_" . $row->id;
            $data[$i]["id"] = $row->id;
            $data[$i]["name"] = $row->name;
            $data[$i]["email"] = $row->email;
            $data[$i]["phone"] = $row->phone;
            $data[$i]["created_at"] = $row->created_at;
            $data[$i]["active_status"] = $status;
            $data[$i]["extra"] = $this->clientExtraDATA($row);
            $i++;
        }
        $res['draw'] = $dts->draw;
        $res['recordsTotal'] = $count;
        $res['recordsFiltered'] = $count;
        $res['data'] = $data;
        return json_encode($res);
    }

    public function clientExtraDATA($userRow)
    {
        $userID = $userRow->id;
        $user = User::find($userID);
        $userImage = asset('assets/admin/media/avatars/avater-men.png');

        $totalDeposit = Deposit::where('user_id', $userID)->sum('amount');
        $totalWithdraw = Withdraw::where('user_id', $userID)->sum('amount');
        $total = ($totalDeposit - $totalWithdraw);

        $nftAccount = NftAccount::select('*')
            ->join('users', 'nft_accounts.user_id', '=', 'users.id')
            ->where('nft_accounts.user_id', $userID)->first();
        $nftAddress = $nftAccount ? $nftAccount->address : "N/A";
        $nftUserName = $nftAccount ? $nftAccount->user_name : "N/A";

        $country = Country::select('*')->join('user_descriptions', 'countries.id', '=', 'user_descriptions.country_id')->where('user_descriptions.user_id', $userID)->first();
        $countryName = $country ? $country->name : "N/A";

        $kyc_status = KycVerification::where('user_id', $userID)->first();
        $kycCheckUncheck = "";
        if ($kyc_status) {
            if ($kyc_status->status == 0) {
                $kycCheckUncheck = '<span class="badge badge-light-warning">Pending</span>';
            } elseif ($kyc_status->status == 1) {
                $kycCheckUncheck = '<span class="badge badge-light-success">Verified</span>';
            } elseif ($kyc_status->status == 2) {
                $kycCheckUncheck = '<span class="badge badge-light-danger">Declined</span>';
            }
        } else {
            $kycCheckUncheck = '<span class="badge badge-light-danger">Unverified</span>';
        }

        $status = [
            'activeStatus' => ($user->active_status == 2) ? 'checked' : '',
            'twoStepStatus' => ($user->g_auth == 1) ? 'checked' : '',
            'emailAuthStatus' => ($user->email_auth == 1) ? 'checked' : '',
            'emailVerifyStatus' => ($user->email_verification == 1) ? 'checked' : '',
            'withdrawOperation' => ($user->withdraw_operation == 1) ? 'checked' : '',
            'withdrawOperation' => ($user->withdraw_operation == 1) ? 'checked' : '',
        ];

        return compact('userID', 'userImage', 'status', 'totalDeposit', 'totalWithdraw', 'total', 'kycCheckUncheck', 'nftAddress', 'nftUserName', 'countryName');
    }

    public function nftExchangeDT($request)
    {
        $dts = new DataTableService($request);
        $result = NftSale::select('nft_sales.*', "nft_sales.id as id", 'nft_assets.name as assetName', 'owner.user_name as ownerName', 'seller.user_name as sellerName', 'transferer.user_name as transfererName', 'reciever.user_name as recieverName', 'winner.user_name as winnerName')
            ->join('users', 'nft_sales.id', '=', 'users.id')
            ->join("nft_assets", "nft_sales.asset_id", "=", "nft_assets.id")
            ->join("nft_accounts as seller", "nft_sales.seller_account", "=", "seller.id")
            ->join("nft_accounts as owner", "nft_assets.owner_id", "=", "owner.id")
            ->join("nft_accounts as transferer", "nft_sales.from_account", "=", "transferer.id")
            ->join("nft_accounts as reciever", "nft_sales.to_account", "=", "reciever.id")
            ->join("nft_accounts as winner", "nft_sales.winner_account", "=", "winner.id")
            ->where('seller.user_id', $request->userID);
        $count = $result->count();
        $result = $result->orderBy($dts->orderBy(), $dts->orderDir)->skip($dts->start)->take($dts->length)->get();
        $data = [];
        $i = 0;
        foreach ($result as $row) {
            $data[$i]["id"] = $row->id;
            $data[$i]["assetName"] = $row->assetName;
            $data[$i]["ownerName"] = $row->ownerName;
            $data[$i]["sellerName"] = $row->sellerName;
            $data[$i]["transfererName"] = $row->transfererName;
            $data[$i]["recieverName"] = $row->recieverName;
            $data[$i]["winnerName"] = $row->winnerName;
            $data[$i]["time"] = Carbon::parse($row->time)->format('d M, Y');
            $i++;
        }
        $res['draw'] = $dts->draw;
        $res['recordsTotal'] = $count;
        $res['recordsFiltered'] = $count;
        $res['data'] = $data;
        return json_encode($res);
    }

    public function withdrawDT($request)
    {
        $dts = new DataTableService($request);
        $result = Withdraw::select('*')->where('user_id', $request->userID);
        $count = $result->count();
        $result = $result->orderBy($dts->orderBy(), $dts->orderDir)->skip($dts->start)->take($dts->length)->get();
        $data = [];
        $i = 0;
        foreach ($result as $row) {
            if ($result) {
                if ($row->approved_status == 'A') {
                    $status = '<span class="badge badge-light-warning">Approved</span>';
                } elseif ($row->approved_status == 'P') {
                    $status = '<span class="badge badge-light-success">Pending</span>';
                } elseif ($row->approved_status== 'D') {
                    $status = '<span class="badge badge-light-danger">Declined</span>';
                }
            } else {
                $status = '<span class="badge badge-light-danger">Unverified</span>';
            }
            $data[$i]["id"] = $row->id;
            $data[$i]["amount"] = '<span>&dollar; ' . $row->amount . '</span>';
            $data[$i]["transaction_type"] = $row->transaction_type;
            $data[$i]["approved_status"] = $status;
            $data[$i]["created_at"] = Carbon::parse($row->created_at)->format('d M, Y');
            $i++;
        }
        $res['draw'] = $dts->draw;
        $res['recordsTotal'] = $count;
        $res['recordsFiltered'] = $count;
        $res['data'] = $data;
        return json_encode($res);
    }


    public function depositDT($request)
    {
        $dts = new DataTableService($request);
        $result = Deposit::select('*')->where('user_id', $request->userID);
        $count = $result->count();
        $result = $result->orderBy($dts->orderBy(), $dts->orderDir)->skip($dts->start)->take($dts->length)->get();
        $data = [];
        $i = 0;
        foreach ($result as $row) {

            if ($result) {
                if ($row->approved_status == 'A') {
                    $status = '<span class="badge badge-light-warning">Approved</span>';
                } elseif ($row->approved_status == 'P') {
                    $status = '<span class="badge badge-light-success">Pending</span>';
                } elseif ($row->approved_status== 'D') {
                    $status = '<span class="badge badge-light-danger">Declined</span>';
                }
            } else {
                $status = '<span class="badge badge-light-danger">Unverified</span>';
            }

            $status = (strtolower($row->approved_status) === 'p') ? '<span class="badge badge-light-warning">Pending</span>' : '<span class="badge badge-light-success">Approved</span>';
            $data[$i]["id"] = $row->id;
            $data[$i]["amount"] = '<span>&dollar; ' . $row->amount . '</span>';
            $data[$i]["transaction_type"] = $row->transaction_type;
            $data[$i]["approved_status"] = $status;
            $data[$i]["created_at"] = Carbon::parse($row->created_at)->format('d M, Y');
            $i++;
        }
        $res['draw'] = $dts->draw;
        $res['recordsTotal'] = $count;
        $res['recordsFiltered'] = $count;
        $res['data'] = $data;
        return json_encode($res);
    }
// kyc datatable-------------------------------------------------------
public function kycDT($request)
{
    $userID = $request->userID;
    $dts = new DataTableService($request);

    $result = KycVerification::where('user_id', $userID)->select();

    $count = $result->count();

    $result = $result->orderBy($dts->orderBy(), $dts->orderDir)->skip($dts->start)->take($dts->length)->get();

    $data = [];
    $i = 0;
    foreach ($result as $value) {
        if ($result) {
            if ($value->status == 0) {
                $status = '<span class="badge badge-light-warning">Pending</span>';
            } elseif ($value->status == 1) {
                $status = '<span class="badge badge-light-success">Verified</span>';
            } elseif ($value->status== 2) {
                $status = '<span class="badge badge-light-danger">Declined</span>';
            }
        } else {
            $status = '<span class="badge badge-light-danger">Unverified</span>';
        }

        $data[$i]["id"] = $value->id;
        $data[$i]["issue_date"] = Carbon::parse($value->issue_date)->format('d M, Y');
        $data[$i]["doc_type"] = $value->doc_type;
        $data[$i]["status"] = $status;
        $i++;
    }
    $res['draw'] = $dts->draw;
    $res['recordsTotal'] = $count;
    $res['recordsFiltered'] = $count;
    $res['data'] = $data;
    return Response::json($res);
}
    // comments datatable-------------------------------------------------------
    public function commentDT($request)
    {
        $userID = $request->userID;
        $dts = new DataTableService($request);

        $result = Comment::where('user_id', $userID)->select();

        $count = $result->count();

        $result = $result->orderBy($dts->orderBy(), $dts->orderDir)->skip($dts->start)->take($dts->length)->get();

        $data = [];
        $i = 0;
        foreach ($result as $value) {
            $data[$i]["id"] = $value->id;
            $data[$i]["created_at"] = Carbon::parse($value->created_at)->format('d M, Y');
            $data[$i]["comment"] = $value->comment;
            $i++;
        }
        $res['draw'] = $dts->draw;
        $res['recordsTotal'] = $count;
        $res['recordsFiltered'] = $count;
        $res['data'] = $data;
        return Response::json($res);
    }

    // add new comment----------------------------------------------------------
    public function addComment(Request $request)
    {
        $rules = [
            'comment' => 'required|min:5',
            'user_id' => 'required',
        ];
        $validation = Validator::make($request->all(), $rules);
        if ($validation->fails()) {
            return [
                'status' => false,
                'message' => 'Failed! Please check validation errors and try again',
                'errors' => $validation->errors(),
            ];
        }
        $newComment = Comment::create([
            'user_id' => $request->user_id,
            'type' => 'User',
            'comment' => $request->comment,
            'commented_by' => Auth::id(),
        ]);
        if ($newComment) {
            return [
                'status' => true,
                'message' => 'Comment Created Successfully',
            ];
        } else {
            return [
                'status' => false,
                'message' => 'Unable To Create New Comment',
            ];
        }
    }

    // update comment-----------------------------------------------------------
    public function updateComment(Request $request)
    {
        $rules = [
            'comment' => 'required|min:5',
        ];
        $validation = Validator::make($request->all(), $rules);
        if ($validation->fails()) {
            return [
                'status' => false,
                'message' => 'Failed! Please check validation errors and try again',
                'errors' => $validation->errors(),
            ];
        }
        $update = Comment::where('id', $request->comment_id)->Update([
            'comment' => $request->comment,
            'commented_by' => Auth::id(),
        ]);
        if ($update) {
            return [
                'status' => true,
                'message' => 'Comment Updated Successfully',
            ];
        } else {
            return [
                'status' => false,
                'message' => 'Unable To Update Comment',
            ];
        }
    }

    // delete comment
    public function deleteComment($request)
    {
        $validation_rules = [
            'commentID' => 'required',
        ];
        $validator = Validator::make($request->all(), $validation_rules);
        if ($validator->fails()) {
            if ($request->ajax()) {
                return Response::json(['status' => false, 'errors' => $validator->errors()]);
            } else {
                return Redirect()->back()->with(['status' => false, 'errors' => $validator->errors()]);
            }
        } else {
            $delete = Comment::where('id', $request->commentID)->delete();
            if ($delete) {
                if ($request->ajax()) {
                    return Response::json(['status' => true, 'message' => 'Comment Deleted Successfully!']);
                } else {
                    return Response::json(['status' => false, 'message' => 'Unable To Delete Comment']);
                }
            }
        }
    }

    // Block unblock user-------------------------------------------------------
    public function blockUnblock($request)
    {
        $validation_rules = [
            'id' => 'required',
            'request_for' => 'required',
        ];
        $validator = Validator::make($request->all(), $validation_rules);
        if ($validator->fails()) {
            if ($request->ajax()) {
                return Response::json([
                    'status' => false,
                    'errors' => $validator->errors(),
                ]);
            } else {
                return Redirect()->back()->with([
                    'status' => false,
                    'errors' => $validator->errors(),
                ]);
            }
        } else {
            $user = User::find($request->id);
            $user->active_status = ($request->request_for === 'block') ? 2 : 1;
            $update = $user->save();
            if ($request->request_for === 'block') {
                $update_message = $user->name . " " . "successfully Blocked";
                $success_title = 'User Blocked';
            } else {
                $update_message = $user->name . " " . "successfully Un-Blocked";
                $success_title = 'User Un-Blocked';
            }
            if ($update) {
                return Response::json([
                    'status' => true,
                    'message' => $update_message,
                    'success_title' => $success_title,
                ]);
            } else {
                return Response::json([
                    'status' => false,
                    'message' => 'Something went wrong please try again later',
                    'success_title' => $success_title,
                ]);
            }
        }
        return Response::json($request->trader_id);
    }

    // Enable/Disable google two step authentication
    public function twoStepAuthED($request)
    {
        $validation_rules = [
            'id' => 'required',
            'request_for' => 'required',
        ];
        $validator = Validator::make($request->all(), $validation_rules);
        if ($validator->fails()) {
            return Response::json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        } else {
            $user = User::find($request->id);
            $user->g_auth = ($request->request_for === 'enable') ? 1 : 0;
            $update = $user->save();
            if ($request->request_for === 'enable') {
                $update_message = $user->name . " " . "Google 2 step authentication successfully Enabled";
                $success_title = 'Google 2 Step Enabled';
            } else {
                $update_message = $user->name . " " . "Google 2 step authentication successfully Disabled";
                $success_title = 'Google 2 Step Disabled';
            }
            if ($update) {
                return Response::json([
                    'status' => true,
                    'message' => $update_message,
                    'success_title' => $success_title,
                ]);
            }
            return Response::json([
                'status' => false,
                'message' => 'Somthing went wrong please try again later',
                'success_title' => $success_title,
            ]);
        }
        return Response::json($request->trader_id);
    }

    // Enable/Disable email authentication
    public function emailAuthED($request)
    {
        $validation_rules = [
            'id' => 'required',
            'request_for' => 'required',
        ];
        $validator = Validator::make($request->all(), $validation_rules);
        if ($validator->fails()) {
            return Response::json(['status' => false, 'errors' => $validator->errors()]);
        } else {
            $user = User::find($request->id);
            $user->email_auth = ($request->request_for === 'enable') ? 1 : 0;
            $update = $user->save();

            if ($request->request_for === 'enable') {
                $update_message = $user->name . " " . "Email Authentication Successfully Enabled";
                $success_title = 'Email Authentication Enabled';
            } else {
                $update_message = $user->name . " " . "Email Authentication successfully Disabled";
                $success_title = 'Email Authentication Disabled';
            }
            if ($update) {
                return Response::json([
                    'status' => true,
                    'message' => $update_message,
                    'success_title' => $success_title,
                ]);
            }
            return Response::json([
                'status' => false,
                'message' => 'Something went wrong! please try again later',
                'success_title' => $success_title,
            ]);
        }
    }

    // Enable/Disable email virification
    public function emailVarifyED($request)
    {
        $validation_rules = [
            'id' => 'required',
            'request_for' => 'required',
        ];
        $validator = Validator::make($request->all(), $validation_rules);
        if ($validator->fails()) {
            return Response::json(['status' => false, 'errors' => $validator->errors()]);
        } else {
            $user = User::find($request->id);
            $user->email_verification = ($request->request_for === 'enable') ? 1 : 0;
            $update = $user->save();
            if ($request->request_for === 'enable') {
                $update_message = $user->name . " " . "Email Verification Successfully Enabled";
                $success_title = 'Email Verification Enabled';
            } else {
                $update_message = $user->name . " " . "Email verification successfully Disabled";
                $success_title = 'Email Verification Disabled';
            }
            if ($update) {
                return Response::json([
                    'status' => true,
                    'message' => $update_message,
                    'success_title' => $success_title,
                ]);
            }
            return Response::json([
                'status' => false,
                'message' => 'Something went wrong! please try again later.',
                'success_title' => $success_title,
            ]);
        }
    }

    public function withdrawOperation($request)
    {
        $validation_rules = [
            'id' => 'required',
            'request_for' => 'required',
        ];
        $validator = Validator::make($request->all(), $validation_rules);
        if ($validator->fails()) {
            return Response::json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        } else {
            $user = User::find($request->id);
            $user->withdraw_operation = ($request->request_for === 'enable') ? 1 : 0;
            $update = $user->save();

            if ($request->request_for === 'enable') {
                $update_message = $user->name . " " . "Withdraw operation Successfully Enabled";
                $success_title = 'Withdraw Operation Enabled';
            } else {
                $update_message = $user->name . " " . "Withdraw Operation successfully Disabled";
                $success_title = 'Withdraw Operation Disabled';
            }
            if ($update) {
                return Response::json([
                    'status' => true,
                    'message' => $update_message,
                    'success_title' => $success_title,
                ]);
            }
            return Response::json([
                'status' => false,
                'message' => 'Somthing went wrong! please try again later.',
                'success_title' => $success_title,
            ]);
        }
    }

    // reset password
    public function resetPassword(Request $request)
    {
        // generate random password
        $random_password = Str::random(5) . '@' . random_int(11, 99);
        $hashed_random_password = Hash::make($random_password);
        $user = User::find($request->userID);
        // get old password
        // $old_password = $user->password;
        // update password
        $user->password = $hashed_random_password;
        $user->tmp_pass = 1;
        $update = $user->save();
        // update reset table
        $expire = date("Y-m-d h:i:s", strtotime('+1 hour'));
        $insert = PasswordReset::insert([
            'email' => $user->email,
            // 'old_password' => $old_password,
            'created_at' => date('Y-m-d h:i:s', time()),
            'token' => csrf_token(),
            // 'expried_on' => $expire
        ]);
        if ($update && $insert) {
            return Response::json([
                'status' => true,
                'message' => 'Password Successfully reset',
            ]);
        }
        return Response::json([
            'status' => false,
            'message' => 'Somthing went wrong please try again later!',
        ]);
    }

    // reset transaction pin---------------------------------------------
    public function resetTransactionPin(Request $request)
    {
        // generate random password
        $random_pin = random_int(000001, 999999);
        $hashed_random_pin = Hash::make($random_pin);
        // update pin
        // $expire = date("Y-m-d h:i:s", strtotime('+1 hour'));
        $user = User::find($request->userID);
        $user->transaction_password = $hashed_random_pin;
        $user->tmp_tran_pass = 1;
        // $user->tmp_trans_pass_expired = $expire;

        $update = $user->save();
        if ($update) {
            return Response::json([
                'status' => true,
                'message' => 'Transaction pin successfully reset',
            ]);
        }
        return Response::json([
            'status' => true,
            'message' => 'Somthing went wrong please try again later',
        ]);
    }

    // change password--------------------------------------
    public function changePassword(Request $request)
    {
        $validation_rules = [
            'password' => 'required|confirmed|regex:/(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[#?!@$%^&*-]).{8,}/i', // Minimum eight characters, at least one uppercase letter, one lowercase letter and one special character
            'password_confirmation' => 'required',
        ];
        $validation = Validator::make($request->all(), $validation_rules);
        if ($validation->fails()) {
            return [
                'status' => false,
                'message' => 'Failed! Please check validation errors and try again',
                'errors' => $validation->errors(),
            ];
        }
        $user = User::find($request->trader_id);
        $user->password = Hash::make($request->password);
        $update = $user->save();
        if ($update) {
            return Response::json([
                'status' => true,
                'message' => "Password has been changed for $user->name",
                'success_title' => 'Change password',
            ]);
        }
    }

    // change pin
    public function changeTransactionPin(Request $request)
    {
        $validation_rules = [
            'transaction_pin' => 'required|confirmed|min:4', // Minimum eight characters, at least one uppercase letter, one lowercase letter and one special character
            'transaction_pin_confirmation' => 'required',
        ];
        $validation = Validator::make($request->all(), $validation_rules);
        if ($validation->fails()) {
            return [
                'status' => false,
                'message' => 'Failed! Please check validation errors and try again',
                'errors' => $validation->errors(),
            ];
        }
        $user = User::find($request->user_id);
        $user->transaction_password = Hash::make($request->transaction_pin);
        $update = $user->save();
        if ($update) {
            return Response::json([
                'status' => true,
                'message' => "Transaction pin has been changed for $user->name",
            ]);
        }
        return Response::json([
            'status' => false,
            'message' => 'Transaction pin hasbeen changes',
        ]);
    }
}
