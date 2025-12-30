var successIcon = '<i class="fa-regular fa-circle-check action-mark"></i>';
var errorIcon = '<i class="fa-solid fa-triangle-exclamation action-mark"></i>';



/**
 *
 * alert message
 *
 */

function status_alert( target, status, success_msg, failure_msg ){
 $('.alert_v2').slideDown();
 var msg = '<div class="alert_v2">'
      if( status == "true"  ){
          msg += '<div class="alert alert-success text-center alert-dismissible show"> '+success_msg+'</div>';
       }else{
         msg += '<div class="alert alert-danger text-center alert-dismissible show">'+ failure_msg +'</div>';
       }  
    msg +=  '</div>';
  $(target).html(msg);
  $('.alert_v2').slideUp(4000);
}

/**
 *
 * reload
 *
 */

function reload_page(time) {
  setTimeout(function(){
    window.location.reload();
  }, time);
}


$(document).on('click', '#delete-table-row', function(){
  $(this).closest('tr').remove();
})


function round(val) {
  return parseFloat(val.toFixed(2));
}

$(document).ready(function(){
  hide_loader();
});

 


/**
 *
 * preloader
 *
 */

function show_loader() {
  $('.preloader').show();
}
function hide_loader() {
  $('.preloader').hide();
}


//delete confirmation
$(document).on('click', '.delete_clk', function(e) {
   if (!confirm('Do you want to delete?')) {
      e.preventDefault();
   }
});

//action confirmation
$(document).on('click', '.confirm_clk', function(e) {
   if (!confirm('Do you want to perform this action?')) {
      e.preventDefault();
   }
});



/**
 *
 * check box selection
 *
 */
 function checkboxBulkSelection(currentTarget, checkBoxtarget) {
    if($(currentTarget).val()==='Select All'){
          $(checkBoxtarget).each(function(){
              $(checkBoxtarget).prop('checked', true);
          })
      }else{
          $(checkBoxtarget).each(function(){
              $(checkBoxtarget).prop('checked', false);
          })
      }
        
 }



 /**
  *
  * reset form
  *
  */
  function resetForm(target){
    $(target+' input').val('');
    $(target+' select').val('');
  }


$(function () {
    $('.table-wrapper1').on('scroll', function (e) {
        $('.table-wrapper2').scrollLeft($('.table-wrapper1').scrollLeft());
    }); 
    $('.table-wrapper2').on('scroll', function (e) {
        $('.table-wrapper1').scrollLeft($('.table-wrapper2').scrollLeft());
    });
});
$(window).on('load', function (e) {
    $('.table-div1').width($('table').width());
    $('.table-div2').width($('table').width());
});


/**
 *
 * placeholder popup
 *
 */

$(document).on('input focus', '.input-container input', function(){

  if ($(this).val()) {
    $(this).closest('.input-container').find('label').show();
  }else{
    $(this).closest('.input-container').find('label').hide();
  }

});


$('#profileDropdown').click(function(){

    let divWidth = parseInt($('.profileDropdownList').width())-20;
    if ( $(window).width()<=768) {
       setTimeout(function(){
      $('.profileDropdownList').css('left', '-'+divWidth+'px');
    }, 20);
    }
     
});

function _setMultiCheckbox(dataSet, target) {
   $(target).each(function() {
        if (dataSet.includes($(this).val())) {
            $(this).prop('checked', true);
        }
    });
}


function _setMultiCheckboxTextView(dataVal, target) {
    var selected = [];
    $(target).text('');
    $(dataVal+':checked').each(function() {
        selected.push($(this).data('label'));
    });

    if(selected.length===0){
        selected.push('Select');
    }
    $(target).text(selected.join(', '));
}
 





 
