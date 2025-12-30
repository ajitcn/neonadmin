<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\admin\HomePageBannerModel;
use App\Models\admin\MediaContentModel;
use App\Models\admin\ReloadCounterModel;

class HomePageBanner extends BaseController
{
    protected $homePage;
    protected $media; 
    protected $counter; 

    public function __construct()
    {
        $this->homePage = new HomePageBannerModel;
        $this->media = new MediaContentModel; 
        $this->counter = new ReloadCounterModel; 

    }


    public function index($section)
    {
        $data['records'] = $this->homePage->getBannerData(str_replace(' ', '-', $section));
        $data['currentSection'] = $section;

        
        return view('admin/pages/home_page_banner', $data);
    }


   /**
     *
     * create new page setup
     * @return array|json
     * 
     */
    public function create()
    {
        $response = array();
        if ($this->request->isAJAX()) {
            $validation = $this->_pageBannerFormValidation(null);
            if ($validation===true) {

                $inputData = $this->_pageBannerInput('new');
                $status = $this->homePage->savePageBanner($inputData);

                if ($status===true) {
                    $this->counter->updateCounter();
                    $response['status'] = true;
                    $response['msg'] =  'Page banner created successfully.';
                }else{
                    $response['status'] = false;
                    $response['msg'] =  'Oops! something went wrong.';
                }
            }else{
                 //validation error
                $response['status'] = false;
                $response['msg'] =  $validation;
            }
            return $this->response->setJSON($response);
        }
    }


    /**
     *
     * input data
     * @param string $type
     * @return array
     */
    
    private function _pageBannerInput($type)
    {
         

        $data  = array();
        $data['banner_section_name'] =  str_replace(' ', '-', $this->request->getPost('section')) ; 
        $data['position'] = (int)$this->request->getPost('position');
        $data['banner_url'] = $this->request->getPost('banner_url');
        $data['status'] = _clean($this->request->getPost('status'));
        if ($type==='new') {
            $data['created_at'] = date('Y-m-d H:i:s');
        }

        return $data;
    }


    /**
     *
     * pageSetup form validation
     * @param int|null $id
     */
    private function _pageBannerFormValidation($id)
    {
        $validation = service('validation');
         
        $validation->setRules([
            'position' => [ 'label' => 'Position Order', 'rules' => 'required|is_natural_no_zero'],
            'banner_url' => [ 'label' => 'Banner Url', 'rules' => 'required|valid_url'],
            'section' => [ 'label' => 'Section', 'rules' => 'required'],
            
            
        ]);

        if ($validation->run($this->request->getPost())) {
                return true;
        }else{
            //validation failed
            return $validation->getErrors();
        }
    }


      
    

     /**
     *
     * delete page banner
     * @param int $id is unique id
     * @return session data
     */
    
    public function delete($id)
    {
        $response = $this->homePage->deletePageBanner($id);
        session()->setFlashdata($response);
        $section = _clean($this->request->getVar('section'));
        $this->counter->updateCounter();
        return redirect()->to('admin/home-page-banner/'.$section);
    }


 


}
