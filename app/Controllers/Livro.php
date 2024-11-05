<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ObraModel;
use App\Models\LivroModel;
use CodeIgniter\Session\Session;

class Livro extends BaseController
{
    private $obraModel;
    private $livroModel;

    public function __construct()
    {
        $this->obraModel = new ObraModel();
        $this->livroModel = new LivroModel();
    }

    public function index()
    {
        // Recupera a lista de livros com os dados da obra
        $livro = $this->livroModel->join('obra', 'livro.id_obra = obra.id')
            ->select('livro.id,livro.disponivel,livro.status,obra.titulo,obra.quantidade,livro.tombo')
            ->findAll();

        $obra = $this->obraModel->findAll(); // Todas as obras

        // Para cada obra, conte o número de livros já cadastrados
        $obraComQuantidadeLivros = [];
        foreach ($obra as $o) {
            $livroCount = $this->livroModel->where('id_obra', $o['id'])->countAllResults();
            $obraComQuantidadeLivros[] = array_merge($o, ['livros_cadastrados' => $livroCount]);
        }

        $statusdisponivel = LivroModel::STATUSLOCADO;
        $status = LivroModel::STATUSLIVRO;
        $pager = $this->livroModel->pager;

        // Passe a lista de obras com a quantidade de livros já cadastrados
        echo view('_partials/header');
        echo view('_partials/navbar');
        echo view('livro/index.php', [
            'listaLivro' => $livro,
            'listaObra' => $obraComQuantidadeLivros,
            'statusdisponivel' => $statusdisponivel,
            'status' => $status,
            'pager' => $pager
        ]);
        echo view('_partials/footer');
    }

    public function editar($id)
    {
        $statusdisponivel = LivroModel::STATUSLOCADO;
        $status = LivroModel::STATUSLIVRO;
        $livro = $this->livroModel->join('obra', 'livro.id_obra = obra.id')
            ->select('livro.id,livro.disponivel,livro.status,livro.id_obra,livro.tombo,obra.titulo')->find($id);
        //$livro = $this->livroModel->find($id);
        //dd($livro);
        $obra = $this->obraModel->findAll();
        echo view('_partials/header');
        echo view('_partials/navbar');
        echo view('livro/edit', ['obra' => $obra, 'livro' => $livro, 'statusdisponivel' => $statusdisponivel, 'status' => $status]);
        echo view('_partials/footer');
    }


    public function cadastrar()
    {
        $livro = $this->request->getPost();

        $dataLivro = [
            'id_obra' => $livro['id_obra'],
            'tombo' => $livro['tombo'],
            'disponivel' => 1,  // Disponibilidade
            'status' => 1       // Status
        ];
        // Tenta cadastrar o livro e exibe mensagem de sucesso ou erro
        if ($this->livroModel->save($dataLivro)) {
            session()->setFlashdata('success', 'Livro cadastrado com sucesso.');
        } else {
            session()->setFlashdata('error', 'Erro ao cadastrar o livro.');
        }

        return redirect()->to('Livro/index');
    }

    public function salvar()
    {
        $livro = $this->request->getPost();

        // Tenta atualizar o livro e exibe mensagem de sucesso ou erro
        if ($this->livroModel->save($livro)) {
            session()->setFlashdata('success', 'Livro atualizado com sucesso.');
        } else {
            session()->setFlashdata('error', 'Erro ao atualizar o livro.');
        }

        return redirect()->to('Livro/index');
    }

    public function excluir()
    {
        $livro = $this->request->getPost();

        // Tenta excluir o livro e exibe mensagem de sucesso ou erro
        if ($this->livroModel->delete($livro)) {
            session()->setFlashdata('success', 'Livro excluído com sucesso.');
        } else {
            session()->setFlashdata('error', 'Erro ao excluir o livro.');
        }
        return redirect()->to('Livro/index');
    }
}