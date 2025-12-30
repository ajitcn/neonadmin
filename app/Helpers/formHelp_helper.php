<?php


    /**
     *
     * display form validation error
     *
     */
    

    if (!function_exists('display_form_error')) {
        function display_form_error($validation, $field)
        {
            if (isset($validation)) {
                if (isset($validation[$field])) {
                    return $validation[$field];
                }else{
                    return false;
                }
            }
        }
    }


    /**
     *
     * clean input data
     *
     */
    

    if (!function_exists('_clean')) {
        function _clean($data)
        {
             return htmlspecialchars(trim($data));
        }
    }



    /**
     *
     * show session message
     *
     */
    

    if (!function_exists('display_session_msg')) {
        function display_session_msg()
        {
            if (session()->has('status')) {
                if (session()->get('status')===true) {
                    return '<div class="alert alert-success text-center">'.session()->get('msg').'</div>';
                }else{
                    return '<div class="alert alert-danger text-center" style="max-height:150px; overflow:auto;">'.session()->get('msg').'</div>';
                }
            }else{
                return false;
            }
             
        }
    }


    function hashPassword($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

?>