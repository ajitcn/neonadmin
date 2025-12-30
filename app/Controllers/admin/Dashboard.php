<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\admin\MemberModel;
use App\Models\admin\PaymentTransactionModel;

class Dashboard extends BaseController
{
    public function index()
    {

        $member = new MemberModel;
        $payment = new PaymentTransactionModel;

        $data['totalMember'] =  sizeof($member->getAllMembers(100000000, ['id', 'desc']));
        $data['recentMembers'] =  $member->getAllMembers(20, ['id', 'desc']);
        $data['activeMember'] = sizeof($member->getAllActiveMembers());

        $data['payments'] =  $payment->getAllPayments(20, 0,  ['id', 'desc']);
        $data['totalPayment'] =  $payment->getPaymentSum();
        $data['last30DaysPayment'] =  $payment->getPaymentSum30Days();
         
  
        return view('admin/pages/home', $data);
    }
}
