@extends('layouts.users.user-layout')
@section('title','NFT Ranking')
@section('content')
<!-- start page title area -->
<div class="rn-breadcrumb-inner ptb--30">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 col-12">
                <h5 class="title text-center text-md-start">Our Top NFTs</h5>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <ul class="breadcrumb-list">
                    <li class="item"><a href="index.html">Home</a></li>
                    <li class="separator"><i class="feather-chevron-right"></i></li>
                    <li class="item current">Ranking</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- end page title area -->

<div class="rn-upcoming-area rn-section-gap pt-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- start Table Title -->
                <div class="table-title-area nuron-expo-filter-widget">
                    <form action="" method="post" id="filter-form" class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-4">
                                    <label for="filter-ratings">
                                        Rating
                                    </label>
                                    <div class="d-flex">
                                        <input type="hidden" name="rating">
                                        <a href="#" class="change-rating" data-rating="1">
                                            <i class="far fa-star text-success"></i>
                                        </a>
                                        <a href="#" class="change-rating" data-rating="2">
                                            <i class="far fa-star text-success"></i>
                                        </a>
                                        <a href="#" class="change-rating" data-rating="3">
                                            <i class="far fa-star text-success"></i>
                                        </a>
                                        <a href="#" class="change-rating" data-rating="4">
                                            <i class="far fa-star text-success"></i>
                                        </a>
                                        <a href="#" class="change-rating" data-rating="5">
                                            <i class="far fa-star text-success"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <label for="filter-ratings">

                                    </label>
                                    <div class="d-flex">
                                        <div class="nuron-form-check">
                                            <input type="checkbox" name="this_month" id="price-check2">
                                            <label for="price-check2">This Month</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <label for="filter-ratings">

                                    </label>
                                    <div class="d-flex">
                                        <div class="nuron-form-check">
                                            <input type="checkbox" name="this_week" id="price-check3">
                                            <label for="price-check3">This Week</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-lg-6"></div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <button type="button" id="btn-reset" class="btn btn-primary-alta w-100"> Reset</button>
                                        </div>
                                        <div class="col-lg-6">
                                            <button type="button" id="btn-filter" class="btn btn-primary-alta w-100"> Filter</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- End Table Title -->

                <!-- table area Start -->
                <div class="box-table table-responsive">
                    <table class="table upcoming-projects">
                        <thead>
                            <tr>
                                <th>
                                    <span>SL</span>
                                </th>
                                <th>
                                    <span>Product</span>
                                </th>
                                <!-- <th>
                                    <span>Volume</span>
                                </th> -->
                                <th>
                                    <span>Rating</span>
                                </th>
                                <th>
                                    <span>Views</span>
                                </th>
                                <th>
                                    <span>Floor Price</span>
                                </th>
                                <th>
                                    <span>Owners</span>
                                </th>
                                <th>
                                    <span>Sales</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="ranking">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('custom-js')
<script>
    
    var dt_ajax_table = $(".upcoming-projects");
    var datatable = dt_ajax_table.fetch_data({
        url: "/nft/ranking",
        columns: [{
                "data": "sl"
            },
            {
                "data": "product"
            },

            {
                "data": "rating"
            },
            {
                "data": "views"
            },
            {
                "data": "floor_price"
            },
            {
            "data": "owners"
            },
            {
                "data": "items"
            },
        ],
        icon_feather: true,
        csv_export: false,
        description: true,
    });

    // rating hove
    // change rating color on hover
    (function($) {
        $.fn.rating = function(options) {
            var settings = $.extend({
                color_class: 'text-warning'
            });

            // this.hover(function() {
            //     $(this).prevAll().find('svg').addClass('text-warning fas').removeClass('text-success far');
            //     $(this).find('svg').addClass('text-warning fas').removeClass('text-success far');
            // });
            // this.on("mouseleave",function() {
            //     $(this).closest('div').find('svg').addClass('text-success far').removeClass('text-warning fas');
            // });
            this.on("click",function () {
                $(this).closest('div').find('svg').removeClass('text-warning fas');
                $(this).prevAll().find('svg').toggleClass('text-warning fas');
                $(this).find('svg').toggleClass('text-warning fas');
                $(this).closest('div').find('input[name=rating]').val($(this).data('rating'))
            })
        }
    }(jQuery));
    $(".change-rating").rating();
</script>
@endsection