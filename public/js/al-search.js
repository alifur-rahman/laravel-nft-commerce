
var itemwrapper = `<div class='al-show-search_result'>
<ul id="al_list_wrapper">
    <li style="padding:5px">
        Searching...
    </li>
</ul>
</div>`;
var liSelected;
var index = -1;
// Input keyup funciton 
$(document).on('keyup','.al-ajax-search input',function(event){
    if (event.which === 40 || event.which === 38) { //when press up||down arrow key 
        ArrowKeySelectItem(event);
    }
    else{
       
        if($('.al-ajax-search .al-show-search_result').length == 0){
            $('.al-ajax-search').append(itemwrapper);
        }
        else{
            $('.al-show-search_result ul').html('<li style="padding:5px">Searching...</li>');
        }
        $('.al-show-search_result').css({
            'width': $('.al-ajax-search').width()
        });
    
        if($(this).val() == ""){
            $('.al-show-search_result').remove();
        }
        else{
          run_ajax_search({
            keyword :  $(this).val(),
          })
        }
    }
   
   
});

//Run Ajax 

function run_ajax_search(arryData){
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
  $.ajax({
    url: "/al-ajax-search",
      type: "POST",
      dataType: "JSON",
      data: arryData,
      success:function(data){
          if(data.status){
              $('.al-show-search_result ul').html(data.returnData);
          }
          else{
              $('.al-show-search_result ul').html('<li style="padding:5px">No Result Found !</li>');
          }
          
      }
      
  });
}


//Hide search wrapper when click outsite of this 
$(document).click(function(event) {
    if (!$(event.target).closest(".al-ajax-search").length) {
        $('.al-show-search_result').hide();
    }
    else{
        $('.al-show-search_result').show();
    }
});

// Press up/down arrow key select item 
function ArrowKeySelectItem(event){
    if($('#al_list_wrapper').length != 0){  
        var ul = document.getElementById('al_list_wrapper');
        var len = ul.getElementsByTagName('li').length - 1;
        if (event.which === 40) {
          index++;
          //down 
          if (liSelected) {
            removeClass(liSelected, 'al_search_selected');
            next = ul.getElementsByTagName('li')[index];
            if (typeof next !== undefined && index <= len) {
      
              liSelected = next;
            } else {
              index = 0;
              liSelected = ul.getElementsByTagName('li')[0];
            }
            addClass(liSelected, 'al_search_selected');
            // console.log(index);
          } else {
            index = 0;
      
            liSelected = ul.getElementsByTagName('li')[0];
            addClass(liSelected, 'al_search_selected');
          }
        } else if (event.which === 38) {
      
          //up
          if (liSelected) {
            removeClass(liSelected, 'al_search_selected');
            index--;
            // console.log(index);
            next = ul.getElementsByTagName('li')[index];
            if (typeof next !== undefined && index >= 0) {
              liSelected = next;
            } else {
              index = len;
              liSelected = ul.getElementsByTagName('li')[len];
            }
            addClass(liSelected, 'al_search_selected');
          } else {
            index = 0;
            liSelected = ul.getElementsByTagName('li')[len];
            addClass(liSelected, 'al_search_selected');
          }
        }
        setNameInInput(event);
        scrollTopEle();
    }
  
}
//set item name as input value
function setNameInInput(valEle){
    $('.al-ajax-search input').val($('.al_search_selected .product-name').html());
}
//Remove class when press arrow key 
function removeClass(el, className) {
  if (el.classList) {
    el.classList.remove(className);
  } else {
    el.className = el.className.replace(new RegExp('(^|\\b)' + className.split(' ').join('|') + '(\\b|$)', 'gi'), ' ');
  }
};
//Add class function press arrow key 
function addClass(el, className) {
  if (el.classList) {
    el.classList.add(className);
  } else {
    el.className += ' ' + className;
  }
};

// Search form submit 
$(document).ready(function() {
  $(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      var selectElement = $('.al_search_selected');
      if(selectElement.length != 0){
        window.location.href = $(selectElement).find('a').attr('href');
      }
      else{
        window.location.href = '/search?keyword='+$('.al-ajax-search input').val();
      }
    }
  });
});

function scrollTopEle(){
  $('.al-show-search_result').animate({
    scrollTop: parseInt($(".al_search_selected").offset().top-100)
  }, 100);
}
