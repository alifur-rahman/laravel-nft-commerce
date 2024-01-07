<?php

namespace App\Http\Controllers\Admin\Request;

use App\Models\User;
use App\Models\NftSale;
use Illuminate\Http\Request;
use App\Models\NftAssetImage;
use App\Http\Controllers\Controller;
use App\Services\AllfunctionService;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class OrderRequestController extends Controller
{
    public function orederRequest()
    {
        return view('admin.request.order_request_report');
    }

    public function orderRequestReport(Request $request)
    {
        if ($request->op==='description') {
            $sales_info = NftSale::where('nft_sales.id', '=', $request->id)->first();

            $seller_info = User::where('id', $sales_info->seller_account)->first();
            $buyer_info = User::where('id', $sales_info->to_account)->first();

            $description = '<tr class="description bg-light border-start border-3 border-primary border-bottom-0" style="display:none">
                                <td colspan="6">
                                <!--begin:::User Info-->
                                <div class="row g-5 g-xl-8">
                                <!--begin::Col-->
                                <div class="col-xl-6">
                                    <!--begin::Tables Widget 2-->
                                    <div class="card card-flush mb-5 mb-xl-8">
                                        <!--begin::Body-->
                                        <div class="card-body py-3 pe-3">
                                            <div class="row">
                                                <div class="col-8">
                                                    <div class="table-responsive">
                                                        <!--begin::Table-->
                                                        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                                            <!--begin::Table head-->
                                                            <tr>
                                                                <th class="fw-semibold">Seller Name :</th>
                                                                <td>'. $seller_info->name .'</td>
                                                            </tr>
                                                            <tr>
                                                                <th class="fw-semibold">Seller Email :</th>
                                                                <td>
                                                                    <span>'. $seller_info->email .'</span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th class="fw-semibold">Contact Number :</th>
                                                                <td>'. $seller_info->phone .'</td>
                                                            </tr>
                                                            <!--end::Table body-->
                                                        </table>
                                                        <!--end::Table-->
                                                    </div>
                                                </div>
                                                <div class="col-4 py-3">
                                                    <div class="d-flex flex-center flex-shrink-0 rounded">
                                                        <img class="w-125px h-125px" src="' . AllfunctionService::userPhoto($sales_info->seller_account). '" alt="image">
                                                    </div>
                                                    <div class="d-flex justify-content-center mt-2">
                                                            <span class="badge badge-light-success"><b>Seller</b></span>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Body-->
                                    </div>
                                    <!--end::Tables Widget 2-->
                                </div>
                                <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-xl-6">
                                        <!--begin::Tables Widget 2-->
                                        <div class="card card-flush mb-5 mb-xl-8">
                                            <!--begin::Body-->
                                            <div class="card-body py-3 pe-3">
                                                <div class="row">
                                                    <div class="col-8">
                                                        <div class="table-responsive">
                                                            <!--begin::Table-->
                                                            <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                                                <!--begin::Table head-->
                                                                <tr>
                                                                    <th class="fw-semibold">Buyer Name :</th>
                                                                    <td>'. $buyer_info->name .'</td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="fw-semibold">Buyer Email :</th>
                                                                    <td>
                                                                        <span>'. $buyer_info->email .'</span>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="fw-semibold">Contact Number :</th>
                                                                    <td>'. $buyer_info->phone .'</td>
                                                                </tr>
                                                                <!--end::Table body-->
                                                            </table>
                                                            <!--end::Table-->
                                                        </div>
                                                    </div>
                                                    <div class="col-4 py-3">
                                                        <div class="d-flex flex-center flex-shrink-0 rounded">
                                                            <img class="w-125px h-125px" src="' . AllfunctionService::userPhoto($sales_info->to_account). '" alt="image">
                                                        </div>
                                                        <div class="d-flex justify-content-center mt-2">
                                                            <span class="badge badge-light-success"><b>Buyer</b></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Body-->
                                        </div>
                                        <!--end::Tables Widget 2-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <div class="row g-5 g-xl-8 d-flex justify-content-end">
                                    <button type="button" class="btn btn-danger hover-scale" style="width:fit-content; margin-right:12px" data-bs-toggle="modal" data-bs-target="#cancel_modal" data-loading="processing..." data-id="'.$request->id.'" data-product-id="'.$request->id.'" onclick="productId('.$request->id.')">Cancel</button>

                                    <button type="button" class="btn btn-primary hover-scale" style="width:fit-content; margin-right:12px" data-loading="processing..." data-id="'.$request->id.'" data-product-id="'.$request->id.'" onclick="orderApproveRequest(this)">Approve</button>
                                </div>

                                </td>
                            </tr>';
            $data = [
                'status' => true,
                'description' => $description
            ];
            return Response::json($data);
        }

        $draw = $request->input('draw');
        $start = $request->input('start');
        $length = $request->input('length');
        $order = $_GET['order'][0]["column"];
        $orderDir = $_GET["order"][0]["dir"];

        $columns = ['asset_id','from_account','to_account', 'quantity','total_price','total_price'];
        $orderby = $columns[$order];

        $category = $request->category;
        $email = $request->email;
        $seller_account = $request->seller_account;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $min_price = $request->min_price;
        $max_price = $request->max_price;

        $result = NftSale::where('order_status', '=', 'pending')
            ->join('nft_assets', 'nft_sales.asset_id', '=', 'nft_assets.id')
            ->join('nft_asset_categories', 'nft_assets.category_id', '=', 'nft_asset_categories.id')
            ->select('nft_sales.*', 'nft_assets.category_id', 'nft_assets.name', 'nft_asset_categories.category');

        if (!empty($category)) {
            $result = $result->where('nft_assets.category_id', '=', $category);
        }
        if (!empty($email)) {
            $result = $result->where('users.email', '=', $email);
        }
        if (!empty($seller_account)) {
            $result = $result->where('nft_sales.seller_account', '=', $seller_account);
        }
        if (!empty($from_date)) {
            $result = $result->where('nft_sales.created_at', '>=', $from_date);
        }
        if (!empty($to_date)) {
            $result = $result->where('nft_sales.created_at', '<=', $to_date);
        }
        if (!empty($min_price)) {
            $result = $result->where('nft_sales.total_price', '>=', $min_price);
        }
        if (!empty($max_price)) {
            $result = $result->where('nft_sales.total_price', '<=', $max_price);
        }

        $count = $result->count();
        $result = $result->orderby($orderby, $orderDir)->skip($start)->take($length)->get();
        $data = array();
        $i = 0;

        foreach ($result as $row) {
            $image = NftAssetImage::where('nft_asset_id', $row->asset_id)->first();

            $data[$i]['product'] =  '<div style="cursor:pointer" class="d-flex align-items-center dt-description" data-id="'.$row->id.'">
                                        <i class="fas fa-plus dt-toggler" style="color: var(--bs-cyan);"></i>
                                        <div class="d-flex align-items-center ms-2 ms-md-10">
                                            <a href="product-details.html" class="symbol symbol-60px symbol-2by3 flex-shrink-0 me-4">
                                                <img src="' . asset('/Uploads/nft-assets/'.$image->image) . '" alt="Nft_Profile">
                                            </a>
                                        </div>
                                    </div>';
            // $data[$i]['name'] = "";
            $data[$i]['name'] = "$row->name";
            $data[$i]['category'] = "$row->category";
            $data[$i]['quantity'] = "$row->quantity";
            $data[$i]['symbol'] = "$row->payment_symbol";
            $data[$i]['total_price'] = '$'.$row->total_price;
            $i++;
        }
        $output = array('draw' => $_REQUEST['draw'], 'recordsTotal' => $count, 'recordsFiltered' => $count);
        $output['data'] = $data;

        return Response::json($output);
    }

    public function approveOrderRequest(Request $request, $id)
    {
        $update= NftSale::where('id', $id)->update(['order_status'=>'process']);

        if ($update) {
            return Response::json(['success' => true, 'message' => 'Request Approved Successfully', 'success_title' =>'Approve request']);
        }
    }

    public function declineOrderRequest(Request $request)
    {
        if ($request->ajax()) {
            $validation_rules = [
                'note' => 'required|min:20|max:191'
            ];
            $validator = Validator::make($request->all(), $validation_rules);
            if ($validator->fails()) {
                return Response::json([
                    'status' => false,
                    'errors' => $validator->errors(),
                    'message' => 'Please fix the following errors!'
                ]);
            } else {
                $update= NftSale::where('id', $request->sale_id)->update(['order_status'=>'cancel', 'note' => $request->note]);

                if ($update) {
                    return Response::json(['success' => true, 'message' => 'This order canceled Successfully', 'success_title' =>'Order Canceled']);
                }
            }
        }
    }
}
