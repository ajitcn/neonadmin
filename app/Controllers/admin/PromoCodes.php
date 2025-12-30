<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\admin\PromoCodesModel;
use App\Models\admin\ReloadCounterModel;

class PromoCodes extends BaseController
{
    protected $promoCodes;
    protected $counter;

    public function __construct()
    {
        $this->promoCodes = new PromoCodesModel;
        $this->counter = new ReloadCounterModel; 
    }

    public function index()
    {   
        $data['promo_codes'] = $this->promoCodes->getPromoCodes();
        return view('admin/pages/promo_codes', $data);
    }


    /**
     *
     * create new promo code
     * @return array|json
     * 
     *
     */
    
    public function create()
    {
        $response = array();
        $validation = $this->_promoCodeFormValidation(null);
        if ($validation===true) {

            $inputData = $this->_promoCodeInput('new');
            $status = $this->promoCodes->savePromoCode($inputData);

            if ($status===true) {
                $this->counter->updateCounter();
                $response['status'] = true;
                $response['msg'] =  'Promo code created successfully.';
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
    
    private function _promoCodeInput($type)
    {
        $data  = array();
        $data['promo_code_name'] = _clean($this->request->getPost('promo_code_name'));
        $data['description'] = _clean($this->request->getPost('description'));
        $data['discount_type'] = _clean($this->request->getPost('discount_type'));
        $data['discount'] = (int) $this->request->getPost('discount'); 
        $data['max_use'] = (int) $this->request->getPost('max_use'); 
        $data['valid_from'] = date('Y-m-d', strtotime($this->request->getPost('valid_from')));
        $data['valid_till'] = date('Y-m-d', strtotime($this->request->getPost('valid_till')));
        $data['status'] = _clean($this->request->getPost('status'));
        if ($type==='new') {
            $data['created_at'] = date('Y-m-d H:i:s');
        }

        return $data;
    }



/**
 *
 * promo code form validation
 * @param int|null $id
 */
private function _promoCodeFormValidation($id = null)
{
    $validation = service('validation');

     
    // Set validation rules
    $validation->setRules([
        'description' => [
            'label' => 'Description', 
            'rules' => 'permit_empty|max_length[255]'
        ],
        'promo_code_name' => [
            'label' => 'Promo Code Name', 
            'rules' => 'required|max_length[255]|is_unique[promo_codes.promo_code_name,id,'.$id.']',
            'errors' => [
                'is_unique' => 'The {field} already exists.'
            ],
        ],
        'discount_type' => [
            'label' => 'Discount Type', 
            'rules' => 'required|in_list[Flat,Percentage]'
        ],
        'discount' => [
            'label' => 'Discount', 
            'rules' => 'required|is_natural'
        ],
        'max_use' => [
            'label' => 'Max Use', 
            'rules' => 'required|is_natural'
        ],
        'valid_from' => [
            'label' => 'Valid From', 
            'rules' => 'required|valid_date[d-m-Y]'
        ],
        'valid_till' => [
            'label' => 'Valid Till', 
            'rules' => 'required|valid_date[d-m-Y]'
        ],
        'status' => [
            'label' => 'Status', 
            'rules' => 'required|in_list[active,inactive]'
        ],
    ]);

    // Run validation
    if ($validation->run($this->request->getPost())) {
        return true;
    } else {
        return $validation->getErrors();
    }
}



    /**
     *
     * edit promo code 
     * @return array|json
     * 
     */
    public function edit()
    {
        if ($this->request->isAJAX()) {
            //primary id
            $id = $this->request->getVar('id');
            $data = $this->promoCodes->promoCodeById($id);
            $response['status'] = $data ? true : false;
            $response['data'] = $data;
            return $this->response->setJSON($response);
        }
    }
    
    
    /**
     *
     * update promo code data
     *
     * @return array|json
     */
    
    public function update()
    {
        $response = array();
        $id = (int)$this->request->getPost('id');
        $validation = $this->_promoCodeFormValidation($id);
        if ($validation===true) {

            $inputData = $this->_promoCodeInput('update');
            
            $status = $this->promoCodes->updatePromoCode($inputData, $id);

            if ($status===true) {
                $this->counter->updateCounter();
                $response['status'] = true;
                $response['msg'] =  'Promo code updated successfully.';
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
     * delete promo code
     * @param int $id is unique id
     * @return session data
     */
    
    public function delete($id)
    {
        $response = $this->promoCodes->deletePromoCode($id);
        session()->setFlashdata($response);
        $this->counter->updateCounter();
        return redirect()->to('admin/promo-codes');
    }

} 
