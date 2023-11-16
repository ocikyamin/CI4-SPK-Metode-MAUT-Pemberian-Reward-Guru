<?php

namespace App\Models;

use CodeIgniter\Model;

class KelasModel extends Model
{
    protected $table            = 'kelas';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = false;
    protected $allowedFields    = [];

    public function KelasBySekolah($id=null)
    {
        if ($id=="all") {
            return $this->db->table('kelas')
            ->select('kelas.*, sekolah.nama_sekolah')
            ->join('sekolah','kelas.sekolah_id=sekolah.id')
            ->orderBy('kelas.kelas', 'asc')
            ->get()->getResultArray();
        }
        return $this->db->table('kelas')
        ->select('kelas.*, sekolah.nama_sekolah')
        ->join('sekolah','kelas.sekolah_id=sekolah.id')
        ->orderBy('kelas.kelas', 'asc')
        ->where('kelas.sekolah_id', $id)->get()->getResultArray();
    }

}
