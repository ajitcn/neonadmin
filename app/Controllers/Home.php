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
        return  redirect()->to('account/user-login');

    }

     
}
