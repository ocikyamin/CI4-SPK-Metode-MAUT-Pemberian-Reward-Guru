<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    protected $helpers = ['app','login'];

    public function index()
    {
        // dd(UserLogin());

        $data = ['title'=> 'Dashboard'];
        return view('Admin/Dashboard', $data);
    }

    public function Logout()
{
session()->remove('ADMIN_SESSION');
return redirect()->to(base_url('auth'));
}
}
