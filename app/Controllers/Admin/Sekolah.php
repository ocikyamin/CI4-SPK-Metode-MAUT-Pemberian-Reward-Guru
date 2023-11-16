<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SekolahModel;

class Sekolah extends BaseController
{
    protected $helpers = ['login'];
    function __construct()
    {
        $this->sekolahM = new SekolahModel;
    }
    public function index()
    {
        $data = ['title'=> 'Sekolah'];
        return view('Admin/Sekolah/index', $data);
    }
    public function Show()
    {
        if ($this->request->isAJAX()) {
           $data = ['sekolah'=> $this->sekolahM->findAll()];
           $view =['list_sekolah'=> view('Admin/Sekolah/Table', $data)];
           echo json_encode($view);
        }
    }

    public function New()
    {
        if ($this->request->isAJAX()) {
            $view =['form_sekolah'=> view('Admin/Sekolah/New')];
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
            'npsn' => [
                'label'  => 'NPSN',
                'rules'  => 'required|is_unique[sekolah.npsn]',
                'errors' => [
                    'required' => '{field} Wajib di isi',
                    'is_unique' => '{field} Telah digunakan'
                    ]
                ],
            ]
        );
        // Jika Tidak Tervalidasi, Kembalikan Pesan Error 
        if (!$validate) {
            $response = [
                'error' => [
                    'npsn' => $this->validate->getError('npsn')
            ]
        ];
            }else{
            
                $data = [
                    'npsn'=> $this->request->getPost('npsn'),
                    'nama_sekolah'=> $this->request->getPost('nama_sekolah'),
                    'kepala_sekolah'=> $this->request->getPost('kepala_sekolah'),
                    'nip'=> $this->request->getPost('nip'),
                    'alamat'=> $this->request->getPost('alamat'),
            ];
            $this->sekolahM->save($data);
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
            $data = ['sekolah'=> $this->sekolahM->find($id)];
            $view =['form_sekolah'=> view('Admin/Sekolah/Edit', $data)];
            echo json_encode($view);
        }
    }
    public function Update()
    {
        if ($this->request->isAJAX()) {
            // Pangil Service Validation 
            $this->validate= \Config\Services::validation();
            $npsn = $this->request->getPost('npsn');
            $npsn_old = $this->request->getPost('npsn_old');
           // Pangil Service Validation 
           $this->validate= \Config\Services::validation();
           // Deklarasi Validasi  
           $validate = $this->validate(
               [
           'npsn' => [
               'label'  => 'NPSN',
               'rules'  => $npsn==$npsn_old ? 'required' : 'required|is_unique[sekolah.npsn]',
               'errors' => [
                   'required' => '{field} Wajib di isi',
                   'is_unique' => '{field} Telah digunakan'
                   ]
               ],
           ]
       );
       // Jika Tidak Tervalidasi, Kembalikan Pesan Error 
       if (!$validate) {
           $response = [
               'error' => [
                   'npsn' => $this->validate->getError('npsn')
           ]
       ];
            }else{
            
                $data = [
                    'id'=> $this->request->getPost('id'),
                    'npsn'=> $npsn,
                    'nama_sekolah'=> $this->request->getPost('nama_sekolah'),
                    'kepala_sekolah'=> $this->request->getPost('kepala_sekolah'),
                    'nip'=> $this->request->getPost('nip'),
                    'alamat'=> $this->request->getPost('alamat')
            ];
            $this->sekolahM->save($data);
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
            $this->sekolahM->delete($id);
            $response = [
                'status'=> 201,
                'msg' => 'Data Dihapus'
            ];
            echo json_encode($response);
        }
    }
}
