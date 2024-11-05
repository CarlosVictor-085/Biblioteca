<?php

namespace App\Models;

use CodeIgniter\Model;

class LivroModel extends Model
{
 // Status de Disponibilidade
 const DISPONIVEL = 1;
 const INDISPONIVEL = 0;

 const STATUSLOCADO = [
     self::DISPONIVEL => "Disponível",
     self::INDISPONIVEL => "Indisponível"
 ];

 // Status de Condição do Livro
 const INTEGRO = 1;
 const RASGADO = 2;
 const PERDIDO = 3;
 const DANIFICADO = 4; // Exemplo de status adicional
 // Exemplo de status adicional

 const STATUSLIVRO = [
     self::INTEGRO => "Íntegro",
     self::RASGADO => "Rasgado",
     self::PERDIDO => "Perdido",
     self::DANIFICADO => "Danificado",  // Novo status   
 ];

    protected $table            = 'livro';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['disponivel','status','tombo','id_obra'];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}