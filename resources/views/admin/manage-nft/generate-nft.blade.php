@extends('layouts.admin.app')
@section('title', 'NFT Generator')
@section('breadcrumb')
    <h1 class="text-dark fw-bold my-0 fs-2">NFT Generator</h1>
    <ul class="breadcrumb fw-semibold fs-base my-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ url('admin/dashboard') }}" class="text-muted">Home</a>
        </li>
        <li class="breadcrumb-item text-muted">Manage NFT</li>
        <li class="breadcrumb-item text-dark">NFT Generator</li>
    </ul>
@endsection
@section('custom-css')
    <style>
        .image-input-wrapper {
            background-image: url({{ asset('assets/admin/media/svg/files/blank-image.svg') }} );
        }

        [data-theme="dark"] .image-input-placeholder {
            background-image: url({{ asset('assets/admin/media/svg/files/blank-image-dark.svg') }} );
        }

        .error-bottom .error-msg {
            position: relative;
            top: 72px;
            left: -64px;
        }

        .error-bottom1 .error-msg {
            top: 75px !important;
            position: relative;
            left: -88px;
        }

        .error-bottom3 .error-msg {
            position: absolute;
            top: 135px;
            display: flex;
            left: -9px;
        }

        .error-bottom3 {
            width: 230px !important;
            margin-top: 45px;
        }

        .image-input .image-input-wrapper {
            width: 100%;
            height: 100%;
            border-radius: 0.475rem;
            background-repeat: no-repeat;
            background-size: cover;
            box-shadow: none !important;
            border: none !important;
        }

        .img-card {
            /* height: -webkit-fill-available; */
            height: 260px;
        }
    </style>
@endsection

@section('content')

    <!--begin::Form-->
    <form id="nft_generate_form" class="form d-flex flex-column flex-lg-row" action="{{ route('admin.nft_generator') }}"
        method="POST">
        @csrf
        <!--begin::Aside column-->
        <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
            <!--begin::Thumbnail settings-->
            <div class="card card-flush py-4 img-card">
                <!--begin::Card header-->
                <div class="card-header">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <span class="required">Upload a picture</span>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body text-center">
                    <!--begin::Image input-->
                    <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3"
                        data-kt-image-input="true">
                        <!--begin::Preview existing avatar-->

                        <!--end::Preview existing avatar-->
                        <!--begin::Label-->
                        <label class="btn btn-active-color-primary h-125px bg-body shadow error-bottom3"
                            data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Upload cover photo">
                            <!--begin::Inputs-->
                            <div class="image-input-wrapper">
                                <input type="file" name="createNFTfile" accept=".png, .jpg, .jpeg" id="rbtinput2" />
                                <input type="hidden" name="avatar_remove" />
                            </div>
                            <!--end::Inputs-->
                        </label>
                        <!--end::Label-->
                        <!--begin::Cancel-->
                        {{-- <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                            data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel image">
                            <i class="bi bi-x fs-2"></i>
                        </span> --}}
                        <!--end::Cancel-->
                    </div>
                    <!--end::Image input-->

                </div>
                <!--end::Card body-->
            </div>
            <!--end::Thumbnail settings-->

        </div>
        <!--begin::Main column-->
        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
            <div class="card card-flush py-4">
                <!--begin::Card header-->
                <div class="card-header">
                    <div class="card-title">
                        <h2>Create NFT</h2>
                    </div>
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Input group-->
                    <div class="mb-10 row">
                        <div class="col-md-6 error-bottom1">
                            <!--begin::Label-->
                            <label class="required form-label">Select User</label>
                            <!--end::Label-->
                            <select class="form-select user-id" name="user_id" id="user_id"
                                data-placeholder="Select a User">
                                <option></option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <!--begin::Label-->
                            <label class="required form-label">Product Name</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" name="product_name" class="form-control" id="product_name"
                                placeholder="Product name" />
                            <!--end::Input-->
                        </div>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="mb-10 row">
                        <div class="rounded d-flex flex-column">
                            <label for="" class="form-label">Description</label>
                            <textarea class="form-control" data-kt-autosize="true" name="description"></textarea>
                        </div>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="mb-10 row">
                        <div class="rounded d-flex flex-column">
                            <label for="" class="form-label">Propertise</label>
                            <textarea class="form-control" data-kt-autosize="true" name="properties"></textarea>
                        </div>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="mb-10 row">
                        <div class="col-md-6 col-increase">
                            <label for="" class="form-label required">Item Price</label>
                            <input type="text" name="price" class="form-control" id="price" placeholder="Price" />
                        </div>
                        <div class="col-md-6 col-increase error-bottom">
                            <label for="" class="form-label required">Sale Type</label>
                            <select class="form-select" name="sale_type" id="sale_type" data-control="select2"
                                data-placeholder="Select an Sale Type">
                                <option></option>
                                <option value="1">Fixed price</option>
                                <option value="2">Timed Auction</option>
                                <option value="3">Not for Sale</option>
                                <option value="4">Open for offer</option>

                            </select>
                        </div>
                        <div class="col-md-4 col-show d-none">
                            <label for="bidding-deadline" class="form-label required">Bidding Deadline</label>
                            <input type="text" name="bidding_deadline" class="form-control date" id="bidding_deadline"
                                placeholder="Price" />
                        </div>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="mb-10 row">
                        <div class="col-md-6 col-increase2 error-bottom">
                            <label for="" class="form-label required">Category</label>
                            <select class="form-select" name="category" id="category" data-control="select2"
                                data-placeholder="Select a Category">
                                <option></option>
                                @php
                                    $categories = App\Models\NftAssetCategory::all();
                                @endphp
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category }}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="col-md-6 col-increase2">
                            <label for="" class="form-label">Royality</label>
                            <input type="text" name="royality" class="form-control" id="royality"
                                placeholder="Royality" />
                        </div>
                        <div class="col-md-4 set-collection">
                        </div>

                    </div>
                    <!--end::Input group-->
                    <!--begin::Actions-->
                    <div class="d-flex justify-content-end pt-7">
                        <button type="reset" class="btn btn-sm btn-light fw-bold btn-active-light-primary me-2 w-200px"
                            data-kt-search-element="preferences-dismiss">Cancel</button>
                        <button type="button" id="create_nft_btn" data-file="true"
                            data-loading="<i class='fas fa-circle-notch fa-spin'></i>" data-btnid="create_nft_btn"
                            data-form="nft_generate_form" data-validator="true" data-callback="nftGenerateCallBack"
                            class="btn fw-bold btn-primary w-200px" onclick=" _run(this)">Create NFT</button>
                    </div>
                    <!--end::Actions-->
                </div>
                <!--end::Card header-->
            </div>
        </div>
        <!--end::Main column-->
    </form>
    <!--end::Form-->

@endsection
@section('custom-script')
    <script>
        $('.user-id').on('change', function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var user_id = $(this).val();
            // alert(user_id);
            $.ajax({
                url: "/admin/manage-nft/get-collection/",
                type: 'POST',
                data: {
                    user_id: user_id
                },
                success: function(result) {
                    $(".set-collection").html(result);
                }
            });
        });

        function nftGenerateCallBack(data) {
            if (data.status == true) {
                notify('success', data.message, 'Nft Create Success');
                let x = document.getElementById("user_id");
                x.remove(x.selectedIndex);
                $(".image-input-wrapper").css("background-image",
                    "url({{ asset('assets/admin/media/svg/files/blank-image.svg') }} )");
                $("#nft_generate_form").trigger("reset");
            } else {
                notify('error', data.message, 'Create Collection Error!');
                $.validator("nft_generate_form", data.errors);
            }
        }

        $(document).ready(function() {
            $('#sale_type').change(function() {
                var sale_val = $(this).val();
                if (sale_val == 2) {
                    $('.col-increase').addClass('col-md-4');
                    $('.col-increase').removeClass('col-md-6');
                    $('.col-show').removeClass('d-none');
                } else {
                    $('.col-increase').removeClass('col-md-4');
                    $('.col-increase').addClass('col-md-6');
                    $('.col-show').addClass('d-none');
                }
            });

            if ($('#if_collection').val() !== '') {
                $('.col-increase2').addClass('col-md-4');
                $('.col-increase2').removeClass('col-md-6');
                $('.col-show2').removeClass('d-none');
            }
        })

        // ajax remote data
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#user_id").select2({
            ajax: {
                url: "/admin/manage-nft/getuser/id",
                type: "post",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        search: params.term // search term
                    };
                },
                processResults: function(response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }

        });
    </script>
@endsection
