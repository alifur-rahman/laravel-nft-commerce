// alifur rahman

$(document).ready(function(){
    var isFOllow = $('[follow_st]');
    for (let index = 0; index < isFOllow.length; index++) {
        if($(isFOllow).attr('follow_st') == 1){
            $(isFOllow).find('.al_fol_text').html('Unfollow');
        }
        
    }
    // console.log($(isFOllow).attr('follow_st'));
});

$(document).on('click','[liked]',function(){ // like operation 
    var thisElement = $(this);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
            url: "/like-operation",
            type: "POST",
            dataType: "JSON",
            data: {
                optype :  $(this).attr('liked'),
                itemId : $(this).attr('itemid')
            },
            success:function(data){
                if(data.status){
                    var countWrapper = $(thisElement).find('.number');
                    $(thisElement).attr('liked', data.return_type);  
                    $(countWrapper).html(data.count); 
                    if(data.return_type == 1){
                        // $(countWrapper).html(parseInt($(countWrapper).html())+1);
                        notify('success', "", 'Liked');  
                    }
                    else if(data.return_type == 0){
                        // $(countWrapper).html(parseInt($(countWrapper).html())-1);
                        notify('success', "", 'Unliked'); 
                    }
                }
                else{
                    notify('info',data.message, 'Like Operaction'); 
                }
                
            }
        });
});


$(document).on('click','[follow_st]',function(){ // follow operation 
    var thisElement = $(this);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
            url: "/follow-operation",
            type: "POST",
            dataType: "JSON",
            data: {
                optype :  $(this).attr('follow_st'),
                followkey : $(this).attr('followkey')
            },
            success:function(data){
                if(data.status){
                    $(thisElement).attr('follow_st', data.return_type); 
                    if(data.return_type == 1){
                        notify('success', "Follow Success", 'Follow');
                        $(thisElement).find('.al_fol_text').html('Unfollow');
                    }
                    else if(data.return_type == 0){
                        notify('success', "Unfollow Success", 'Unfollow');  
                        $(thisElement).find('.al_fol_text').html('Follow');
                    }
                    
                }
                else{
                    notify('info', data.message, 'Follow Operaction');  
                }
                console.log($(thisElement).find('.al_fol_text'));
                
            }
        });
});