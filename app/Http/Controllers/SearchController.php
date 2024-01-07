<?php

namespace App\Http\Controllers;

use App\Models\NftAsset;
use App\Models\NftAssetCategory;
use App\Models\NftCollection;
use App\Services\AllfunctionService;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function ajaxSearch(Request $Request){
        $keyword = $Request->keyword;
        $conditions = array(
            array('name', 'LIKE', '%'.$keyword.'%'),
        );
        $data = NftAsset::where($conditions)->get();
        if(count($data) != 0){
            $returnData = "";
            foreach ($data as $key => $value) {
                $returnData .= ' <li class="al_search_item">
                                    <div class="product-style-one no-overlay">
                                        <div class="card-thumbnail">
                                            <a href="/asset-details/'.$value->id.'"><img
                                                    src="'.AllfunctionService::asset_image($value->id).'"
                                                    alt="'.$value->name.'"></a>
                                        </div>
                                        <div class="p_content">
                                            <a href="/asset-details/'.$value->id.'"><span class="product-name">'.$value->name.'</span></a>
                                            <span class="latest-bid"> Base price '.$value->base_price.' each.</span>
                                    </div>
                                </li>';
            }

            return Response::json([
                'status' => true,
                'returnData' => $returnData,
            ]);
        }else{
            return Response::json([
                'status' => false,
                'message' => 'No Result Found !',
            ]);
        }

        return Response::json([
            'status' => false,
            'message' => 'No Result Found !',
        ]);

        $item = ' <li class="al_search_item">
                        <div class="product-style-one no-overlay">
                            <div class="card-thumbnail">
                                <a href="#"><img
                                        src="http://127.0.0.1:8000/Uploads/nft-assets/nftimg1.jpg"
                                        alt="NFT_portfolio"></a>
                            </div>
                            <div class="p_content">
                                <a href="product-details.html"><span class="product-name">NFT image</span></a>
                                <span class="latest-bid">Highest bid 1/20</span>
                                <div class="bid-react-area">
                                    <div class="last-bid">100 wETH</div>
                                        <div class="react-area" >
                                            <svg viewBox="0 0 17 16" fill="none" width="16" height="16"
                                                class="sc-bdnxRM sc-hKFxyN kBvkOu">
                                                <path
                                                    d="M8.2112 14L12.1056 9.69231L14.1853 7.39185C15.2497 6.21455 15.3683 4.46116 14.4723 3.15121V3.15121C13.3207 1.46757 10.9637 1.15351 9.41139 2.47685L8.2112 3.5L6.95566 2.42966C5.40738 1.10976 3.06841 1.3603 1.83482 2.97819V2.97819C0.777858 4.36443 0.885104 6.31329 2.08779 7.57518L8.2112 14Z"
                                                    stroke="currentColor" stroke-width="2">
                                                </path>
                                            </svg>
                                            <span class="number">100</span>
                                        </div>
                                    </div>
                                </div>
                        
                        
                        </div>
                    </li>';
        
    }

    public function SubmitSearch(Request $Request){
        $keyword = $Request->keyword;
        $conditions = array(
            array('name', 'LIKE', '%'.$keyword.'%'),
        );
        $datas = NftAsset::where($conditions)->get();
        $categorys = NftAssetCategory::all();
        $collections = NftCollection::limit('4')->get();

        if (Auth::check()) {
            $mycollections = NftCollection::where('user_id', Auth::user()->id)->get(['name', 'id']);
        } else {
            $mycollections = [];
        }

        return view('users.search',[
            'keyword' => $keyword,
            'datas' => $datas,
            'categorys' => $categorys,
            'mycollections' => $mycollections
        ]);
    }

    public function explorSearchProduct(Request $request)
    {
        $keyword = $request->keyword;
        // return $keyword;
        $conditions = array(
            array('name', 'LIKE', '%'.$keyword.'%'),
        );
        $datas = NftAsset::where($conditions);
        // $datas = new NftAsset;
        // if ($request->like != '') {
        //     $datas = $datas->where('txnid', $request->tnx_ID);
        // }
        if ($request->category != '') {
            $datas = $datas->where('category_id', $request->category);
        }
        // if ($request->collection) {
        //     $datas = $datas->where('status', $request->status);
        // }
        if ($request->sale_type != '') {
            $datas = $datas->where('sale_type',  $request->sale_type);
        }

        $amount = explode("-", $request->price);
        if ($amount) {
            $datas = $datas->whereBetween('base_price', [$amount[0], $amount[1]]);
        }


        $datas = $datas->get();

        $viewRender = view('search-random-explor', compact('datas'))->render();
        return response(['success' => true, 'html' => $viewRender]);
    }

   
}