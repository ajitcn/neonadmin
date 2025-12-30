<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class PaymentTransactionModel extends Model
{
    protected $table            = 'payment_transactions';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';



    /**
     *
     * count all records
     *
     */
    public function countAllTransactions()
    {
         return $this->db->table($this->table)
                        ->countAllResults();
    }


    public function getAllPayments($limit, $offset, $orderBy)
    {
        return $this->db->table($this->table.' as pt')
                ->select('members.member_name, members.mobile_number, pt.*, payment_gateways.payment_gateway_name')
                ->join('members', 'members.id=pt.member_id')
                ->join('payment_gateways', 'payment_gateways.id=pt.gateway_id')
                ->orderBy($orderBy[0], $orderBy[1])
                ->get($limit, $offset)->getResult();
    }

    public function getPaymentSum()
    {
        return $this->db->table($this->table)
                ->select('COALESCE(SUM(amount), 0) totalAmt')
                ->where('payment_status', 'success')
                ->get()->getRow('totalAmt');
    }


    public function getPaymentSum30Days()
    {
        return $this->db->table($this->table)
                ->select('COALESCE(SUM(amount), 0) totalAmt')
                ->where('payment_status', 'success')
                ->where('created_at >= NOW() - INTERVAL 30 DAY')
                ->get()->getRow('totalAmt');
    }




    
    
  
}
