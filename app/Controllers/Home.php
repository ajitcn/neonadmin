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
        print_r($a);
        return  redirect()->to('account/user-login');

    }

     
}
