<?php



namespace App\Controllers;



use App\Controllers\BaseController;
use App\Models\EmprestimoModel;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\ObraModel;
use App\Models\LivroModel;
use CodeIgniter\Session\Session;



class Livro extends BaseController

{

    private $obraModel;

    private $livroModel;

    private $emprestimoModel;


    public function __construct()

    {

        $this->obraModel = new ObraModel();

        $this->livroModel = new LivroModel();
        
        $this->emprestimoModel = new EmprestimoModel(); 

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

    public function gerarRelatorioPDF($alunoId)
{
    // Limpa qualquer saída de buffer para evitar conflitos
    if (ob_get_length()) ob_end_clean();

    // Recupera os dados do aluno e seus empréstimos
    $aluno = $this->alunoModel->find($alunoId);
    if (!$aluno) {
        return "Aluno não encontrado.";
    }

    $emprestimos = $this->emprestimoModel
        ->select('livro.titulo as livro_titulo, emprestimo.data_inicio, emprestimo.data_fim, emprestimo.status')
        ->join('livro', 'emprestimo.livro_id = livro.id')
        ->where('emprestimo.aluno_id', $alunoId)
        ->findAll();

    // Conta o número total de empréstimos
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

    // Título e informações do aluno
    $pdf->SetFont('helvetica', 'B', 16);
    $pdf->Cell(0, 10, 'Relatório de Empréstimos do Aluno: ' . $aluno['nome'], 0, 1, 'C');

    $pdf->SetFont('helvetica', '', 12);
    $pdf->Cell(0, 10, 'ID do Aluno: ' . $aluno['id'], 0, 1);
    $pdf->Cell(0, 10, 'Total de Empréstimos: ' . $totalEmprestimos, 0, 1);
    $pdf->Ln(5); // Espaçamento

    // Exibe o título para as informações dos empréstimos
    $pdf->SetFont('helvetica', 'B', 14);
    $pdf->Cell(0, 8, 'Informações dos Empréstimos', 0, 1);
    $pdf->Ln(5); // Reduzindo o espaçamento após o título

    // Preenche os dados no formato de tabela
    $pdf->SetFont('helvetica', '', 12); // Fonte padrão para os dados dos empréstimos
    $html = '';

    foreach ($emprestimos as $emp) {
        // Formatar datas
        $dataInicio = date('d/m/Y', strtotime($emp['data_inicio']));
        $dataFim = $emp['data_fim'] ? date('d/m/Y', strtotime($emp['data_fim'])) : "Livro não devolvido";

        // Tabela HTML com os dados dos empréstimos
        $html .= '
        <table cellpadding="5" border="1" cellspacing="0" style="width:100%; border-collapse: collapse;">
            <tr>
                <td><strong>Título do Livro:</strong></td>
                <td>' . htmlspecialchars($emp['livro_titulo']) . '</td>
            </tr>
            <tr>
                <td><strong>Data de Início:</strong></td>
                <td>' . $dataInicio . '</td>
            </tr>
            <tr>
                <td><strong>Data de Fim:</strong></td>
                <td>' . $dataFim . '</td>
            </tr>
            <tr>
                <td><strong>Status:</strong></td>
                <td>' . htmlspecialchars($emp['status']) . '</td>
            </tr>
        </table><br><hr><br>';
    }

    // Escreve o conteúdo no PDF
    $pdf->writeHTML($html, true, false, true, false, '');

    // Definir cabeçalhos para o navegador reconhecer o PDF
    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="relatorio_emprestimos_' . $alunoId . '.pdf"');
    header('Cache-Control: private, max-age=0, must-revalidate');
    header('Pragma: public');

    // Saída do PDF
    $pdf->Output('relatorio_emprestimos_' . $alunoId . '.pdf', 'I');

    // Finaliza a execução para evitar que algum conteúdo seja anexado após o PDF
    exit;
}


}