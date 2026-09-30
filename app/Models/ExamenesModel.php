<?php

namespace App\Models;

use CodeIgniter\Model;

class ExamenesModel extends Model
{
    protected $table      = 'examen';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['usuario', 'nombreExamen'];
}