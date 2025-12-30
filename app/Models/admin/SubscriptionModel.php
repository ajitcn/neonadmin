<?php

namespace App\Models\admin;

use CodeIgniter\Model;

class SubscriptionModel extends Model
{
    

    /**
     *
     * get all available packages
     *
     */
    public function getSubscriptionPackage()
    {
        return $this->db->table('subscriptions') 
                        ->orderBy('price', 'ASC')
                        ->get()->getResult();
    }
    
    
}
