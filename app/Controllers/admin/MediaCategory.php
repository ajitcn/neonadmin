<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\admin\MediaCategoryModel;

class MediaCategory extends BaseController
{
    protected $category;

    public function __construct()
    {
        $this->category = new MediaCategoryModel;
    }

    public function index()
    {   
        $data['categories'] = $this->category->getMediaCategory();
        return view('admin/pages/media_category', $data);
    }


    /**
     *
     * create new category
     * @return array|json
     * 
     *
     */
    
    public function create()
    {
        $response = array();
        $validation = $this->_categoryFormValidation(null);
        if ($validation===true) {

            $inputData = $this->_categoryInput('new');
            $status = $this->category->saveCategory($inputData);

            if ($status===true) {
                $response['status'] = true;
                $response['msg'] =  'Category created successfully.';
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
    
    private function _categoryInput($type)
    {
        $data  = array();
        $data['category_name'] = _clean($this->request->getPost('category_name'));
        $data['description'] = _clean($this->request->getPost('description'));
        if ($type==='new') {
            $data['created_at'] = date('Y-m-d H:i:s');
        }

        return $data;
    }


    /**
     *
     * category form validation
     * @param int|null $id
     */
    private function _categoryFormValidation($id)
    {
        $validation = service('validation');
         
        $validation->setRules([
            'description' => [ 'label' => 'Description', 'rules' => 'permit_empty|max_length[255]'],
            'category_name' => [ 
                'label' => 'Category Name', 
                'rules' => 'required|max_length[100]|is_unique[media_content_categories.category_name,id,'.$id.']', 
                'errors' => [
                    'is_unique' => 'The {field} is already exist.'
                ],
            ],
            
        ]);

        if ($validation->run($this->request->getPost())) {
             //validation success
             return true;
        }else{
            //validation failed
            return $validation->getErrors();
        }
    }


    /**
     *
     * edit category 
     * @return array|json
     * 
     */
    public function edit()
    {
        if ($this->request->isAJAX()) {
            //primary id
            $id = $this->request->getVar('id');
            $data = $this->category->categoryById($id);
            $response['status'] = $data ? true : false;
            $response['data'] = $data;
            return $this->response->setJSON($response);
        }
    }
    
    
    /**
     *
     * update category data
     *
     * @return array|json
     */
    
    public function update()
    {
        $response  =array();
        $id = (int)$this->request->getPost('category_id');
        $validation = $this->_categoryFormValidation($id);
        if ($validation===true) {

            $inputData = $this->_categoryInput('update');
            
            $status = $this->category->updateCategory($inputData, $id);

            if ($status===true) {
                $response['status'] = true;
                $response['msg'] =  'Category updated successfully.';
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
     * delete category
     * @param int $id is unique user id
     * @return session data
     */
    
    public function delete($id)
    {
        $response = $this->category->deleteCategory($id);
        session()->setFlashdata($response);
        return redirect()->to('admin/media-category');
    }

}
