<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UsuarioModel;

class Usuario extends BaseController
{
    private $usuarioModel;
    
    public function __construct()
    {
        $this->usuarioModel = new UsuarioModel();
    }

    public function index()
    {
        $tipousuario = UsuarioModel::TIPOUSUARIO;
        $dados = $this->usuarioModel->findAll();
        echo view('_partials/header');
        echo view('_partials/navbar');
        echo view('usuario/index.php', ['listaUsuarios' => $dados, 'tipousuario' => $tipousuario]);
        echo view('_partials/footer');
    }

    public function editar($id)
    {
        $dados = $this->usuarioModel->find($id);
        $tipousuario = UsuarioModel::TIPOUSUARIO;
        echo view('_partials/header');
        echo view('_partials/navbar');
        echo view('usuario/edit', ['usuario' => $dados, 'tipousuario' => $tipousuario]);
        echo view('_partials/footer');
    }

    public function senha($id)
    {
        $dados = $this->usuarioModel->find($id);
        echo view('_partials/header');
        echo view('_partials/navbar');
        echo view('usuario/senha', ['usuario' => $dados]);
        echo view('_partials/footer');
    }

    public function cadastrar()
    {
        $usuario = $this->request->getPost();
        // Tenta salvar o usuário e exibe mensagem de sucesso ou erro
        if ($this->usuarioModel->save($usuario)) {
            session()->setFlashdata('success', 'Usuário cadastrado com sucesso.');
        } else {
            session()->setFlashdata('error', 'Erro ao cadastrar o usuário.');
        }
        return redirect()->to(previous_url());
    }

    public function salvar()
    {
        $usuario = $this->request->getPost();
        // Tenta salvar o usuário e exibe mensagem de sucesso ou erro
        if ($this->usuarioModel->save($usuario)) {
            session()->setFlashdata('success', 'Usuário atualizado com sucesso.');
        } else {
            session()->setFlashdata('error', 'Erro ao atualizar o usuário.');
        }
        return redirect()->to('Usuario/index');
    }

    public function salvarsenha()
    {
        $usuario = $this->request->getPost();
        // Tenta salvar a nova senha do usuário e exibe mensagem de sucesso ou erro
        if ($this->usuarioModel->save($usuario)) {
            session()->setFlashdata('success', 'Senha atualizada com sucesso.');
        } else {
            session()->setFlashdata('error', 'Erro ao atualizar a senha.');
        }
        return redirect()->to('Usuario/index');
    }

    public function excluir()
    {
        $usuario = $this->request->getPost();
        // Tenta excluir o usuário e exibe mensagem de sucesso ou erro
        if ($this->usuarioModel->delete($usuario)) {
            session()->setFlashdata('error', 'Usuário excluído com sucesso.');
        } else {
            session()->setFlashdata('error', 'Erro ao excluir o usuário.');
        }
        return redirect()->to('Usuario/index');
    }

}