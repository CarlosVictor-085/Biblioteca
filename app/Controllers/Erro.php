<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Erro extends BaseController
{
    public function index()
    {
        echo view('_partials/header');
        echo view('errors/custom/404');
        echo view('_partials/footer');
    }
}
