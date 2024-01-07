 
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).on('click', '.btn-collection', function() {
    $('#asset_id').val($(this).data('id'));
})

$('#collection_add_btn').click(function() {
    var collection_id = $('input[name="collection_name"]:checked').val();
    var asset_id = $('#asset_id').val();


    $.ajax({
        type: 'POST',
        url: '/add/collection',
        data: {
            collection_id: collection_id,
            asset_id: asset_id
        },
        success: function(data) {
            if (data.success == true) {
                $('.btn-close').trigger('click');
                notify('success', data.message);
            }
        }
    });
})
 