<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Livro extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'disponivel' => [
                'type'       => 'INT',
            ],
            'status' => [
                'type' => 'INT',
            ],
            'tombo' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                
            ],
            'id_obra' => [
                'type'           => 'INT',
                'unsigned'       => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_obra', 'obra', 'id');
        $this->forge->createTable('livro');
    }

    public function down()
    {
        $this->forge->dropTable('livro');
    }
}