<?php

namespace App\Models\admin;

use CodeIgniter\Model;
use CodeIgniter\Database\Exceptions\DatabaseException;

class SectionModel extends Model
{
    protected $table = 'sections'; 
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $protectFields = false;
    protected $allowedFields = ['section_name', 'created_at'];

      /**
     * Get all sections
     */
    public function getSectionList()
    {
        return $this->db->table($this->table)
                        ->orderBy('section_name', 'ASC')
                        ->get()
                        ->getResult();
    }

    /**
     * Get section by id
     */
    public function sectionById($id)
    {
        return $this->db->table($this->table)
                        ->where('id', $id)
                        ->get()
                        ->getRow();
    }

    /**
     * Save section
     */
    public function saveSection($inputData)
    {
        $this->db->transStart();
        $this->insert($inputData);
        $this->db->transComplete();
        return $this->db->transStatus();
    }

    /**
     * Update section
     */
    public function updateSection($inputData, $id)
    {
        $this->db->transStart();
        $this->db->table($this->table)
                ->where('id', $id)
                ->update($inputData);
        $this->db->transComplete();
        return $this->db->transStatus();
    }

    /**
     * Delete section
     */
    public function deleteSection($id)
    {
        $this->db->transStart();
        try {
            $this->db->table($this->table)
                     ->where('id', $id)
                     ->delete();

            $this->db->transComplete();
            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
               throw new DatabaseException('This data can not be deleted.');
            } else {
                return ['status' => true, 'msg' => 'Section deleted successfully.'];
            }
        } catch (DatabaseException $e) {
            return ['status' => false, 'msg' => $e->getMessage()];
        }
    }

}
