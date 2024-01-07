(function (window, document, $) { 
    $("#client-type").on("change",function () {
        let type = $(this).val();
        // END: Show/hide issue row
        // -------------------------------------------------------------
        // START: get client
        $.ajax({
            type: "GET",
            url: '/admin/kyc-management/get-client/'+type,
            dataType: 'json',
            success: function (data) {
                $("#client").html(data.users);
            }
        });//END: get client
    });
    // END: Client Type
    // ---------------------------------------------------------------------------
    // START: get finance details
    $(document).on('change','#client',function () {
        let client_id = $(this).val();
        $.ajax({
            type: "GET",
            url: '/admin/kyc-management/get-client-details/'+client_id,
            dataType: 'json',
            success: function (data) {
                $("#name").html(data.name);
                $("#address").html(data.address);
                $("#zip-code").html(data.zip_code);
                $("#city").html(data.city);
                $("#state").html(data.state);
                $("#user-type").html(data.type);
                $("#user-name-top").html(data.name);
            }
        });//END: get client
    })// END: Get finance detailed

    // START: kyc submit kyc form
    // -----------------------------------------------------------------------------------
    $(document).on('submit','#kyc-upload-form',function (event) {
        let form_data = $(this).serializeArray();
        event.preventDefault();
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: '/admin/kyc-management/kyc-store',
            dataType: 'json',
            data: form_data,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (data) {
                if (data.status == true) {
                    toastr['success'](data.message, 'KYC Upload',{
                        showMethod: 'slideDown',
                        hideMethod: 'slideUp',
                        closeButton: true,
                        tapToDismiss: false,
                        progressBar: true,
                        timeOut: 2000,
                    });
                    $("#kyc-upload-form")[0].reset();
                    $('#document-type').trigger("change");
                    $('#client-type, #client').trigger("change");
                    $('#status, #id-type').trigger("change");
                    $('.img-front-part-u, .img-back-part-u, #back-part-col, #front-part-col, .img-address-proof-u, #address-proof-img-col, #address-proof-col').slideUp();
                    $('#disabled-dropzone').slideDown();

                    // sending mail for kyc decline
                    if (data.kyc_decline == true) {
                        $("#kyc-decline-mail-modal").modal("show");
                        $.ajaxSetup({
                            headers: {
                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: "POST",
                            url: '/admin/kyc-management/kyc-upload-decline-mail',
                            dataType: 'json',
                            data: {last_id:data.last_id},
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            success: function (mail_data) {
                                $("#kyc-decline-mail-modal").modal("hide");
                                if (mail_data.status==true) {
                                    toastr['success'](mail_data.message, 'KYC Upload',{
                                        showMethod: 'slideDown',
                                        hideMethod: 'slideUp',
                                        closeButton: true,
                                        tapToDismiss: false,
                                        progressBar: true,
                                        timeOut: 2000,
                                    });
                                }
                                else{
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Decline mail!',
                                        html: 'Mail sending failed, Try sendin mail manualy',
                                        customClass: {
                                            confirmButton: 'btn btn-danger'
                                        }
                                    })
                                }
                                
                            }
                        });
                    }
                }
                if (data.status == false) {
                    
                    let error_list = '<ol style="text-align:left">'
                    if (data.errors.hasOwnProperty('document_type')) {
                        error_list += '<li>'+data.errors.document_type+'</li>';
                    }
                    if (data.errors.hasOwnProperty('client_type')) {
                        error_list += '<li>'+data.errors.client_type+'</li>';
                    }
                    if (data.errors.hasOwnProperty('client')) {
                        error_list += '<li>'+data.errors.client+'</li>';
                    }
                    if (data.errors.hasOwnProperty('status')) {
                        error_list += '<li>'+data.errors.status+'</li>';
                    }
                    if (data.errors.hasOwnProperty('id_type')) {
                        error_list += '<li>'+data.errors.id_type+'</li>';
                    }
                    if (data.errors.hasOwnProperty('front_part')) {
                        error_list += '<li>'+data.errors.front_part+'</li>';
                    }
                    if (data.errors.hasOwnProperty('back_part')) {
                        error_list += '<li>'+data.errors.back_part+'</li>';
                    }
                    if (data.errors.hasOwnProperty('address_proof')) {
                        error_list += '<li>'+data.errors.address_proof+'</li>';
                    }
                    if (data.errors.hasOwnProperty('decline_reason')) {
                        error_list += '<li>'+data.errors.decline_reason+'</li>';
                    }
                    if (data.message) {
                        error_list += '<li>'+data.message+'</li>';
                    }
                    error_list += '</ol>'
                    Swal.fire({
                        icon: 'error',
                        title: 'Wallet Balance!',
                        html: error_list,
                        customClass: {
                            confirmButton: 'btn btn-danger'
                        }
                    })
                }
                submit_wait("#save-wallet-balance",data.submit_wait);
            }
        });
    })//END: form submit

    // START: Form submit by click button
    // ---------------------------------------------------------------------------------
    // click form button and submit form
    $(document).on("click","#upload-kyc-button",function () {
        $("#kyc-upload-form").trigger("submit");
    })

    submit_wait("#save-wallet-balance");
    // START: get id type
    // on change document type
    // ---------------------------------------------------------------------------------
    $('#document-type').val("");
    $(document).on("change","#document-type",function () {
        let id_group = $(this).val();
        if (id_group.toLowerCase()==='id proof') {
            $("#issue-date-row").slideDown();
            $("#expire-date-row").slideDown();
        }
        else{
            $("#issue-date-row").slideUp();
            $("#expire-date-row").slideUp();
        }
        $.ajax({
            type: "GET",
            url: '/admin/kyc-management/kyc-get-id-type/'+id_group,
            dataType: 'json',
            success: function (data) {
                // console.log(data)
                $("#id-type").html(data.options);
            }
        });
    });

    $("#client-type, #status").val('');

    // kyc files upload by drop zone
    // -----------------------------------------------------------------------------------------------
    
    Dropzone.autoDiscover = false;
    'use strict';

    // upload front part of id
    // START: dropzone
    // -------------------------------------------------------------------------------
    var front_part = $('#dpz-front-part');
    var uploaded_file_name;

    //Remove Thumbnail
    front_part.dropzone({
        paramName: 'file', // The name that will be used to transfer the file
        maxFilesize: 1, // MB
        addRemoveLinks: true,
        removedfile: function(file) {
            var name = uploaded_file_name; 
            $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: '/admin/kyc-management/kyc-upload-front-delete-file',
                data: {name: name},
                sucess: function(data){
                    toastr['error']("Please upload Front part of your ID", 'ID front part',{
                        showMethod: 'slideDown',
                        hideMethod: 'slideUp',
                        closeButton: true,
                        tapToDismiss: false,
                        progressBar: true,
                        timeOut: 2000,
                    });
                }
            });
            var _ref;
            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
        },
        dictRemoveFile: ' Trash',
        acceptedFiles: 'image/*',
        maxFiles: 1,
        url: "/admin/kyc-management/kyc-front-upload-file",
        method:'post',
        headers: {
            'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content
        },
        success: function( file, response ){
            uploaded_file_name =response.id; // <---- here is your filename
            $(".img-front-part-u").slideUp();
       }
    });

    // upload back part of id
     // START: dropzone
    // -------------------------------------------------------------------------------------------
    var back_part = $('#dpz-back-part');
    var uploaded_file_name;
    

    //Remove Thumbnail
    back_part.dropzone({
        paramName: 'file', // The name that will be used to transfer the file
        maxFilesize: 1, // MB
        addRemoveLinks: true,
        removedfile: function(file) {
            var name = uploaded_file_name; 
            $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: '/admin/kyc-management/kyc-upload-back-delete-file',
                data: {name: name},
                sucess: function(data){
                    console.log('success: ' + data);
                }
            });
            var _ref;
            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
        },
        dictRemoveFile: ' Trash',
        acceptedFiles: 'image/*',
        maxFiles: 1,
        url: "/admin/kyc-management/kyc-back-upload-file",
        method:'post',
        headers: {
            'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content
        },
        success: function( file, response ){
            $(".img-back-part-u").slideUp();
            uploaded_file_name =response.id; // <---- here is your filename
       }
    });
    // upload address proof
     // START: dropzone
    // -------------------------------------------------------------------------------------------
    var back_part = $('#dpz-address-proof');
    var uploaded_file_name;

    //Remove Thumbnail
    back_part.dropzone({
        paramName: 'file', // The name that will be used to transfer the file
        maxFilesize: 1, // MB
        addRemoveLinks: true,
        removedfile: function(file) {
            var name = uploaded_file_name; 
            $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: '/admin/kyc-management/kyc-upload-address-delete-file',
                data: {name: name},
                sucess: function(data){
                    console.log('success: ' + data);
                }
            });
            var _ref;
            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
        },
        dictRemoveFile: ' Trash',
        acceptedFiles: 'image/*',
        maxFiles: 1,
        url: "/admin/kyc-management/kyc-address-upload-file/",
        method:'post',
        headers: {
            'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content
        },
        success: function( file, response ){
            uploaded_file_name =response.id; // <---- here is your filename
       }
    });

    // get decline reason field
    // ------------------------------------------------------------------------------
    $("#status").on("change",function () {
        let status = $(this).val();
        if (status==2) {
            $("#decline-reason-row").slideDown();
        }
        else{
            $("#decline-reason-row").slideUp();
        }
    });

    // validation check and auto activate file uploader
    // ------------------------------------------------------------------------------------------
    var document_type_err = true;
    var issue_date_err = false;
    var expire_date_err = false;
    var doc_type ;
    // document type validation
    $(document).on("change","#document-type",function () {
        let document_type = $(this).val();
        doc_type = document_type;
        if (document_type !== "") {
            document_type_err = false;
            if (document_type === 'id proof') {
                issue_date_err = true;
                expire_date_err = true;
                $("#front-part-col, #back-part-col, #front-part-img-col, #back-part-img-col").slideDown();
                $("#disabled-dropzone, #address-proof-col, #address-proof-img-col").slideUp();
            }
            else if (document_type === 'address proof') {
                $("#front-part-col, #back-part-col, #front-part-img-col, #back-part-img-col").slideUp();
                $("#address-proof-col, #address-proof-img-col").slideDown();
                $("#disabled-dropzone").slideUp();
            }
            else{
                issue_date_err = false;
                expire_date_err = false;
            }
        }
        else{
            document_type_err = true;
            $("#front-part-col, #back-part-col, #address-proof-col").slideUp();
            $("#disabled-dropzone").slideDown();
        }
        

    });
    // client type validation
    var client_type_err = true;
    $(document).on("change","#client-type",function () {
        let client_type = $(this).val();
        if (client_type !== "") {
            client_type_err = false;
        }
        else{
            client_type_err = true;
        }
    });

    // client validation
    var client_err = true;
    $(document).on("change","#client",function () {
        let client = $(this).val();
        if (client !== "") {
            client_err = false;
        }
        else{
            client_err = true;
        }

    });
    // status validation
    var status_err = true;
    $(document).on("change",'#status',function () {
        let status = $(this).val();
        if (status !== "") {
            status_err = false;
        }
        else{
            status_err = true;
        }
    });

    //id type validation
    var id_type_err = true;
    $(document).on("change","#id-type",function () {
        let id_type = $(this).val();
        if (id_type !== "") {
            id_type_err = false;
        }
        else{
            id_type_err = true;
        }
    });

    // incode validation
    var incode_err = true;
    $(document).on("blure","#incode",function () {
        let incode = $(this).val();
        if (incode !== "") {
            incode_err = false;
        }
        else{
            incode_err = true;
        }
    });

    // issudate validation
    $(document).on("change","#issue-date",function () {
        let issue_date = $(this).val();
        if (issue_date !== "") {
            issue_date_err = false;
        }
        else{
            issue_date_err = true;
        }
    });
    // expire date validation
    $(document).on("change","#expire-date",function () {
        let expire_date = $(this).val();
        if (expire_date !== "") {
            expire_date_err = false;
        }
        else{
            expire_date_err = true;
        }
    });

    // enabled drag drop opiton
    $(document).on( "mouseenter mouseleave","#dpz-address-proof",function () {
        if (document_type_err == false && client_type_err == false && client_err == false && status_err == false && id_type_err == false && incode_err == false && issue_date_err == false && expire_date_err == false) {
            $(this).prop("disabled",false);
        }
        else{
            $(this).prop("disabled",true);
        }
    })

   
})(window, document, jQuery);