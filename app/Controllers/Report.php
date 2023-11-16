<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GuruMapelModel;
use App\Models\KriteriaModel;
use App\Models\SubKriteriaModel;
use App\Models\NilaiAlternatif;
use App\Models\NilaiIndikator;
use App\Models\PeriodeModel;
use App\Models\SekolahModel;


class Report extends BaseController
{
    function __construct()
    {
        $this->GuruMapelM = new GuruMapelModel;
        $this->KriteriaM = new KriteriaModel;
        $this->SubKriteriaM = new SubKriteriaModel;
        $this->NilaiM = new NilaiAlternatif;
        $this->NilaiI = new NilaiIndikator;
        $this->periodeM = new PeriodeModel;
        $this->sekolahM = new SekolahModel;
    }
     // inlcude helper 
     protected $helpers=['superv','app','penilaian','maut'];
    public function index()
    {
        
    }

    public function NilaiGuru($guru_mapel_id = null)
    {
        $guru = $this->GuruMapelM->GuruID($guru_mapel_id);
        $data = ['title'=> 'Form Penilaian',
        'guru'=> $guru ,
        'guru_mapel_id'=> $guru->id,
        'periode_id'=> $guru->periode_id,
        'kriteria'=> $this->KriteriaM->findAll()
        ];

        return view('Report/nilai_guru', $data);
    }

    public function PKG($periode_id, $sekolah_id)
    {
       
        $data = [
            'periode_id'=> $periode_id,
            'sekolah_id'=> $sekolah_id,
            'kriteria'=> $this->KriteriaM->findAll(),
            'guru_mapel'=> $this->GuruMapelM->BySekolahID($sekolah_id,$periode_id),
            'periode'=> $this->periodeM->find($periode_id),
            'sekolah'=> $this->sekolahM->find($sekolah_id)
        ];
        return view('Report/nilai_alternatif', $data);
    }
}