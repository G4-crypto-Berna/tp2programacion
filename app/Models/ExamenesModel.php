<?php 

namespace App\Models;

use CodeIgniter\Model;

class ExamenesModel extends Model
{
    protected $table         = 'examen';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $allowedFields = ['usuario', 'nombreExamen'];

    protected $validationRules = [
        'usuario'      => 'required|integer',
        'nombreExamen' => 'required|min_length[3]',
    ];

    // Todos los exámenes de un usuario
    public function delUsuario(int $idUsuario)
    {
        return $this->where('usuario', $idUsuario)->findAll();
    }
}