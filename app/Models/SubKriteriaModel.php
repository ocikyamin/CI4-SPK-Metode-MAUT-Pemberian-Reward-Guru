<?php

namespace App\Models;

use CodeIgniter\Model;

class SubKriteriaModel extends Model
{
    protected $table            = 'kriteria_sub';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = false;
    protected $allowedFields    = [];
    
    public function KriteriaByID($id)
    {
       return $this->db->table('kriteria_sub')->where('kriteria_id', $id)->get()->getResultArray();
    }



}
