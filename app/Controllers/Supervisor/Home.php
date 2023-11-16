<?php

namespace App\Controllers\Supervisor;

use App\Controllers\BaseController;

class Home extends BaseController
{
    // inlcule helper 
    protected $helpers = ['superv', 'app'];
    public function index()
    {
        // dd(UserLogin());
        $data = ['title' => 'Home'];
        return view('Supervisor/Home', $data);
    }

    public function Logout()
    {
        session()->remove('SUPERV_SESSION');
        return redirect()->to(base_url('auth'));
    }
}
