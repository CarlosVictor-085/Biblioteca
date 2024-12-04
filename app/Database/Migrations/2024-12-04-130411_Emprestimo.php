<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Emprestimo extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'data_inicio' => [
                'type'       => 'DATE',
            ],
            'data_fim' => [
                'type' => 'DATE',
            ],
            'data_prazo' => [
                'type' => 'INT',
            ],
             'id_livro' => [
                'type'           => 'INT',
                'unsigned'       => true,
            ],
             'id_aluno' => [
                'type'           => 'INT',
                'unsigned'       => true,
            ],
            'id_usuario' => [
                'type'           => 'INT',
                'unsigned'       => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_livro', 'livro', 'id');
        $this->forge->addForeignKey('id_aluno', 'aluno', 'id');
        $this->forge->addForeignKey('id_usuario', 'usuario', 'id');
        $this->forge->createTable('emprestimo');
    }

    public function down()
    {
        $this->forge->dropTable('emprestimo');
    }
}