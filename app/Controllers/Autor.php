<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\AutorModel;

class Autor extends BaseController
{
    private $autorModel;

    public function __construct()
    {
        $this->autorModel = new AutorModel();
    }

    public function index()
    {
        $autor = $this->autorModel->findAll();
        echo view('_partials/header');
        echo view('_partials/navbar');
        echo view('autor/index.php',['listaAutor' => $autor]);
        echo view('_partials/footer');
    }

    public function editar($id)
    {
        $autor = $this->autorModel->find($id);
        echo view('_partials/header');
        echo view('_partials/navbar');
        echo view('autor/edit',['autor' => $autor]);
        echo view('_partials/footer');
    }

    public function cadastrar()
    {
        $autor = $this->request->getPost();
        // Tenta salvar o autor e exibe mensagem de sucesso ou erro
        if ($this->autorModel->save($autor)) {
            session()->setFlashdata('success', 'Autor cadastrado com sucesso.');
        } else {
            session()->setFlashdata('error', 'Erro ao cadastrar o autor.');
        }
        return redirect()->to('Autor');
    }

    public function salvar()
    {
        $autor = $this->request->getPost();
        // Tenta salvar o autor e exibe mensagem de sucesso ou erro
        if ($this->autorModel->save($autor)) {
            session()->setFlashdata('success', 'Autor atualizado com sucesso.');
        } else {
            session()->setFlashdata('error', 'Erro ao atualizar o autor.');
        }
        return redirect()->to('Autor');
    }

    public function excluir()
    {
        $autor = $this->request->getPost();
        // Tenta excluir o autor e exibe mensagem de sucesso ou erro
        if ($this->autorModel->delete($autor)) {
            session()->setFlashdata('error', 'Autor excluído com sucesso.');
        } else {
            session()->setFlashdata('error', 'Erro ao excluir o autor.');
        }
        return redirect()->to('Autor');
    }

}