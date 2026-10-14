<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuariosModel extends Model
{
    protected $table         = 'usuarios';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $allowedFields = ['usuario', 'password'];

    // Reglas de validación (se aplican en insert/update)
    protected $validationRules = [
        'usuario'  => 'required|min_length[3]|is_unique[usuarios.usuario]',
        'password' => 'required|min_length[4]',
    ];

    // Hashea la contraseña antes de guardar
    protected $beforeInsert = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }
        return $data;
    }

    public function buscarPorUsuario(string $usuario)
    {
        return $this->where('usuario', $usuario)->first();
    }
}