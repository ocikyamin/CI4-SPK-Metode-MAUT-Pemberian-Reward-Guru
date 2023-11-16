<?php

namespace App\Controllers\Admin;
// Import Hash Password
use App\Libraries\Hash;
use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\UserAccessModel;

class Users extends BaseController
{
    protected $helpers = ['login','app'];
    function __construct()
    {
        $this->userM = new UserModel;
        $this->UserAccessM = new UserAccessModel;
    }
    public function index()
    {
        $data = ['title' => 'User Settings'];
        return view('Admin/Users/index', $data);
    }
    public function Show()
    {
        if ($this->request->isAJAX()) {
            $data = ['user' => $this->userM->AllUsers()];
            $view = ['list_user' => view('Admin/Users/Table', $data)];
            echo json_encode($view);
        }
    }

    public function New()
    {
        if ($this->request->isAJAX()) {
            $view = ['form_user' => view('Admin/Users/New')];
            echo json_encode($view);
        }
    }
    public function Save()
    {
        if ($this->request->isAJAX()) {
            // Pangil Service Validation 
            $this->validate = \Config\Services::validation();
            // Deklarasi Validasi  
            $validate = $this->validate(
                [
                    'email' => [
                        'label'  => 'Email',
                        'rules'  => 'required|is_unique[users.email]',
                        'errors' => [
                            'required' => '{field} Wajib di isi',
                            'is_unique' => '{field} Telah digunakan'
                        ]
                    ],
                    'fullname' => [
                        'label'  => 'Nama Lengkap',
                        'rules'  => 'required',
                        'errors' => [
                            'required' => '{field} Wajib di isi'
                        ]
                    ],
                    'newpass' => [
                        'label'  => 'Password Baru',
                        'rules'  => 'required',
                        'errors' => [
                            'required' => '{field} Wajib di isi'
                        ]
                    ],
                    'confpass' => [
                        'label'  => 'Konfirmasi Password',
                        'rules'  => 'required|matches[newpass]',
                        'errors' => [
                            'required' => '{field} Wajib di isi',
                            'matches' => '{field} Tidak Cocok'
                        ]
                    ],
                    'role' => [
                        'label'  => 'Hak Akses',
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
                        'email' => $this->validate->getError('email'),
                        'fullname' => $this->validate->getError('fullname'),
                        'newpass' => $this->validate->getError('newpass'),
                        'confpass' => $this->validate->getError('confpass'),
                        'role' => $this->validate->getError('role')
                    ]
                ];
            } else {

                $data = [
                    'email' => $this->request->getPost('email'),
                    'password' => Hash::make($this->request->getPost('confpass')),
                    'full_name' => $this->request->getPost('fullname')
                ];
            
                $this->userM->save($data);
                $user_id = $this->userM->insertID();
                $sekolah_id = $this->request->getPost('sekolah');

                $user_akses = [
                    'user_id'=> $user_id,
                    'role_user_id'=> $this->request->getPost('role'),
                    'sekolah_id'=> $sekolah_id =="" ? null : $sekolah_id
                ];
    
                $this->UserAccessM->save($user_akses);

                $response = [
                    'status' => 201,
                    'msg' => 'User Berhasil Ditambahkan'

                ];
            }
            echo json_encode($response);
        }
    }
    public function Edit()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $data = [
                'user' => $this->userM->find($id),
                'akses' => $this->UserAccessM->where('user_id', $id)->first()
            ];
            $view = ['form_user' => view('Admin/Users/Edit', $data)];
            echo json_encode($view);
        }
    }
    public function Update()
    {
        if ($this->request->isAJAX()) {
        // Pangil Service Validation 
        $this->validate = \Config\Services::validation();
        $old_email = $this->request->getPost('old_email');
        $email = $this->request->getPost('email');
        // Deklarasi Validasi  
        $validate = $this->validate(
            [
                'email' => [
                    'label'  => 'Email',
                    'rules'  => $old_email==$email ? 'required' : 'required|is_unique[users.email]',
                    'errors' => [
                        'required' => '{field} Wajib di isi',
                        'is_unique' => '{field} Telah digunakan'
                    ]
                ],
                'fullname' => [
                    'label'  => 'Nama Lengkap',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => '{field} Wajib di isi'
                    ]
                ],
                'role' => [
                    'label'  => 'Hak Akses',
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
                    'email' => $this->validate->getError('email'),
                    'fullname' => $this->validate->getError('fullname'),
                    'role' => $this->validate->getError('role')
                ]
            ];
        } else {

            $data = [
                'id'=> $this->request->getPost('id'),
                'email' => $this->request->getPost('email'),
                'full_name' => $this->request->getPost('fullname')
            ];
        
            $this->userM->save($data);
            $user_id = $this->userM->insertID();
            $sekolah_id = $this->request->getPost('sekolah');

            $user_akses = [
                'id'=> $this->request->getPost('akses_id'),
                'role_user_id'=> $this->request->getPost('role'),
                'sekolah_id'=> $sekolah_id =="" ? null : $sekolah_id
            ];

            $this->UserAccessM->save($user_akses);

            $response = [
                'status' => 201,
                'msg' => 'User Berhasil Diperbarui'

            ];
        }
        echo json_encode($response);
    }
     
    }
    public function Status()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $periode = $this->userM->find($id);
            $status = $periode['is_active'];
            $data = [
                'id' => $id,
                'is_active' => $status == 1 ? 0 : 1
            ];

            $this->userM->save($data);
            $response = [
                'status' => 201,
                'msg' => 'Status diperbarui'
            ];
            echo json_encode($response);
        }
    }
    public function Delete()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $this->userM->delete($id);
            $response = [
                'status' => 201,
                'msg' => 'Data Dihapus'
            ];
            echo json_encode($response);
        }
    }
}