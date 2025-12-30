
/*================================
=            Media Content            =
================================*/
/**
 *
 * save new media content
 *
 */


$('#mediaContentForm').on('submit', function (e) {
    e.preventDefault();
    var formData = new FormData(this);
     
    show_loader();
         $.ajax({
            type: 'post',
            url: routes.saveMediaContent,
            data: formData,
            processData: false,
            contentType: false,
            success: function(response){
                 $('.validation-error').html('');
                 if (response.status===true) {
                    status_alert('#js_alert', 'true', response.msg, ''); 
                    
                    $('.jsResponseMsg').html(response.msg).removeClass('text-danger').addClass('text-success');
                    setTimeout(function() {
                        window.location.href = routes.mediaContentDetails+'/'+response.id;
                    }, 1000);
                 }else{
                    status_alert('#js_alert', 'false', '', 'Error!'); 
                    $.each(response.msg, function(key, error) {
                            $('#mediaContentForm #' + key + 'Err').text(error); 
                    });
                    hide_loader();
                 }
                
            },
            error: function (request, status, error) {
                if (status==='error') {
                    status_alert('#js_alert', 'false', '', error); 
                    hide_loader();
                } 
            }
        });
  });

 
$(document).on('change', '.genreAdd', function(){
     _setMultiCheckboxTextView('.genreAdd', '#mediaContentForm .selectedGenre');
});
$(document).on('change', '.genreUpdate', function(){
     _setMultiCheckboxTextView('.genreUpdate', '#editMediaContentForm .selectedGenre');
});


$(document).on('change', '.langAdd', function(){
     _setMultiCheckboxTextView('.langAdd', '#mediaContentForm .selectedLang');
});
$(document).on('change', '.langUpdate', function(){
     _setMultiCheckboxTextView('.langUpdate', '#editMediaContentForm .selectedLang');
});

/**
 *
 * edit media content
 *
 */
function openMediaContentEditForm(id) {
    show_loader();
    $.ajax({
        type: 'get',
        url: routes.editMediaContent,
        data: { id: id },
        dataType: 'json',
        success: function(response) {
            if (response.status === true) {
                let data = response.data;

                $('#editMediaContentForm [name=id]').val(data.id);
                $('#editMediaContentForm [name=media_title]').val(data.title);
                $('#editMediaContentForm [name=category]').val(data.media_category_id);
                $('#editMediaContentForm [name=content_type]').val(data.content_type);
                $('#editMediaContentForm [name=vertical_video]').val(data.vertical_video);
                $('#editMediaContentForm [name=release_date]').val(data.release_date);
                $('#editMediaContentForm [name=duration]').val(data.duration);
                $('#editMediaContentForm [name=age_rating]').val(data.age_rating);
                $('#editMediaContentForm [name=trending_content]').val(data.trending_content);
                $('#editMediaContentForm [name=trending_content_order]').val(data.trending_content_order);
                $('#editMediaContentForm [name=status]').val(data.status);
                $('#editMediaContentForm [name=description]').val(data.description);
                $('#editMediaContentForm [name=thumbnail_image_link]').val(data.thumbnail_url);
                $('#editMediaContentForm [name=landscape_image_link]').val(data.landscape_image_url);
                $('#editMediaContentForm [name=portrait_image_link]').val(data.portrait_image_url);
                $('#editMediaContentForm [name=cast]').val(data.cast);
                $('#editMediaContentForm [name=director]').val(data.director);
                $('#editMediaContentForm [name=cast_image]').val(data.cast_image_link);
                $('#editMediaContentForm [name=trailer_link]').val(data.trailer_link);

                //set values
                _setMultiCheckbox(data.language, '#editMediaContentForm input[name="language[]"]');
                _setMultiCheckbox(data.genres, '#editMediaContentForm input[name="genre[]"]');

                //set selected text
                _setMultiCheckboxTextView('.genreUpdate', '#editMediaContentForm .selectedGenre');
                _setMultiCheckboxTextView('.langUpdate', '#editMediaContentForm .selectedLang');

                $('#editMediaModal').modal('show');
            } else {
                status_alert('#js_alert', 'false', '', response.msg);
            }
            hide_loader();
        },
        error: function(request, status, error) {
            if (status === 'error') {
                status_alert('#js_alert', 'false', '', error);
                hide_loader();
            }
        }
    });
}


$(document).on('submit', '#editMediaContentForm', function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    show_loader();

    $.ajax({
        type: 'post',
        url: routes.updateMediaContent, // must match route
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(response) {
            $('.validation-error').html('');
            if (response.status === true) {
                status_alert('#js_alert', 'true', response.msg, '');
                $('.jsResponseMsg').html(response.msg).removeClass('text-danger').addClass('text-success');
                reload_page(200);
            } else {
                status_alert('#js_alert', 'false', '', 'Error!');
                $.each(response.msg, function(key, error) {
                    $('#editMediaContentForm #' + key + 'Err').text(error);
                });
            }
            hide_loader();
        },
        error: function(request, status, error) {
            status_alert('#js_alert', 'false', '', error);
            hide_loader();
        }
    });
});

 
 


/*=====  End of Media Content  ======*/







/*===========================================
=            Media Content Segment           =
=============================================*/
/**
 *
 * save new media content segment/video/episode
 *
 */


$('#mediaContentSegmentForm').on('submit', function (e) {
    e.preventDefault();
    var formData = new FormData(this);
     
    show_loader();
         $.ajax({
            type: 'post',
            url: routes.saveMediaContentSegment,
            data: formData,
            processData: false,
            contentType: false,
            success: function(response){
                 $('.validation-error').html('');
                 if (response.status===true) {
                    status_alert('#js_alert', 'true', response.msg, ''); 
                    
                    $('.jsResponseMsg').html(response.msg).removeClass('text-danger').addClass('text-success');
                    reload_page(500);
                 }else{
                    status_alert('#js_alert', 'false', '', 'Error!'); 
                    $.each(response.msg, function(key, error) {
                            $('#mediaContentSegmentForm #' + key + 'Err').text(error); 
                    });
                    hide_loader();
                 }
                
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
     * Open Edit Form
     */
    function openSegmentEditForm(id) {
        show_loader();
        $.ajax({
            type: 'get',
            url: routes.editMediaContentSegment,
            data: { id: id },
            dataType: 'json',
            success: function (response) {
                if (response.status === true) {
                    let data = response.data;

                    $('#editMediaContentSegmentForm [name=segment_id]').val(data.id);
                    $('#editMediaContentSegmentForm [name=media_content_id]').val(data.media_content_id);
                    $('#editMediaContentSegmentForm [name=segment_number]').val(data.segment_number);
                    $('#editMediaContentSegmentForm [name=segment_title]').val(data.segment_title);
                    $('#editMediaContentSegmentForm [name=description]').val(data.description);
                    $('#editMediaContentSegmentForm [name=duration]').val(data.duration);
                    $('#editMediaContentSegmentForm [name=media_video]').val(data.media_url);
                    $('#editMediaContentSegmentForm [name=cover_image_link]').val(data.cover_image_link);
                    $('#editMediaContentSegmentForm [name=vertical_video]').val(data.vertical_video);
                    $('#editMediaContentSegmentForm [name=release_date]').val(data.release_date);
                    $('#editMediaContentSegmentForm [name=resolution]').val(data.resolution);
                    $('#editMediaContentSegmentForm [name=media_language]').val(data.media_language);

                    $('#editMediaSegmentModal').modal('show');
                } else {
                    status_alert('#js_alert', 'false', '',  response.msg);
                }
                hide_loader();
            },
            error: function (request, status, error) {
                status_alert('#js_alert', 'false', '', error);
                hide_loader();
            }
        });
    }

    /**
     * Submit Edit Form
     */
    $(document).on('submit', '#editMediaContentSegmentForm', function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        show_loader();

        $.ajax({
            type: 'post',
            url: routes.updateMediaContentSegment,
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (response) {
                $('.validation-error').html('');
                if (response.status === true) {
                    status_alert('#js_alert', 'true', response.msg, '');
                    $('.jsResponseMsg').html(response.msg).removeClass('text-danger').addClass('text-success');
                    reload_page(200);
                } else {
                    status_alert('#js_alert', 'false', '',  response.msg);
                    $.each(response.msg, function (key, error) {
                        $('#editMediaContentSegmentForm #' + key + 'Err').text(error);
                    });
                }
                hide_loader();
            },
            error: function (request, status, error) {
                status_alert('#js_alert', 'false', '', error);
                hide_loader();
            }
        });
    });

 
 


/*=====  End of Media Content Segment ======*/