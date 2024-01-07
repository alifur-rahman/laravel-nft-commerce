(function (window, document, $) {

    $(document).on('click', ".kyc-modal", function () {
      $("#userDescriptionModel").modal("show");
  
      var id = $(this).data('id');
      var table_id = $(this).data('table_id');
  
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        url: '/admin/kyc-management/kyc-request-description/' + id + '/' + table_id,
        method: 'GET',
        dataType: 'json',
        success: function (data) {
          if (data.group_name == 'id proof') {
            $('#pills-profile-tab').show();
            var frontPart = `/${data.image_path}/${data.images.front_part}`;
            $('#front_part').attr("src", frontPart);
  
            var backPart = `/${data.image_path}/${data.images.back_part}`;
            $('#backpart_part').attr("src", backPart);
          } else if (data.group_name == 'address proof') {
            $('#pills-profile-tab').hide();
            var address_proof = `/${data.image_path}/${data.images.front_part}`;
            $('#front_part').attr("src", address_proof);
          }
          $('#user-status').html(data.status);
          $('#user_name').text(data.user.name);
          $('#user-email').text(data.user.email);
          $('#user-phone').text(data.user.phone);
          $('#user-city').text(data.user.city);
          $('#user-state').text(data.user.state);
          $('#user-address').text(data.user.address);
          $('#user-zip-code').text(data.user.zip_code);
          $('#user-issue_date').text(data.issue_date);
          $('#user-exp_date').text(data.exp_date);
          $('#user-doc_type').text(data.document_name);
          $('#user-country').text(data.country.name);
          $('#user-dob').text(data.dob);
          $('#user-issuer-country').text(data.country.name);
  
          var hidden = data.user_kyc_sts;
          if (hidden != 0) {
            document.getElementById('decline_button').style.visibility = 'hidden';
            document.getElementById('approve_button').style.visibility = 'hidden';
          }
          else {
            document.getElementById('decline_button').style.visibility = 'visible';
            document.getElementById('approve_button').style.visibility = 'visible';
          }
        }
      });
    });
  })(window, document, jQuery);
  
  /*<!---------------Approve Data request operation------------------!>*/
  function kycApproveRequest() {
    var id = $('#approve_id').val();
    var table_id = $('#table_id').val();
    let warning_title = "";
    let warning_msg = "";
    let request_for;
  
    warning_title = 'Are you sure? to Approve this user!';
    warning_msg = 'If you want to Approve this User please click OK, otherwise simply click cancel';
    request_for = 'block';
  
    Swal.fire({
      icon: 'warning',
      title: warning_title,
      html: warning_msg,
  
      showCancelButton: true,
      customClass: {
        confirmButton: 'btn btn-warning',
        cancelButton: 'btn btn-danger'
      },
    }).then((willDelete) => {
      if (willDelete.isConfirmed) {
        $('#send-mail-pass').modal('toggle');
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.ajax({
          url: '/admin/kyc-management/kyc-approve-request/' + id + '/' + table_id,
          method: 'POST',
          dataType: 'json',
          data: { id: id, request_for: request_for },
          success: function (data) {
            if (data.success === true) {
              toastr['success'](data.message, 'Mail send', {
                showMethod: 'slideDown',
                hideMethod: 'slideUp',
                closeButton: true,
                tapToDismiss: false,
                progressBar: true,
                timeOut: 2000,
  
              });
              $('#send-mail-pass').modal('toggle');
              Swal.fire({
                icon: 'success',
                title: data.success_title,
                html: data.message,
                customClass: {
                  confirmButton: 'btn btn-success'
                }
  
              }).then((willDelete) => {
                const table = $("#kyc_report_tbl").DataTable();
                table.draw();
              });
            } else {
  
              Swal.fire({
                icon: 'error',
                title: 'Mail sending failed!',
                html: data.message,
                customClass: {
                  confirmButton: 'btn btn-danger'
                }
              });
            }
          }
        });
      }
    });
  }
  
  // User Profile data show
  function update_profile(e) {
    let obj = $(e);
    var id = obj.data('id');
    console.log(id);
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: '/admin/kyc-management/kyc-request-profile-view/' + id,
      method: 'GET',
      dataType: 'json',
    //   data: {}
      success: function (data) {
        $('#country').html(data.country_option);
        $('#name').val(data.user_info.name);
        $('#state').val(data.user_info.state);
        $('#zip').val(data.user_info.zip_code);
        $('#city').val(data.user_info.city);
        $('#issue_date').val(data.issue_date);
        $('#expire_date').val(data.exp_date);
        $('#dob').val(data.dob);
        $('#address').val(data.user_info.address);
      }
    });
  }
  
  
  
  
  