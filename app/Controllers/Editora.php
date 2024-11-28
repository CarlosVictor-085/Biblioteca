<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\EditoraModel;

class Editora extends BaseController
{
    private $editoraModel;

    public function __construct()
    {
        $this->editoraModel = new EditoraModel();
    }

    public function index()
    {
        $editora = $this->editoraModel->findAll();
        echo view('_partials/header');
        echo view('_partials/navbar');
        echo view('editora/index.php', ['listaEditora' => $editora]);
        echo view('_partials/footer');
    }

    public function editar($id)
    {
        $editora = $this->editoraModel->find($id);
        echo view('_partials/header');
        echo view('_partials/navbar');
        echo view('editora/edit', ['editora' => $editora]);
        echo view('_partials/footer');
    }

    public function cadastrar()
    {
        $editora = $this->request->getPost();
        // Tenta salvar a editora e exibe mensagem de sucesso ou erro
        if ($this->editoraModel->save($editora)) {
            session()->setFlashdata('success', 'Editora cadastrada com sucesso.');
        } else {
            session()->setFlashdata('error', 'Erro ao cadastrar a editora.');
        }
        return redirect()->to('Editora');
    }
    
    public function salvar()
    {
        $editora = $this->request->getPost();
        // Tenta salvar a editora e exibe mensagem de sucesso ou erro
        if ($this->editoraModel->save($editora)) {
            session()->setFlashdata('success', 'Editora atualizada com sucesso.');
        } else {
            session()->setFlashdata('error', 'Erro ao atualizar a editora.');
        }
        return redirect()->to('Editora');
    }

    public function excluir()
    {
        $editora = $this->request->getPost();
            // Tenta excluir a editora e exibe mensagem de sucesso ou erro
        if ($this->editoraModel->delete($editora)) {
            session()->setFlashdata('error', 'Editora excluída com sucesso.');
        } else {
            session()->setFlashdata('error', 'Erro ao excluir a editora.');
        }
        return redirect()->to('Editora');
    }

}