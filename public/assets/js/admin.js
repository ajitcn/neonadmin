/*===============================
=            Member            =
===============================*/


/**
 *
 * save new member
 *
 */

$(document).on('submit', '#memberForm', function(e){
    e.preventDefault();
    show_loader();
         $.ajax({
            type: 'post',
            url: routes.saveMember,
            data: $('#memberForm').serialize(),
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
                            $('#memberForm #' + key + 'Err').text(error); 
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
 * edit member
 *
 */
 function openMemberEditForm(id) {
     show_loader();
         $.ajax({
            type: 'get',
            url: routes.editMember,
            data: {
                id
            },
            dataType: 'json',
            success: function(response){
                 
                 if (response.status===true) {
                     $('#editMemberForm [name=member_id]').val(response.data['id']);
                     $('#editMemberForm [name=member_name]').val(response.data['member_name']);
                     $('#editMemberForm [name=mobile_number]').val(response.data['mobile_number']);
                     $('#editMemberForm [name=member_email]').val(response.data['member_email']);
                     $('#editMemberForm [name=status]').val(response.data['status']);
                     $('#editMemberModal').modal('show');
                 }else{
                    status_alert('#js_alert', 'false', '', 'Error!'); 
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
 }


/**
 *
 * update member
 *
 */

$(document).on('submit', '#editMemberForm', function(e){
    e.preventDefault();
    show_loader();
         $.ajax({
            type: 'post',
            url: routes.updateMember,
            data: $('#editMemberForm').serialize(),
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
                            $('#editMemberForm #' + key + 'Err').text(error); 
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
 * open subscription form modal
 *
 */

 function openSubscriptionForm(id, memberName) {
    
     $('#subscriptionForm [name=member_id]').val(id);
     $('#subscriptionForm #member_name').val(memberName);
     $('#subscriptionFormModal').modal('show');         
     
 }


 /**
 *
 * save new subscription
 *
 */

$(document).on('submit', '#subscriptionForm', function(e){
    e.preventDefault();
    show_loader();
         $.ajax({
            type: 'post',
            url: routes.saveSubscription,
            data: $('#subscriptionForm').serialize(),
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
                            $('#subscriptionForm #' + key + 'Err').text(error); 
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


/*=====  End of Member  ======*/



/*================================
=            Category            =
================================*/
/**
 *
 * save new category
 *
 */

$(document).on('submit', '#categoryForm', function(e){
    e.preventDefault();
    show_loader();
         $.ajax({
            type: 'post',
            url: routes.saveMediaCategory,
            data: $('#categoryForm').serialize(),
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
                            $('#categoryForm #' + key + 'Err').text(error); 
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
 * edit category
 *
 */
 function openCategoryEditForm(id) {
     show_loader();
         $.ajax({
            type: 'get',
            url: routes.editMediaCategory,
            data: {
                id
            },
            dataType: 'json',
            success: function(response){
                 
                 if (response.status===true) {
                     $('#editCategoryForm [name=category_id]').val(response.data['id']);
                     $('#editCategoryForm [name=category_name]').val(response.data['category_name']);
                     $('#editCategoryForm [name=description]').val(response.data['description']);
                     
                     $('#editCategoryModal').modal('show');
                 }else{
                    status_alert('#js_alert', 'false', '', 'Error!'); 
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
 }


/**
 *
 * update category
 *
 */

$(document).on('submit', '#editCategoryForm', function(e){
    e.preventDefault();
    show_loader();
         $.ajax({
            type: 'post',
            url: routes.updateMediaCategory,
            data: $('#editCategoryForm').serialize(),
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
                            $('#editCategoryForm #' + key + 'Err').text(error); 
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


/*=====  End of Category  ======*/



/*================================
=            Genre            =
================================*/
/**
 *
 * save new Genre
 *
 */

$(document).on('submit', '#genreForm', function(e){
    e.preventDefault();
    show_loader();
         $.ajax({
            type: 'post',
            url: routes.saveMediaGenre,
            data: $('#genreForm').serialize(),
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
                            $('#genreForm #' + key + 'Err').text(error); 
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
 * edit Genre
 *
 */
 function openGenreEditForm(id) {
     show_loader();
         $.ajax({
            type: 'get',
            url: routes.editMediaGenre,
            data: {
                id
            },
            dataType: 'json',
            success: function(response){
                 
                 if (response.status===true) {
                     $('#editGenreForm [name=genre_id]').val(response.data['id']);
                     $('#editGenreForm [name=genre_name]').val(response.data['genre_name']);
                     $('#editGenreForm [name=description]').val(response.data['description']);
                     
                     $('#editGenreModal').modal('show');
                 }else{
                    status_alert('#js_alert', 'false', '', 'Error!'); 
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
 }


/**
 *
 * update Genre
 *
 */

$(document).on('submit', '#editGenreForm', function(e){
    e.preventDefault();
    show_loader();
         $.ajax({
            type: 'post',
            url: routes.updateMediaGenre,
            data: $('#editGenreForm').serialize(),
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
                            $('#editGenreForm #' + key + 'Err').text(error); 
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


/*=====  End of Genre  ======*/


/*================================
=            Package             =
================================*/

/**
 *
 * save new package
 *
 */
$(document).on('submit', '#packageForm', function (e) {
    e.preventDefault();
    show_loader();
    $.ajax({
        type: 'post',
        url: routes.createPackage, 
        data: $('#packageForm').serialize(),
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
                    $('#packageForm #' + key + 'Err').text(error);
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
 *
 * edit package
 *
 */
function openPackageEditForm(id) {
    show_loader();
    $.ajax({
        type: 'get',
        url: routes.editPackage,
        data: { id },
        dataType: 'json',
        success: function (response) {
            if (response.status === true) {
                $('#editPackageForm [name=id]').val(response.data['id']);
                $('#editPackageForm [name=package_name]').val(response.data['package_name']);
                $('#editPackageForm [name=package_mrp]').val(response.data['package_mrp']);
                $('#editPackageForm [name=description]').val(response.data['description']);
                $('#editPackageForm [name=duration]').val(response.data['duration']);
                $('#editPackageForm [name=duration_type]').val(response.data['duration_type']);
                $('#editPackageForm [name=ad_free]').val(response.data['ad_free']);
                $('#editPackageForm [name=device]').val(response.data['device']);
                $('#editPackageForm [name=quality]').val(response.data['quality']);
                $('#editPackageForm [name=on_rent]').val(response.data['on_rent']);
                $('#editPackageForm [name=other_details]').val(response.data['other_details']);
                
                $('#editPackageModal').modal('show');
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
 * update package
 *
 */
$(document).on('submit', '#editPackageForm', function (e) {
    e.preventDefault();
    show_loader();
    $.ajax({
        type: 'post',
        url: routes.updatePackage, 
        data: $('#editPackageForm').serialize(),
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
                    $('#editPackageForm #' + key + 'Err').text(error);
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

/*=====  End of Package  ======*/

/*================================
=          Promo Codes           =
================================*/

/**
 *
 * save new promo code
 *
 */
$(document).on('submit', '#promoCodeForm', function (e) {
    e.preventDefault();
    show_loader();
    $.ajax({
        type: 'post',
        url: routes.createPromoCode, 
        data: $('#promoCodeForm').serialize(),
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
                    $('#promoCodeForm #' + key + 'Err').text(error);
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
 *
 * edit promo code
 *
 */
function openPromoCodeEditForm(id) {
    show_loader();
    $.ajax({
        type: 'get',
        url: routes.editPromoCode,
        data: { id },
        dataType: 'json',
        success: function (response) {
            if (response.status === true) {
                $('#editPromoCodeForm [name=id]').val(response.data['id']);
                $('#editPromoCodeForm [name=promo_code_name]').val(response.data['promo_code_name']);
                $('#editPromoCodeForm [name=description]').val(response.data['description']);
                $('#editPromoCodeForm [name=discount_type]').val(response.data['discount_type']);
                $('#editPromoCodeForm [name=discount]').val(response.data['discount']);
                $('#editPromoCodeForm [name=max_use]').val(response.data['max_use']);
                $('#editPromoCodeForm [name=valid_from]').val(response.data['valid_from']);
                $('#editPromoCodeForm [name=valid_till]').val(response.data['valid_till']);
                $('#editPromoCodeForm [name=status]').val(response.data['status']);
                
                $('#editPromoCodeModal').modal('show');
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
 * update promo code
 *
 */
$(document).on('submit', '#editPromoCodeForm', function (e) {
    e.preventDefault();
    show_loader();
    $.ajax({
        type: 'post',
        url: routes.updatePromoCode, 
        data: $('#editPromoCodeForm').serialize(),
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
                    $('#editPromoCodeForm #' + key + 'Err').text(error);
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

/*=====  End of Promo Codes  ======*/

/*===========================================
=            Admin Password Reset            =
===========================================*/


$(document).on('submit', '#updatePasswordForm', function(e){
    e.preventDefault();
    show_loader();
         $.ajax({
            type: 'post',
            url: routes.updateUserPassword,
            data: $('#updatePasswordForm').serialize(),
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
                            $('#updatePasswordForm #' + key + 'Err').text(error); 
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


/*=====  End of Admin Password Reset  ======*/









