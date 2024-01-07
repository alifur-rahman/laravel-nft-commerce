@extends('layouts.admin.app')
@section('title', 'Collection Create')
@section('breadcrumb')
    <h1 class="text-dark fw-bold my-0 fs-2">Create Collection</h1>
    <ul class="breadcrumb fw-semibold fs-base my-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ url('admin/dashboard') }}" class="text-muted">Home</a>
        </li>
        <li class="breadcrumb-item text-muted">Manage Collection</li>
        <li class="breadcrumb-item text-dark">Create Collection</li>
    </ul>
@endsection
@section('custom-css')
    <style>
        .image-input-wrapper {
            background-image: url({{ asset('assets/admin/media/svg/files/blank-image.svg') }});
        }

        [data-theme="dark"] .image-input-placeholder {
            background-image: url({{ asset('assets/admin/media/svg/files/blank-image-dark.svg') }} );
        }

        .error-bottom1 .error-msg {
            position: relative;
            top: 70px;
            left: -86px;
        }

        .error-bottom2 .error-msg {
            position: absolute;
            top: 173px;
            display: flex;
            left: -159px;
        }

        .error-bottom3 .error-msg {
            position: absolute;
            top: 135px;
            display: flex;
            left: -1px;
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
        .img-card{
            /* height: -webkit-fill-available; */
            height: 260px;
        }
    </style>
@endsection

@section('content')

    <!--begin::Form-->
    <form id="create_collection_form" class="form d-flex flex-column flex-lg-row"
        action="{{ route('admin.create_collection') }}" method="POST">
        @csrf
        <!--begin::Aside column-->
        <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
            <!--begin::Thumbnail settings-->
            <div class="card card-flush py-4 img-card">
                <!--begin::Card header-->
                <div class="card-header">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <span class="required">Profile Photo</span>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body text-center">
                    <!--begin::Image input-->
                    {{-- <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3"
                        data-kt-image-input="true" id="img_1">
                        <!--begin::Preview existing avatar-->
                        <div class="image-input-wrapper w-150px h-150px"></div>
                        <!--end::Preview existing avatar-->
                        <!--begin::Label-->
                        <label
                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow error-bottom2"
                            data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Upload profile photo">
                            <i class="bi bi-pencil-fill fs-7"></i>
                            <!--begin::Inputs-->
                            <input type="file" name="profile_photo" accept=".png, .jpg, .jpeg" id="rbtinput1" />
                            <input type="hidden" name="avatar_remove" />
                            <!--end::Inputs-->
                        </label>
                        <!--end::Label-->
                        <!--begin::Cancel-->
                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                            data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel image">
                            <i class="bi bi-x fs-2"></i>
                        </span>
                        <!--end::Cancel-->
                        <!--begin::Remove-->
                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                            data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove image">
                            <i class="bi bi-x fs-2"></i>
                        </span>
                        <!--end::Remove-->
                    </div> --}}
                    <!--end::Image input-->
                    <!--begin::Image input-->
                    <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3"
                        data-kt-image-input="true">
                        <!--begin::Preview existing avatar-->

                        <!--end::Preview existing avatar-->
                        <!--begin::Label-->
                        <label class="btn btn-active-color-primary h-125px bg-body shadow error-bottom3"
                            data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Upload Profile photo">
                            <!--begin::Inputs-->
                            <div class="image-input-wrapper">
                                <input type="file" name="profile_photo" accept=".png, .jpg, .jpeg" id="rbtinput1" />
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

            <!--begin::Thumbnail settings-->
            <div class="card card-flush py-4 img-card">
                <!--begin::Card header-->
                <div class="card-header">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <span class="required">Cover Photo</span>
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
                                <input type="file" name="cover_photo" accept=".png, .jpg, .jpeg" id="rbtinput2" />
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
                        <h2>Create Collection</h2>
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
                            <label class="required form-label">Collection Name</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" name="name" class="form-control" id="name"
                                placeholder="collection name" />
                            <!--end::Input-->
                        </div>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="mb-10 row">
                        <div class="rounded d-flex flex-column">
                            <label for="" class="form-label">Description</label>
                            <textarea class="form-control" data-kt-autosize="true" rows="10" name="description"></textarea>
                        </div>
                    </div>
                    <!--end::Input group-->

                    <!--begin::Actions-->
                    <div class="d-flex justify-content-end pt-7">
                        <button type="reset" class="btn btn-sm btn-light fw-bold btn-active-light-primary me-2 w-200px"
                            data-kt-search-element="preferences-dismiss">Cancel</button>
                        <button type="button" id="create_collection_btn" data-file="true"
                            data-loading="<i class='fas fa-circle-notch fa-spin'></i>" data-btnid="create_collection_btn"
                            data-form="create_collection_form" data-validator="true" data-callback="createCollection"
                            class="btn fw-bold btn-primary w-200px" onclick=" _run(this)">Create Collection</button>
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
        function createCollection(data) {
            if (data.status == true) {
                notify('success', data.message, 'Collection Create Success');
                let x = document.getElementById("user_id");
                x.remove(x.selectedIndex);
                $(".image-input-wrapper").css("background-image",
                    "url({{ asset('assets/admin/media/svg/files/blank-image.svg') }} )");
                $("#create_collection_form").trigger("reset");
            } else {
                notify('error', data.message, 'Collection Create Failed!');
                $.validator("create_collection_form", data.errors);
            }
        }

        // ajax remote data
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#user_id").select2({
            ajax: {
                url: "/admin/manage-collection/getuser/id",
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
