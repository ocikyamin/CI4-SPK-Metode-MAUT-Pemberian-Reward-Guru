<?php

namespace App\Models;

use CodeIgniter\Model;

class GuruMapelModel extends Model
{
    protected $table            = 'guru_mapel';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = false;
    protected $allowedFields    = [];

public function AllGuruMapel()
{
return $this->db->table('guru_mapel')
->select('
guru_mapel.id,
guru_mapel.kode_guru,
guru.nama,
mapel.mapel,
kelas.kelas
')
->join('guru','guru_mapel.guru_id=guru.id')
->join('mapel','guru_mapel.mapel_id=mapel.id')
->join('kelas','guru_mapel.kelas_id=kelas.id')
// ->orderBy('guru_mapel.kode_guru', 'asc')

->get()
->getResultArray();
}


    // Get Guru Mapel berdasarkan tingkat sekolah 
    public function BySekolahID($sekolah_id=null,$periode_id =null)
    {
        if ($sekolah_id==null || $periode_id=="") {
            return 0;
        }
        if ($sekolah_id=="all") {
            return $this->db->table('guru_mapel')
        ->select('
        guru_mapel.id,
        guru_mapel.kode_guru,
        guru_mapel.sekolah_id,
        guru.nama,
        mapel.mapel,
        kelas.kelas
        ')
        ->join('guru','guru_mapel.guru_id=guru.id')
        ->join('mapel','guru_mapel.mapel_id=mapel.id')
        ->join('kelas','guru_mapel.kelas_id=kelas.id')
        ->where('guru_mapel.periode_id', $periode_id)
        ->orderBy('guru_mapel.id', 'ASC')
        ->get()
        ->getResultArray();
        }else{
            return $this->db->table('guru_mapel')
        ->select('
        guru_mapel.id,
        guru_mapel.kode_guru,
        guru_mapel.sekolah_id,
        guru.nama,
        mapel.mapel,
        kelas.kelas
        ')
        ->join('guru','guru_mapel.guru_id=guru.id')
        ->join('mapel','guru_mapel.mapel_id=mapel.id')
        ->join('kelas','guru_mapel.kelas_id=kelas.id')
        ->where('guru_mapel.sekolah_id', $sekolah_id)
        ->where('guru_mapel.periode_id', $periode_id)
        ->orderBy('guru_mapel.id', 'ASC')
        ->get()
        ->getResultArray();
        }
    }

    public function GuruID($guru_id)
    {
        return $this->db->table('guru_mapel')
        ->select('
        guru_mapel.*,
        guru.nuptk,
        guru.nama,
        guru.tmp_lahir,
        guru.tgl_lahir,
        guru.pddk_akhir,
        mapel.mapel,
        kelas.kelas,
        periode.periode,
        periode.tahun_akademik,
        sekolah.npsn,
        sekolah.nama_sekolah,
        sekolah.kepala_sekolah,
        sekolah.nip,
        sekolah.alamat
        

        ')
        ->join('sekolah','guru_mapel.sekolah_id=sekolah.id')
        ->join('periode','guru_mapel.periode_id=periode.id')
        ->join('guru','guru_mapel.guru_id=guru.id')
        ->join('mapel','guru_mapel.mapel_id=mapel.id')
        ->join('kelas','guru_mapel.kelas_id=kelas.id')
        ->where('guru_mapel.id', $guru_id)
        ->get()
        ->getRow();
    }


    public function isCombinationUnique($sekolahId, $periodeId, $guruId, $mapelId, $kelasId, $currentId = null)
    {
        $query = $this->db->table('guru_mapel')
        ->where([
            'sekolah_id' => $sekolahId,
            'periode_id' => $periodeId,
            'guru_id' => $guruId,
            'mapel_id' => $mapelId,
            'kelas_id' => $kelasId
        ]);

        if ($currentId !== null) {
            $query->where('id !=', $currentId);
        }

        // Cek apakah kombinasi mapel_id dan kelas_id sudah ada pada sekolah_id dan periode_id tertentu
        $query->orWhere("sekolah_id = $sekolahId AND periode_id = $periodeId AND mapel_id = $mapelId AND kelas_id = $kelasId");

        return ($query->countAllResults() === 0);
    }

}
