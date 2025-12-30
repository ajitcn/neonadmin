<?php

namespace App\Models\admin;
use CodeIgniter\Database\Exceptions\DatabaseException;

use CodeIgniter\Model;

class MediaCategoryModel extends Model
{
    protected $table            = 'media_content_categories';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = false;
    protected $allowedFields    = [];



    /**
     *
     * category data
     *
     */
    
    public function getMediaCategory()
    {
        $result = $this->db->table($this->table)
                        ->orderBy('created_at', 'DESC')
                        ->get()->getResult();

        return $result;
    }



    /**
     *
     * save category
     *
     */
    public function saveCategory($inputData)
    {
        $this->db->transStart();
        $this->insert($inputData);
        $this->db->transComplete();
        return $this->db->transStatus();
    }


    /**
     *
     * category by primary id
     *
     */
    
    public function categoryById($id)
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
    public function updateCategory($inputData, $id)
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
    public function deleteCategory($id)
    {
        $this->db->transStart();
        try {

            $this->db->table($this->table)
                    ->where('id', $id)
                    ->delete();

            $this->db->transComplete();
            if ($this->db->transStatus()===false) {
                $this->db->transRollback();
                throw new DatabaseException('This category can not be deleted.');
            }else{
                return ['status' => true, 'msg' => 'Category deleted successfully.'];
            }

        } catch (DatabaseException $e) {
            return ['status' => false, 'msg' => $e->getMessage()];
        }
            
    }
    

    
}
