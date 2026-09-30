<?php

namespace App\Controllers;

use App\Models\ExamenesModel;
use App\Models\PreguntasModel;

class Preguntas extends BaseController
{
    protected $sesion;
    protected $examenes;
    protected $preguntas;

    public function __construct()
    {
        $this->sesion    = session();
        $this->examenes  = new ExamenesModel();
        $this->preguntas = new PreguntasModel();
    }

    private function esMio($idExamen)
    {
        return $this->examenes->where('id', $idExamen)->where('usuario', $this->sesion->get('id'))->first();
    }

    public function insertar($idExamen)
    {
        if (!$this->sesion->get('id')) {
            return redirect()->to(base_url('login'));
        }

        if (!$this->esMio($idExamen)) {
            return redirect()->to(base_url('examenes'));
        }

        $texto = trim($this->request->getPost('textoPregunta'));

        if ($texto == '') {
            return redirect()->to(base_url('examenes/ver/' . $idExamen))->with('error', 'Escribí la pregunta.');
        }

        $this->preguntas->save([
            'idExamen'      => $idExamen,
            'textoPregunta' => $texto,
        ]);

        return redirect()->to(base_url('examenes/ver/' . $idExamen))->with('ok', 'Pregunta agregada.');
    }

    public function borrar($id)
    {
        if (!$this->sesion->get('id')) {
            return redirect()->to(base_url('login'));
        }

        $pregunta = $this->preguntas->find($id);

        if ($pregunta && $this->esMio($pregunta['idExamen'])) {
            $this->preguntas->delete($id);
            return redirect()->to(base_url('examenes/ver/' . $pregunta['idExamen']))->with('ok', 'Pregunta eliminada.');
        }

        return redirect()->to(base_url('examenes'));
    }
}