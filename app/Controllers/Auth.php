<?php

namespace App\Controllers;
// Import Hash Password
use App\Libraries\Hash;
use App\Controllers\BaseController;
use App\Models\UserModel;


class Auth extends BaseController
{
    public function index()
    {
        // var_dump(Hash::make('admin'));
        return view('Auth/index');
        // var_dump(session('SUPERV_SESSION'));
    }


    public function LoginCheck()
    {
        if ($this->request->isAJAX()) {
            // Pangil Service Validation 
            $this->validate= \Config\Services::validation();
            // Deklarasi Validasi Login 
            $validate = $this->validate(
                [
            'email' => [
                'label'  => 'Email',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong'
                    ]
            ],
            'password' => [
                'label'  => 'Password',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong'
                    ]
                ],
                ]
            );
            // Jika Tidak Tervalidasi, Kembalikan Pesan Error 
            if (!$validate) {
                $msg = [
                'error' => [
                'email' => $this->validate->getError('email'),
                'password' => $this->validate->getError('password')
                ]
                ];
    }else{
        // Jika Lolos Validasi 
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

            $userM = new UserModel;    
            // Dapatkan Identitas User 
            $user = $userM->CheckUserEmail($email);
            if ($user) {
                // Jika Email Tersedia, cek kebenaran Password
                $is_valid = Hash::check($password, $user->password);
                if ($is_valid) {
                // Jika Password Benar dan Email Benar, Buat Sesi baru untuk login berdasarkan ID user 
                // Cek jika login sebagai admin
                if ($user->role_user_id == 1 && $user->sekolah_id==NULL) {
                    # Redirect ke halaman admin
                        $new_session = ['ADMIN_SESSION' => $user->user_id];
                        session()->set($new_session);
                        $msg = [
                        'sukses'=> 200,
                        'link'=> base_url('admin')
                        ];
                }else{
                    # Redirect ke halaman penilai
                    $new_session = ['SUPERV_SESSION' => $user->user_id];
                    session()->set($new_session);
                    $msg = [
                    'sukses'=> 200,
                    'link'=> base_url('superv')
                    ];
                }

                }else{
                    $msg = false;
                }
                 
                
                }else{
                // Jika Email Tidak tersedia 
                $msg = [
                'error'=> [
                'email'=> 'Email Tidak Terdaftar.']
                ];
                }
        
            }
            echo json_encode($msg);
        }
    }
}