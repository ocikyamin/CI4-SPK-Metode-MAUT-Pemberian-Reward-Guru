<?php

namespace App\Models;

use CodeIgniter\Model;

class NilaiAlternatif extends Model
{

    protected $table            = 'nilai_alternatif';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = false;
    protected $allowedFields    = [];


    public function GetNilai($sekolah_id =null, $periode_id =null, $guru_mapel_id =null,$kriteria_id =null,)
    {
        if ($sekolah_id === null || $periode_id === null || $guru_mapel_id === null | $kriteria_id === null) {
            return 0; // Kembalikan nilai 0 jika salah satu parameter kosong
        }
        return $this->db->table('nilai_alternatif')
        ->select('id,skor')
        ->where('sekolah_id', $sekolah_id)
        ->where('periode_id', $periode_id)
        ->where('guru_mapel_id', $guru_mapel_id)
        ->where('kriteria_id', $kriteria_id)
        ->get()->getRow();
    }
   
}
