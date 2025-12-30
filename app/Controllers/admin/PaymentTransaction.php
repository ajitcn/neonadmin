<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\admin\PaymentTransactionModel;

class PaymentTransaction extends BaseController
{

    protected $transaction;

    public function __construct()
    {
        $this->transaction = new PaymentTransactionModel;
    }

    public function index($current_page=1)
    {
        $limit = 25;
        //get params
        $get_para = '?search_term='.$this->request->getVar('search_term').'&order_by='.$this->request->getVar('order_by').'&member_status='.$this->request->getVar('member_status').'&subscription_validity='.$this->request->getVar('subscription_validity');
        
        $total_data = $this->transaction->countAllTransactions();
        $page_data = paginationLinkAndOffset($total_data, $limit, $current_page, '', $get_para); 
        $data['link'] = $page_data['link'];
        $data['transactions'] = $this->transaction->getAllPayments($limit, $page_data['offset'], ['id', 'desc']);
        
        return view('admin/pages/payment_transaction', $data);
    }
}
