<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ObraModel;
use App\Models\EditoraModel;
use App\Models\AutorModel;
use App\Models\AutorObraModel;
use App\Models\LivroModel;
use CodeIgniter\Session\Session;

class Obra extends BaseController
{
    private $obraModel;
    private $editoraModel;
    private $autorModel;
    private $autorObraModel;
    private $livroModel;

    public function __construct()
    {
        $this->editoraModel = new EditoraModel();
        $this->obraModel = new ObraModel();
        $this->autorModel = new AutorModel();
        $this->autorObraModel = new AutorObraModel();
        $this->livroModel = new LivroModel();
    }

    public function index()
    {
        $obra = $this->obraModel->select('obra.id, obra.titulo, obra.categoria, obra.ano_publicacao, obra.isbn, obra.quantidade, editora.nome')
            ->join('editora', 'obra.id_editora = editora.id')
            ->findAll();
        $editora = $this->editoraModel->findAll();
        //dd($obra);
        $autor = $this->autorModel->findAll();
        $dadosAutorObra = $this->autorObraModel->findAll();
        echo view('_partials/header');
        echo view('_partials/navbar');
        echo view('obra/index.php', [
            'listaObra' => $obra,
            'listaEditora' => $editora,
            'listaAutor' => $autor,
            'listaAutorObra' => $dadosAutorObra,
        ]);
        echo view('_partials/footer');
    }

    public function cadastrar()
    {
        $obra = $this->request->getPost();

        // Primeiro cadastra a obra na tabela "obra"
        $this->obraModel->save($obra);
        $id_obra = $this->obraModel->getInsertID(); // Obtém o ID da obra recém-criada

        // Verifica se os tombos foram enviados
        if (isset($obra['tombo']) && is_array($obra['tombo'])) {
            foreach ($obra['tombo'] as $tombo) {
                // Para cada tombo, cria um registro na tabela "livro"
                $dataLivro = [
                    'id_obra' => $id_obra,
                    'tombo' => $tombo,
                    'disponivel' => 1,  // Disponibilidade
                    'status' => 1       // Status
                ];
                $this->livroModel->save($dataLivro); // Salva cada livro com seu tombo
            }
        }

        return redirect()->to('Obra/index')->with('success', 'Obra e livros cadastrados com sucesso!');
    }

    public function editar($id)
    {
        $obra = $this->obraModel
            ->select('obra.id as obra_id, obra.titulo, obra.categoria, obra.ano_publicacao, obra.isbn, obra.quantidade, obra.id_editora, editora.nome, editora.id')
            ->join('editora', 'obra.id_editora = editora.id')
            ->find($id);

        // Obtém os tombos dos livros relacionados a esta obra
        $livrosExistentes = $this->livroModel->where('id_obra', $id)->findAll();
        $tombosExistentes = array_column($livrosExistentes, 'tombo'); // Extrai os tombos existentes

        // Obtém outros dados, como autores e editoras
        $autor = $this->autorModel->findAll();
        $dadosAutorObra = $this->autorObraModel->findAll();
        $editora = $this->editoraModel->findAll();

        // Passa os dados para a view, incluindo os tombos existentes
        echo view('_partials/header');
        echo view('_partials/navbar');
        echo view('obra/edit', [
            'obra' => $obra,
            'editora' => $editora,
            'listaAutor' => $autor,
            'listaAutorObra' => $dadosAutorObra,
            'tombosExistentes' => $tombosExistentes, // Passando os tombos para a view
            'quantidadeExistente' => count($livrosExistentes) // Número de livros já cadastrados
        ]);
        echo view('_partials/footer');
    }


    public function adicionarAutor()
    {
        $autor = $this->request->getPost();
        //dd($obra);
        $this->autorObraModel->save($autor);
        return redirect()->to(previous_url());
    }

    public function salvar()
    {
        $obra = $this->request->getPost();
        $id_obra = $obra['id']; // Presumindo que o ID da obra esteja no array

        // Primeiro, atualiza a obra na tabela "obra"
        $this->obraModel->save($obra);

        // Obtém a quantidade informada pelo usuário
        $quantidadeNova = isset($obra['quantidade']) ? (int)$obra['quantidade'] : 0;

        // Verifica quantos livros já existem para essa obra
        $livrosExistentes = $this->livroModel->where('id_obra', $id_obra)->findAll();
        $quantidadeExistente = count($livrosExistentes);

        // Calcula a quantidade que falta adicionar
        $quantidadeAdicionar = $quantidadeNova - $quantidadeExistente;

        // Obtém os tombos do formulário, se disponíveis
        $tombos = isset($obra['tombo']) ? $obra['tombo'] : [];

        // Verifica se há necessidade de adicionar novos livros
        if ($quantidadeAdicionar > 0 && !empty($tombos)) {
            // Adiciona novos livros
            for ($i = 0; $i < $quantidadeAdicionar; $i++) {
                // Certifique-se de que há tombos suficientes fornecidos pelo usuário
                if (isset($tombos[$i])) {
                    $dataLivro = [
                        'id_obra' => $id_obra,
                        'tombo' => $tombos[$i], // Usa o tombo fornecido pelo usuário
                        'disponivel' => 1,  // Disponibilidade
                        'status' => 1       // Status
                    ];
                    $this->livroModel->save($dataLivro); // Salva cada livro com o tombo fornecido
                }
            }
        } elseif ($quantidadeAdicionar < 0) {
            // Se a quantidade diminuir, remova os livros extras
            $quantidadeRemover = abs($quantidadeAdicionar);

            // Remove livros até que a quantidade desejada seja atendida
            for ($i = 0; $i < $quantidadeRemover; $i++) {
                if (!empty($livrosExistentes)) {
                    // Remove o último livro adicionado para esta obra
                    $livroParaRemover = array_pop($livrosExistentes); // Remove o último livro

                    // Remover o livro do banco de dados
                    $this->livroModel->delete($livroParaRemover['id']); // Presumindo que a chave primária é 'id'
                }
            }
        }

        return redirect()->to('Obra/index')->with('success', 'Obra e livros atualizados com sucesso!');
    }




    public function excluir()
{
    // Obter os dados do POST
    $obraData = $this->request->getPost();
    
    // Supondo que o ID da obra esteja no array $obraData
    $id = $obraData['id']; // ID da obra

    // Buscar os livros associados a esta obra
    $livros = $this->livroModel->where('id_obra', $id)->findAll();

    if (empty($livros)) {
        session()->setFlashdata('error', 'Nenhum livro encontrado para esta obra.');
        return redirect()->to(previous_url());
    }

    try {
        // Excluir os livros vinculados a esta obra
        foreach ($livros as $livro) {
            $this->livroModel->delete($livro['id']); // Presumindo que a chave primária é 'id'
        }
        
        // Excluir a obra
        $this->obraModel->delete($id);
        
        session()->setFlashdata('success', 'Obra e livros excluídos com sucesso!');
    } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
        session()->setFlashdata('error', 'Erro ao excluir a obra e os livros. Você não pode excluir uma obra que está vinculada a uma editora.');
        return redirect()->to(previous_url());
    }

    return redirect()->to(previous_url());
}

    public function excluir_autor()
    {
        $id = $this->request->getPost('id'); // Obter o ID genérico a partir do POST

        try {
            // Verifica se o ID está definido e não é vazio
            if (!$id) {
                throw new \Exception('ID não fornecido.');
            }

            // Chame o modelo para excluir usando o ID genérico (ajuste o modelo conforme necessário)
            if ($this->autorObraModel->delete($id)) {
                session()->setFlashdata('success', 'autor excluído com sucesso!');
            } else {
                session()->setFlashdata('error', 'Erro ao excluir o autor.');
            }
        } catch (\Exception $e) {
            // Em caso de erro, registra a mensagem de erro
            session()->setFlashdata('error', 'Erro ao excluir o registro: ' . $e->getMessage());
        }

        // Redireciona para a página anterior
        return redirect()->to(previous_url());
    }

    public function getAutores($id_obra) {
        $listaAutorObra = $this->autorObraModel->where('id_obra', $id_obra)->findAll();
        
        if (!empty($listaAutorObra)) {
            $autor = [];
            foreach ($listaAutorObra as $lao) {
                $autor[$lao['id_autor']] = $this->autorModel->find($lao['id_autor'])->nome; // Presumindo que 'nome' é um campo no modelo de Autor
            }
            
            foreach ($autor as $nome) {
                echo '<div class="d-flex justify-content-between align-items-center mb-2">';
                echo '<div>' . htmlspecialchars($nome) . '</div>';
                echo '<button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-id="' . $lao['id'] . '">Excluir</button>';
                echo '</div>';
            }
        } else {
            echo '<p>Nenhum autor encontrado para esta obra.</p>';
        }
    }
    
        
    
}