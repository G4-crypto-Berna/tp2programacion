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

    // Preguntas del examen que todavía no salieron en ningún sorteo
    private function disponibles($idExamen)
    {
        $yaSalieron = $this->sesion->get('sorteadas_' . $idExamen) ?? [];

        $consulta = $this->preguntas->where('idExamen', $idExamen);
        if (!empty($yaSalieron)) {
            $consulta->whereNotIn('id', $yaSalieron);
        }

        return $consulta;
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

        $cantidad  = (int) $this->request->getPost('cantidad');
        $restantes = $this->disponibles($idExamen)->countAllResults();

        if ($cantidad < 1) {
            return $this->response->setJSON([
                'ok' => false, 'mensaje' => 'Indicá un número mayor a 0.', 'token' => csrf_hash(),
            ]);
        }

        if ($restantes == 0) {
            return $this->response->setJSON([
                'ok'        => false,
                'mensaje'   => 'Ya salieron todas las preguntas. Reiniciá el sorteo para volver a empezar.',
                'restantes' => 0,
                'token'     => csrf_hash(),
            ]);
        }

        if ($cantidad > $restantes) {
            return $this->response->setJSON([
                'ok'        => false,
                'mensaje'   => "Quedan solo $restantes pregunta(s) sin sortear. Elegí un número menor o igual.",
                'restantes' => $restantes,
                'token'     => csrf_hash(),
            ]);
        }

        $sorteadas = $this->disponibles($idExamen)
            ->orderBy('id', 'RANDOM')
            ->limit($cantidad)
            ->findAll();

        // Guarda en la sesión los ids que acaban de salir
        $clave      = 'sorteadas_' . $idExamen;
        $yaSalieron = $this->sesion->get($clave) ?? [];
        $this->sesion->set($clave, array_merge($yaSalieron, array_column($sorteadas, 'id')));

        return $this->response->setJSON([
            'ok'        => true,
            'preguntas' => array_column($sorteadas, 'textoPregunta'),
            'restantes' => $restantes - count($sorteadas),
            'token'     => csrf_hash(),
        ]);
    }

    public function reiniciar($idExamen)
    {
        if (!$this->sesion->get('id')) {
            return $this->response->setStatusCode(401)
                ->setJSON(['ok' => false, 'mensaje' => 'Sesión vencida.']);
        }

        if (!$this->esMio($idExamen)) {
            return $this->response->setStatusCode(403)
                ->setJSON(['ok' => false, 'mensaje' => 'Examen no válido.']);
        }

        $this->sesion->remove('sorteadas_' . $idExamen);

        return $this->response->setJSON([
            'ok'      => true,
            'mensaje' => 'Sorteo reiniciado.',
            'token'   => csrf_hash(),
        ]);
    }
}