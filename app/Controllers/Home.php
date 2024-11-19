<?php

namespace App\Controllers;

use App\Models\LivroModel;
use App\Models\AlunoModel;
use App\Models\EmprestimoModel;
use App\Models\AutorModel; // Adicionando o modelo de Autor
use App\Models\EditoraModel; // Adicionando o modelo de Editora
use App\Models\NoticiaModel;

class Home extends BaseController
{
    protected $livroModel;
    protected $alunoModel;
    protected $emprestimoModel;
    protected $autorModel; // Variável para o modelo de Autor
    protected $editoraModel; // Variável para o modelo de Editora
    protected $noticiaModel;

    public function __construct()
    {
        // Carregar os modelos necessários
        $this->livroModel = new LivroModel();
        $this->alunoModel = new AlunoModel();
        $this->emprestimoModel = new EmprestimoModel();
        $this->autorModel = new AutorModel(); // Inicializando o modelo de Autor
        $this->editoraModel = new EditoraModel(); // Inicializando o modelo de Editora
        $this->noticiaModel = new NoticiaModel();
    }

    // Página inicial com estatísticas e notícias
    public function index()
    {
        // Estatísticas
        $livrosDisponiveis = $this->livroModel->countAllResults();
        $emprestimosDevolvidos = $this->emprestimoModel->where('data_fim IS NOT NULL')->countAllResults();
        $emprestimosNaoDevolvidos = $this->emprestimoModel->where('data_fim IS NULL')->countAllResults(); // Contagem de empréstimos não devolvidos
        $novosAlunos = $this->alunoModel->countAllResults();
        $totalAutores = $this->autorModel->countAllResults(); // Contagem total de autores
        $totalEditoras = $this->editoraModel->countAllResults(); // Contagem total de editoras

        // Notícias (substituindo por dados reais do banco de dados)
        $noticias = $this->noticiaModel->findAll();

        // Carregar as views e passar os dados para a view 'home/index.php'
        echo view('_partials/header');
        echo view('_partials/navbar');
        echo view('home/index.php', [
            'livrosDisponiveis' => $livrosDisponiveis,
            'emprestimosDevolvidos' => $emprestimosDevolvidos,
            'emprestimosNaoDevolvidos' => $emprestimosNaoDevolvidos, // Passando a contagem de empréstimos não devolvidos
            'novosAlunos' => $novosAlunos,
            'noticias' => $noticias,
            'totalAutores' => $totalAutores, // Passando a contagem de autores
            'totalEditoras' => $totalEditoras // Passando a contagem de editoras
        ]);
        echo view('_partials/footer');
    }

    // Salvar a notícia no banco de dados
    public function salvar_noticia()
    {
        // Processamento da imagem
        $imagem = $this->request->getFile('imagem');
        $nomeImagem = '';  // Inicializando a variável para o nome da imagem

        // Verificar se a imagem foi enviada
        if ($imagem && $imagem->isValid() && !$imagem->hasMoved()) {
            // Gerar nome aleatório para a imagem
            $nomeImagem = $imagem->getRandomName();
            // Mover a imagem para a pasta de uploads
            $imagem->move(FCPATH . 'uploads/noticias', $nomeImagem);
        }

        // Inserir dados no banco de dados
        $data = [
            'titulo' => $this->request->getPost('titulo'),
            'descricao' => $this->request->getPost('descricao'),
            'imagem' => $nomeImagem,  // Nome da imagem ou string vazia se não houver imagem
            'link' => $this->request->getPost('link')
        ];

        // Salvar notícia no banco
        if ($this->noticiaModel->insert($data)) {
            session()->setFlashdata('success', 'Notícia adicionada com sucesso.');
            return redirect()->to('Home');
        } else {
            session()->setFlashdata('error', 'Erro ao adicionar notícia.');
            return redirect()->to('Home');
        }
    }

    // Excluir a notícia
    public function excluir_noticia($id)
    {
        // Primeiro, recuperar a notícia para saber o nome da imagem
        $noticia = $this->noticiaModel->find($id);

        // Verificar se a notícia foi encontrada
        if ($noticia) {
            // Deletar a imagem do diretório de uploads se existir
            if ($noticia['imagem'] && file_exists(FCPATH . 'uploads/noticias/' . $noticia['imagem'])) {
                unlink(FCPATH . 'uploads/noticias/' . $noticia['imagem']);
            }

            // Excluir a notícia do banco
            if ($this->noticiaModel->delete($id)) {
                session()->setFlashdata('success', 'Notícia excluída com sucesso.');
            } else {
                session()->setFlashdata('error', 'Erro ao excluir notícia.');
            }
        } else {
            session()->setFlashdata('error', 'Notícia não encontrada.');
        }

        return redirect()->to('Home');
    }
}
