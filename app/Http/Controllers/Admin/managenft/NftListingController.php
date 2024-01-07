<?php

namespace App\Http\Controllers\Admin\managenft;

use App\Models\User;
use App\Models\NftAsset;
use Illuminate\Http\Request;
use App\Models\NftAssetImage;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\AllfunctionService;
use Illuminate\Support\Facades\Response;

class NftListingController extends Controller
{
    public function nftListing()
    {
        return view('admin.manage-nft.nft-listing');
    }

    public function getData(Request $request, )
    {
        if ($request->op==='description') {

            $nft_des = NftAsset::where('nft_assets.id', '=', $request->id)
            ->join('nft_asset_images', 'nft_asset_images.nft_asset_id', 'nft_assets.id')
            ->select('nft_assets.*', 'nft_asset_images.image')
            ->first();


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
                                                            <th class="min-w-200px fw-semibold">Category:</th>
                                                            <td>' . $nft_des->category_id .'</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="min-w-200px fw-semibold">Blockchain:</th>
                                                            <td>'. $nft_des->blockchain .'</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="min-w-200px fw-semibold">Url:</th>
                                                            <td>'. $nft_des->url .'</td>
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
                                                                    <th class="min-w-200px fw-semibold">Total Sale:</th>
                                                                    <td>100</td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="min-w-200px fw-semibold">Active Status:</th>

                                                                    <td>
                                                                        <span class="badge badge-light-success">'. $nft_des->active_status .'</span>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="min-w-200px fw-semibold">Bit Time:</th>
                                                                    <td>'. date('D M y h:i A',strtotime($nft_des->bit_time)) .'</td>
                                                                </tr>
                                                                <!--end::Table body-->
                                                            </table>
                                                            <!--end::Table-->
                                                        </div>
                                                    </div>
                                                    <div class="col-4 py-3">
                                                        <div class="d-flex flex-center flex-shrink-0 rounded">
                                                            <img class="w-125px h-125px" src="' . AllfunctionService:: userPhoto($nft_des->owner_id). '" alt="image">
                                                        </div>
                                                        <div class="d-flex justify-content-center mt-2">
                                                            <span>'. AllfunctionService::userName($nft_des->owner_id) .'</span>
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
                                    <button type="button" class="btn btn-primary hover-scale" style="width:fit-content; margin-right:12px" data-loading="processing..." data-id="'.$nft_des->id.'" onclick="nftActive(this)">Active Product</button>

                                    <button type="button" class="btn btn-danger hover-scale" style="width:fit-content; margin-right:12px" data-loading="processing..." data-id="'.$request->id.'" onclick="nftDeactive(this)">Deactive Product</button>

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

        $columns = ['id ','category_id','sale_type', 'name','contract_date','base_price'];
        $orderby = $columns[$order];

        $category = $request->category;
        $sale_type = $request->sale_type;
        $email = $request->email;
        $token = $request->token;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $min_price = $request->min_price;
        $max_price = $request->max_price;


        $result = DB::table('nft_assets')
        ->join('nft_asset_images', 'nft_assets.id', '=', 'nft_asset_images.nft_asset_id')
        ->join('users', 'nft_assets.owner_id', '=', 'users.id')
        ->select('nft_assets.*', 'nft_asset_images.image', 'users.email');

        if (!empty($category)) {
            $result = $result->where('nft_assets.category_id', '=', $category);
        }
        if (!empty($sale_type)) {
            $result = $result->where('nft_assets.sale_type', '=', $sale_type);
        }
        if (!empty($email)) {
            $result = $result->where('users.email', '=', $email);
        }
        if (!empty($token)) {
            $result = $result->where('nft_assets.token', '=', $token);
        }
        if (!empty($from_date)) {
            $result = $result->where('nft_assets.created_at', '>=', $from_date);
        }
        if (!empty($to_date)) {
            $result = $result->where('nft_assets.created_at', '<=', $to_date);
        }
        if (!empty($min_price)) {
            $result = $result->where('nft_assets.base_price', '>=', $min_price);
        }
        if (!empty($max_price)) {
            $result = $result->where('nft_assets.base_price', '<=', $max_price);
        }

        $count = $result->count();
        $result = $result->orderby($orderby, $orderDir)->skip($start)->take($length)->get();
        $data = array();
        $i = 0;

        foreach ($result as $row) {
            $owner_email = User::where('id', $row->owner_id)->first();
            if ($row->sale_type == 1) {
                $type = 'Fixed price';
            }elseif($row->sale_type == 2){
                $type = 'Timed Auction';
            }elseif($row->sale_type == 3){
                $type = 'Not for Sale';
            }else{
                $type = 'Open for offer';
            }

            $data[$i]['product'] =  '<div style="cursor:pointer" class="d-flex align-items-center dt-description" data-id="'.$row->id.'">
                                <i class="fas fa-plus dt-toggler" style="color: var(--bs-cyan);"></i>
                                <div class="d-flex align-items-center ms-2 ms-md-10">
                                    <a href="#" class="symbol symbol-60px symbol-2by3 flex-shrink-0 me-4">
                                        <img src="' . asset('/Uploads/nft-assets/'.$row->image) . '" alt="Nft_Profile">
                                    </a>

                                </div></div>';
            $data[$i]['name'] = $row->name;
            $data[$i]['token'] = $row->token;
            $data[$i]['owner_email'] = $owner_email->email;
            $data[$i]['sale_type'] = $type;
            $data[$i]['base_price'] = '$'.$row->base_price;

            $i++;
        }
        $output = array('draw' => $_REQUEST['draw'], 'recordsTotal' => $count, 'recordsFiltered' => $count);
        $output['data'] = $data;

        return Response::json($output);
    }



    public function activeNft(Request $request, $asset_id)
    {
        $assets= NftAsset::find($asset_id);

        if ($assets->active_status == 'deactive') {
            $assets->active_status = 'active';
            $assets->save();
            return Response::json(['success' => true, 'message' => 'Nft active Successfully', 'success_title' =>'NFT Active']);

        }else {
            return Response::json(['success' => false, 'message' => 'This Nft Already active', 'success_title' =>'NFT Active Failed']);
        }

    }

    public function deactiveNft(Request $request, $asset_id)
    {

        $assets= NftAsset::find($asset_id);
        if ($assets->active_status == 'active') {
            $assets->active_status = 'deactive';
            $assets->save();
            return Response::json(['success' => true, 'message' => 'Nft deactive Successfully', 'success_title' =>'NFT Deactive']);
        }else {
            return Response::json(['success' => false, 'message' => 'This Nft Already deactive', 'success_title' =>'NFT Deactive Failed']);
        }

    }
}
