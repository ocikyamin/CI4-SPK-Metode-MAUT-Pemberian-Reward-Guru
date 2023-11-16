<?php

namespace App\Models;

use CodeIgniter\Model;

class MapelModel extends Model
{

    protected $table            = 'mapel';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = false;
    protected $allowedFields    = [];

}
