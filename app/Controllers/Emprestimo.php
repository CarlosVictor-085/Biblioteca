<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\EmprestimoModel;
use App\Models\LivroModel;
use App\Models\AlunoModel;
use App\Models\UsuarioModel;
use App\Models\ObraModel;
use TCPDF;

class Emprestimo extends BaseController
{
    private $EmprestimoModel;
    private $livroModel;
    private $alunoModel;
    private $usuarioModel;
    private $obraModel;

    public function __construct()
    {
        $this->EmprestimoModel = new EmprestimoModel();
        $this->livroModel = new LivroModel();
        $this->alunoModel = new AlunoModel();
        $this->usuarioModel = new UsuarioModel();
        $this->obraModel = new ObraModel();
    }

    public function index()
    {
        // Construindo a consulta usando QueryBuilder
        $builder = $this->EmprestimoModel->builder();
        // Verifique se a tabela principal e seus aliases estão corretos
        $builder->select('e.id AS emprestimo_id, e.data_inicio, e.data_prazo, e.data_fim, 
                       a.nome AS nome_aluno, u.nome AS nome_usuario, o.titulo AS nome_obra, l.tombo AS tombo, l.status AS status, l.id AS id_livro')
            ->distinct()
            ->from('emprestimo e') // Definindo a tabela principal e o alias
            ->join('aluno a', 'e.id_aluno = a.id', 'left')
            ->join('usuario u', 'e.id_usuario = u.id', 'left')
            ->join('livro l', 'e.id_livro = l.id', 'left')
            ->join('obra o', 'l.id_obra = o.id', 'left')
            ->orderBy('e.id', 'DESC'); // Ordena os resultados
        // Obtendo todos os registros
        $emprestimos = $builder->get()->getResultArray();
        // Processando cada empréstimo para formatar as datas e calcular o estado da devolução
        foreach ($emprestimos as &$emprestimo) {
            // Formatando a data de início
            $data_inicio = explode('-', $emprestimo['data_inicio']);
            $timestamp_inicio = mktime(0, 0, 0, $data_inicio[1], $data_inicio[2], $data_inicio[0]);
            $emprestimo['data_inicio_formatada'] = date('d/m/Y', $timestamp_inicio);
            // Calculando a data de prazo
            $prazo = $emprestimo['data_prazo'] * 24 * 60 * 60; // Convertendo o prazo de dias para segundos
            $timestamp_prazo = $timestamp_inicio + $prazo;
            $emprestimo['data_prazo_formatada'] = date('d/m/Y', $timestamp_prazo);
            // Verificando e formatando a data de fim, se existir
            if (!empty($emprestimo['data_fim'])) {
                $data_fim = explode('-', $emprestimo['data_fim']);
                $timestamp_fim = mktime(0, 0, 0, $data_fim[1], $data_fim[2], $data_fim[0]);
                $emprestimo['data_fim_formatada'] = date('d/m/Y', $timestamp_fim);
            } else {
                $emprestimo['data_fim_formatada'] = 'Não definida';
            }
            // Verifica se o status do livro é igual a 3 (Livro perdido)
            if ($emprestimo['status'] == 3) {
                $emprestimo['status_devolucao'] = "Livro perdido";
                // Define a data de fim como a data atual se estiver vazia
                if (empty($emprestimo['data_fim'])) {
                    $emprestimo['data_fim'] = date('Y-m-d'); // Define a data atual
                    $emprestimo['data_fim_formatada'] = date('d/m/Y'); // Formata a data de fim como a data atual
                }
            } else {
                // Calculando se a devolução está no prazo ou fora do prazo, caso exista data de fim
                if (!empty($emprestimo['data_fim'])) {
                    if ($timestamp_fim - $timestamp_prazo <= 0) {
                        $emprestimo['status_devolucao'] = "Devolução no prazo";
                    } else {
                        $emprestimo['status_devolucao'] = "Devolução fora do prazo";
                    }
                } else {
                    $emprestimo['status_devolucao'] = "Aguardando devolução";
                }
            }
        }
        //dd($emprestimos);
        $livro = $this->livroModel->findAll();
        $dadosobra = $this->obraModel->findAll();
        $aluno = $this->alunoModel->findAll();
        $usuario = $this->usuarioModel->findAll();
        echo view('_partials/header');
        echo view('_partials/navbar');
        echo view('emprestimo/index.php', [
            'listaEmprestimo' => $emprestimos,
            'listaLivro' => $livro,
            'listaAluno' => $aluno,
            'listaUsuario' => $usuario,
            'listaObra' => $dadosobra,
        ]);
        echo view('_partials/footer');
    }

    public function editar($id)
    {
        // Recupera o empréstimo específico pelo ID
        $dados = $this->EmprestimoModel->find($id);
        // Processa a data de início
        if ($dados) {
            $data_inicio = $dados['data_inicio'];
            $data_inicio = explode('-', $data_inicio);
            $data_inicio = mktime(0, 0, 0, $data_inicio[1], $data_inicio[2], $data_inicio[0]);
            $dados['data_inicio_formatada'] = date('Y-m-d', $data_inicio); // Formato correto para o input type=date
        } else {
            $dados['data_inicio_formatada'] = ''; // Defina como vazio se não houver dados
        }
        //dd($dados);
        $dadosaluno = $this->alunoModel->findAll();
        $dadosobra = $this->obraModel->findAll();
        $dadosusuario = $this->usuarioModel->findAll();
        $dadoslivro = $this->livroModel->findAll();
        echo view('_partials/header');
        echo view('_partials/navbar');
        echo view('emprestimo/edit', ['emprestimo' => $dados, 'listaAluno' => $dadosaluno, 'listaLivro' => $dadoslivro, 'listaUsuario' => $dadosusuario, 'listaObra' => $dadosobra]);
        echo view('_partials/footer');
    }

    public function devolucao($id)
    {
        $emprestimo = $this->EmprestimoModel->find($id);
        $dadosobra = $this->obraModel->findAll();
        $livro = $this->livroModel->findAll();
        echo view('_partials/header');
        echo view('_partials/navbar');
        echo view('devolucao/index.php', ['emprestimo' => $emprestimo, 'listaLivro' => $livro, 'listaObra' => $dadosobra]);
        echo view('_partials/footer');
    }

    public function cadastrar()
    {
        $dados = $this->request->getPost();
        // Tenta salvar o empréstimo
        if ($this->EmprestimoModel->save($dados)) {
            $this->livroModel->update($dados['id_livro'], ['disponivel' => 0]);
            session()->setFlashdata('success', 'Empréstimo cadastrado com sucesso.');
        } else {
            session()->setFlashdata('error', 'Erro ao cadastrar o empréstimo.');
        }
        return redirect()->to('emprestimo/index');
    }

    public function salvar()
    {
        $dados = $this->request->getPost();
        // Tenta salvar o empréstimo
        if ($this->EmprestimoModel->save($dados)) {
            $this->livroModel->update($dados['id_livro_antigo'], ['disponivel' => 1]);
            $this->livroModel->update($dados['id_livro'], ['disponivel' => 0]);
            session()->setFlashdata('success', 'Empréstimo atualizado com sucesso.');
        } else {
            session()->setFlashdata('error', 'Erro ao atualizar o empréstimo.');
        }
        return redirect()->to('emprestimo/index');
    }

    public function salvardev()
    {
        $dados = $this->request->getPost();
        // Tenta salvar a devolução
        if ($this->EmprestimoModel->save($dados)) {
            $this->livroModel->update($dados['id_livro'], ['disponivel' => 1]);
            session()->setFlashdata('success', 'Devolução registrada com sucesso.');
        } else {
            session()->setFlashdata('error', 'Erro ao registrar a devolução.');
        }
        return redirect()->to('emprestimo/index');
    }

    public function excluir()
    {
        $dados = $this->request->getPost();
        // Debug para verificar os dados recebidos
        //dd($dados);
        // Verifica se o ID do empréstimo está definido e exclui o empréstimo
        if (!empty($dados['id'])) {
            // Tenta excluir o empréstimo
            if ($this->EmprestimoModel->delete($dados['id'])) {
                // Atualiza o status do livro para disponível
                $this->livroModel->update($dados['id_livro'], ['disponivel' => 1]);
                session()->setFlashdata('error', 'Empréstimo excluído com sucesso.');
            } else {
                session()->setFlashdata('error', 'Erro ao excluir o empréstimo.');
            }
        } else {
            session()->setFlashdata('error', 'ID do empréstimo não fornecido.');
        }
        return redirect()->to('Emprestimo/index');
    }

    public function relatorioPendencias()
    {
        // Consulta para obter empréstimos pendentes (data_fim nula)
        $builder = $this->EmprestimoModel->builder();
        $builder->select('e.id AS emprestimo_id, e.data_inicio, e.data_prazo, 
                          a.nome AS nome_aluno, a.telefone, a.turma,a.cpf AS aluno_cpf, 
                          o.titulo AS nome_obra, l.id AS id_livro')
            ->distinct() // Impede duplicações
            ->from('emprestimo e')
            ->join('aluno a', 'e.id_aluno = a.id', 'left')
            ->join('livro l', 'e.id_livro = l.id', 'left')
            ->join('obra o', 'l.id_obra = o.id', 'left')
            ->where('e.data_fim IS NULL') // Filtra por empréstimos sem data de devolução
            ->orderBy('e.data_inicio', 'ASC');

        // Obtém todos os registros que correspondem ao filtro
        $emprestimos = $builder->get()->getResultArray();

        // Controle de duplicação de obras
        $obrasExibidas = [];

        // Inicia TCPDF
        $pdf = new TCPDF();
        $pdf->AddPage();
        $pdf->SetFont('helvetica', '', 10);

        // Conteúdo HTML para o relatório
        $html = '<h2>Relatório de Pendências de Empréstimos</h2>';
        $html .= '<table border="1" cellpadding="5">
                    <thead>
                        <tr style="background-color: #cccccc;">
                            <th>Aluno</th>
                            <th>Telefone</th>
                            <th>Turma</th>
                            <th>CPF</th>
                            <th>Obra</th>
                            <th>Data de Início</th>
                            <th>Data de Prazo</th>
                        </tr>
                    </thead>
                    <tbody>';

        foreach ($emprestimos as $emprestimo) {
            // Controle para evitar duplicação
            if (in_array($emprestimo['id_livro'], $obrasExibidas)) {
                continue; // Pula para o próximo se a obra já foi exibida
            }

            // Marca o livro como exibido
            $obrasExibidas[] = $emprestimo['id_livro'];

            // Formata as datas
            $data_inicio = date('d/m/Y', strtotime($emprestimo['data_inicio']));
            $prazo_segundos = $emprestimo['data_prazo'] * 24 * 60 * 60; // Converte o prazo em segundos
            $timestamp_prazo = strtotime($emprestimo['data_inicio']) + $prazo_segundos;
            $data_prazo = date('d/m/Y', $timestamp_prazo);

            // Linha da tabela com os dados
            $html .= "<tr>
                        <td>{$emprestimo['nome_aluno']}</td>
                        <td>{$emprestimo['telefone']}</td>
                        <td>{$emprestimo['turma']}</td>
                        <td>{$emprestimo['aluno_cpf']}</td>
                        <td>{$emprestimo['nome_obra']}</td>
                        <td>{$data_inicio}</td>
                        <td>{$data_prazo}</td>
                      </tr>";
        }

        $html .= '</tbody></table>';

        // Adiciona o conteúdo HTML ao PDF
        $pdf->writeHTML($html, true, false, true, false, '');

        // Configuração dos headers do PDF
        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="relatorio_pendencias_emprestimos.pdf"');
        header('Cache-Control: private, max-age=0, must-revalidate');
        header('Pragma: public');

        // Gera o PDF para o navegador
        $pdf->Output('relatorio_pendencias_emprestimos.pdf', 'I');

        exit;
    }

    public function relatorioDevolvidos()
    {
        // Consulta para obter empréstimos devolvidos (com data_fim não nula)
        $builder = $this->EmprestimoModel->builder();
        $builder->select('e.id AS emprestimo_id, e.data_inicio, e.data_fim, e.data_prazo,
                      a.nome AS nome_aluno, a.telefone, a.turma, a.cpf AS aluno_cpf,
                      o.titulo AS nome_obra, l.id AS id_livro')
            ->distinct() // Impede duplicações
            ->from('emprestimo e')
            ->join('aluno a', 'e.id_aluno = a.id', 'left')
            ->join('livro l', 'e.id_livro = l.id', 'left')
            ->join('obra o', 'l.id_obra = o.id', 'left')
            ->where('e.data_fim IS NOT NULL') // Filtra por empréstimos com data de devolução
            ->orderBy('e.data_inicio', 'ASC');

        // Obtém todos os registros que correspondem ao filtro
        $emprestimos = $builder->get()->getResultArray();

        // Inicia TCPDF
        $pdf = new TCPDF();
        $pdf->AddPage();
        $pdf->SetFont('helvetica', '', 10);

        // Conteúdo HTML para o relatório
        $html = '<h2>Relatório de Empréstimos Devolvidos</h2>';
        $html .= '<table border="1" cellpadding="5">
                <thead>
                    <tr style="background-color: #cccccc;">
                        <th>Aluno</th>
                        <th>Telefone</th>
                        <th>Turma</th>
                        <th>CPF</th>
                        <th>Obra</th>
                        <th>Data de Início</th>
                        <th>Data de Prazo</th>
                        <th>Data de Devolução</th>
                    </tr>
                </thead>
                <tbody>';

        foreach ($emprestimos as $emprestimo) {
            // Formata as datas
            $data_inicio = date('d/m/Y', strtotime($emprestimo['data_inicio']));
            $data_fim = date('d/m/Y', strtotime($emprestimo['data_fim']));

            $prazo_segundos = $emprestimo['data_prazo'] * 24 * 60 * 60; // Converte o prazo em segundos
            $timestamp_prazo = strtotime($emprestimo['data_inicio']) + $prazo_segundos;
            $data_prazo = date('d/m/Y', $timestamp_prazo);

            // Linha da tabela com os dados formatados
            $html .= "<tr>
                    <td>{$emprestimo['nome_aluno']}</td>
                    <td>{$emprestimo['telefone']}</td>
                    <td>{$emprestimo['turma']}</td>
                    <td>{$emprestimo['aluno_cpf']}</td>
                    <td>{$emprestimo['nome_obra']}</td>
                    <td>{$data_inicio}</td>
                    <td>{$data_prazo}</td>
                    <td>{$data_fim}</td>
                  </tr>";
        }

        $html .= '</tbody></table>';

        // Adiciona o conteúdo HTML ao PDF
        $pdf->writeHTML($html, true, false, true, false, '');

        // Configuração dos headers do PDF
        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="relatorio_devolvidos_emprestimos.pdf"');
        header('Cache-Control: private, max-age=0, must-revalidate');
        header('Pragma: public');

        // Gera o PDF para o navegador
        $pdf->Output('relatorio_devolvidos_emprestimos.pdf', 'I');

        exit;
    }
}