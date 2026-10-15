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

    // Todas las preguntas de un examen
    public function delExamen(int $idExamen)
    {
        return $this->where('idExamen', $idExamen)->findAll();
    }
}