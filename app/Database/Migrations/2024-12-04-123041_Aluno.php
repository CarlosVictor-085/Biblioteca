<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Aluno extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'cpf' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'nome' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'telefone' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'turma' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('aluno');
    }

    public function down()
    {
        $this->forge->dropTable('aluno');
    }
}