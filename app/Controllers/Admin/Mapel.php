<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\MapelModel;

class Mapel extends BaseController
{
    protected $helpers = ['login'];
    function __construct()
    {
        $this->mapelM = new MapelModel;
    }
    public function index()
    {
        $data = ['title'=> 'Mapel'];
        return view('Admin/Mapel/index', $data);
    }
    public function Show()
    {
        if ($this->request->isAJAX()) {
           $data = ['mapel'=> $this->mapelM->findAll()];
           $view =['list_mapel'=> view('Admin/Mapel/Table', $data)];
           echo json_encode($view);
        }
    }

    public function New()
    {
        if ($this->request->isAJAX()) {
            $view =['form_mapel'=> view('Admin/Mapel/New')];
            echo json_encode($view);
        }
    }
    public function Save()
    {
        if ($this->request->isAJAX()) {
            // Pangil Service Validation 
            $this->validate= \Config\Services::validation();
            // Deklarasi Validasi  
            $validate = $this->validate(
                [
            'mapel' => [
                'label'  => 'Mata Pelajaran',
                'rules'  => 'required|is_unique[mapel.mapel]',
                'errors' => [
                    'required' => '{field} Wajib di isi',
                    'is_unique' => '{field} Telah Tersedia'
                    ]
                ],
            ]
        );
        // Jika Tidak Tervalidasi, Kembalikan Pesan Error 
        if (!$validate) {
            $response = [
                'error' => [
                    'mapel' => $this->validate->getError('mapel')
            ]
        ];
            }else{
            
                $data = [
                    'mapel'=> $this->request->getPost('mapel')
            ];
            $this->mapelM->save($data);
            $response = [
                'status'=> 201,
                'msg' => 'Data Berhasil disimpan'
                
            ];
        }
           echo json_encode($response);
        }
    }
    public function Edit()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $data = ['mapel'=> $this->mapelM->find($id)];
            $view =['form_mapel'=> view('Admin/Mapel/Edit', $data)];
            echo json_encode($view);
        }
    }
    public function Update()
    {
        if ($this->request->isAJAX()) {
            // Pangil Service Validation 
            $this->validate= \Config\Services::validation();
            $mapel = $this->request->getPost('mapel');
            $mapel_old = $this->request->getPost('mapel_old');
            // Deklarasi Validasi  
            $validate = $this->validate(
                [
            'mapel' => [
                'label'  => 'Mata Pelajaran',
                'rules'  => $mapel==$mapel_old ? 'required':'required|is_unique[mapel.mapel]',
                'errors' => [
                    'required' => '{field} Wajib di isi',
                    'is_unique' => '{field} Telah tersedia'
                    ]
                ],
            ]
        );
        // Jika Tidak Tervalidasi, Kembalikan Pesan Error 
        if (!$validate) {
            $response = [
                'error' => [
                    'mapel' => $this->validate->getError('mapel')
            ]
        ];
            }else{
            
                $data = [
                    'id'=> $this->request->getPost('id'),
                    'mapel'=> $mapel
            ];
            $this->mapelM->save($data);
            $response = [
                'status'=> 201,
                'msg' => 'Data Berhasil diperbarui'
                
            ];
        }
           echo json_encode($response);
        }
    }
    public function Delete()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $this->mapelM->delete($id);
            $response = [
                'status'=> 201,
                'msg' => 'Data Dihapus'
            ];
            echo json_encode($response);
        }
    }
}
