<?php

namespace App\Models\admin;
use CodeIgniter\Database\Exceptions\DatabaseException;

use CodeIgniter\Model;

class MediaContentSegmentModel extends Model
{
    protected $table            = 'media_content_segments';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = false;
    protected $allowedFields    = [];


     /**
     *
     * get media content segment data by id
     * @param int $mediaId
     * @return array object
     * 
     */
    
    public function mediaContentSegmentById($mediaId)
    {
        
        $result = $this->db->table('media_content_segments')
                        ->where('media_content_id', $mediaId)
                        ->orderBy('segment_number', 'ASC')
                        ->get()->getResult();
        return $result;
    }



    /**
     *
     * save media content segment
     * @return boolean
     */
    public function saveMediaContentSegment($inputData)
    {
        $this->db->transStart();
        $this->insert($inputData);
        $this->db->transComplete();
        return $this->db->transStatus();
    }

    /**
     * Get segment by ID
     */
    public function getSegmentById($id)
    {
        return $this->db->table($this->table)
                        ->where('id', $id)
                        ->get()->getRow();
    }

     /**
     * Update segment
     */
    public function updateMediaContentSegment($inputData, $id)
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
     * update media content
     *
     */
    public function updateMediaContent($inputData, $id)
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
     * delete media content segment
     *
     */
    public function deleteMediaContentSegment($id)
    {
        $this->db->transStart();
        try {

            $this->db->table($this->table)
                    ->where('id', $id)
                    ->delete();

            $this->db->transComplete();
            if ($this->db->transStatus()===false) {
                $this->db->transRollback();
                throw new DatabaseException('This media segment can not be deleted.');
            }else{
                return ['status' => true, 'msg' => 'Media segment deleted successfully.'];
            }

        } catch (DatabaseException $e) {
            return ['status' => false, 'msg' => $e->getMessage()];
        }
    }
    

    
}
