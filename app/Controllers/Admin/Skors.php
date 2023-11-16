<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\GuruMapelModel;
use App\Models\KriteriaModel;
use App\Models\SubKriteriaModel;
use App\Models\NilaiAlternatif;
use App\Models\NilaiIndikator;

class Skors extends BaseController
{
    function __construct()
    {
        $this->GuruMapelM = new GuruMapelModel;
        $this->KriteriaM = new KriteriaModel;
        $this->SubKriteriaM = new SubKriteriaModel;
        $this->NilaiM = new NilaiAlternatif;
        $this->NilaiI = new NilaiIndikator;
    }
    protected $helpers=['login','app','penilaian','maut'];
    public function index()
    {
        $data = ['title'=> 'Home'];
        return view('Admin/Skors/index', $data);
    }

    public function NilaiAlternatif()
    {
        if ($this->request->isAJAX()) {
            $periode_id = $this->request->getVar('periode_id');
            $sekolah_id = $this->request->getVar('sekolah_id');
            $data = [
                'periode_id'=> $periode_id,
                'sekolah_id'=> $sekolah_id,
                'kriteria'=> $this->KriteriaM->findAll(),
                'guru_mapel'=> $this->GuruMapelM->BySekolahID($sekolah_id,$periode_id)
            ];
            $response = ['list_alternatif'=> view('Admin/Skors/nilai_alternatif', $data)];
            echo json_encode($response);
        }
    }



}
