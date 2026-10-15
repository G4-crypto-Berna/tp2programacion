<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuariosModel extends Model
{
    protected $table         = 'usuarios';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $allowedFields = ['usuario', 'password'];

    public function buscarPorUsuario(string $usuario)
    {
        return $this->where('usuario', $usuario)->first();
    }
}