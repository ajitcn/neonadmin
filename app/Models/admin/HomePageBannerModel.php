<?php

namespace App\Models\admin;

use CodeIgniter\Model;

class HomePageBannerModel extends Model
{
    protected $table            = 'home_page_banners';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = false;
    protected $allowedFields    = [];


    /**
     *
     * get banner data
     *
     */
    
    public function getBannerData($section)
    {
        $result = $this->db->table($this->table)
                    ->where('banner_section_name', $section)
                    ->orderBy('position', 'ASC')
                    ->get()->getResult();

        return $result;
    }    


    /**
     *
     * save data
     *
     */
    public function savePageBanner($inputData)
    {
        $this->db->transStart();
        $this->insert($inputData);
        $this->db->transComplete();
        return $this->db->transStatus();
    }


    /**
     *
     * page setup by primary id
     *
     */
    
    public function homePageSetupById($id)
    {
        
        $result = $this->db->table($this->table.' as hps')
                        ->select('hps.*, media_contents.title')
                        ->join('media_contents', 'media_contents.id=hps.media_content_id')
                        ->where('hps.id', $id)
                        ->get()->getRow();
        return $result;
    }


 



    /**
     *
     * delete 
     *
     */
    public function deletePageBanner($id)
    {
        $this->db->transStart();
        try {

            $this->db->table($this->table)
                    ->where('id', $id)
                    ->delete();

            $this->db->transComplete();
            if ($this->db->transStatus()===false) {
                $this->db->transRollback();
                throw new DatabaseException('This data can not be deleted.');
            }else{
                return ['status' => true, 'msg' => 'Banner deleted successfully.'];
            }

        } catch (DatabaseException $e) {
            return ['status' => false, 'msg' => $e->getMessage()];
        }
    }
    

}
