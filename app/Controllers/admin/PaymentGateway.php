<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\admin\PaymentGatewayModel;
use App\Models\admin\ReloadCounterModel;

class PaymentGateway extends BaseController
{
     protected $pg;
     protected $counter;

    public function __construct()
    {
        $this->pg = new PaymentGatewayModel;
        $this->counter = new ReloadCounterModel; 
    }

    public function index()
    {   
        $data['paymentGateways'] = $this->pg->getPaymentGateway();
        return view('admin/pages/payment_gateway', $data);
    }


    /**
     *
     * create new Payment Gateway
     * @return array|json
     * 
     *
     */
    
    public function create()
    {
        $response = array();
        $validation = $this->_paymentGatewayFormValidation(null);
        if ($validation===true) {

            $inputData = $this->_paymentGatewayInput('new');
            $status = $this->pg->savePaymentGateway($inputData);

            if ($status===true) {
                $response['status'] = true;
                $response['msg'] =  'Payment gateway created successfully.';
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
    
    private function _paymentGatewayInput($type)
    {
        $data  = array();
        //$data['payment_gateway_name'] = _clean($this->request->getPost('payment_gateway_name'));
        $data['api_key'] =  _clean($this->request->getPost('api_key')); 
        $data['secret_code'] = _clean($this->request->getPost('secret_code'));
        $data['merchant_id'] = _clean($this->request->getPost('merchant_id')); 
        $data['status'] = _clean($this->request->getPost('status'));
        $data['updated_at'] = date('Y-m-d H:i:s');
        if ($type==='new') {
            $data['created_at'] = date('Y-m-d H:i:s');
        }

        return $data;
    }



    /**
     *
     * Payment Gateway form validation
     * @param int|null $id
     */
    private function _paymentGatewayFormValidation($id)
    {
        $validation = service('validation');
         
        $validation->setRules([

            'payment_gateway_name' => [ 
                'label' => 'Gateway Name', 
                'rules' => 'required|max_length[255]|is_unique[payment_gateways.payment_gateway_name,id,'.$id.']', 
                'errors' => [
                    'is_unique' => 'The {field} already exists.'
                ],
            ],
            'api_key' => [ 'label' => 'API Key', 'rules' => 'required' ], 
            'secret_code' => [ 'label' => 'Secret Code', 'rules' => 'required' ], 
            'merchant_id' => [ 'label' => 'Merchant ID', 'rules' => 'permit_empty' ],
            'status' => [ 'label' => 'Status', 'rules' => 'required|in_list[active,inactive]' ],
             
        ]);

        if ($validation->run($this->request->getPost())) {
             return true;
        }else{
            return $validation->getErrors();
        }
    }



    /**
     *
     * edit Payment Gateway 
     * @return array|json
     * 
     */
    public function edit()
    {
        if ($this->request->isAJAX()) {
            //primary id
            $id = $this->request->getVar('id');
            $data = $this->pg->paymentGatewayById($id);
            $response['status'] = $data ? true : false;
            $response['data'] = $data;
            return $this->response->setJSON($response);
        }
    }
    
    
    /**
     *
     * update Payment Gateway data
     *
     * @return array|json
     */
    
    public function update()
    {
        $response = array();
        $id = (int)$this->request->getPost('id');
        $validation = $this->_paymentGatewayFormValidation($id);
        if ($validation===true) {

            $inputData = $this->_paymentGatewayInput('update');
            
            $status = $this->pg->updatePaymentGateway($inputData, $id);

            if ($status===true) {
                $this->counter->updateCounter();
                $response['status'] = true;
                $response['msg'] =  'Payment gateway updated successfully.';
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
     * delete Payment Gateway
     * @param int $id is unique user id
     * @return session data
     */
    
    public function delete($id)
    {
        $response = $this->pg->deletePaymentGateway($id);
        session()->setFlashdata($response);
        return redirect()->to('admin/payment-gateway');
    }
}
