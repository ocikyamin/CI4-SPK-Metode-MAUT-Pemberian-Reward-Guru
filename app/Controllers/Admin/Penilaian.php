<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Penilaian extends BaseController
{
    protected $helpers = ['login'];
    public function index()
    {
        $data = ['title'=> 'Guru'];
        return view('Admin/Guru/index', $data);
    }
}
