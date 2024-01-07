<?php

namespace App\Http\Controllers\Admin\managecollection;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\NftCollection;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\NftSale;
use App\Services\AllfunctionService;
use Illuminate\Support\Facades\Response;

class ManageCollectionController extends Controller
{
    public function showCollection()
    {
        return view('admin.manage-collection.collection-listing');
    }

    public function getCollection(Request $request)
    {
        if ($request->op==='description') {
            $collection_des = NftCollection::where('nft_collections.id', '=', $request->id)
            ->join('users', 'users.id', 'nft_collections.user_id')
            ->select('nft_collections.*', 'users.phone as contact_number')
            ->first();

            $array= json_decode($collection_des->item);

            $item = is_array($array) ? count($array) : 0 ;
            $total_sale = NftSale::where('collection_id', $request->id)
            ->sum('nft_sales.total_price');

            $description = '<tr class="description bg-light border-start border-3 border-primary border-bottom-0" style="display:none">
                                <td colspan="6">
                                <!--begin:::User Info-->
                                <div class="row g-5 g-xl-8">
                                    <!--begin::Col-->
                                    <div class="col-xl-5">
                                        <!--begin::Tables Widget 1-->
                                        <div class="card card-xl-stretch mb-xl-8">
                                            <!--begin::Body-->
                                            <div class="card-body py-3">
                                                <!--begin::Table container-->
                                                <div class="table-responsive">
                                                    <!--begin::Table-->
                                                    <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                                        <tr>
                                                            <th class="min-w-200px fw-semibold">Total Item :</th>
                                                            <td>'. $item .'</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="min-w-200px fw-semibold">Create Time :</th>
                                                            <td>'. date('d M y h:i A', strtotime($collection_des->created_at)) .'</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="min-w-200px fw-semibold">Last Update :</th>
                                                            <td>'. date('d M y h:i A', strtotime($collection_des->updated_at)) .'</td>
                                                        </tr>
                                                    </table>
                                                    <!--end::Table-->
                                                </div>
                                                <!--end::Table container-->
                                            </div>
                                            <!--end::Body-->
                                        </div>
                                        <!--endW::Tables Widget 1-->
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-xl-7">
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
                                                                    <th class="min-w-200px fw-semibold">Total Sale Amount :</th>
                                                                    <td class="text-primary">$'. $total_sale .'</td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="min-w-200px fw-semibold">Owner Name :</th>
                                                                    <td>
                                                                        <span>'. AllfunctionService::userName($collection_des->user_id) .'</span>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="min-w-200px fw-semibold">Owner Contact Number :</th>
                                                                    <td>'. $collection_des->contact_number .'</td>
                                                                </tr>
                                                                <!--end::Table body-->
                                                            </table>
                                                            <!--end::Table-->
                                                        </div>
                                                    </div>
                                                    <div class="col-4 py-3">
                                                        <div class="d-flex flex-center flex-shrink-0 rounded">
                                                            <img class="w-125px h-125px" src="' . AllfunctionService::userPhoto($collection_des->user_id). '" alt="image">
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

                                <!--end:::User Info-->
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

        $columns = ['id','item','slug','name','details'];
        $orderby = $columns[$order];

        $collection_name = $request->collection_name;
        $slug = $request->slug;
        $owner_name = $request->owner_name;
        $email = $request->email;
        $url = $request->url;
        $from_date = $request->from_date;
        $to_date = $request->to_date;

        $result = DB::table('nft_collections')
        ->join('users', 'nft_collections.user_id', '=', 'users.id')
        ->select('nft_collections.*', 'users.email');

        if (!empty($collection_name)) {
            $result = $result->where('nft_collections.category_id', '=', $collection_name);
        }
        if (!empty($owner_name)) {
            $result = $result->where('users.name', '=', $owner_name);
        }
        if (!empty($slug)) {
            $result = $result->where('nft_collections.sale_type', '=', $slug);
        }
        if (!empty($email)) {
            $result = $result->where('users.email', '=', $email);
        }
        if (!empty($url)) {
            $result = $result->where('nft_collections.token', '=', $url);
        }
        if (!empty($from_date)) {
            $result = $result->where('nft_collections.created_at', '>=', $from_date);
        }
        if (!empty($to_date)) {
            $result = $result->where('nft_collections.created_at', '<=', $to_date);
        }

        $count = $result->count();
        $result = $result->orderby($orderby, $orderDir)->skip($start)->take($length)->get();
        $data = array();
        $i = 0;

        foreach ($result as $row) {
            $owner_info = User::where('id', $row->user_id)->first();

            $data[$i]['collection'] =  '<div style="cursor:pointer" class="d-flex align-items-center dt-description" data-id="'.$row->id.'">
                                <i class="fas fa-plus dt-toggler" style="color: var(--bs-cyan);"></i>
                                <div class="d-flex align-items-center ms-2 ms-md-10">
                                    <a href="#" class="symbol symbol-60px symbol-2by3 flex-shrink-0 me-4">
                                        <img src="' . asset('/Uploads/profile/'.$row->profile_photo) . '" alt="collection_profile">
                                    </a>

                                </div></div>';
            $data[$i]['name'] = $row->name;
            $data[$i]['owner_name'] = $owner_info->name;
            $data[$i]['owner_email'] = $owner_info->email;
            $data[$i]['created_at'] = date('d M y', strtotime($row->created_at));

            $i++;
        }
        $output = array('draw' => $_REQUEST['draw'], 'recordsTotal' => $count, 'recordsFiltered' => $count);
        $output['data'] = $data;

        return Response::json($output);
    }
}
