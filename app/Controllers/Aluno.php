<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\AlunoModel;
use CodeIgniter\Session\Session;

class Aluno extends BaseController{   
    private $alunoModel;
    
    public function __construct(){
        $this->alunoModel = new AlunoModel();
    }
    
    public function index(){
        $dados = $this->alunoModel->findAll();
        $pager = $this->alunoModel->pager;
        echo view('_partials/header');
        echo view('_partials/navbar');
        echo view('aluno/index.php',['listaAlunos' => $dados,'pager' => $pager]);
        echo view('_partials/footer');
    }


    public function cadastrar() {
        $aluno = $this->request->getPost();
        if ($this->alunoModel->save($aluno)) {
            session()->setFlashdata('success', 'Aluno cadastrado com sucesso.');
        } else {
            session()->setFlashdata('error', 'Erro ao cadastrar aluno.');
        }
        return redirect()->to('Aluno/index');
    }

    public function editar($id){
        $dados = $this->alunoModel->find($id);
        echo view('_partials/header');
        echo view('_partials/navbar');
        echo view('aluno/edit',['aluno' => $dados]);
        echo view('_partials/footer');

    }

    public function salvar() {
        $aluno = $this->request->getPost();
        if ($this->alunoModel->save($aluno)) {
            session()->setFlashdata('success', 'Aluno atualizado com sucesso.');
        } else {
            session()->setFlashdata('error', 'Erro ao atualizar aluno.');
        }
        return redirect()->to('Aluno/index');
    }

    public function excluir() {
        $aluno = $this->request->getPost();
        if ($this->alunoModel->delete($aluno)) {
            session()->setFlashdata('error', 'Aluno excluído com sucesso.');
        } else {
            session()->setFlashdata('error', 'Erro ao excluir aluno. Pode ser que haja restrições de chave estrangeira.');
        }
        return redirect()->to('Aluno/index');
    }
    
}