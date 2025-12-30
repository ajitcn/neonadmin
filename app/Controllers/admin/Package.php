<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\admin\PackageModel;
use App\Models\admin\ReloadCounterModel;

class Package extends BaseController
{
    protected $package;
    protected $counter;

    public function __construct()
    {
        $this->package = new PackageModel;
        $this->counter = new ReloadCounterModel; 

    }

    public function index()
    {   
        $data['packages'] = $this->package->getPackage();
        return view('admin/pages/package', $data);
    }


    /**
     *
     * create new package
     * @return array|json
     * 
     *
     */
    
    public function create()
    {
        $response = array();
        $validation = $this->_packageFormValidation(null);
        if ($validation===true) {

            $inputData = $this->_packageInput('new');
            $status = $this->package->savePackage($inputData);

            if ($status===true) {
                $this->counter->updateCounter();
                $response['status'] = true;
                $response['msg'] =  'Package created successfully.';
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
     * input data
     * @param string $type
     * @return array
     */
    
    private function _packageInput($type)
{
    $data  = array();
    $data['package_name'] = _clean($this->request->getPost('package_name'));
    $data['package_mrp'] = (float) $this->request->getPost('package_mrp'); 
    $data['description'] = _clean($this->request->getPost('description'));
    $data['duration'] = (int) $this->request->getPost('duration'); 
    $data['duration_type'] = _clean($this->request->getPost('duration_type'));
    $data['ad_free'] = _clean($this->request->getPost('ad_free'));
    $data['device'] = _clean($this->request->getPost('device'));
    $data['quality'] = _clean($this->request->getPost('quality'));
    $data['on_rent'] = _clean($this->request->getPost('on_rent'));
    $data['other_details'] = _clean($this->request->getPost('other_details'));
    if ($type==='new') {
        $data['created_at'] = date('Y-m-d H:i:s');
    }

    return $data;
}



    /**
     *
     * package form validation
     * @param int|null $id
     */
    private function _packageFormValidation($id)
{
    $validation = service('validation');
     
    $validation->setRules([
        'description' => [ 'label' => 'Description', 'rules' => 'permit_empty|max_length[255]'],
        'package_name' => [ 
            'label' => 'Package Name', 
            'rules' => 'required|max_length[255]|is_unique[packages.package_name,id,'.$id.']', 
            'errors' => [
                'is_unique' => 'The {field} already exists.'
            ],
        ],
        'package_mrp' => [ 'label' => 'Package MRP', 'rules' => 'required|numeric' ], 
        'duration' => [ 'label' => 'Duration', 'rules' => 'required|is_natural' ], 
        'duration_type' => [ 'label' => 'Duration Type', 'rules' => 'required' ],
        'ad_free' => [ 'label' => 'Ad Free', 'rules' => 'permit_empty|in_list[0,1]' ],
        'device' => [ 'label' => 'Device', 'rules' => 'permit_empty|max_length[100]' ],
        'quality' => [ 'label' => 'Quality', 'rules' => 'permit_empty|max_length[100]' ],
        'on_rent' => [ 'label' => 'On Rent', 'rules' => 'permit_empty|in_list[0,1]' ],
        'other_details' => [ 'label' => 'Other Details', 'rules' => 'permit_empty|max_length[500]' ],
    ]);

    if ($validation->run($this->request->getPost())) {
         return true;
    }else{
        return $validation->getErrors();
    }
}



    /**
     *
     * edit package 
     * @return array|json
     * 
     */
    public function edit()
    {
        if ($this->request->isAJAX()) {
            //primary id
            $id = $this->request->getVar('id');
            $data = $this->package->packageById($id);
            $response['status'] = $data ? true : false;
            $response['data'] = $data;
            return $this->response->setJSON($response);
        }
    }
    
    
    /**
     *
     * update package data
     *
     * @return array|json
     */
    
    public function update()
    {
        $response  =array();
        $id = (int)$this->request->getPost('id');
        $validation = $this->_packageFormValidation($id);
        if ($validation===true) {

            $inputData = $this->_packageInput('update');
            
            $status = $this->package->updatePackage($inputData, $id);

            if ($status===true) {
                $this->counter->updateCounter();
                $response['status'] = true;
                $response['msg'] =  'Package updated successfully.';
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
     * delete package
     * @param int $id is unique user id
     * @return session data
     */
    
    public function delete($id)
    {
        $response = $this->package->deletePackage($id);
        session()->setFlashdata($response);
        $this->counter->updateCounter();
        return redirect()->to('admin/package');
    }

}
