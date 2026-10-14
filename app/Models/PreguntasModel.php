<?php

namespace App\Models;

use CodeIgniter\Model;

class PreguntasModel extends Model
{
    protected $table         = 'preguntas';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $allowedFields = ['idExamen', 'textoPregunta'];

    protected $validationRules = [
        'idExamen'      => 'required|integer',
        'textoPregunta' => 'required|min_length[3]',
    ];

    public function delExamen(int $idExamen)
    {
        return $this->where('idExamen', $idExamen)->findAll();
    }

    // El sorteo: N preguntas al azar, sin repetir
    public function sortear(int $idExamen, int $cantidad)
    {
        return $this->where('idExamen', $idExamen)
                    ->orderBy('id', 'RANDOM')
                    ->limit($cantidad)
                    ->findAll();
    }
}