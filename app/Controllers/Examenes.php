<?php

namespace App\Controllers;

use App\Models\ExamenesModel;
use App\Models\PreguntasModel;

class Examenes extends BaseController
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

    // Devuelve el examen solo si es del usuario logueado
    private function buscar($id)
    {
        return $this->examenes->where('id', $id)->where('usuario', $this->sesion->get('id'))->first();
    }

    public function index()
    {
        if (!$this->sesion->get('id')) {
            return redirect()->to(base_url('login'));
        }

        $datos = [
            'titulo'   => 'Mis exámenes',
            'examenes' => $this->examenes->where('usuario', $this->sesion->get('id'))->findAll(),
        ];

        echo view('header', $datos);
        echo view('examenes/listado');
        echo view('footer');
    }

    public function nuevo()
    {
        if (!$this->sesion->get('id')) {
            return redirect()->to(base_url('login'));
        }

        echo view('header', ['titulo' => 'Nuevo examen']);
        echo view('examenes/formulario');
        echo view('footer');
    }

    public function insertar()
    {
        if (!$this->sesion->get('id')) {
            return redirect()->to(base_url('login'));
        }

        $nombre = trim($this->request->getPost('nombreExamen'));

        if ($nombre == '' || strlen($nombre) > 50) {
            return redirect()->to(base_url('examenes/nuevo'))->with('error', 'El nombre es obligatorio (máximo 50 caracteres).');
        }

        $this->examenes->save([
            'usuario'      => $this->sesion->get('id'),
            'nombreExamen' => $nombre,
        ]);

        return redirect()->to(base_url('examenes'))->with('ok', 'Examen creado.');
    }

    public function editar($id)
    {
        if (!$this->sesion->get('id')) {
            return redirect()->to(base_url('login'));
        }

        $examen = $this->buscar($id);
        if (!$examen) {
            return redirect()->to(base_url('examenes'));
        }

        echo view('header', ['titulo' => 'Editar examen', 'examen' => $examen]);
        echo view('examenes/formulario');
        echo view('footer');
    }

    public function actualizar($id)
    {
        if (!$this->sesion->get('id')) {
            return redirect()->to(base_url('login'));
        }

        if (!$this->buscar($id)) {
            return redirect()->to(base_url('examenes'));
        }

        $nombre = trim($this->request->getPost('nombreExamen'));

        if ($nombre == '' || strlen($nombre) > 50) {
            return redirect()->to(base_url('examenes/editar/' . $id))->with('error', 'El nombre es obligatorio (máximo 50 caracteres).');
        }

        $this->examenes->update($id, ['nombreExamen' => $nombre]);

        return redirect()->to(base_url('examenes'))->with('ok', 'Examen actualizado.');
    }

    public function borrar($id)
    {
        if (!$this->sesion->get('id')) {
            return redirect()->to(base_url('login'));
        }

        if ($this->buscar($id)) {
            // La FK no tiene ON DELETE CASCADE: primero se borran las preguntas
            $this->preguntas->where('idExamen', $id)->delete();
            $this->examenes->delete($id);
        }

        return redirect()->to(base_url('examenes'))->with('ok', 'Examen eliminado.');
    }

    public function ver($id)
    {
        if (!$this->sesion->get('id')) {
            return redirect()->to(base_url('login'));
        }

        $examen = $this->buscar($id);
        if (!$examen) {
            return redirect()->to(base_url('examenes'));
        }

        $datos = [
            'titulo'    => $examen['nombreExamen'],
            'examen'    => $examen,
            'preguntas' => $this->preguntas->where('idExamen', $id)->findAll(),
        ];

        echo view('header', $datos);
        echo view('examenes/ver');
        echo view('footer');
    }
}