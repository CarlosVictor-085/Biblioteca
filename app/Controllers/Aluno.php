<?php



namespace App\Controllers;


use TCPDF;
use App\Controllers\BaseController;

use CodeIgniter\HTTP\ResponseInterface;

use App\Models\AlunoModel;
use App\Models\EmprestimoModel;
use CodeIgniter\Session\Session;



class Aluno extends BaseController
{

    private $alunoModel;
    private $emprestimoModel;


    public function __construct()
    {

        $this->alunoModel = new AlunoModel();
        $this->emprestimoModel = new EmprestimoModel();
    }



    public function index()
    {

        $dados = $this->alunoModel->findAll();

        $pager = $this->alunoModel->pager;

        echo view('_partials/header');

        echo view('_partials/navbar');

        echo view('aluno/index.php', ['listaAlunos' => $dados, 'pager' => $pager]);

        echo view('_partials/footer');
    }





    public function cadastrar()
    {

        $aluno = $this->request->getPost();

        if ($this->alunoModel->save($aluno)) {

            session()->setFlashdata('success', 'Aluno cadastrado com sucesso.');
        } else {

            session()->setFlashdata('error', 'Erro ao cadastrar aluno.');
        }

        return redirect()->to('Aluno/index');
    }



    public function editar($id)
    {

        $dados = $this->alunoModel->find($id);

        echo view('_partials/header');

        echo view('_partials/navbar');

        echo view('aluno/edit', ['aluno' => $dados]);

        echo view('_partials/footer');
    }



    public function salvar()
    {

        $aluno = $this->request->getPost();

        if ($this->alunoModel->save($aluno)) {

            session()->setFlashdata('success', 'Aluno atualizado com sucesso.');
        } else {

            session()->setFlashdata('error', 'Erro ao atualizar aluno.');
        }

        return redirect()->to('Aluno/index');
    }



    public function excluir()
    {

        $aluno = $this->request->getPost();

        if ($this->alunoModel->delete($aluno)) {

            session()->setFlashdata('error', 'Aluno excluído com sucesso.');
        } else {

            session()->setFlashdata('error', 'Erro ao excluir aluno. Pode ser que haja restrições de chave estrangeira.');
        }

        return redirect()->to('Aluno/index');
    }

    public function gerarRelatorioPDF($id)
    {
        // Limpa qualquer saída de buffer para evitar conflitos
        if (ob_get_length()) ob_end_clean();

        // Busca os empréstimos do aluno com as informações necessárias
        $emprestimos = $this->emprestimoModel
            ->select('e.id AS emprestimo_id, e.data_inicio, e.data_prazo, e.data_fim, 
            a.nome AS nome_aluno, u.nome AS nome_usuario, o.titulo AS nome_obra, 
            l.tombo AS tombo, l.status AS status, l.id AS id_livro')
            ->distinct()
            ->from('emprestimo e') // Definindo a tabela principal e o alias
            ->join('aluno a', 'e.id_aluno = a.id', 'left')
            ->join('usuario u', 'e.id_usuario = u.id', 'left')
            ->join('livro l', 'e.id_livro = l.id', 'left')
            ->join('obra o', 'l.id_obra = o.id', 'left')
            ->where('e.id_aluno', $id) // Filtra pelo id do aluno
            ->orderBy('e.id', 'DESC') // Ordena os resultados
            ->findAll();

        // Contando o total de empréstimos
        $totalEmprestimos = count($emprestimos);

        // Instancia o TCPDF
        $pdf = new TCPDF();

        // Configurações do PDF
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Sistema de Gerenciamento');
        $pdf->SetTitle('Relatório de Empréstimos');
        $pdf->SetMargins(15, 15, 15);
        $pdf->SetAutoPageBreak(true, 15);

        // Adiciona uma página ao PDF
        $pdf->AddPage();

        // Definindo a fonte e o título
        $pdf->SetFont('helvetica', 'B', 16);
        $pdf->Cell(0, 10, 'Relatório de Empréstimos do Aluno', 0, 1, 'C');

        // Adiciona informações do aluno
        $aluno = $this->alunoModel->find($id);
        $pdf->SetFont('helvetica', 'B', 13);
        $pdf->Cell(0, 8, 'Aluno: ' . htmlspecialchars($aluno['nome']), 0, 1, 'L');
        $pdf->Ln(5); // Espaço

        // Verificar se o aluno possui empréstimos
        if (empty($emprestimos)) {
            // Se não houver empréstimos, exibe "Nada consta"
            $pdf->SetFont('helvetica', 'I', 12);
            $pdf->Cell(0, 8, 'Nada consta: Este aluno não possui empréstimos registrados.', 0, 1, 'L');
        } else {

            // Exibe o total de empréstimos
            $pdf->SetFont('helvetica', '', 12);
            $pdf->Cell(0, 8, 'Total de Empréstimos: ' . $totalEmprestimos, 0, 1, 'L');
            $pdf->Ln(5); // Espaço
            // Caso contrário, exibe os empréstimos
            $pdf->SetFont('helvetica', '', 12);
            $pdf->Cell(0, 8, 'Empréstimos Realizados:', 0, 1, 'L');
            $pdf->Ln(5); // Espaço

            // Adiciona a tabela dos empréstimos
            $pdf->SetFont('helvetica', '', 10);

            // Cabeçalho da tabela
            $html = '
        <table border="1" cellpadding="5">
            <tr style="background-color: #cccccc;">
                <th>Nome Obra</th>
                <th>Tombo</th>
                <th>Data Início</th>
                <th>Data Prazo</th>
                <th>Data Entrega</th>
                <th>Nome Usuário</th>
            </tr>';

            // Preenche os dados dos empréstimos
            // Preenche os dados dos empréstimos
            foreach ($emprestimos as $emprestimo) {
                // Cálculo da data de fim com base na data de início e no prazo
                $timestamp_inicio = strtotime($emprestimo['data_inicio']);
                $prazo_em_segundos = $emprestimo['data_prazo'] * 24 * 60 * 60;
                $timestamp_fim = $timestamp_inicio + $prazo_em_segundos;
                $data_fim_formatada = is_null($emprestimo['data_fim'])
                    ? 'Livro não devolvido'
                    : date('d/m/Y', $timestamp_fim);

                // Preenche a linha da tabela com as informações do empréstimo
                $html .= '
            <tr>
            <td>' . htmlspecialchars($emprestimo['nome_obra']) . '</td>
            <td>' . htmlspecialchars($emprestimo['tombo']) . '</td>
                <td>' . date('d/m/Y', $timestamp_inicio) . '</td>
                <td>' . date('d/m/Y', $timestamp_fim) . '</td>
                <td>' . $data_fim_formatada . '</td>
                <td>' . htmlspecialchars($emprestimo['nome_usuario']) . '</td>
            </tr>';
            }

            $html .= '</table>';

            // Escreve o conteúdo no PDF
            $pdf->writeHTML($html, true, false, true, false, '');
        }

        // Definir cabeçalhos para o navegador reconhecer o PDF
        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="relatorio_emprestimos_aluno.pdf"');
        header('Cache-Control: private, max-age=0, must-revalidate');
        header('Pragma: public');

        // Saída do PDF
        $pdf->Output('relatorio_emprestimos_aluno.pdf', 'I');

        // Finaliza a execução para evitar que algum conteúdo seja anexado após o PDF
        exit;
    }
}