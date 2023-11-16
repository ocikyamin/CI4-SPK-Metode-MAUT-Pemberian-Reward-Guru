<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KriteriaModel;
use App\Models\SubKriteriaModel;

class Kriteria extends BaseController
{
    protected $helpers = ['login'];
    function __construct()
    {
        $this->kriteriaM = new KriteriaModel;
        $this->subKriteriaM = new SubKriteriaModel;
    }
    public function index()
    {
        $data = ['title'=> 'Kriteria'];
        return view('Admin/Kriteria/index', $data);
    }

    public function ListKriteria()
    {
        if ($this->request->isAJAX()) {
           $data = ['kriteria'=> $this->kriteriaM->findAll()];
           $view =['list_kriteria'=> view('Admin/Kriteria/Table', $data)];
           echo json_encode($view);
        }
    }
    
    
    public function NewKriteria()
    {
        if ($this->request->isAJAX()) {
            $view =['form_kriteria'=> view('Admin/Kriteria/New')];
            echo json_encode($view);
        }
    }
    public function SaveKriteria()
    {
        if ($this->request->isAJAX()) {
            // Pangil Service Validation 
            $this->validate= \Config\Services::validation();
            // Deklarasi Validasi Login 
            $validate = $this->validate(
                [
            'kode' => [
                'label'  => 'Kode',
                'rules'  => 'required|is_unique[kriteria.kode]',
                'errors' => [
                    'required' => '{field} Wajib di isi',
                    'is_unique' => '{field} Telah digunakan'
                    ]
                ],
                'kriteria' => [
                    'label'  => 'Nama Kriteria',
                    'rules'  => 'required',
            'errors' => [
                'required' => '{field} Wajib di isi'
                ]
            ],
            'bobot' => [
            'label'  => 'Bobot',
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
                    'kode' => $this->validate->getError('kode'),
            'kriteria' => $this->validate->getError('kriteria'),
            'bobot' => $this->validate->getError('bobot')
            ]
        ];
            }else{
            
                $data = [
                    'kode'=> $this->request->getPost('kode'),
                    'kriteria'=> $this->request->getPost('kriteria'),
                'bobot'=> $this->request->getPost('bobot')
            ];
            $this->kriteriaM->save($data);
            $response = [
                'status'=> 201,
                'msg' => 'Data Berhasil disimpan'
                
            ];
        }
           echo json_encode($response);
        }
    }
    public function EditKriteria()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $data = ['data'=> $this->kriteriaM->find($id)];
            $view =['form_kriteria'=> view('Admin/Kriteria/Edit', $data)];
            echo json_encode($view);
        }
    }
    public function UpdateKriteria()
    {
        if ($this->request->isAJAX()) {
            $oldkode = $this->request->getPost('oldkode');
            $kode = $this->request->getPost('kode');
            // Pangil Service Validation 
            $this->validate= \Config\Services::validation();
            // Deklarasi Validasi Login 
            $validate = $this->validate(
                [
                    'kode' => [
                    'label'  => 'Kode',
                    'rules'  => $oldkode==$kode ? 'required': 'required|is_unique[kriteria.kode]',
                    'errors' => [
            'required' => '{field} Wajib di isi',
            'is_unique' => '{field} Telah digunakan'
            ]
        ],
        'kriteria' => [
            'label'  => 'Nama Kriteria',
            'rules'  => 'required',
            'errors' => [
                'required' => '{field} Wajib di isi'
                ]
            ],
            'bobot' => [
                'label'  => 'Bobot',
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
            'kode' => $this->validate->getError('kode'),
            'kriteria' => $this->validate->getError('kriteria'),
            'bobot' => $this->validate->getError('bobot')
            ]
        ];
    }else{
        
        $data = [
                'id'=> $this->request->getPost('id'),
                'kode'=> $kode,
                'kriteria'=> $this->request->getPost('kriteria'),
                'bobot'=> $this->request->getPost('bobot')
            ];
            $this->kriteriaM->save($data);
            $response = [
                'status'=> 201,
                'msg' => 'Data Berhasil diperbarui'
                    
            ];
        }
            echo json_encode($response);
        }
    }
    
    public function DeleteKriteria()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $this->kriteriaM->delete($id);
            $response = [
                'status'=> 201,
                'msg' => 'Data Berhasil dihapus.'
                
            ];
            echo json_encode($response);
        }
    }
    
    public function SubKriteria()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $data = [
                'kriteria'=> $this->kriteriaM->find($id)
                
            ];
            $view =['sub_kriteria'=> view('Admin/Kriteria/SubKriteria', $data)];
            echo json_encode($view);
        }
    }
    public function ListSubKriteria()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $data = ['sub_kriteria'=> $this->subKriteriaM->KriteriaByID($id)];
           $view =['list_sub_kriteria'=> view('Admin/Kriteria/TableSubKriteria', $data)];
           echo json_encode($view);
        }
    }
    
    public function SaveSubKriteria()
    {
        if ($this->request->isAJAX()) {
        // Pangil Service Validation 
        $this->validate= \Config\Services::validation();
        // Deklarasi Validasi Login 
        $validate = $this->validate(
        [
        'sub_kriteria' => [
        'label'  => 'Nama Indikator',
        'rules'  => 'required|is_unique[kriteria_sub.sub_kriteria]',
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
        'sub_kriteria' => $this->validate->getError('sub_kriteria')
        ]
        ];
        }else{

        $data = [
        'kriteria_id'=> $this->request->getPost('kriteria_id'),
        'sub_kriteria'=> $this->request->getPost('sub_kriteria')
        ];
        $this->subKriteriaM->save($data);
        $response = [
        'status'=> 201,
        'msg' => 'Data Berhasil disimpan'

        ];
        }
        echo json_encode($response);
        }
        }

        public function EditSubKriteria()
        {
            if ($this->request->isAJAX()) {
                $id = $this->request->getVar('id');
                $data = ['sub'=> $this->subKriteriaM->find($id)];
                $view =['edit_sub_kriteria'=> view('Admin/Kriteria/SubKriteriaEdit', $data)];
           
                echo json_encode($view);
            }

        }





        public function DeleteSubKriteria()
        {
            if ($this->request->isAJAX()) {
                $id = $this->request->getPost('id');
                $this->subKriteriaM->delete($id);
                $response = [
                    'status'=> 201,
                    'msg' => 'Data Berhasil dihapus.'
                    
                ];
                echo json_encode($response);
            }
        }





}