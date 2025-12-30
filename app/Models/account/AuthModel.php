<?php

namespace App\Models\account;

use CodeIgniter\Model;

class AuthModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = false;
    protected $allowedFields    = [];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function verifyUserLogin($data)
    {

        $result = $this->db->table('users')
                            ->select('id, full_name, status , password')
                            ->where('email_id', $data['user_id'])
                            ->orWhere('phone', $data['user_id'])
                            ->get()->getRow();
                             
        if ($result) {
           if ($this->_verify_password_hash($data['password'], $result->password)) {
            //password verified
            return ['status' => true, 'data' => $result, 'msg' => 'Verified'];
              
           }else{
            //invalid password
            return ['status' => false, 'data' => '', 'msg' => 'Invalid password'];

           }
        }else{
            //invalid user
            return ['status' => false, 'data' => '', 'msg' => 'Invalid user'];
        }

    }

    /**
     *
     * verify password via hash
     *
     */
    
    private function _verify_password_hash($password, $hash)
    {
      return password_verify ($password, $hash);
    }




    /**
     *
     * verify old password
     *
     */
    public function verifyCurrentPassword($password)
    {
        $result = $this->db->table('users')
                            ->select('password')
                            ->where('id', session('user_id'))
                            ->get()->getRow();   
        if ($result) {
            return $this->_verify_password_hash($password, $result->password);
        }else{
            return false;
        }
    }


    /**
     *
     * update password
     *
     */
    public function updateUserPassword($password)
    {
        $this->db->transStart();
        $this->db->table('users')
                ->set('password', $password)
                ->where('id', session('user_id'))
                ->update();
        $this->db->transComplete();
        return $this->db->transStatus();
    }




    /**
     *
     * student login
     *
     */
    public function verifyStudentLogin($data)
    {
        $result = $this->db->table('students')
                            ->select('id, studentName, status, password')
                            ->where('emailId', $data['user_id'])
                            ->orWhere('mobileNumber', $data['user_id'])
                            ->get()->getRow();
                             
        if ($result) {
           if ($this->_verify_password_hash($data['password'], $result->password)) {
            //password verified
            return ['status' => true, 'data' => $result, 'msg' => 'Verified'];
              
           }else{
            //invalid password
            return ['status' => false, 'data' => '', 'msg' => 'Invalid password'];

           }
        }else{
            //invalid user
            return ['status' => false, 'data' => '', 'msg' => 'Invalid user'];
        }
    }
    
    
    
}
