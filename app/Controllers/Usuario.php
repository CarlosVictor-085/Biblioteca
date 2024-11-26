<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UsuarioModel;
use CodeIgniter\Email\Email;

class Usuario extends BaseController
{
    private $usuarioModel;
    protected $validation;

    public function __construct()
    {
        $this->usuarioModel = new UsuarioModel();
        $this->validation = \Config\Services::validation();
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
        // Pegando os dados do formulário
        $usuario = $this->request->getPost();
        $email = $usuario['email'];  // Pegando o e-mail do formulário

        // Verificar se o e-mail já está registrado no banco
        $usuarioExistente = $this->usuarioModel->where('email', $email)->first();

        if ($usuarioExistente) {
            // Se o e-mail já estiver registrado, exibe mensagem de erro
            session()->setFlashdata('error', 'E-mail já registrado. Tente outro e-mail.');
            return redirect()->back()->withInput();
        }

        // Gerar uma senha aleatória
        $senhaGerada = bin2hex(random_bytes(4));  // Gerando uma senha de 8 caracteres (4 bytes)

        // Adicionando a senha gerada ao array de dados
        $usuario['senha'] = $senhaGerada;

        // Tenta salvar o usuário
        if ($this->usuarioModel->save($usuario)) {
            session()->setFlashdata('success', 'Usuário cadastrado com sucesso.');

            // Enviar o email com a senha gerada
            $this->enviarEmailSenha($usuario['email'], $senhaGerada, $usuario['nome']);
        } else {
            session()->setFlashdata('error', 'Erro ao cadastrar o usuário.');
        }

        return redirect()->to(previous_url());
    }


    protected function enviarEmailSenha($email, $senha, $nome)
    {
        $emailService = \Config\Services::email();

        // Configuração do email
        $emailService->setFrom('carlosvictorrodrigues45@gmail.com', 'Biblioteca');
        $emailService->setTo($email);
        $emailService->setSubject('Sua Senha de Acesso');

        // Corpo do email
        $mensagem = "Olá, $nome Sua conta foi criada com sucesso. Abaixo está sua senha de acesso:<br>";
        $mensagem .= "Senha: $senha<br>";
        $mensagem .= "Por favor, faça login e altere sua senha assim que possível.\n\n";
        $mensagem .= "Atenciosamente,\nBiblioteca.";

        $emailService->setMessage($mensagem);

        // Enviar o email
        if ($emailService->send()) {
            //log_message('info', 'Email com senha enviado para: ' . $email);
            session()->setFlashdata('success', 'Email com senha enviado para: ' . $email);
        } else {
            //log_message('error', 'Erro ao enviar email para: ' . $email);
            session()->setFlashdata('error', 'Erro ao enviar email para: ' . $email);
        }
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
        return redirect()->to('Usuario');
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
        return redirect()->to('Usuario');
    }

    public function excluir()
    {
        $id = $this->request->getPost('id'); // Obtém o ID do POST
        if (!$id) {
            throw new \InvalidArgumentException("ID não fornecido.");
        }
    
        // Lógica para excluir o usuário
        if ($this->usuarioModel->delete($id)) {
            session()->setFlashdata('error', 'Usuário excluído com sucesso.');
        } else {
            session()->setFlashdata('error', 'Erro ao excluir o usuário.');
        }
        return redirect()->to('Usuario');
    }

    public function alterarFoto($id)
    {
        // Verificar se a requisição é POST
        if ($this->request->getMethod() === 'post') {
            // Validar imagem
            $image = $this->request->getFile('foto');

            if ($image->isValid() && !$image->hasMoved()) {
                // Buscar o usuário no banco de dados
                $usuario = $this->usuarioModel->find($id);

                if ($usuario) {
                    // Verificar se já existe uma foto cadastrada
                    if (!empty($usuario['foto']) && file_exists(FCPATH . 'uploads/perfil/' . $usuario['foto'])) {
                        // Deletar a foto antiga se existir
                        unlink(FCPATH . 'uploads/perfil/' . $usuario['foto']);
                    }


                    // Gerar um nome único para a nova imagem
                    $newName = $image->getRandomName();
                    // Mover a imagem para a pasta uploads/perfil
                    $image->move(FCPATH . 'uploads/perfil', $newName);

                    // Atualizar o banco com o novo caminho da imagem
                    $usuarioData = [
                        'id' => $id,
                        'foto' => $newName,
                    ];

                    if ($this->usuarioModel->save($usuarioData)) {
                        session()->setFlashdata('success', 'Foto alterada com sucesso!');
                    } else {
                        session()->setFlashdata('error', 'Erro ao alterar a foto.');
                    }
                } else {
                    session()->setFlashdata('error', 'Usuário não encontrado.');
                }
            } else {
                session()->setFlashdata('error', 'Arquivo de imagem inválido.');
            }

            // Redirecionar para a página de perfil ou a URL desejada
            return redirect()->to(base_url('Login/logout'));  // Ajuste para a URL do perfil do usuário
        }
        // Se não for uma requisição POST, apenas exibir a página com o formulário
    }

    public function excluirFoto($id)
    {
        // Buscar o usuário no banco de dados
        $usuario = $this->usuarioModel->find($id);

        if ($usuario) {
            // Verificar se o usuário tem uma foto cadastrada
            if (!empty($usuario['foto']) && file_exists(FCPATH . 'uploads/perfil/' . $usuario['foto'])) {
                // Deletar a foto do diretório
                unlink(FCPATH . 'uploads/perfil/' . $usuario['foto']);
            }

            // Atualizar o campo 'foto' no banco de dados para null ou vazio
            $usuarioData = [
                'id' => $id,
                'foto' => null, // Define como null (ou vazio) para indicar a ausência de foto
            ];

            if ($this->usuarioModel->save($usuarioData)) {
                session()->setFlashdata('success', 'Foto excluída com sucesso!');
            } else {
                session()->setFlashdata('error', 'Erro ao atualizar o registro no banco de dados.');
            }
        } else {
            session()->setFlashdata('error', 'Usuário não encontrado.');
        }

        // Redirecionar para a página de perfil ou outra URL desejada
        return redirect()->to(base_url('Login/logout')); // Ajuste para a URL do perfil ou dashboard
    }
}