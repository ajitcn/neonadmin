<?php

namespace App\Controllers\account;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\account\AuthModel;

class Auth extends BaseController
{

    protected $auth;
    public $db;
    public function __construct()
    {
        $this->auth = new AuthModel;
    }


    public function index()
    {
        return view('account/pages/login');
    }



    /**
     *
     * verify user login
     *
     */
    public function verifyLogin()
    {
        /*form validation*/
        $validation = $this->_userLoginFormValidation();
        if ($validation===true) {

            $data['user_id'] = _clean($this->request->getPost('user_id'));
            $data['password'] = $this->request->getPost('user_password');
         
            //admin section
            return $this->_adminLogin($data);
        }else{ 
            //form validation error
            return redirect()->to('account/user-login')->withInput();
           
        }
    }


    /**
     *
     * admin login
     *
     */
    private function _adminLogin($data)
    {
        $response = $this->auth->verifyUserLogin($data);
        if ($response['status']===true) {
            //success
            if ($response['data']->status==='active') {
                // user is active
                $sessionData = [
                    'loggedIn' => true,
                    'user_id' => $response['data']->id,
                    'user_name' => $response['data']->full_name,
                    'login_time' => date('Y-m-d H:i:s'),
                ];
                //set session data
                session()->set($sessionData);
                return redirect()->to('admin/dashboard');
            }else{
                //user is not active
                session()->setFlashdata([
                    'status' => false,
                    'msg' => 'User is not active. Please contact admin.'
                ]);
                return redirect()->to('account/user-login');
            }
        }else{
            //user verification error
            session()->setFlashdata([
                'status' => false,
                'msg' => 'Invalid credential found. Please try again...'
            ]);
            return redirect()->to('account/user-login');
        }
    }

 

    /**
     *
     * form validation
     *
     */
    private function _userLoginFormValidation()
    {
        $validation = service('validation');
        $validation->setRules([
            'user_id' => [ 'label' => 'User Id', 'rules' => 'trim|required'],
            'user_password' => [ 'label' => 'Password', 'rules' => 'required'],
             
             
        ]);

        if ($validation->run($this->request->getPost())) {
             //validation success
             return true;
        }else{
            //validation failed
            return  $validation->getErrors();
        }

    }




    /**
     *
     * update password
     *
     */
    public function updateUserPassword()
    {
        if ($this->request->isAJAX()) {
            $validation = $this->_updatePasswordFormValidation();
            if ($validation===true) {
                $password = $this->request->getPost('old_password');
                $validatePassword = $this->auth->verifyCurrentPassword($password);
                if ($validatePassword) {
                    $newPassword= hashPassword($this->request->getPost('new_password'));
                    $status = $this->auth->updateUserPassword($newPassword);
                    if ($status===true) {
                        $response['status'] = true;
                        $response['msg'] =  'Password updated successfully.';
                        return $this->response->setJSON($response);
                    }else{
                        $response['status'] = false;
                        $response['msg'] =  'Oops! something went wrong.';
                        return $this->response->setJSON($response);
                    }
                }else{
                    $response['status'] = false;
                    $response['msg'] =  ['old_password' => 'Old password is incorrect.'];
                    return $this->response->setJSON($response);
                }
            }else{
                $response['status'] = false;
                $response['msg'] =  $validation;
                return $this->response->setJSON($response);
            }
        }
    }



    private function _updatePasswordFormValidation()
    {
        $validation = service('validation');
        $validation->setRules([
            'old_password' => [ 'label' => 'Old Password', 'rules' => 'trim|required'],
            'new_password' => [ 'label' => 'New Password', 'rules' => 'required|min_length[6]'],
            'confirm_password' => [ 'label' => 'Confirm Password', 'rules' => 'required|min_length[6]|matches[new_password]'],
             
             
        ]);

        if ($validation->run($this->request->getPost())) {
             //validation success
             return true;
        }else{
            //validation failed
            return  $validation->getErrors();
        }
    }


    /**
     *
     * logout
     *
     */
    public function logoutUser()
    {
        
        session()->destroy();
        
        session()->setFlashdata('logoutStatus', true);
         
        return redirect()->to('account/user-login');

    }
    
    


}
