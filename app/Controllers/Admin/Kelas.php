<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KelasModel;

class Kelas extends BaseController
{
    protected $helpers = ['login','app'];
    function __construct()
    {
        $this->kelasM = new KelasModel;
    }
    public function index()
    {
        $data = ['title'=> 'Kelas'];
        return view('Admin/Kelas/index', $data);
    }
    public function Show()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
           $data = ['kelas'=> $this->kelasM->KelasBySekolah($id)];
           $view =['list_kelas'=> view('Admin/Kelas/Table', $data)];
           echo json_encode($view);
        }
    }

    public function New()
    {
        if ($this->request->isAJAX()) {
            $view =['form_kelas'=> view('Admin/Kelas/New')];
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
            'kelas' => [
                'label'  => 'Nama Kelas',
                'rules'  => 'required|is_unique[kelas.kelas]',
                'errors' => [
                    'required' => '{field} Wajib di isi',
                    'is_unique' => '{field} Telah digunakan'
                    ]
                ],
                'sekolah' => [
                    'label'  => 'Sekolah',
                    'rules'  => 'required',
            'errors' => [
                'required' => '{field} Wajib di isi'
                ]
            ],
            ]
        );
        // Jika Tidak Tervalidasi, Kembalikan Pesan Error 
        if (!$validate) {
            $response = [
                'error' => [
                    'sekolah' => $this->validate->getError('sekolah'),
            'kelas' => $this->validate->getError('kelas')
            ]
        ];
            }else{
            $sekolah = $this->request->getPost('sekolah');
                $data = [
                    'sekolah_id'=> $sekolah,
                    'kelas'=> $this->request->getPost('kelas')
            ];
            $this->kelasM->save($data);
            $response = [
                'status'=> 201,
                'sekolah_id'=> $sekolah,
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
            $data = ['kelas'=> $this->kelasM->find($id)];
            $view =['form_kelas'=> view('Admin/Kelas/Edit', $data)];
            echo json_encode($view);
        }
    }
    public function Update()
    {
        if ($this->request->isAJAX()) {
            // Pangil Service Validation 
            $this->validate= \Config\Services::validation();
            $kelas = $this->request->getPost('kelas');
            $old_kelas = $this->request->getPost('old_kelas');
            // Deklarasi Validasi  
            $validate = $this->validate(
                [
            'kelas' => [
                'label'  => 'Kelas',
                'rules'  => $kelas==$old_kelas ? 'required':'required|is_unique[kelas.kelas]',
                'errors' => [
                    'required' => '{field} Wajib di isi',
                    'is_unique' => '{field} Telah digunakan'
                    ]
                ],
                'sekolah' => [
                    'label'  => 'Sekolah',
                    'rules'  => 'required',
            'errors' => [
                'required' => '{field} Wajib di isi'
                ]
            ],
            ]
        );
        // Jika Tidak Tervalidasi, Kembalikan Pesan Error 
        if (!$validate) {
            $response = [
                'error' => [
                    'kelas' => $this->validate->getError('kelas'),
            'sekolah' => $this->validate->getError('sekolah')
            ]
        ];
            }else{
            $sekolah = $this->request->getPost('sekolah');
                $data = [
                    'id'=> $this->request->getPost('id'),
                    'sekolah_id'=> $sekolah,
                    'kelas'=> $kelas
            ];
            $this->kelasM->save($data);
            $response = [
                'status'=> 201,
                'sekolah_id'=> $sekolah,
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
            $this->kelasM->delete($id);
            $response = [
                'status'=> 201,
                'msg' => 'Data Dihapus'
            ];
            echo json_encode($response);
        }
    }
}
