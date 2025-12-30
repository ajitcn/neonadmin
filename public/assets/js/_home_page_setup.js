/*autocomplete media*/
 $( "#mediaContentSearch, #mediaContentSearch2" ).autocomplete({
  source: function(request, response) {
    
    if (request.term.length > 1) {
      $.ajax({
        url: routes.searchMediaContent,
        dataType: "json",
        data: { term: request.term },
        success: function(data) {
          response(data);
        }
      });
    } else {
      response([]);
    }
  }
});


 

 
 /**
 *
 * save new home page setup
 *
 */

$(document).on('submit', '#homePageSetupForm', function(e){
    e.preventDefault();
    show_loader();
         $.ajax({
            type: 'post',
            url: routes.createHomePageSetup,
            data: $('#homePageSetupForm').serialize(),
            dataType: 'json',
            success: function(response){
                 $('.validation-error').html('');
                 if (response.status===true) {
                    status_alert('#js_alert', 'true', response.msg, ''); 
                    
                    $('.jsResponseMsg').html(response.msg).removeClass('text-danger').addClass('text-success');
                    reload_page(200);
                 }else{
                    status_alert('#js_alert', 'false', '', 'Error!'); 
                    $.each(response.msg, function(key, error) {
                            $('#homePageSetupForm #' + key + 'Err').text(error); 
                    });
                 }
                hide_loader();
            },
            error: function (request, status, error) {
                if (status==='error') {
                    status_alert('#js_alert', 'false', '', error); 
                    hide_loader();
                } 
            }
        });
  });


/**
 *
 * edit home page setup
 *
 */
function openHomePageSetupEditForm(id) {
    show_loader();
    $.ajax({
        type: 'get',
        url: routes.editHomePageSetup,
        data: { id },
        dataType: 'json',
        success: function (response) {
            if (response.status === true) {
                $('#editPageSetupForm [name=page_id]').val(response.data['id']);
                $('#editPageSetupForm [name=position_order]').val(response.data['position_number']);
                $('#editPageSetupForm [name=media_content]').val(response.data['title']);
                $('#editPageSetupForm [name=content_type]').val(response.data['content_type']);
                $('#editPageSetupForm [name=layout_type]').val(response.data['layout_type']);
                $('#editPageSetupForm [name=status]').val(response.data['status']);
                 
                
                
                $('#editPageSetupModal').modal('show');
            } else {
                status_alert('#js_alert', 'false', '', 'Error!');
            }
            hide_loader();
        },
        error: function (request, status, error) {
            if (status === 'error') {
                status_alert('#js_alert', 'false', '', error);
                hide_loader();
            }
        },
    });
}

/**
 *
 * update payment gateway
 *
 */
$(document).on('submit', '#editPageSetupForm', function (e) {
    e.preventDefault();
    show_loader();
    $.ajax({
        type: 'post',
        url: routes.updateHomePageSetup, 
        data: $('#editPageSetupForm').serialize(),
        dataType: 'json',
        success: function (response) {
            $('.validation-error').html('');
            if (response.status === true) {
                status_alert('#js_alert', 'true', response.msg, '');
                $('.jsResponseMsg')
                    .html(response.msg)
                    .removeClass('text-danger')
                    .addClass('text-success');
                reload_page(200);
            } else {
                status_alert('#js_alert', 'false', '', 'Error!');
                $.each(response.msg, function (key, error) {
                    $('#editPageSetupForm #' + key + 'Err').text(error);
                });
            }
            hide_loader();
        },
        error: function (request, status, error) {
            if (status === 'error') {
                status_alert('#js_alert', 'false', '', error);
                hide_loader();
            }
        },
    });
});



/**
 * ===================================================
 * SECTION MANAGEMENT
 * ===================================================
 */

/**
 * Save Section
 */
$(document).on('submit', '#sectionForm', function (e) {
    e.preventDefault();
    show_loader();

    $.ajax({
        type: 'post',
        url: routes.saveSection, 
        data: $('#sectionForm').serialize(),
        dataType: 'json',
        success: function (response) {
            $('.validation-error').html('');

            if (response.status === true) {
                status_alert('#js_alert', 'true', response.msg, '');
                $('.jsResponseMsg')
                    .html(response.msg)
                    .removeClass('text-danger')
                    .addClass('text-success');
                    reload_page(500);
            } else {
                status_alert('#js_alert', 'false', '', 'Error!');
                $.each(response.msg, function (key, error) {
                    $('#sectionForm #' + key + 'Err').text(error);
                });
            }
            hide_loader();
        },
        error: function (request, status, error) {
            if (status === 'error') {
                status_alert('#js_alert', 'false', '', error);
                hide_loader();
            }
        },
    });
});

/**
 * Delete Section
 */
$(document).on('click', '.deleteSectionBtn', function () {
    let id = $(this).data('id');
    if (confirm('Are you sure you want to delete this section?')) {
        show_loader();
        $.ajax({
            type: 'POST',
            url: routes.deleteSection,
            data: {
                id: id,
                '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
            },
            dataType: 'json',
            success: function (response) {
                if (response.status === true) {
                    status_alert('#js_alert', 'true', response.msg, '');
                    loadSections();
                } else {
                    status_alert('#js_alert', 'false', '', response.msg);
                }
                hide_loader();
            },
            error: function (xhr, status, error) {
                status_alert('#js_alert', 'false', '', error);
                hide_loader();
            }
        });
    }
});

function openEditSectionModal(id) {
    $('#editSectionModal').modal('show');        
}

$(document).on('change', '#editSectionForm [name=old_section_name]', function(){
 
    $('#editSectionForm [name=status]').val($('#editSectionForm [name=old_section_name] option:selected').attr('data-status'));
});

// Update section
$(document).on('submit', '#editSectionForm', function(e) {
    e.preventDefault();
    show_loader();
    $.ajax({
        type: 'post',
        url: routes.updateSection,
        data: $('#editSectionForm').serialize(),
        dataType: 'json',
        success: function(response) {
            $('.validation-error').html('');
            if (response.status) {
                status_alert('#js_alert', 'true', response.msg, '');
                $('.jsResponseMsg').html(response.msg).removeClass('text-danger').addClass('text-success');
                reload_page(200);
            } else {
                $.each(response.msg, function(key, error) {
                    $('#editSectionForm #' + key + 'Err').text(error);
                });
            }
            hide_loader();
        }
    });
});



// set delete url
$(document).on('click', '#deleteSectionBtn', function(e) {
    if ($('#editSectionDropdown').val()!=='') {
        window.location.href = routes.deleteSection+'/'+$('#editSectionDropdown').val()+'?pageSection='+$('[name=section]').val();
    }else{
         e.preventDefault();
          status_alert('#js_alert', 'false', '', 'Please select a value to be deleted!');
          
    }
   
    
});



/*========================================
=            Home Page Banner            =
========================================*/

 /**
 *
 * save new home page banner
 *
 */

$(document).on('submit', '#homePageBannerForm', function(e){
    e.preventDefault();
    show_loader();
         $.ajax({
            type: 'post',
            url: routes.createHomePageBanner,
            data: $('#homePageBannerForm').serialize(),
            dataType: 'json',
            success: function(response){
                 $('.validation-error').html('');
                 if (response.status===true) {
                    status_alert('#js_alert', 'true', response.msg, ''); 
                    
                    $('.jsResponseMsg').html(response.msg).removeClass('text-danger').addClass('text-success');
                    reload_page(200);
                 }else{
                    status_alert('#js_alert', 'false', '', 'Error!'); 
                    $.each(response.msg, function(key, error) {
                            $('#homePageBannerForm #' + key + 'Err').text(error); 
                    });
                 }
                hide_loader();
            },
            error: function (request, status, error) {
                if (status==='error') {
                    status_alert('#js_alert', 'false', '', error); 
                    hide_loader();
                } 
            }
        });
  });


/*=====  End of Home Page Banner  ======*/




