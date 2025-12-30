<?php

namespace App\Models\admin;
use CodeIgniter\Database\Exceptions\DatabaseException;

use CodeIgniter\Model;

class PackageModel extends Model
{
    protected $table            = 'packages';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = false;
    protected $allowedFields    = [];



    /**
     *
     * package data
     *
     */
    
    public function getPackage()
    {
        $result = $this->db->table($this->table)
                        ->orderBy('created_at', 'DESC')
                        ->get()->getResult();

        return $result;
    }



    /**
     *
     * save package
     *
     */
    public function savePackage($inputData)
    {
        $this->db->transStart();
        $this->insert($inputData);
        $this->db->transComplete();
        return $this->db->transStatus();
    }


    /**
     *
     * package by primary id
     *
     */
    
    public function packageById($id)
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
    public function updatePackage($inputData, $id)
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
    public function deletePackage($id)
    {
        $this->db->transStart();
        try {

            $this->db->table($this->table)
                    ->where('id', $id)
                    ->delete();

            $this->db->transComplete();
            if ($this->db->transStatus()===false) {
                $this->db->transRollback();
                throw new DatabaseException('This package can not be deleted.');
            }else{
                return ['status' => true, 'msg' => 'Package deleted successfully.'];
            }

        } catch (DatabaseException $e) {
            return ['status' => false, 'msg' => $e->getMessage()];
        }
            
    }
    

      
}
