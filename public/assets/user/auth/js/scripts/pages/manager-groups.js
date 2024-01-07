$(function () {
    // store goups by ajax
    $(document).on("submit", "#manager-group-form", function (event) {
        let form_data = $(this).serializeArray();
        event.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: '/admin/manager-settings/manager-group',
            dataType: 'json',
            data: form_data,
            success: function (data) {
                if (data.status == true) {
                    toastr['success'](data.message, 'Manager Group', {
                        showMethod: 'slideDown',
                        hideMethod: 'slideUp',
                        closeButton: true,
                        tapToDismiss: false,
                        progressBar: true,
                        timeOut: 2000,
                    });
                }
                if (data.status == false) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Manager Group!',
                        html: data.errors.group_name,
                        customClass: {
                            confirmButton: 'btn btn-danger'
                        }
                    })
                }
            }
        });
    })

    // click form button and submit form
    $(document).on("click", "#save-group", function () {
        $("#manager-group-form").trigger("submit");
    });
    // get data into edit offcanvas
    $(document).on("click", ".edit-group", function () {
        $("#group_id").val($(this).data('id'));
        $("#group-name-edit").val($(this).data('name'));
    });

    // manager group delete operation
    $(document).on("click",".delete-manager-group",function () {
        let id = $(this).data('id');
        let request_url = '/admin/manager-settings/manager-group-delete';
        let data = {id:id};
        confirm_alert('Are your confirm to delete account manager?','If you confirm to delete this? Please click ok button.',request_url,data,'Delete Manager Group');
    })
});