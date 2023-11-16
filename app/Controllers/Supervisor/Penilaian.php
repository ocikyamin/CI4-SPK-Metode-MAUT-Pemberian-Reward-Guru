<?php

namespace App\Controllers\Supervisor;

use App\Controllers\BaseController;
use App\Models\GuruMapelModel;
use App\Models\KriteriaModel;
use App\Models\SubKriteriaModel;
use App\Models\NilaiAlternatif;
use App\Models\NilaiIndikator;

class Penilaian extends BaseController
{
    function __construct()
    {
        $this->GuruMapelM = new GuruMapelModel;
        $this->KriteriaM = new KriteriaModel;
        $this->SubKriteriaM = new SubKriteriaModel;
        $this->NilaiM = new NilaiAlternatif;
        $this->NilaiI = new NilaiIndikator;
    }
     // inlcule helper 
     protected $helpers=['superv','app','penilaian'];
     public function index()
     {
        //  dd(UserLogin()->sekolah_id);
         $data = ['title'=> 'Home'];

         return view('Supervisor/Penilaian/index', $data);
     }
//  Menampilkan daftar guru mapel berdasarkan tingkat sekolah dan periode akademik 
     public function GuruMapel()
     {
        if ($this->request->isAJAX()) {
            $periode_id = $this->request->getVar('periode_id');
            $data = [
                'periode_id'=> $periode_id,
                'guru_mapel'=> $this->GuruMapelM->BySekolahID(UserLogin()->sekolah_id,$periode_id)
            ];
            $response = ['guru_mapel_list'=> view('Supervisor/Penilaian/guru_mapel_list', $data)];
            echo json_encode($response);
        }
    }
    
        public function FormNilai($guru_id)
        {
        //  dd(UserLogin()->sekolah_id);
        $data = ['title'=> 'Form Penilaian',
        'guru'=> $this->GuruMapelM->GuruID($guru_id),
        'kriteria'=> $this->KriteriaM->findAll()
        ];

        return view('Supervisor/Penilaian/form_penilaian', $data);
        }

public function NilaiKompetnsi()
{
    if ($this->request->isAJAX()) {
    $data = [
    'guru_mapel_id'=> $this->request->getVar('guru_mapel_id'),
    'periode_id'=> $this->request->getVar('periode_id'),
    'kriteria'=> $this->KriteriaM->findAll()
    ];
    $response = ['table_status_nilai'=> view('Supervisor/Penilaian/status_penilaian', $data)];
    echo json_encode($response);
    }
}

     public function FormSubKriteria()
     {
        if ($this->request->isAJAX()) {
            $guru_mapel_id = $this->request->getVar('guru_mapel_id');
            $kriteria_id = $this->request->getVar('kriteria_id');
            $guru = $this->GuruMapelM->GuruID($guru_mapel_id);
            $data = [
            'guru'=> $guru,
            'kriteria'=> $this->KriteriaM->find($kriteria_id),
            'sub_kriteria'=> $this->SubKriteriaM->KriteriaByID($kriteria_id),
            'nilai_kriteria'=> $this->NilaiM->GetNilai($guru->sekolah_id,$guru->periode_id,$guru->id,$kriteria_id,)
        ];
            $response = ['form_sub_kriteria'=> view('Supervisor/Penilaian/form_sub_kriteria', $data)];
            echo json_encode($response);            
        }
     }
     public function SaveNilai()
     {
        if ($this->request->isAJAX()) {
            $nilai_id = $this->request->getPost('nilai_id');
            $sekolah_id = $this->request->getPost('sekolah_id');
            $periode_id = $this->request->getPost('periode_id');
            $penilai_id = $this->request->getPost('penilai_id');
            $guru_mapel_id = $this->request->getPost('guru_mapel_id');
            $kriteria_id = $this->request->getPost('kriteria_id');
            $skor = $this->request->getPost('skor');
            $tgl_penilaian = $this->request->getPost('tgl_penilaian');
            $total_skor = array_sum($skor);
            
            // Nilai Komptensi / Kriteria Utama 
            $data = [
                'id'=> $nilai_id==0 ? 0 : $nilai_id,
                'sekolah_id'=> $sekolah_id,
                'periode_id'=> $periode_id,
                'penilai_id'=> $penilai_id,
                'guru_mapel_id'=> $guru_mapel_id,
                'kriteria_id'=> $kriteria_id,
                'skor'=> $total_skor,
                'tgl_penilaian'=> $tgl_penilaian
            ];
            
            // Nilai Indikator / Sub Kriteria 
            $nilai_indikator_id = $this->request->getPost('nilai_indikator_id');
            $indikator = $this->request->getPost('indikator'); // Array dari inputan indikator
            $dataNilaiIndikator = [];
            foreach ($indikator as $index => $id) {
                $skorValue = $skor[$index];
                $nilai_id = $nilai_indikator_id[$index];
                // Siapkan data berdasarkan indikator dan skor
                $dataNilaiIndikator[] = [
                    'id'=> $nilai_id==0 ? 0 : $nilai_id,
                    'sekolah_id'=> $sekolah_id,
                    'periode_id'=> $periode_id,
                    // 'penilai_id'=> $penilai_id,
                    'guru_mapel_id'=> $guru_mapel_id,
                    'kriteria_id'=> $kriteria_id,
                    'sub_kriteria_id' => $id,
                    'nilai' => $skorValue
                ];
            }

            if (array_sum($nilai_indikator_id)==0) {
            $this->NilaiI->insertBatch($dataNilaiIndikator);
            }else{
            // Update jika id nilai indikator ada 
            $this->NilaiI->updateBatch($dataNilaiIndikator, 'id');
            }
     
            $this->NilaiM->save($data);
            $response = [
                'sukses'=> 200,
                'msg'=> 'Nilai Indikator Berhasil disimpan.'
            ];


            echo json_encode($response);            
        }
     }

     public function ResetNilai()
     {
        if ($this->request->isAJAX()) {
            $params = $this->request->getPost();
            $this->NilaiM
            ->where('periode_id', $params['periode_id'])
            ->where('guru_mapel_id', $params['guru_mapel_id'])
            ->where('kriteria_id', $params['kriteria_id'])
            ->delete();
            $this->NilaiI
            ->where('periode_id', $params['periode_id'])
            ->where('guru_mapel_id', $params['guru_mapel_id'])
            ->where('kriteria_id', $params['kriteria_id'])
            ->delete();
            $response = [
                'status'=> 201,
                'msg' => 'Data Dihapus',
                'url'=> base_url('superv/penilaian/guru/'.$params['guru_mapel_id'])

            ];
            echo json_encode($response);
        }
     }
}