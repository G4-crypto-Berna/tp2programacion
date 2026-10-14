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

    public function sortear($idExamen)
    {
        if (!$this->sesion->get('id')) {
            return $this->response->setStatusCode(401)
                ->setJSON(['ok' => false, 'mensaje' => 'Sesión vencida.']);
        }

        if (!$this->esMio($idExamen)) {
            return $this->response->setStatusCode(403)
                ->setJSON(['ok' => false, 'mensaje' => 'Examen no válido.']);
        }

        $cantidad = (int) $this->request->getPost('cantidad');
        $total    = $this->preguntas->where('idExamen', $idExamen)->countAllResults();

        if ($cantidad < 1) {
            return $this->response->setJSON([
                'ok' => false, 'mensaje' => 'Indicá un número mayor a 0.', 'token' => csrf_hash(),
            ]);
        }

        if ($cantidad > $total) {
            return $this->response->setJSON([
                'ok' => false,
                'mensaje' => "El examen tiene solo $total pregunta(s). Elegí un número menor o igual.",
                'token' => csrf_hash(),
            ]);
        }

        // Cada fila aparece una sola vez, por lo tanto no se repiten preguntas
        $sorteadas = $this->preguntas
            ->where('idExamen', $idExamen)
            ->orderBy('id', 'RANDOM')
            ->limit($cantidad)
            ->findAll();

        return $this->response->setJSON([
            'ok'        => true,
            'preguntas' => array_column($sorteadas, 'textoPregunta'),
            'token'     => csrf_hash(),
        ]);
    }
}