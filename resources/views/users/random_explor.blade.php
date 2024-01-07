@php
use App\Services\AllfunctionService;
use App\Services\likeOperactionService;
$likeService = new likeOperactionService();
@endphp
@foreach ($datas as $data)
    <div data-sal="slide-up" data-sal-delay="200" data-sal-duration="800" class="col-5 col-lg-4 col-md-6 col-sm-6 col-12"
        style="transform: translateY(0%);">
        <div class="product-style-one no-overlay">
            <div class="card-thumbnail">
                <a href="{{ url('asset-details/' . $data->id) }}"><img
                        src="{{ asset('Uploads/nft-assets' . '/' . $data->images[0]->image) }}" alt="NFT_portfolio"></a>
            </div>
            <div class="product-share-wrapper">
                <div class="profile-share">
                    @php
                        $get_user = AllfunctionService::get_all_bid_users_image($data->id);
                    @endphp
                    @foreach ($get_user as $item)
                        @if ($item->profile_photo)
                            <a href="{{ url('/profile') . '/' . $item->bidder_id }}" class="avatar"
                                data-tooltip="{{ $item->name }}"><img
                                    src="{{ asset('Uploads/profile') . '/' . $item->profile_photo }}"
                                    alt="Nft_Profile"></a>
                        @else
                            <a href="{{ url('/profile') . '/' . $item->bidder_id }}" class="avatar"
                                data-tooltip="{{ $item->name }}"><img
                                    src="{{ asset('Uploads/profile/avater-men.jpg') }}" alt="Nft_Profile"></a>
                        @endif
                    @endforeach
                    <a class="more-author-text" href="#">{{ AllfunctionService::get_all_bid_counts($data->id) }}
                        Place Bit.</a>
                </div>
                <div class="share-btn share-btn-activation dropdown">
                    <button class="icon" data-bs-toggle="dropdown" aria-expanded="false">
                        <svg viewBox="0 0 14 4" fill="none" width="16" height="16"
                            class="sc-bdnxRM sc-hKFxyN hOiKLt">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M3.5 2C3.5 2.82843 2.82843 3.5 2 3.5C1.17157 3.5 0.5 2.82843 0.5 2C0.5 1.17157 1.17157 0.5 2 0.5C2.82843 0.5 3.5 1.17157 3.5 2ZM8.5 2C8.5 2.82843 7.82843 3.5 7 3.5C6.17157 3.5 5.5 2.82843 5.5 2C5.5 1.17157 6.17157 0.5 7 0.5C7.82843 0.5 8.5 1.17157 8.5 2ZM11.999 3.5C12.8274 3.5 13.499 2.82843 13.499 2C13.499 1.17157 12.8274 0.5 11.999 0.5C11.1706 0.5 10.499 1.17157 10.499 2C10.499 2.82843 11.1706 3.5 11.999 3.5Z"
                                fill="currentColor"></path>
                        </svg>
                    </button>

                    <div class="share-btn-setting dropdown-menu dropdown-menu-end">
                        <button type="button" data-id="{{ $data->id }}" class="btn-setting-text share-text"
                            data-bs-toggle="modal" data-bs-target="#shareModal">
                            Share
                        </button>
                        @if (Auth::check())
                            @if (Auth::user()->id == $data->user->id)
                                <button type="button" class="btn-setting-text collection-text btn-collection"
                                    data-id="{{ $data->id }}" data-bs-toggle="modal"
                                    data-bs-target="#collectionModel">
                                    Add Collection
                                </button>

                                <a class="btn-setting-text collection-text btn-collection"
                                    href="{{ url('edit/nft/' . $data->id) }}">Edit</a>
                            @endif
                        @else
                            <button type="button" class="btn-setting-text report-text" data-bs-toggle="modal"
                                data-bs-target="#reportModal">
                                Report
                            </button>
                        @endif
                    </div>

                </div>
            </div>
            <a href="{{ url('asset-details/' . $data->id) }}"><span
                    class="product-name">{{ $data->name }}</span></a>
            @if (AllfunctionService::get_highest_bid_amount($data->id))
                <span class="latest-bid">Highest bid:
                    <b>{{ AllfunctionService::get_highest_bid_amount($data->id) }}</b></span>
            @else
                <span class="latest-bid">Highest bid: <b>0</b></span>
            @endif
            <div class="bid-react-area">
                <div class="last-bid">{{ $data->base_price }}wETH</div>
                <div class="react-area" {{ $likeService->is_liked($data->id) }}>
                    <svg viewBox="0 0 17 16" fill="none" width="16" height="16"
                        class="sc-bdnxRM sc-hKFxyN kBvkOu">
                        <path
                            d="M8.2112 14L12.1056 9.69231L14.1853 7.39185C15.2497 6.21455 15.3683 4.46116 14.4723 3.15121V3.15121C13.3207 1.46757 10.9637 1.15351 9.41139 2.47685L8.2112 3.5L6.95566 2.42966C5.40738 1.10976 3.06841 1.3603 1.83482 2.97819V2.97819C0.777858 4.36443 0.885104 6.31329 2.08779 7.57518L8.2112 14Z"
                            stroke="currentColor" stroke-width="2"></path>
                    </svg>
                    <span class="number">{{ $likeService->like_count($data->id) }}</span>
                </div>
            </div>
        </div>
    </div>
@endforeach
