<?php

namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
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

        // Salvar a planilha no sistema
        $writer = new Xlsx($spreadsheet);
        $filePath = WRITEPATH . 'uploads/modelo_alunos.xlsx';
        $writer->save($filePath);

        // Forçar download da planilha
        return $this->response->download($filePath, null)->setFileName('modelos_para_incerir_alunos.xlsx');
    }

    public function import()
    {
        if ($file = $this->request->getFile('file')) {
            if ($file->isValid() && ! $file->hasMoved()) {
                $filePath = $file->getTempName();
                
                // Carregar o arquivo Excel
                $spreadsheet = IOFactory::load($filePath);
                $worksheet = $spreadsheet->getActiveSheet();
                
                // Conectar ao banco de dados
                $db = Config::connect();
                $builder = $db->table('aluno');
                
                // Loop pelas linhas do Excel
                foreach ($worksheet->getRowIterator() as $row) {
                    $cellIterator = $row->getCellIterator();
                    $cellIterator->setIterateOnlyExistingCells(false); 

                    $data = [];
                    foreach ($cellIterator as $cell) {
                        $data[] = $cell->getValue();
                    }
                    
                    // Inserir dados no banco de dados
                    $builder->insert([
                        'nome' => $data[0],
                        'cpf' => $data[1],
                        'email' => $data[2],
                        'telefone' => $data[3],
                        'turma' => $data[4],
                    ]);
                }

                session()->setFlashdata('success', 'Importação concluída!');
            } else {
                session()->setFlashdata('error', 'Erro ao mover o arquivo.');
            }
        } else {
            session()->setFlashdata('error', 'Nenhum arquivo foi enviado.');
        }

        return redirect()->to('excel/view');
    }

    public function view()
    {
        return view('import_excel');
    }
}
