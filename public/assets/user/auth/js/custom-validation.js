//Alifur Rahman from IT Corner
//jQuery custom form validation 
$(document).on('keyup','input', function(){
    removeErrorOnKeyup(this);
});
$(document).on('change','select', function(){
    var runf = true;
    var skipSelect = $(this).attr('data-select2-id');
    if($(this).hasClass("btExport")){
        runf = false;
    }
    if(skipSelect == 'fx-export'){
        runf = false;
    }
    if(runf){
        removeErrorOnKeyup(this);
    }
    
});
$(document).on('change','input', function(){
    removeErrorOnKeyup(this);
});
$(document).on('keyup','textarea', function(){
    removeErrorOnKeyup(this);
});


function validateEmail($email) {
    if($email.length != 0){
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        return emailReg.test( $email );
    }else{
        return false;
    }
}
function removeErrorOnKeyup(inputEle){ // V.0.1 simple input validation with email validation 
    var LabelOn =  $(inputEle).closest('div');
    if(LabelOn.find('label').length == 0){
        LabelOn = $(inputEle).closest('div').parent();
    }
    var inputName = $(inputEle).attr('name');
    var className = "."+inputName+".error-msg";
   
    var errorSpan = LabelOn.find(className);
    if(errorSpan.length == 0){
        errorSpan = LabelOn.parent().find('.error');
    }
    
    if(errorSpan.length == 0){
        errorSpan = LabelOn.find('.has-error');
    }

    var fildedName = $(inputEle).attr('name');
    if(fildedName){
        fildedName = fildedName.replace("_", " ");
    }
   if($(inputEle).attr('type') == 'email'){
        if (inputEle.value == ""){
            if(errorSpan.length == 0){
                $(inputEle).closest('div').append('<span class="'+inputName+' error-msg">The '+fildedName+' field is required.</span>');
            }
            else{
                $(errorSpan).html("The email field is required.");
            }
        }
    
        else if(!validateEmail(inputEle.value)){
            if(errorSpan.length == 0){
                $(inputEle).closest('div').append('<span class="'+inputName+' error-msg">Invalid email address</span>');
            }
            else{
                $(errorSpan).html("Invalid email address");
            }
        }
        else{
            if(errorSpan.length != 0){
                $(errorSpan).remove();
            }
        }
   }
   else{
        if(inputEle.value != ''){
            if(errorSpan.length != 0){
                $(errorSpan).remove();
            }
        }
   } 
}
