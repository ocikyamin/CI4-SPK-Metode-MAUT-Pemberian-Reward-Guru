<?php

namespace App\Models;

use CodeIgniter\Model;

class UserAccessModel extends Model
{

    protected $table            = 'user_akses';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = false;
    protected $allowedFields    = [];

}