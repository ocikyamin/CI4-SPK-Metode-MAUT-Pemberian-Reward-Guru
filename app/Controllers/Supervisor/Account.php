<?php

namespace App\Controllers\Supervisor;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Account extends BaseController
{
    // inlcule helper 
    protected $helpers = ['superv', 'app'];
    public function index()
    {
        $data = ['title' => 'My Account'];
        return view('Supervisor/Account/index', $data);
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
                $userM = new UserModel();
                $data = [
                    'id' => $this->request->getPost('id'),
                    'email' => $email,
                    'full_name' => $this->request->getPost('fullname'),
                ];
                $userM->save($data);


                $response = ['sukses' => 200, 'msg' => 'Informasi Account Diperbarui..'];
            }
            echo json_encode($response);
        }
    }
}
