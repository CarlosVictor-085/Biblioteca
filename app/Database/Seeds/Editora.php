<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class Editora extends Seeder
{
    public function run()
    {
        $faker = Factory::create('pt_BR');  
        
        $quantidade = 30000;  

        for ($i = 0; $i < $quantidade; $i++) {
            
            $nome = $faker->company;
            $email = $faker->email;
            $telefone = $faker->phoneNumber;

            $data = [
                'nome'     => $nome,
                'email'    => $email,
                'telefone' => $telefone,
            ];

            $this->db->table('editora')->insert($data);
        }
    }
}