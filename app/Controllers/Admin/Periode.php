<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PeriodeModel;

class Periode extends BaseController
{
    protected $helpers = ['login'];
    function __construct()
    {
        $this->periodeM = new PeriodeModel;
    }
    public function index()
    {
        $data = ['title'=> 'Periode'];
        return view('Admin/Periode/index', $data);
    }
    public function Show()
    {
        if ($this->request->isAJAX()) {
           $data = ['periode'=> $this->periodeM->findAll()];
           $view =['list_periode'=> view('Admin/Periode/Table', $data)];
           echo json_encode($view);
        }
    }

    public function New()
    {
        if ($this->request->isAJAX()) {
            $view =['form_periode'=> view('Admin/Periode/New')];
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
            'periode' => [
                'label'  => 'Periode',
                'rules'  => 'required|is_unique[periode.periode]',
                'errors' => [
                    'required' => '{field} Wajib di isi',
                    'is_unique' => '{field} Telah digunakan'
                    ]
                ],
                'tahun' => [
                    'label'  => 'Tahun Akademik',
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
                    'periode' => $this->validate->getError('periode'),
            'tahun' => $this->validate->getError('tahun')
            ]
        ];
            }else{
            
                $data = [
                    'periode'=> $this->request->getPost('periode'),
                    'tahun_akademik'=> $this->request->getPost('tahun')
            ];
            $this->periodeM->save($data);
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
            $data = ['periode'=> $this->periodeM->find($id)];
            $view =['form_periode'=> view('Admin/Periode/Edit', $data)];
            echo json_encode($view);
        }
    }
    public function Update()
    {
        if ($this->request->isAJAX()) {
            // Pangil Service Validation 
            $this->validate= \Config\Services::validation();
            $periode = $this->request->getPost('periode');
            $periode_old = $this->request->getPost('periode_old');
            // Deklarasi Validasi  
            $validate = $this->validate(
                [
            'periode' => [
                'label'  => 'Periode',
                'rules'  => $periode==$periode_old ? 'required':'required|is_unique[periode.periode]',
                'errors' => [
                    'required' => '{field} Wajib di isi',
                    'is_unique' => '{field} Telah digunakan'
                    ]
                ],
                'tahun' => [
                    'label'  => 'Tahun Akademik',
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
                    'periode' => $this->validate->getError('periode'),
            'tahun' => $this->validate->getError('tahun')
            ]
        ];
            }else{
            
                $data = [
                    'id'=> $this->request->getPost('id'),
                    'periode'=> $periode,
                    'tahun_akademik'=> $this->request->getPost('tahun')
            ];
            $this->periodeM->save($data);
            $response = [
                'status'=> 201,
                'msg' => 'Data Berhasil diperbarui'
                
            ];
        }
           echo json_encode($response);
        }
    }
    public function Status()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $periode = $this->periodeM->find($id);
            $status = $periode['is_active'];
            $data = [
                'id'=> $id,
                'is_active'=> $status==1 ? 0 : 1
            ];

            $this->periodeM->save($data);
            $response = [
                'status'=> 201,
                'msg' => 'Status diperbarui'
            ];
            echo json_encode($response);
        }
    }
    public function Delete()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $this->periodeM->delete($id);
            $response = [
                'status'=> 201,
                'msg' => 'Data Dihapus'
            ];
            echo json_encode($response);
        }
    }
}
