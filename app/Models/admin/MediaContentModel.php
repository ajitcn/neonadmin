<?php

namespace App\Models\admin;
use CodeIgniter\Database\Exceptions\DatabaseException;

use CodeIgniter\Model;

class MediaContentModel extends Model
{
    protected $table            = 'media_contents';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = false;
    protected $allowedFields    = [];




    /**
     *
     * count all contents
     *
     */
    public function countAllMediaContent()
    {
        return $this->db->table($this->table)
                ->countAllResults();
    }


     /**
     *
     * get media content data
     * @param int $limit
     * @param int $offset
     * @param array $defOrderBy
     * @return array object
     */
    
    public function getMediaContent($limit, $offset, $defOrderBy)
    {
        
        $result = $this->db->table($this->table . ' as mdc')
                        ->select('mdc.*, GROUP_CONCAT(mcg.genre_name) AS genres, category_name, mdc2.title as parent_season')
                        ->join('media_content_associated_genres as mcag', 'mcag.media_content_id=mdc.id')
                        ->join('media_content_genres as mcg', 'mcg.id=mcag.content_genre_id')
                        ->join('media_content_categories as cat', 'cat.id=mdc.media_category_id')
                        ->join('media_content_parent_season as mcps', 'mcps.media_content_id=mdc.id', 'left')
                        ->join($this->table . ' as mdc2', 'mdc2.id=mcps.parent_season_id', 'left')
                         
                        ->groupBy('mdc.id')
                        ->orderBy('mdc.'.$defOrderBy[0], $defOrderBy[1])
                        ->get($limit, $offset)->getResult();
        return $result;
    }


    /**
     *
     * get media content data by id
     * @param int $mediaId
     * @return array object
     * 
     */
    
    public function mediaContentById($mediaId)
    {
        
        $result = $this->db->table($this->table . ' as mdc')
                        ->select('mdc.*, GROUP_CONCAT(mcg.genre_name) AS genres, category_name, mdc2.title as parent_season')
                        ->join('media_content_associated_genres as mcag', 'mcag.media_content_id=mdc.id')
                        ->join('media_content_genres as mcg', 'mcg.id=mcag.content_genre_id')
                        ->join('media_content_categories as cat', 'cat.id=mdc.media_category_id')
                        ->join('media_content_parent_season as mcps', 'mcps.media_content_id=mdc.id', 'left')
                        ->join($this->table . ' as mdc2', 'mdc2.id=mcps.parent_season_id', 'left')
                        ->where('mdc.id', $mediaId)
                        ->groupBy('mdc.id')
                        ->get()->getRow();
        return $result;
    }



    /**
     *
     * media content by id with genre ids
     *
     */
    
    public function mediaContentById2($mediaId)
    {
        
        $result = $this->db->table($this->table . ' as mdc')
                        ->select('mdc.*, GROUP_CONCAT(mcg.id) AS genres, category_name, mdc2.title as parent_season')
                        ->join('media_content_associated_genres as mcag', 'mcag.media_content_id=mdc.id')
                        ->join('media_content_genres as mcg', 'mcg.id=mcag.content_genre_id')
                        ->join('media_content_categories as cat', 'cat.id=mdc.media_category_id')
                        ->join('media_content_parent_season as mcps', 'mcps.media_content_id=mdc.id', 'left')
                        ->join($this->table . ' as mdc2', 'mdc2.id=mcps.parent_season_id', 'left')
                        ->where('mdc.id', $mediaId)
                        ->groupBy('mdc.id')
                        ->get()->getRow();
        return $result;
    }

   

    
    /**
     *
     * save media
     *
     */
    public function saveMediaContent($inputData)
    {    
        $insertedId = $this->insert($inputData);
        return $insertedId ?? null;
    }

    /**
     *
     * set media and genre ids
     *
     */
    public function setAssociatedGenres($inputData){ 
        $this->db->table('media_content_associated_genres')
                ->insertBatch($inputData);
    }


    /**
     *
     * set media parent season
     *
     */
    public function setMediaParentSeason($inputData){ 
        $this->db->table('media_content_parent_season')
                ->insert($inputData);
    }


    /**
     *
     * search media content
     *
     */
    public function searchMediaContentByName($term)
    {
        $result = $this->db->table($this->table)
                        ->select('title')
                        ->like('title', $term)
                        ->orderBy('title', 'ASC')
                        ->get(30, 0)->getResult();
        return $result;
    }


    /**
     *
     * get media content
     *
     */
    public function getMediaContentByName($term)
    {
        $result = $this->db->table($this->table)
                        ->select('id')
                        ->where('title', $term)
                        ->get()->getRow();
        return $result;
    }

    /**
     * Get media content by ID
     */
    public function getMediaContentById($id)
    {
        return $this->db->table('media_contents')
                        ->where('id', $id)
                        ->get()->getRow();
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
     * delete media content
     *
     */
    public function deleteMediaContent($id)
    {
        $this->db->transStart();
        try {

            //remove connected genre
            $this->removeAssociatedGenres($id);
            //remove connected parent season
            $this->removeMediaParentSeason($id);
            //delete media content
            $this->db->table($this->table)
                    ->where('id', $id)
                    ->delete();

            $this->db->transComplete();
            if ($this->db->transStatus()===false) {
                $this->db->transRollback();
                throw new DatabaseException('This media content can not be deleted.');
            }else{
                return ['status' => true, 'msg' => 'Media content deleted successfully.'];
            }

        } catch (DatabaseException $e) {
            return ['status' => false, 'msg' => $e->getMessage()];
        }
    }


    /**
     *
     * delete media linked with genre
     *
     */
    private function removeAssociatedGenres($mediaId){ 
        $this->db->table('media_content_associated_genres')
                ->where('media_content_id', $mediaId)
                ->delete();
    }


    /**
     *
     * set media parent season
     *
     */
    private function removeMediaParentSeason($mediaId){ 
        $this->db->table('media_content_parent_season')
                ->where('media_content_id', $mediaId)
                ->delete();
    }
    
}
