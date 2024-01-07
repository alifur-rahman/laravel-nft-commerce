@extends('layouts.users.user-admin-layout')
@section('title', 'Edit NFT')
@section('custom-css')
    <style>
        .nice-select {
            padding: 4px 10px;
            height: 49px;
            border-radius: ;
            border: 2px solid var(--color-border) !important;
        }

        .upload-area label {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
        }

        /* new  */
        .logo-c-image.logo {
            position: relative;
        }

        .upload-area label span {
            font-size: 20px;
            position: absolute;
            top: 0;
            display: flex;
            align-items: center;
            line-height: 75px;
            bottom: 0;
        }

        .logo-c-image.logo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
@endsection
@section('content')
    @php use App\Services\AllfunctionService; @endphp


    <!-- create new product area -->
    @if ($nft_asset->user->id == Auth::user()->id)
        <div class="rn-nft-mid-wrapper">
            <div class="container">
                <form action="{{ url('edit/nft/'.$nft_asset->id) }}" id="nft_create_form" method="post" enctype="multipart/form-data">
                    @csrf 
                    <div class="row g-5">
                        <div class="col-lg-3 offset-1 ml_md--0 ml_sm--0">
                            <!-- file upload area -->
                            <div class="upload-area">

                                <div class="upload-formate mb--30">
                                    <h6 class="title">
                                        Upload asset image
                                    </h6>
                                    <p class="formate">
                                        Drag or choose your file to upload
                                    </p>
                                </div>

                                <div class="create-collection-input logo-image">
                                    <div class="logo-c-image logo">
                                        <img id="rbtinput1" src="{{AllfunctionService::asset_image($nft_asset->id)}}"
                                            alt="Profile-NFT">
                                        <label for="fatima" title="No File Choosen">
                                            <span class="text-center color-white"><i class="feather-edit"></i></span>
                                        </label>
                                    </div>
                                    <div class="button-area">
                                        <div class="brows-file-wrapper">
                                            <!-- actual upload which is hidden -->
                                            <input name="createNFTfile" id="fatima" type="file">
                                            <!-- our custom upload button -->
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- end upoad file area -->

                            <div class="mt--100 mt_sm--30 mt_md--30 d-none d-lg-block">
                                <h5> Note: </h5>
                                <span> Service fee : <strong>2.5%</strong> </span> <br>
                                <span> You will receive : <strong>25.00 ETH $50,000</strong></span>
                            </div>

                        </div>

                        <div class="col-lg-7">
                            <div class="form-wrapper-one row flex-wrap">

                                <div class="col-md-12">
                                    <div class="input-box pb--20">
                                        <label for="name" class="form-label">Product Name</label>
                                        <input id="name" value="{{$nft_asset->name}}" name="product_name"
                                            placeholder="e. g. `Digital Awesome Game`">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="input-box pb--20">
                                        <label for="Discription" class="form-label">Discription</label>
                                        <textarea id="Discription" name="description" rows="3"
                                            placeholder="e. g. “After purchasing the product you can get item...”">{{$nft_asset->details->description}}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-box pb--20">
                                        <label for="properties" class="form-label">Properties</label>
                                        <textarea id="properties" name="properties" rows="3"
                                            placeholder="e. g. “After purchasing the product you can get item...”">{{$nft_asset->details->properties}}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-6 col-increase">
                                    <div class="input-box pb--20">
                                        <label for="dollerValue" class="form-label">Item Price in $</label>
                                        <input id="dollerValue" name="price" value="{{$nft_asset->base_price}}" placeholder="e. g. `20$`">
                                    </div>
                                </div>

                                <div class="col-md-6 col-increase">
                                    <div class="input-box pb--20 al_show_error">
                                        <label for="sale_type" class="form-label">Sale Type</label>
                                        <select class="profile-edit-select" id="sale_type" name="sale_type">
                                            <option value="1" {{($nft_asset->sale_type==1)?'selected':''}}>Fidex Price</option>
                                            <option value="2" {{($nft_asset->sale_type==2)?'selected':''}}>Timed Auction</option>
                                            <option value="3" {{($nft_asset->sale_type==3)?'selected':''}}>Not for Sale</option>
                                            <option value="4" {{($nft_asset->sale_type==4)?'selected':''}}>Open for offer</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4 col-show d-none">
                                    <div class="input-box pb--20">
                                        <label for="bidding_deadline" class="form-label">Bidding Deadline</label>
                                        <input id="bidding_deadline" type="date" name="bidding_deadline"
                                            placeholder="e. g. `Bidding Deadline`">
                                    </div>
                                </div>

                                <div class="col-md-6 col-increase2">
                                    <div class="input-box pb--20 al_show_error">
                                        <label for="category" class="form-label">Category</label>
                                        <select class="profile-edit-select" id="category" name="category">
                                            <option value="" selected>Select a Category</option>
                                            @foreach ($category as $value)
                                                <option {{($nft_asset->category_id == $value->id)?'selected':''}} value="{{ $value->id }}">{{ $value->category }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-increase2">
                                    <div class="input-box pb--20">
                                        <label for="Royality" class="form-label">Royality</label>
                                        <input id="Royality" name="royality" placeholder="e. g. `20%`">
                                    </div>
                                </div>
                                <input type="hidden" id="if_collection" value="{{ isset($NftCollection[0]->name) }}">
                                <div class="col-md-4 col-show2 d-none">
                                    @if (isset($NftCollection[0]->name))
                                        <div class="input-box pb--20">
                                            <label for="collection" class="form-label">Collection</label>
                                            <select class="profile-edit-select" id="collection" name="collection">
                                                <option value="" selected>Select a Collection</option>
                                                @foreach ($NftCollection as $value)
                                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                </div>


                                {{-- <div class="col-md-4 col-sm-4">
                                <div class="input-box pb--20 rn-check-box">
                                    <input class="rn-check-box-input" name="sale_check" type="checkbox" id="putonsale">
                                    <label class="rn-check-box-label" for="putonsale">
                                        Put on Sale
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-4">
                                <div class="input-box pb--20 rn-check-box">
                                    <input class="rn-check-box-input" name="price_check" type="checkbox" id="instantsaleprice">
                                    <label class="rn-check-box-label" for="instantsaleprice">
                                        Instant Sale Price
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-4">
                                <div class="input-box pb--20 rn-check-box">
                                    <input class="rn-check-box-input" name="unlock_check" type="checkbox" id="unlockpurchased">
                                    <label class="rn-check-box-label" for="unlockpurchased">
                                        Unlock Purchased
                                    </label>
                                </div>
                            </div> --}}

                                {{-- <div class="col-md-12 col-xl-4">
                                <div class="input-box">
                                    <button type="button" class="btn btn-primary-alta btn-large w-100" data-bs-toggle="modal" data-bs-target="#uploadModal">Preview</button>
                                </div>
                            </div> --}}

                                <div class="input-box">
                                    <button type="button" class="btn btn-primary btn-large w-100" id="nft_create_btn"
                                        onclick="_run(this)" data-el="fg" data-form="nft_create_form"
                                        data-loading="<div class='spinner-border spinner-border-sm' role='status'></div>"
                                        data-file="true" data-callback="nftUpdateCallBack"
                                        data-btnid="nft_create_btn">Submit Item</button>
                                </div>
                            </div>

                        </div>

                        <div class="mt--100 mt_sm--30 mt_md--30 d-block d-lg-none">
                            <h5> Note: </h5>
                            <span> Service fee : <strong>2.5%</strong> </span> <br>
                            <span> You will receive : <strong>25.00 ETH $50,000</strong></span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @else
        <div class="rn-nft-mid-wrapper">
            <div class="container">
                <p class="text-muted text-center">You are not Owner of this NFT</p>
            </div>
        </div>
    @endif
    <!-- create new product area -->


    <!-- Modal -->
    <div class="rn-popup-modal upload-modal-wrapper modal fade" id="uploadModal" tabindex="-1" aria-hidden="true">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                data-feather="x"></i></button>
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content share-wrapper">
                <div class="modal-body">
                    <div class="product-style-one no-overlay">
                        <div class="card-thumbnail">
                            <a href="product-details.html"><img src="assets/images/portfolio/portfolio-08.jpg"
                                    alt="NFT_portfolio"></a>
                        </div>
                        <div class="product-share-wrapper">
                            <div class="profile-share">
                                <a href="author.html" class="avatar" data-tooltip="Jone lee"><img
                                        src="assets/images/client/client-1.png" alt="Nft_Profile"></a>
                                <a href="author.html" class="avatar" data-tooltip="Jone lee"><img
                                        src="assets/images/client/client-2.png" alt="Nft_Profile"></a>
                                <a href="author.html" class="avatar" data-tooltip="Jone lee"><img
                                        src="assets/images/client/client-3.png" alt="Nft_Profile"></a>
                                <a class="more-author-text" href="#">9+ Place Bit.</a>
                            </div>
                            <div class="share-btn share-btn-activation dropdown">

                                <div class="share-btn-setting dropdown-menu dropdown-menu-end">
                                    <button type="button" class="btn-setting-text share-text" data-bs-toggle="modal"
                                        data-bs-target="#shareModal">
                                        Share
                                    </button>
                                    <button type="button" class="btn-setting-text report-text" data-bs-toggle="modal"
                                        data-bs-target="#reportModal">
                                        Report
                                    </button>
                                </div>

                            </div>
                        </div>
                        <a href="product-details.html"><span class="product-name">Preatent</span></a>
                        <span class="latest-bid">Highest bid 1/20</span>
                        <div class="bid-react-area">
                            <div class="last-bid">0.244wETH</div>
                            <div class="react-area">
                                <svg viewBox="0 0 17 16" fill="none" width="16" height="16"
                                    class="sc-bdnxRM sc-hKFxyN kBvkOu">
                                    <path
                                        d="M8.2112 14L12.1056 9.69231L14.1853 7.39185C15.2497 6.21455 15.3683 4.46116 14.4723 3.15121V3.15121C13.3207 1.46757 10.9637 1.15351 9.41139 2.47685L8.2112 3.5L6.95566 2.42966C5.40738 1.10976 3.06841 1.3603 1.83482 2.97819V2.97819C0.777858 4.36443 0.885104 6.31329 2.08779 7.57518L8.2112 14Z"
                                        stroke="currentColor" stroke-width="2"></path>
                                </svg>
                                <span class="number">322</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-js')
    <script>
         function nftUpdateCallBack(data){
            if (data.status == true) {
                notify('success', data.message, 'NFT Create Success'); 
            } else {
                notify('error', data.message, 'NFT Create Error');
                $.validator("nft_create_form", data.errors);
            }
        }


        $(document).ready(function(){ 
            dateInput();
            $('#sale_type').change(function(){ 
                dateInput();
            });  
            function dateInput(){
                var sale_val = $('#sale_type').val();
                if(sale_val == 2){
                    $('.col-increase').addClass('col-md-4');
                    $('.col-increase').removeClass('col-md-6');
                    $('.col-show').removeClass('d-none');
                }else{
                    $('.col-increase').removeClass('col-md-4');
                    $('.col-increase').addClass('col-md-6');
                    $('.col-show').addClass('d-none');
                }
            }

            if($('#if_collection').val() !== ''){  
                $('.col-increase2').addClass('col-md-4'); 
                $('.col-increase2').removeClass('col-md-6');
                $('.col-show2').removeClass('d-none');
            }
        })  
    </script>
@endsection
