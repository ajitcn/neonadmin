<?php

namespace App\Models\admin;
use CodeIgniter\Database\Exceptions\DatabaseException;

use CodeIgniter\Model;

class PromoCodesModel extends Model
{
    protected $table            = 'promo_codes';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = false;
    protected $allowedFields    = [];



    /**
     *
     * promo codes data
     *
     */
    
    public function getPromoCodes()
    {
        $result = $this->db->table($this->table)
                        ->orderBy('created_at', 'DESC')
                        ->get()->getResult();

        return $result;
    }



    /**
     *
     * save promo code
     *
     */
    public function savePromoCode($inputData)
    {
        $this->db->transStart();
        $this->insert($inputData);
        $this->db->transComplete();
        return $this->db->transStatus();
    }


    /**
     *
     * promo code by primary id
     *
     */
    
    public function promoCodeById($id)
    {
        
        $result = $this->db->table($this->table)
                        ->where('id', $id)
                        ->get()->getRow();
        return $result;
    }


    /**
     *
     * update data
     *
     */
    public function updatePromoCode($inputData, $id)
    {
        $this->db->transStart();
        $this->db->table($this->table)
                ->where('id', $id)
                ->update($inputData);

        $this->db->transComplete();
        return $this->db->transStatus();
    }



    /**
     *
     * delete data
     *
     */
    public function deletePromoCode($id)
    {
        $this->db->transStart();
        try {

            $this->db->table($this->table)
                    ->where('id', $id)
                    ->delete();

            $this->db->transComplete();
            if ($this->db->transStatus()===false) {
                $this->db->transRollback();
                throw new DatabaseException('This promo code can not be deleted.');
            }else{
                return ['status' => true, 'msg' => 'Promo code deleted successfully.'];
            }

        } catch (DatabaseException $e) {
            return ['status' => false, 'msg' => $e->getMessage()];
        }
            
    }
    

      
} 
