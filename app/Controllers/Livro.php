<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EmprestimoModel;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ObraModel;
use App\Models\LivroModel;
use TCPDF;

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
        // Passe a lista de obras com a quantidade de livros já cadastrados
        echo view('_partials/header');
        echo view('_partials/navbar');
        echo view('livro/index.php', [
            'listaLivro' => $livro,
            'listaObra' => $obraComQuantidadeLivros,
            'statusdisponivel' => $statusdisponivel,
            'status' => $status
        ]);
        echo view('_partials/footer');
    }

    public function editar($id)
    {
        $statusdisponivel = LivroModel::STATUSLOCADO;
        $status = LivroModel::STATUSLIVRO;
        $livro = $this->livroModel->join('obra', 'livro.id_obra = obra.id')
            ->select('livro.id,livro.disponivel,livro.status,livro.id_obra,livro.tombo,obra.titulo')->find($id);
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
        return redirect()->to('Livro');
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
        return redirect()->to('Livro');
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
        return redirect()->to('Livro');
    }

    public function relatorioLivrosPerdidos()
    {
        // Define o status de livro perdido
        $statusPerdido = LivroModel::PERDIDO;

        // Consulta para obter livros com status "Perdido"
        $builder = $this->livroModel->builder();
        $builder->select('livro.id, livro.tombo, obra.titulo, livro.status')
            ->join('obra', 'livro.id_obra = obra.id', 'left')
            ->where('livro.status', $statusPerdido);

        // Obtém todos os registros que correspondem ao filtro
        $livrosPerdidos = $builder->get()->getResultArray();

        // Inicia TCPDF
        $pdf = new TCPDF();
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Sistema de Gerenciamento');
        $pdf->SetTitle('Relatório de Livros Perdidos');
        $pdf->SetMargins(15, 15, 15);
        $pdf->setPrintHeader(false); // Desativa o cabeçalho (se a linha for do cabeçalho)

        // Adiciona uma página ao PDF
        $pdf->AddPage();

        // Definindo a fonte e o título
        $pdf->SetFont('helvetica', 'B', 16);
        $pdf->Cell(0, 10, 'Relatório de Livros Perdidos', 0, 1, 'C');

        $pdf->Cell(0, 0, '', 'B');
        $pdf->Ln(5); // Espaço

        $pdf->SetFont('helvetica', '', 10);
        $pdf->Ln(5); // Espaço
        // Conteúdo HTML para o relatório

        // Verifica se há registros de livros perdidos
        if (empty($livrosPerdidos)) {
            $html = '<p>Nada consta</p>';
        } else {
            $html = '<table border="1" cellpadding="5">
                    <thead>
                        <tr style="background-color: #cccccc;">
                            <th>Título</th>
                            <th>Tombo</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>';

            foreach ($livrosPerdidos as $livro) {
                // Obtém o status do livro com o texto correspondente
                $statusTexto = LivroModel::STATUSLIVRO[$livro['status']];

                // Linha da tabela com os dados do livro
                $html .= "<tr>
                        <td>{$livro['titulo']}</td>
                        <td>{$livro['tombo']}</td>
                        <td>{$statusTexto}</td>
                      </tr>";
            }

            $html .= '</tbody></table>';
        }

        // Adiciona o conteúdo HTML ao PDF
        $pdf->writeHTML($html, true, false, true, false, '');

        // Configuração dos headers do PDF
        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="relatorio_livros_perdidos.pdf"');
        header('Cache-Control: private, max-age=0, must-revalidate');
        header('Pragma: public');

        // Gera o PDF para o navegador
        $pdf->Output('relatorio_livros_perdidos.pdf', 'I');

        exit;
    }

    public function relatorioLivrosDanificados()
    {
        // Define o status de livro perdido
        $statusDanificado = LivroModel::DANIFICADO;

        // Consulta para obter livros com status "Perdido"
        $builder = $this->livroModel->builder();
        $builder->select('livro.id, livro.tombo, obra.titulo, livro.status')
            ->join('obra', 'livro.id_obra = obra.id', 'left')
            ->where('livro.status', $statusDanificado);

        // Obtém todos os registros que correspondem ao filtro
        $livrosPerdidos = $builder->get()->getResultArray();

        // Inicia TCPDF
        $pdf = new TCPDF();

        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Sistema de Gerenciamento');
        $pdf->SetTitle('Relatório de Livros Danificados');
        $pdf->SetMargins(15, 15, 15);
        $pdf->SetAutoPageBreak(true, 15);
        $pdf->setPrintHeader(false); // Desativa o cabeçalho (se a linha for do cabeçalho)

        // Adiciona uma página ao PDF
        $pdf->AddPage();

        // Definindo a fonte e o título
        $pdf->SetFont('helvetica', 'B', 16);
        $pdf->Cell(0, 10, 'Relatório de Livros Danificados', 0, 1, 'C');

        $pdf->Cell(0, 0, '', 'B');
        $pdf->Ln(5); // Espaço

        $pdf->SetFont('helvetica', '', 10);
        $pdf->Ln(5); // Espaço
        // Conteúdo HTML para o relatório

        // Verifica se há registros de livros perdidos
        if (empty($livrosPerdidos)) {
            $html = '<p>Nada consta</p>';
        } else {
            $html = '<table border="1" cellpadding="5">
                    <thead>
                        <tr style="background-color: #cccccc;">
                            <th>Título</th>
                            <th>Tombo</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>';

            foreach ($livrosPerdidos as $livro) {
                // Obtém o status do livro com o texto correspondente
                $statusTexto = LivroModel::STATUSLIVRO[$livro['status']];

                // Linha da tabela com os dados do livro
                $html .= "<tr>
                        <td>{$livro['titulo']}</td>
                        <td>{$livro['tombo']}</td>
                        <td>{$statusTexto}</td>
                      </tr>";
            }

            $html .= '</tbody></table>';
        }

        // Adiciona o conteúdo HTML ao PDF
        $pdf->writeHTML($html, true, false, true, false, '');

        // Configuração dos headers do PDF
        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="relatorio_livros_perdidos.pdf"');
        header('Cache-Control: private, max-age=0, must-revalidate');
        header('Pragma: public');

        // Gera o PDF para o navegador
        $pdf->Output('relatorio_livros_danificados.pdf', 'I');

        exit;
    }

    public function relatorioLivrosDisponiveis()
    {
        // Define o status de disponibilidade
        $statusDisponivel = LivroModel::DISPONIVEL;

        // Consulta para obter livros com status "Disponível"
        $builder = $this->livroModel->builder();
        $builder->select('livro.id, livro.tombo, obra.titulo, livro.status, livro.disponivel')
            ->join('obra', 'livro.id_obra = obra.id', 'left')
            ->where('livro.status', $statusDisponivel);

        // Obtém todos os registros que correspondem ao filtro
        $livrosDisponiveis = $builder->get()->getResultArray();

        // Inicia TCPDF
        $pdf = new TCPDF();

        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Sistema de Gerenciamento');
        $pdf->SetTitle('Relatório de Livros Disponíveis');
        $pdf->SetMargins(15, 15, 15);
        $pdf->SetAutoPageBreak(true, 15);
        $pdf->setPrintHeader(false); // Desativa o cabeçalho (se a linha for do cabeçalho)

        // Adiciona uma página ao PDF
        $pdf->AddPage();

        // Definindo a fonte e o título
        $pdf->SetFont('helvetica', 'B', 16);
        $pdf->Cell(0, 10, 'Relatório de Livros Disponíveis', 0, 1, 'C');

        $pdf->Cell(0, 0, '', 'B');
        $pdf->Ln(5); // Espaço

        $pdf->SetFont('helvetica', '', 10);
        $pdf->Ln(5); // Espaço

        // Conteúdo HTML para o relatório
        if (empty($livrosDisponiveis)) {
            $html = '<p>Nenhum livro disponível no momento.</p>';
        } else {
            $html = '<table border="1" cellpadding="5">
                <thead>
                    <tr style="background-color: #cccccc;">
                        <th>Título</th>
                        <th>Tombo</th>
                        <th>Status</th>
                        <th>Situação</th>
                    </tr>
                </thead>
                <tbody>';

            foreach ($livrosDisponiveis as $livro) {
                // Obtém o status e condição com os textos correspondentes
                $statusTexto = LivroModel::STATUSLOCADO[$livro['status']];
                $condicaoTexto = LivroModel::STATUSLIVRO[$livro['disponivel']];

                // Linha da tabela com os dados do livro
                $html .= "<tr>
                    <td>{$livro['titulo']}</td>
                    <td>{$livro['tombo']}</td>
                    <td>{$statusTexto}</td>
                    <td>{$condicaoTexto}</td>
                  </tr>";
            }

            $html .= '</tbody></table>';
        }

        // Adiciona o conteúdo HTML ao PDF
        $pdf->writeHTML($html, true, false, true, false, '');

        // Configuração dos headers do PDF
        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="relatorio_livros_disponiveis.pdf"');
        header('Cache-Control: private, max-age=0, must-revalidate');
        header('Pragma: public');

        // Gera o PDF para o navegador
        $pdf->Output('relatorio_livros_disponiveis.pdf', 'I');

        exit;
    }
}