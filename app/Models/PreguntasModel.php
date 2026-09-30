<?php

namespace App\Models;

use CodeIgniter\Model;

class PreguntasModel extends Model
{
    protected $table      = 'preguntas';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['idExamen', 'textoPregunta'];
}