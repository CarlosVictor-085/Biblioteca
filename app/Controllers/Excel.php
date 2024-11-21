<?php

namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory; // Adicionado: Importação da IOFactory
use CodeIgniter\Controller;
use CodeIgniter\Database\Config;

class Excel extends Controller
{
    public function generate()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        // Definindo os cabeçalhos da planilha
        $sheet->setCellValue('A1', 'Nome');
        $sheet->setCellValue('B1', 'CPF');
        $sheet->setCellValue('C1', 'Email');
        $sheet->setCellValue('D1', 'Telefone');
        $sheet->setCellValue('E1', 'Turma');
    
        // Salvar a planilha em um caminho temporário
        $writer = new Xlsx($spreadsheet);
        $filePath = sys_get_temp_dir() . '/modelo_alunos.xlsx';
        $writer->save($filePath);
    
        // Forçar o download da planilha
        return $this->response->download($filePath, null)->setFileName('modelos_para_inserir_alunos.xlsx');
    }
    
    public function import()
    {
        if ($file = $this->request->getFile('file')) {
            if ($file->isValid() && !$file->hasMoved()) {
                $filePath = $file->getTempName();
                
                // Carregar o arquivo Excel
                $spreadsheet = IOFactory::load($filePath);
                $worksheet = $spreadsheet->getActiveSheet();
                
                // Conectar ao banco de dados
                $db = Config::connect();
                $builder = $db->table('aluno');
                
                // Loop pelas linhas do Excel, começando da segunda linha
                $startRow = 2;
                foreach ($worksheet->getRowIterator($startRow) as $row) {
                    $cellIterator = $row->getCellIterator();
                    $cellIterator->setIterateOnlyExistingCells(false); 

                    $data = [];
                    foreach ($cellIterator as $cell) {
                        $data[] = trim($cell->getValue());
                    }

                    // Verificar se as colunas obrigatórias não estão vazias
                    if (!empty($data[0]) && !empty($data[1]) && !empty($data[2]) && !empty($data[3]) && !empty($data[4])) {
                        // Inserir dados no banco de dados
                        $builder->insert([
                            'nome' => $data[0],
                            'cpf' => $data[1],
                            'email' => $data[2],
                            'telefone' => $data[3],
                            'turma' => $data[4],
                        ]);
                    }
                }

                session()->setFlashdata('success', 'Importação concluída!');
            } else {
                session()->setFlashdata('error', 'Erro ao mover o arquivo.');
            }
        } else {
            session()->setFlashdata('error', 'Nenhum arquivo foi enviado.');
        }

        // Redirecionar para a página "Aluno"
        return redirect()->to('Aluno');
    }
}
