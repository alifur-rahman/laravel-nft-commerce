var count = 0;
$('.menu-btn').click(function () {
  if (count == 0) {
    $('.sidebar').addClass('sidebar-show');
    $('.menu-text').show('slow');
    $('.content').css('margin-left', '225px')
    count = 1;
  } else {
    $('.menu-text').hide('slow');
    $('.sidebar').removeClass('sidebar-show');
    $('.content').css('margin-left', '90px')

    count = 0;
  }
});

$('.dropdown_menu').click(function(){
   $('.dropdown_item').toggle();
});
 


// for dark and white mode
$(document).ready(function () {
  var mode = localStorage.getItem("mode");
  if(mode=='white'){
    $('#night_mode').prop('checked', true);
    $(':root').css({'--background': '#fff','--white':'#0b0d21','--dark-light':'#fff','--light':'#ddd'});  
  }
  $('#night_mode').change(function () { 
      if($('#night_mode').prop("checked") == true){
          $(':root').css({'--background': '#fff','--white':'#0b0d21','--dark-light':'#fff','--light':'#ddd'}); 
          localStorage.setItem("mode", "white");
      }else{
          $(':root').css({'--background': '#0b0d21','--white':'#fff','--dark-light':'#101331','--light':'#101331'});
          localStorage.setItem("mode", "dark");
      }
  });
});
