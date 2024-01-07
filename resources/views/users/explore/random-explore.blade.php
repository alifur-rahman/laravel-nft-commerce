@php
use App\Services\likeOperactionService;
use App\Services\AllfunctionService;
$likeService = new likeOperactionService();
@endphp

@foreach ($NftAsset as $item)
    <!-- start single product -->
    <div class="col-lg-4 col-md-6 col-sm-12"> 
        <div class="product-style-one no-overlay with-placeBid">
            <div class="card-thumbnail">
                <a href="{{ url('asset-details/' . $item->id) }}">
                    <img id="explore_img"
                        src="{{ asset('/Uploads/nft-assets') . '/' . $item->images[0]->image }}"
                        alt="NFT_portfolio">
                </a>
                <a href="{{ url('asset-details/' . $item->id) }}" class="btn btn-primary">Place
                    Bid</a>
            </div>
            <div class="product-share-wrapper">
                <div class="profile-share">
                    
                    @php 
                        $get_user = AllfunctionService::get_all_bid_users_image($item->id); 
                    @endphp
                    @foreach ($get_user as $data) 
                        @if ($data->profile_photo)
                            <a href="{{url('/profile').'/'.$data->id}}" class="avatar" data-tooltip="{{$data->name}}"><img
                            src="{{ asset('Uploads/profile').'/'.$data->profile_photo }}"
                            alt="Nft_Profile"></a>
                        @else
                            <a href="{{url('/profile').'/'.$data->id}}" class="avatar" data-tooltip="{{$data->name}}"><img
                            src="{{ asset('Uploads/profile/avater-men.jpg') }}"
                            alt="Nft_Profile"></a>
                        @endif 
                        
                    @endforeach 
                    <a class="more-author-text" href="#">{{AllfunctionService::get_all_bid_counts($item->id)}} Place Bit.</a>
                </div>
                <div class="share-btn share-btn-activation dropdown">
                    <button class="icon" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <svg viewBox="0 0 14 4" fill="none" width="16" height="16"
                            class="sc-bdnxRM sc-hKFxyN hOiKLt">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M3.5 2C3.5 2.82843 2.82843 3.5 2 3.5C1.17157 3.5 0.5 2.82843 0.5 2C0.5 1.17157 1.17157 0.5 2 0.5C2.82843 0.5 3.5 1.17157 3.5 2ZM8.5 2C8.5 2.82843 7.82843 3.5 7 3.5C6.17157 3.5 5.5 2.82843 5.5 2C5.5 1.17157 6.17157 0.5 7 0.5C7.82843 0.5 8.5 1.17157 8.5 2ZM11.999 3.5C12.8274 3.5 13.499 2.82843 13.499 2C13.499 1.17157 12.8274 0.5 11.999 0.5C11.1706 0.5 10.499 1.17157 10.499 2C10.499 2.82843 11.1706 3.5 11.999 3.5Z"
                                fill="currentColor"></path>
                        </svg>
                    </button>

                    <div class="share-btn-setting dropdown-menu dropdown-menu-end">
                        <button type="button" data-id="{{ $item->id }}" class="btn-setting-text share-text"
                            data-bs-toggle="modal" data-bs-target="#shareModal">
                            Share
                        </button>
                        @if (Auth::check())
                            @if (Auth::user()->id == $item->user->id)
                                <button type="button"
                                    class="btn-setting-text collection-text btn-collection"
                                    data-id="{{ $item->id }}" data-bs-toggle="modal"
                                    data-bs-target="#collectionModel">
                                    Add Collection
                                </button>

                                <a class="btn-setting-text collection-text btn-collection"
                                                href="{{ url('edit/nft/' . $item->id) }}">Edit</a>
                            @endif
                        @else
                            <button type="button" class="btn-setting-text report-text"
                                data-bs-toggle="modal" data-bs-target="#reportModal">
                                Report
                            </button>
                        @endif
                    </div>

                </div>
            </div>

            <a href="{{ url('asset-details/' . $item->id) }}"><span id="explore_product_name"
                    class="product-name">{{ $item->name }}</span></a>
            <span class="latest-bid">Highest bid 1/20</span>
            <div class="bid-react-area">
                <div class="last-bid" id="base_price">{{ $item->base_price }} wETH</div>
                <div class="react-area" {{ $likeService->is_liked($item->id) }}>
                    <svg viewBox="0 0 17 16" fill="none" width="16" height="16"
                        class="sc-bdnxRM sc-hKFxyN kBvkOu">
                        <path
                            d="M8.2112 14L12.1056 9.69231L14.1853 7.39185C15.2497 6.21455 15.3683 4.46116 14.4723 3.15121V3.15121C13.3207 1.46757 10.9637 1.15351 9.41139 2.47685L8.2112 3.5L6.95566 2.42966C5.40738 1.10976 3.06841 1.3603 1.83482 2.97819V2.97819C0.777858 4.36443 0.885104 6.31329 2.08779 7.57518L8.2112 14Z"
                            stroke="currentColor" stroke-width="2"></path>
                    </svg>
                    <span class="number">{{ $likeService->like_count($item->id) }}</span>
                </div>
            </div>
        </div>
    </div>
    <!-- end single product -->
@endforeach 