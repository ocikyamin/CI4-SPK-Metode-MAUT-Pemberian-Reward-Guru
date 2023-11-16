<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\Hash;
use App\Models\UserModel;

class Account extends BaseController
{
    protected $helpers = ['login'];
    function __construct()
    {
        $this->userM = new UserModel();
    }
    public function index()
    {
        // dd(Hash::check('tes', UserLogin()->password));
        $data = ['title'=> 'My Account'];
        return view('Admin/Account/index', $data);
    }

    public function Update()
    {
        if ($this->request->isAJAX()) {

            $this->validate = \Config\Services::validation();
            $email = $this->request->getPost('email');
            $old_email = $this->request->getPost('old_email');
            // Deklarasi Validasi  
            $validate = $this->validate(
                [
                    'email' => [
                        'label'  => 'Email',
                        'rules'  => $email == $old_email ? 'required' : 'required|is_unique[users.email]',
                        'errors' => [
                            'required' => '{field} Wajib di isi',
                            'is_unique' => '{field} Telah digunakan'
                        ]
                    ],
                    'fullname' => [
                        'label'  => 'Full Name',
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
                        'fullname' => $this->validate->getError('fullname')
                    ]
                ];
            } else {
               
                $data = [
                    'id' => $this->request->getPost('id'),
                    'email' => $email,
                    'full_name' => $this->request->getPost('fullname'),
                ];
                $this->userM->save($data);


                $response = ['sukses' => 200, 'msg' => 'Informasi Account Diperbarui..'];
            }
            echo json_encode($response);
        }
    }

    public function FormPassword()
    {
       if ($this->request->isAJAX()) {
        $response = ['form_pwd'=> view('Admin/Account/Password')];
        echo json_encode($response);
       }
    }

    public function ChangePassword()
    {
        if ($this->request->isAJAX()) {
            // Pangil Service Validation 
            $this->validate = \Config\Services::validation();
            // Deklarasi Validasi  
            $validate = $this->validate(
                [
                    'oldpass' => [
                        'label'  => 'Password Lama',
                        'rules'  => 'required',
                        'errors' => [
                            'required' => '{field} Wajib diisi'
                        ]
                    ],
                    
                    'newpass' => [
                        'label'  => 'Password Baru',
                        'rules'  => 'required',
                        'errors' => [
                            'required' => '{field} Wajib diisi'
                        ]
                    ],
                    'confpass' => [
                        'label'  => 'Konfirmasi Password',
                        'rules'  => 'required|matches[newpass]',
                        'errors' => [
                            'required' => '{field} Wajib diisi',
                            'matches' => '{field} Tidak Cocok'
                        ]
                    ],
                 
                ]
            );
            // Jika Tidak Tervalidasi, Kembalikan Pesan Error 
            if (!$validate) {
                $response = [
                    'error' => [
                        'oldpass' => $this->validate->getError('oldpass'),
                        'newpass' => $this->validate->getError('newpass'),
                        'confpass' => $this->validate->getError('confpass')
                    ]
                ];
            } else {

        $oldd = $this->request->getPost('oldpass');
        if (!Hash::check($oldd, UserLogin()->password)) {
            $response = [
                'error' => [
                    'oldpass' => 'Password Lama Salah'
                ]
            ];
        }else{
            $data = [
                'id' => UserLogin()->user_id,
                'password' => Hash::make($this->request->getPost('confpass')),
              
            ];
            $this->userM->save($data);
    
            $response = [
                'status' => 201,
                'msg' => 'Password diperbarui'
    
            ];
        }

  
   
            }
            echo json_encode($response);
        }
    }
}