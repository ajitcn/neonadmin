<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class ReloadCounterModel extends Model
{
    protected $table            = 'reload_counters';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'object';

    public function updateCounter()
    {
         $this->db->table($this->table)
                    ->set('counter', 'counter+1', false)
                    ->update();
    }
     
}
