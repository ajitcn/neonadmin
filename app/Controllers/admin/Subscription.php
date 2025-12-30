<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\admin\SubscriptionModel;

class Subscription extends BaseController
{
    protected $subscription;

    public function __construct()
    {
        $this->subscription = new SubscriptionModel;
    }

    /**
     *
     * packages
     *
     */
    
    public function index()
    {
        $data['packages'] = $this->subscription->getSubscriptionPackage();
        return view('admin/pages/packages', $data);
    }



}
