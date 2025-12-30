<?php

namespace App\Models\admin;
use CodeIgniter\Database\Exceptions\DatabaseException;

use CodeIgniter\Model;

class MemberModel extends Model
{
    protected $table            = 'members';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = false;
    protected $allowedFields    = [];
 


    /**
     *
     * count all members
     * @return int
     * 
     */
    public function countAllMembers()
    {
        $orderBy = !empty(service('request')->getVar('order_by'))? explode('-', service('request')->getVar('order_by')) : '';

        $builder = $this->db->table('members');
                        if (!empty(service('request')->getVar('search_term'))) {
                            $builder->groupStart();

                            $builder->like('member_name', _clean(service('request')->getVar('search_term')));
                            $builder->orLike('mobile_number', _clean(service('request')->getVar('search_term')));
                            $builder->orLike('member_email', _clean(service('request')->getVar('search_term')));

                            $builder->groupEnd();
                        }
                        if (!empty(service('request')->getVar('member_status'))) {
                            $builder->where('status', _clean(service('request')->getVar('member_status')));
                        }
                        if (!empty(service('request')->getVar('subscription_validity'))) {
                             if (service('request')->getVar('subscription_validity')==='active') {
                                 $builder->where('end_of_subscription >=', date('Y-m-d'));
                             }else{
                                $builder->where('end_of_subscription <', date('Y-m-d'));
                             }
                        }
                        if (!empty(service('request')->getVar('order_by'))) {
                            $builder->orderBy($orderBy[0], $orderBy[1]);
                        }
        return $builder->countAllResults();
    }
    
    /**
     *
     * get member data
     * @param int $limit
     * @param int $offset
     * @param array $defOrderBy
     * @return array object
     */
    
    public function getMembers($limit, $offset, $defOrderBy)
    {
        $orderBy = !empty(service('request')->getVar('order_by'))? explode('-', service('request')->getVar('order_by')) : '';

        $builder = $this->db->table('members') ;
                        if (!empty(service('request')->getVar('search_term'))) {
                            $builder->groupStart();

                            $builder->like('member_name', _clean(service('request')->getVar('search_term')));
                            $builder->orLike('mobile_number', _clean(service('request')->getVar('search_term')));
                            $builder->orLike('member_email', _clean(service('request')->getVar('search_term')));

                            $builder->groupEnd();
                        }
                        if (!empty(service('request')->getVar('member_status'))) {
                            $builder->where('status', _clean(service('request')->getVar('member_status')));
                        }
                        if (!empty(service('request')->getVar('subscription_validity'))) {
                             if (service('request')->getVar('subscription_validity')==='active') {
                                 $builder->where('end_of_subscription >=', date('Y-m-d'));
                             }else{
                                $builder->where('end_of_subscription <', date('Y-m-d'));
                             }
                        }
                        if (!empty(service('request')->getVar('order_by'))) {
                            $builder->orderBy($orderBy[0], $orderBy[1]);
                        }else{
                            $builder->orderBy($defOrderBy[0], $defOrderBy[1]);
                        }
                        
        return $builder->get($limit, $offset)->getResult();
    }


    public function getAllMembers($limit, $orderBy)
    {
        return $this->db->table('members') 
                        ->orderBy($orderBy[0], $orderBy[1])
                        ->get($limit)->getResult();
    }

    public function getAllActiveMembers()
    {
        return $this->db->table('members')
                        ->where('status', 1)
                        ->orderBy('member_name')
                        ->get()->getResult();
    }

 



    /**
     *
     * new student Id
     *
     */
    public function _newMemberId()
    {
        $id = 1;
        $result = $this->db->table('members')
                        ->orderBy('id_card_number', 'desc')
                        ->get(1)->getRow();
        if ($result) {
            $id = (int)$result->id_card_number+1;
        }
        return $id;
    }


    /**
     *
     * student by primary id
     *
     */
    
    public function memberById($id)
    {
        
        $result = $this->db->table('members')
                        ->where('id', $id)
                        ->get()->getRow();
        return $result;
    }



    /**
     *
     * save student
     *
     */
    public function saveMember($inputData)
    {
        $this->db->transStart();
        $this->insert($inputData);
        $this->db->transComplete();
        return $this->db->transStatus();
    }


    public function _updateAssignmentQty($studentId, $qty, $operation)
    {
        $this->db->table('students')
                ->set('currentBookAssignment', 'currentBookAssignment'.$operation.$qty, false)
                ->set('updatedAt', date('Y-m-d H:i:s'))
                ->where('id', $studentId)
                ->where('parent_user_id', session('parent_user_id'))
                ->update();
    }



    /**
     *
     * update data
     *
     */
    public function updateMember($inputData, $id)
    {
        $this->db->transStart();
        $this->db->table('members')
                ->where('id', $id)
                ->update($inputData);

        $this->db->transComplete();
        return $this->db->transStatus();
    }



    /**
     *
     * delete data
     *
     */
    public function deleteMember($id)
    {
        $this->db->transStart();
        try {


            //delete base product

            $this->db->table('members')
                    ->where('id', $id)
                    ->delete();

            

            $this->db->transComplete();
            if ($this->db->transStatus()===false) {
                $this->db->transRollback();
                throw new DatabaseException('This member can not be deleted.');
            }else{
                return ['status' => true, 'msg' => 'Member deleted successfully.'];
            }

        } catch (DatabaseException $e) {
            return ['status' => false, 'msg' => $e->getMessage()];
        }
            
    }



    /**
     *
     * save membership
     *
     */
    
    public function saveSubscription($inputData, $setEndDate)
    {
       $this->db->transStart();
        $this->db->table('member_subscription')
                ->insert($inputData);

        //update member data
        $this->_updateSubscriptionDuration($inputData, $setEndDate);
       $this->db->transComplete();
       return $this->db->transStatus();
    }

    /**
     *
     * update duration
     *
     */

    private function _updateSubscriptionDuration($inputData, $setEndDate)
    {
        $this->db->table('members')
                ->set('end_of_subscription', $setEndDate)
                ->set('status', 'active')
                ->set('updated_at', date('Y-m-d'))
                ->where('id', $inputData['member_id'])
                ->update();
    }


    /**
     *
     * membership list
     *
     */

    public function membershipList($limit)
    {
        return $this->db->table('student_memberships')
                ->select('student_memberships.*, students.studentName, students.studentId')
                ->join('students', 'students.id=student_memberships.studentId')
                ->where('student_memberships.parent_user_id', session('parent_user_id'))
                ->orderBy('student_memberships.createdAt', 'desc')
                ->get()->getResult();
    }
    
    

    
    
    
    


}
