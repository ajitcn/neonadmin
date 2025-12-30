<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\admin\MemberModel;

class Member extends BaseController
{

    protected $member;

    public function __construct()
    {
        $this->member = new MemberModel;
    }

    public function index($current_page=1)
    {   
        $limit = 25;
        //get params
        $get_para = '?search_term='.$this->request->getVar('search_term').'&order_by='.$this->request->getVar('order_by').'&member_status='.$this->request->getVar('member_status').'&subscription_validity='.$this->request->getVar('subscription_validity');
        
        $total_data = $this->member->countAllMembers();
        $page_data = paginationLinkAndOffset($total_data, $limit, $current_page, '', $get_para); 
        $data['link'] = $page_data['link'];
        $data['members'] = $this->member->getMembers($limit, $page_data['offset'], ['id', 'desc']);
        
        return view('admin/pages/member', $data);
    }


    /**
     *
     * create new member
     * @return array|json
     * 
     *
     */
    
    public function create()
    {
        $response = array();
        $validation = $this->_memberFormValidation(null);
        if ($validation===true) {

            $inputData = $this->_memberInput('new');
            $status = $this->member->saveMember($inputData);

            if ($status===true) {
                $response['status'] = true;
                $response['msg'] =  'Member created successfully.';
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
    
    private function _memberInput($type)
    {
        $data  = array();
        $data['member_name'] = _clean($this->request->getPost('member_name'));
        $data['mobile_number'] = _clean($this->request->getPost('mobile_number'));
        $data['member_email'] = _clean($this->request->getPost('member_email'));
        $data['updated_at'] = date('Y-m-d H:i:s');
        if ($type==='new') {
            $data['created_at'] = date('Y-m-d H:i:s');
        }else{
            $data['status'] = _clean($this->request->getPost('status'));
        }

        return $data;
    }


    /**
     *
     * member form validation
     * @param int|null $id
     */
    private function _memberFormValidation($id)
    {
        $validation = service('validation');
         
        $validation->setRules([
            'member_name' => [ 'label' => 'Member Name', 'rules' => 'required'],
            'mobile_number' => [ 
                'label' => 'Mobile Number', 
                'rules' => 'required|exact_length[10]|is_unique[members.mobile_number,id,'.$id.']', 
                'errors' => [
                    'is_unique' => 'The {field} is already exist.'
                ],
            ],
            'member_email' => [ 
                'label' => 'Email Id', 
                'rules' => 'permit_empty|max_length[100]|is_unique[members.member_email,id,'.$id.']', 
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
     * edit member 
     * @return array|json
     * 
     */
    public function edit()
    {
        if ($this->request->isAJAX()) {
            //primary id
            $id = $this->request->getVar('id');
            $data = $this->member->memberById($id);
            $response['status'] = $data ? true : false;
            $response['data'] = $data;
            return $this->response->setJSON($response);
        }
    }
    
    
    /**
     *
     * update member data
     *
     * @return array|json
     */
    
    public function update()
    {
        $response  = array();
        $id = (int)$this->request->getPost('member_id');
        $validation = $this->_memberFormValidation($id);
        if ($validation===true) {

            $inputData = $this->_memberInput('update');
            
            $status = $this->member->updateMember($inputData, $id);

            if ($status===true) {
                $response['status'] = true;
                $response['msg'] =  'Member updated successfully.';
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
     * delete member
     * @param int $id is unique user id
     * @return session data
     */
    
    public function delete($id)
    {
        $response = $this->member->deleteMember($id);
        session()->setFlashdata($response);
        return redirect()->to('admin/members/1');
    }



 
    
}
