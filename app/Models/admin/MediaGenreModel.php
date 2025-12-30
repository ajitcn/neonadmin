<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class MediaGenreModel extends Model
{
    protected $table            = 'media_content_genres';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = false;
    protected $allowedFields    = [];


     /**
     *
     * genre data
     *
     */
    
    public function getMediaGenre()
    {
        $result = $this->db->table($this->table)
                        ->orderBy('created_at', 'DESC')
                        ->get()->getResult();

        return $result;
    }



    /**
     *
     * save genre
     *
     */
    public function saveGenre($inputData)
    {
        $this->db->transStart();
        $this->insert($inputData);
        $this->db->transComplete();
        return $this->db->transStatus();
    }


    /**
     *
     * genre by primary id
     *
     */
    
    public function genreById($id)
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
    public function updateGenre($inputData, $id)
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
    public function deleteGenre($id)
    {
        $this->db->transStart();
        try {

            $this->db->table($this->table)
                    ->where('id', $id)
                    ->delete();

            $this->db->transComplete();
            if ($this->db->transStatus()===false) {
                $this->db->transRollback();
                throw new DatabaseException('This genre can not be deleted.');
            }else{
                return ['status' => true, 'msg' => 'Genre deleted successfully.'];
            }

        } catch (DatabaseException $e) {
            return ['status' => false, 'msg' => $e->getMessage()];
        }
            
    }
 
}
