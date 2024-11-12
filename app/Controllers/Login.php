<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\UsuarioModel;

class Login extends Controller
{
    protected $session;
    protected $usuarioModel;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->usuarioModel = new UsuarioModel();
    }

    public function index()
    {
        echo view('_partials/header');
        echo view('loguin/index');
        echo view('_partials/footer');
        // Verificar se o usuário já está logado
        if ($this->session->has('logged_in')) {
            return redirect()->to(base_url('Home/index'));
        }
    }

    public function authenticate()
    {
        // Obter os dados do formulário
        $email = $this->request->getPost('email');
        $senha = $this->request->getPost('senha');
        // Verificar se os campos estão vazios
        if (empty($email) || empty($senha)) {
            session()->setFlashdata('error', 'Preencha todos os campos!');
            return redirect()->back()->withInput();
        }
        // Buscar o usuário pelo email
        $usuario = $this->usuarioModel->where('email', $email)->first();
        // Verificar se o usuário existe
        if (!$usuario) {
            session()->setFlashdata('error', 'Email ou Senha não encontrado.');
            return redirect()->back()->withInput();
        }
        // Verificar se a senha está correta
        if (!password_verify($senha, $usuario['senha'])) {
            session()->setFlashdata('error', 'Email ou Senha incorreta.');
            return redirect()->back()->withInput();
        }
        // Autenticação bem-sucedida - criar sessão
        $this->session->set('logged_in', true);
        $this->session->set('email', $email);
        $this->session->set('nome', $usuario['nome']);
        $this->session->set('id', $usuario['id']);
        $this->session->set('tipo_usuario', UsuarioModel::TIPOUSUARIO[$usuario['tipo_usuario']]);
        // Redirecionar para o dashboard
        session()->setFlashdata('success', 'Login realizado com sucesso!');
        return redirect()->to(base_url('Home/index'));
    }

    public function logout()
    {
        // Destruir sessão
        $this->session->destroy();
        // Redirecionar para a página de login
        return redirect()->to(base_url('Login/index'));
    }

}