<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\admin\HomePageSetupModel;
use App\Models\admin\MediaContentModel;
use App\Models\admin\SectionModel;
use App\Models\admin\ReloadCounterModel;

class HomePageSetup extends BaseController
{
    protected $homePage;
    protected $media;
    protected $section; 
    protected $counter; 

    public function __construct()
    {
        $this->homePage = new HomePageSetupModel;
        $this->media = new MediaContentModel;
        $this->section = new SectionModel();
        $this->counter = new ReloadCounterModel; 

    }


    public function index($section)
    {
        $trendingRecords = $this->homePage->getPageSectionData(str_replace(' ', '-', $section));
        $data['setionRecords'] = $this->section->getSectionList();
        $data['trending'] = view('admin/pages/_home_page_setup_parts', ['records' => $trendingRecords, 'section' => $section]);
        $data['currentSection'] = $section;
        $data['recentMediaContents'] = $this->media->getMediaContent(30, 0, ['id', 'desc']);

        
        return view('admin/pages/home_page_setup', $data);
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
            $validation = $this->_pageSetupFormValidation(null);
            if ($validation===true) {

                $inputData = $this->_pageSetupInput('new');
                $status = $this->homePage->savePageSetup($inputData);

                if ($status===true) {
                    $this->counter->updateCounter();
                    $response['status'] = true;
                    $response['msg'] =  'Page setup created successfully.';
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
    
    private function _pageSetupInput($type)
    {
        //get media id
        $mediaData = $this->media->getMediaContentByName(_clean($this->request->getPost('media_content')));

        $data  = array();
        $data['section'] =  str_replace(' ', '-', $this->request->getPost('section')) ;
        $data['media_content_id'] = $mediaData->id;
        $data['position_number'] = (int)$this->request->getPost('position_order');
        $data['content_type'] = $this->request->getPost('content_type');
        $data['layout_type'] = $this->request->getPost('layout_type');
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
    private function _pageSetupFormValidation($id)
    {
        $validation = service('validation');
         
        $validation->setRules([
            'position_order' => [ 'label' => 'Position Order', 'rules' => 'required|is_natural_no_zero'],
            'media_content' => [ 'label' => 'Media Content', 'rules' => 'required|min_length[2]'],
            'section' => [ 'label' => 'Section', 'rules' => 'required'],
            'content_type' => [ 'label' => 'Content Type', 'rules' => 'required'],
            'layout_type' => [ 'label' => 'Layout Type', 'rules' => 'required'],
            
            
        ]);

        if ($validation->run($this->request->getPost())) {
            //check if media name is correct
            $mediaData = $this->media->getMediaContentByName(_clean($this->request->getPost('media_content')));
              if (is_null($mediaData)) {
                  //validation failed
                  return [ 'media_content' => 'Media Content Not Found.'];
              }else{
                //validation success
                return true;
              }
             
        }else{
            //validation failed
            return $validation->getErrors();
        }
    }


     /**
     *
     * edit page setup 
     * @return array|json
     * 
     */
    public function edit()
    {
        if ($this->request->isAJAX()) {
            //primary id
            $id = $this->request->getVar('id');
            $data = $this->homePage->homePageSetupById($id);
            $response['status'] = $data ? true : false;
            $response['data'] = $data;
            return $this->response->setJSON($response);
        }
    }
    
    
    /**
     *
     * update page setup data
     *
     * @return array|json
     */
    
    public function update()
    {

        $response = array();
        $id = (int)$this->request->getPost('page_id');
        $validation = $this->_pageSetupFormValidation($id);
        if ($validation===true) {

            $inputData = $this->_pageSetupInput('update');
            
            $status = $this->homePage->updatePageSetup($inputData, $id);

            if ($status===true) {
                $this->counter->updateCounter();
                $response['status'] = true;
                $response['msg'] =  'Page setup updated successfully.';
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


     /**
     *
     * delete page setup
     * @param int $id is unique id
     * @return session data
     */
    
    public function delete($id)
    {
        $response = $this->homePage->deletePageSeup($id);
        session()->setFlashdata($response);
        $section = _clean($this->request->getVar('section'));
        $this->counter->updateCounter();
        return redirect()->to('admin/home-page-setup/'.$section);
    }




    /**
     * create new section
     * @return array|json
     */
    public function createSection()
    {
        $response = array();
        $validation = $this->_sectionFormValidation(null);
        if ($validation === true) {

            $inputData = $this->_sectionInput('new');
            $status = $this->section->saveSection($inputData);

            if ($status === true) {
                $response['status'] = true;
                $response['msg'] = 'Section created successfully.';
            } else {
                $response['status'] = false;
                $response['msg'] = 'Oops! Something went wrong.';
            }
        } else {
            //validation error
            $response['status'] = false;
            $response['msg'] = $validation;
        }
        return $this->response->setJSON($response);
    }

    /**
     *
     * section form validation
     * @param int|null $id
     */
    private function _sectionFormValidation($id)
    {
        $validation = service('validation');
        if ($id) {
            $validation->setRules([
            'old_section_name' => ['label' => 'Old Section Name','rules' => 'required'],
            'status' => ['label' => 'Status','rules' => 'required'],
            ]);
             
        }else{
            $validation->setRules([
                'section_name' => [
                    'label' => 'Section Name',
                    'rules' => 'required|max_length[255]|is_unique[sections.section_name,id,' . $id . ']',
                    'errors' => [
                        'is_unique' => 'The {field} already exists.'
                    ],
                ],
                'status' => [
                    'label' => 'Status',
                    'rules' => 'required',
                     
                ],
            ]);
        }

      

        if ($validation->run($this->request->getPost())) {
            return true;
        } else {
            return $validation->getErrors();
        }
    }

    /**
     *
     * prepare input data for section
     * @param string $type
     * @return array
     */
    private function _sectionInput($type)
    {
        $data = array();
        
        $data['status'] = _clean($this->request->getPost('status'));
        if ($type === 'new') {
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['section_name'] = _clean($this->request->getPost('section_name'));
        }else{
            if (!empty($this->request->getPost('section_name'))) {
                $data['section_name'] = _clean($this->request->getPost('section_name'));
            }
        }
        return $data;
    }


   

    /**
     *
     * update section data
     *
     * @return array|json
     */
    public function updateSection()
    {
        $response = array();
        $id = (int)$this->request->getPost('old_section_name');  
        $validation = $this->_sectionFormValidation($id);

        if ($validation === true) {

            $inputData = $this->_sectionInput('update');
            $status = $this->section->updateSection($inputData, $id);

            if ($status === true) {
                $this->counter->updateCounter();
                $response['status'] = true;
                $response['msg'] = 'Section updated successfully.';
            } else {
                $response['status'] = false;
                $response['msg'] = 'Oops! Something went wrong.';
            }

        } else {
            // validation errors
            $response['status'] = false;
            $response['msg'] = $validation;
        }

        return $this->response->setJSON($response);
    }

    /**
     *
     * delete section
     * @param int $id is unique id
     * @return session data
     */
    public function deleteSection($id)
    {
        $response = $this->section->deleteSection($id);
        session()->setFlashdata($response);
        $this->counter->updateCounter();
        return redirect()->to('admin/home-page-setup/'.$this->request->getGet('pageSection')); 
    }



}
