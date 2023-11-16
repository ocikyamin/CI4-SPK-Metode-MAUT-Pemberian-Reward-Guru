<?php

namespace App\Controllers\Supervisor;

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
    protected $helpers=['superv','app','penilaian','maut'];
    public function index()
    {
        $data = ['title'=> 'Home'];
        return view('Supervisor/Skors/index', $data);
    }

    public function NilaiAlternatif()
    {
        if ($this->request->isAJAX()) {
            $periode_id = $this->request->getVar('periode_id');
            $data = [
                'periode_id'=> $periode_id,
                'kriteria'=> $this->KriteriaM->findAll(),
                'guru_mapel'=> $this->GuruMapelM->BySekolahID(UserLogin()->sekolah_id,$periode_id)
            ];
            $response = ['list_alternatif'=> view('Supervisor/Skors/nilai_alternatif', $data)];
            echo json_encode($response);
        }
    }



}
