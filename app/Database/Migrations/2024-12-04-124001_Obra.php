<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Obra extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'titulo' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'isbn' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'categoria' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'ano_publicacao' => [
                'type' => 'INT',
            ],
            'id_editora' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'quantidade' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_editora', 'editora', 'id');
        $this->forge->createTable('obra');
    }

    public function down()
    {
        $this->forge->dropTable('obra');
    }
}