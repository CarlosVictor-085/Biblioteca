<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Email\Email;

class Suporte extends BaseController
{
    public function index()
    {
        echo view('_partials/header');
        echo view('_partials/navbar');
        echo view('suporte/index.php');
        echo view('_partials/footer');
    }

    public function enviar()
    {
        $nome = $this->request->getPost('nome');
        $email = $this->request->getPost('email');
        $assunto = $this->request->getPost('assunto');
        $mensagem = $this->request->getPost('mensagem');

        $emailService = \Config\Services::email();
        $emailService->setFrom($email, 'Suporte');
        $emailService->setTo('carlosvictorrodrigues45@gmail.com');
        $emailService->setReplyTo($email, $nome);
        $emailService->setSubject($assunto);
        $emailService->setMessage("Nome: $nome<br>Email: $email<br>Mensagem:<br>$mensagem");


        if ($emailService->send()) {
            session()->setFlashdata('success', 'Mensagem enviada com sucesso!');
        } else {
            session()->setFlashdata('error', 'Erro ao enviar a mensagem.');
            //log_message('error', $emailService->printDebugger(['headers']));
        }
        return redirect()->to('Suporte/index');
    }
}