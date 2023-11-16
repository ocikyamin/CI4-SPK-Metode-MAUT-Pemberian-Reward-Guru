<?php

namespace App\Models;

use CodeIgniter\Model;

class NilaiIndikator extends Model
{
    protected $table            = 'nilai_alternatif_indikator';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = false;
    protected $allowedFields    = [];
}
