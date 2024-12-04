<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Autorobra extends Migration
{
    public function up()
    {
         $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_obra' => [
                'type'       => 'INT',
                'unsigned'       => true,
            ],
            'id_autor' => [
                'type' => 'INT',
                'unsigned'       => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_obra', 'obra', 'id');
        $this->forge->addForeignKey('id_autor', 'autor', 'id');
        $this->forge->createTable('autor_obra');
    }

    public function down()
    {
        $this->forge->dropTable('autor_obra');
    }
}