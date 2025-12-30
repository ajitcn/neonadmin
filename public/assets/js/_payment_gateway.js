


/**
 *
 * save new payment gateway
 *
 */
$(document).on('submit', '#paymentGatewayForm', function (e) {
    e.preventDefault();
    show_loader();
    $.ajax({
        type: 'post',
        url: routes.createPaymentGateway, 
        data: $('#paymentGatewayForm').serialize(),
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
                    $('#paymentGatewayForm #' + key + 'Err').text(error);
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
 * edit payment gateway
 *
 */
function openPaymentGatewayEditForm(id) {
    show_loader();
    $.ajax({
        type: 'get',
        url: routes.editPaymentGateway,
        data: { id },
        dataType: 'json',
        success: function (response) {
            if (response.status === true) {
                $('#editPaymentGatewayForm [name=id]').val(response.data['id']);
                $('#editPaymentGatewayForm [name=payment_gateway_name]').val(response.data['payment_gateway_name']);
                $('#editPaymentGatewayForm [name=api_key]').val(response.data['api_key']);
                $('#editPaymentGatewayForm [name=secret_code]').val(response.data['secret_code']);
                $('#editPaymentGatewayForm [name=merchant_id]').val(response.data['merchant_id']);
                $('#editPaymentGatewayForm [name=status]').val(response.data['status']);
                
                
                $('#editPaymentGatewayModal').modal('show');
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
$(document).on('submit', '#editPaymentGatewayForm', function (e) {
    e.preventDefault();
    show_loader();
    $.ajax({
        type: 'post',
        url: routes.updatePaymentGateway, 
        data: $('#editPaymentGatewayForm').serialize(),
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
                    $('#editPaymentGatewayForm #' + key + 'Err').text(error);
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


