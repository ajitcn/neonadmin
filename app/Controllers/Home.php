<?php

namespace App\Controllers;

class Home extends BaseController
{


    
    /**
     *
     * redirect back to login page
     *
     */
    
    public function index()
    {
        if (session()->has('user_id')) {
            return redirect()->to('admin/dashboard');
        }

        return  redirect()->to('account/user-login');

    }

     
}
