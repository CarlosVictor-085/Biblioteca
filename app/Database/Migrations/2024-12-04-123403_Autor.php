<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Autor extends Migration
{
    public function up()
    {
         $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nome' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('autor');
    }

    public function down()
    {
        $this->forge->dropTable('autor');
    }
}