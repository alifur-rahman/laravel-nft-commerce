@extends('layouts.users.user-layout')
@section('title','KYC Report')
@section('custom-css')
<!-- Datatable CSS -->
   

<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.min.css" integrity="sha512-cyIcYOviYhF0bHIhzXWJQ/7xnaBuIIOecYoPZBgJHQKFPo+TOBA+BY1EnTpmM8yKDU4ZdI3UGccNGCEUdfbBqw==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
<style>
table.dataTable>tbody>tr {
    background-color: #f8f9fa;
}
.input-two-wrapper .currency { 
    width: 100%;
}
.dropzone{
    background: var(--color-primary);
    border: 2px dotted #ddd;
    border-radius: 9px;
    padding: 29px;
}

.input-two-wrapper .currency {
    margin-right: 0px;
}
.input-two-wrapper .profile-edit-select {
    margin-top: 0px;

}
label{
    margin-top: 10px !important;
}


</style>
@endsection

@section('content')
  <!-- Start tabs area -->
  <div class="edit-profile-area rn-section-gapTop">
    <div class="container">
        {{-- <div class="row plr--70 padding-control-edit-wrapper pl_md--0 pr_md--0 pl_sm--0 pr_sm--0">
            <div class="col-12 d-flex justify-content-between mb--30 align-items-center">
                <h4 class="title-left">KYC Upload Here</h4>
                <a href="author.html" class="btn btn-primary ml--10"><i class="feather-eye mr--5"></i> Preview</a>
            </div>
        </div> --}}
        <div class="row plr--70 padding-control-edit-wrapper pl_md--0 pr_md--0 pl_sm--0 pr_sm--0">
            <div class="col-lg-3 col-md-3 col-sm-12">
                <!-- Start tabs area -->
                <nav class="left-nav rbt-sticky-top-adjust-five">
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                   
                        <button class="nav-link active" id="nav-home-tabs" data-bs-toggle="tab" data-bs-target="#nav-homes" type="button" role="tab" aria-controls="nav-homes" aria-selected="false"><i class="feather-user"></i>ID Proof</button>
                        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false"> <i class="feather-unlock"></i>Address Proof</button>
                       
                    </div>
                </nav>
                <!-- End tabs area -->
            </div>
               <!-------------------------ID Proof--------------------------->
            <div class="col-lg-9 col-md-9 col-sm-12 mt_sm--30">
                <div class="tab-content tab-content-edit-wrapepr" id="nav-tabContent">
                    <!-- sigle tab content -->
                    <form class="tab-pane fade show active" id="nav-homes" role="tabpanel" aria-labelledby="nav-home-tab">
                        @csrf
                        <input type="hidden" name="perpose" value="id proof">
                        <input type="hidden" name="op" value="admin">
                        <!-- start personal information -->
                        <div class="nuron-information">
                           
                                <div class="input-two-wrapper col-12">
                                    <div class="full-wid currency">
                                        <label for="document" class="form-label">Document Type</label>
                                        <select class="profile-edit-select" name="document_type">
                                            <option value="" selected>Select a document type first</option>
                                            @foreach($id_document_type as $value)
                                            <option value="{{$value->id}}">{{$value->id_type}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                          
                            <div class="profile-form-wrapper">
                                <div class="issue-area">
                                    <label for="issudate" class="form-label">Issue Date</label>
                                    <input type="date" data-date-format="yyyy-mm-dd" id="id-issue-date" class="form-control form-control-solid" placeholder="YYYY-MM-DD" name="issue_date"  />
                                </div>
                            </div>
                            <div class="profile-form-wrapper">
                                <div class="issue-area">
                                    <label for="expiredate" class="form-label">Expire Date</label>
                                    <input type="date" data-date-format="yyyy-mm-dd" id="id-expire-date" name="expire_date" class="form-control form-control-solid"  placeholder="YYYY-MM-DD" />
                                </div>
                            </div>
                            <div class="profile-form-wrapper">
                                <div class="issue-area">
                                    <label for="client-email" class="form-label">Client Email</label>
                                    <input type="text" name="client_email" class="form-control form-control-solid get-client" placeholder="client email" id="myInput" onkeyup="filterFunction()">
                                </div>
                            </div>
                            <div class="row" >
                                <div class="input-two-wrapper col-12">
                                    <div class="full-wid currency">
                                        <!-- select gender -->
                                        <label for="status" class="form-label">Status</label>
                                        <select class="profile-edit-select" name="status">
                                            <option></option>
                                            <option value="" selected>Select status</option>
                                            <option value="1">Verified</option>
                                            <option value="0">Pending</option>
                                            <option value="2">Decline</option>
                                        </select>
                                        <!-- end gender -->
                                    </div>
                                </div>
                            </div>

                            <div class="card-body p-8 pt-4">
                                <div class="col-sm-12">
                                    <div class="d-flex justify-content-end">
                                        <!-- id front part -->
                                        <div class="w-50">
                                            <div class="dropzone dropzone-area id-proof-dropzone w-100 text-center" data-field="front_part" id="id-dropzone" enctype="multipart/form-data" data-bs-toggle="tooltip" data-bs-placement="top" title="Drag and Drop or click your ID">
                                                <div class="dz-message justify-content-center">
                                                    <div class="dz-message-label text-white">Drop Your id front part</div>
                                                </div>
                                                <span class="svg-icon svg-icon-2">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path opacity="0.3" d="M10 4H21C21.6 4 22 4.4 22 5V7H10V4Z" fill="currentColor" />
                                                        <path d="M10.4 3.60001L12 6H21C21.6 6 22 6.4 22 7V19C22 19.6 21.6 20 21 20H3C2.4 20 2 19.6 2 19V4C2 3.4 2.4 3 3 3H9.20001C9.70001 3 10.2 3.20001 10.4 3.60001ZM16 11.6L12.7 8.29999C12.3 7.89999 11.7 7.89999 11.3 8.29999L8 11.6H11V17C11 17.6 11.4 18 12 18C12.6 18 13 17.6 13 17V11.6H16Z" fill="currentColor" />
                                                        <path opacity="0.3" d="M11 11.6V17C11 17.6 11.4 18 12 18C12.6 18 13 17.6 13 17V11.6H11Z" fill="currentColor" />
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>

                                        <!-- id back part -->
                                        <div class="w-50 ms-2">
                                            <div class="dropzone dropzone-area id-proof-dropzone w-100" data-field="back_part" id="id-back-part" enctype="multipart/form-data" data-bs-toggle="tooltip" data-bs-placement="top" title="Drag and Drop or click your ID Back Part">
                                                <div class="dz-message justify-content-center">
                                                    <div class="dz-message-label text-white">Drop Your id back part</div>
                                                </div>
                                                <span class="svg-icon svg-icon-2">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path opacity="0.3" d="M10 4H21C21.6 4 22 4.4 22 5V7H10V4Z" fill="currentColor" />
                                                        <path d="M10.4 3.60001L12 6H21C21.6 6 22 6.4 22 7V19C22 19.6 21.6 20 21 20H3C2.4 20 2 19.6 2 19V4C2 3.4 2.4 3 3 3H9.20001C9.70001 3 10.2 3.20001 10.4 3.60001ZM16 11.6L12.7 8.29999C12.3 7.89999 11.7 7.89999 11.3 8.29999L8 11.6H11V17C11 17.6 11.4 18 12 18C12.6 18 13 17.6 13 17V11.6H16Z" fill="currentColor" />
                                                        <path opacity="0.3" d="M11 11.6V17C11 17.6 11.4 18 12 18C12.6 18 13 17.6 13 17V11.6H11Z" fill="currentColor" />
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="button-area save-btn-edit">
                                <a href="#"  class="btn btn-primary-alta mr--15">Cancel</a>
                                <a href="#" class="btn btn-primary" id="upload-kyc-button">Save</a>
                            </div>
                        </div>
                    </form>
                    <!-- End single tabv content -->

                     <!-------------------------Address Proof--------------------------->
                    <form class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                       @csrf
                       <input type="hidden" name="perpose" value="address proof">
                        <input type="hidden" name="op" value="admin">
                        <!-- start personal information -->
                       <div class="nuron-information">
                        <div class="row" >
                            <div class="input-two-wrapper col-12">
                                <div class="full-wid currency">
                                    <!-- select gender -->
                                    <label for="document" class="form-label">Document Type</label>
                                    <select class="profile-edit-select" name="document_type">
                                        <option value="" selected>Select a document type first</option>
                                        @foreach($address_document_type as $value)
                                        <option value="{{$value->id}}">{{$value->id_type}}</option>
                                        @endforeach
                                    </select>
                                    <!-- end gender -->
                                </div>
                            </div>
                        </div>
                        <div class="profile-form-wrapper">
                            <div class="issue-area">
                                <label for="issudate" class="form-label">Issue Date</label>
                                <input type="date" id="id-issue-date" class="form-control form-control-solid " placeholder="YYYY-MM-DD" name="issue_date"  />
                            </div>
                        </div>
                        <div class="profile-form-wrapper">
                            <div class="issue-area">
                                <label for="expiredate" class="form-label">Expire Date</label>
                                <input type="date" id="id-expire-date" name="expire_date" class="form-control form-control-solid"  placeholder="YYYY-MM-DD" />
                            </div>
                        </div>
                        <div class="profile-form-wrapper">
                            <div class="issue-area">
                                <label for="client-email" class="form-label">Client Email</label>
                                <input type="text" name="client_email" class="form-control form-control-solid get-client" placeholder="client email" id="myInput" onkeyup="filterFunction()">
                            </div>
                        </div>
                        <div class="row" >
                            <div class="input-two-wrapper col-12">
                                <div class="full-wid currency">
                                    <!-- select gender -->
                                    <label for="status" class="form-label">Status</label>
                                    <select class="profile-edit-select" name="status">
                                        <option></option>
                                        <option value="" selected>Select status</option>
                                        <option value="1">Verified</option>
                                        <option value="0">Pending</option>
                                        <option value="2">Decline</option>
                                    </select>
                                    <!-- end gender -->
                                </div>
                            </div>
                        </div>

                        <div class="card-body p-8 pt-4">
                            <div class="col-sm-12">
                                <div class="d-flex justify-content-end">
                                    <!-- id front part -->
                                    <div class="w-50">
                                        <div class="dropzone dropzone-area address-proof-dropzone w-100 text-center" data-field="document" id="id-dropzone-address-proof" enctype="multipart/form-data" data-bs-toggle="tooltip" data-bs-placement="top" title="Drag and Drop or click your ID">
                                            <div class="dz-message justify-content-center">
                                                <div class="dz-message-label text-white">Drop Your id front part</div>
                                            </div>
                                            <span class="svg-icon svg-icon-2">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path opacity="0.3" d="M10 4H21C21.6 4 22 4.4 22 5V7H10V4Z" fill="currentColor" />
                                                    <path d="M10.4 3.60001L12 6H21C21.6 6 22 6.4 22 7V19C22 19.6 21.6 20 21 20H3C2.4 20 2 19.6 2 19V4C2 3.4 2.4 3 3 3H9.20001C9.70001 3 10.2 3.20001 10.4 3.60001ZM16 11.6L12.7 8.29999C12.3 7.89999 11.7 7.89999 11.3 8.29999L8 11.6H11V17C11 17.6 11.4 18 12 18C12.6 18 13 17.6 13 17V11.6H16Z" fill="currentColor" />
                                                    <path opacity="0.3" d="M11 11.6V17C11 17.6 11.4 18 12 18C12.6 18 13 17.6 13 17V11.6H11Z" fill="currentColor" />
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="button-area save-btn-edit">
                            <a href="#"  class="btn btn-primary-alta mr--15">Cancel</a>
                            <a href="#" class="btn btn-primary" id="upload-kyc-button-address">Save</a>
                        </div>
                    </div>
                    <!-- End personal information -->
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- End tabs area -->

        
@endsection

@section('custom-js')
<script src="{{asset('assets/user/js/pages/user-kyc-upload.js')}}"> </script>



<script src="{{ asset('assets/admin/custom-js/pages/common-ajax.js') }}"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>



<script src="{{asset('assets/admin/js/file-uploaders/dropzone.min.js')}}"></script>
<script src="{{asset('assets/admin/js/file-upload-with-form.js')}}"></script>
<script src="{{asset('assets/admin/custom-js/search-dropdown.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.all.min.js" integrity="sha512-IZ95TbsPTDl3eT5GwqTJH/14xZ2feLEGJRbII6bRKtE/HC6x3N4cHye7yyikadgAsuiddCY2+6gMntpVHL1gHw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>

$('#upload-kyc-button, #upload-kyc-button-address').click(function() {
        $(this).prop('disabled', true);
        setTimeout(() => {
            $(this).prop('disabled', false);
        }, 30000);
   
    })
// proof--------------
file_upload(
    "/user/verify-form", //<--request url for proccessing
    false, //<---auto process true or false
    ".id-proof-dropzone", //<---dropzones selectore
    "nav-homes", //<---form id/selectore
    "#upload-kyc-button", //<---submit button selectore
    "ID Proof" //<---Notification Title
);
// address proof--------------------------------------
file_upload(
    "/user/verify-form", //<--request url for proccessing
    false, //<---auto process true or false
    ".address-proof-dropzone", //<---dropzones selectore
    "nav-profile", //<---form id/selectore
    "#upload-kyc-button-address", //<---submit button selectore
    "Address proof" //<---Notification title
);
  
</script>
@endsection