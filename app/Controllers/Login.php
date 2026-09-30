<?php

namespace App\Controllers;

use App\Models\UsuariosModel;

class Login extends BaseController
{
    protected $usuarios;

    public function __construct()
    {
        $this->usuarios = new UsuariosModel();
    }

    public function index()
    {
        $datos = ['titulo' => 'Iniciar sesión'];

        echo view('header', $datos);
        echo view('logueo/login');
        echo view('footer');
    }

    public function validacion()
    {
        $usuario  = strtolower(trim($this->request->getPost('usuario')));
        $password = $this->request->getPost('password');

        $datosUsuario = $this->usuarios->where('usuario', $usuario)->first();

        if ($datosUsuario != null && password_verify($password, $datosUsuario['password'])) {
            session()->set([
                'id'      => $datosUsuario['id'],
                'usuario' => $datosUsuario['usuario'],
            ]);
            return redirect()->to(base_url('examenes'));
        }

        return redirect()->to(base_url('login'))->with('error', 'Usuario o contraseña incorrectos.');
    }

    public function salir()
    {
        session()->destroy();
        return redirect()->to(base_url('login'));
    }

    public function nuevo()
    {
        $datos = ['titulo' => 'Crear cuenta'];

        echo view('header', $datos);
        echo view('logueo/registro');
        echo view('footer');
    }

    public function guardar()
    {
        $usuario  = strtolower(trim($this->request->getPost('usuario')));
        $password = trim($this->request->getPost('password'));
        $repetir  = trim($this->request->getPost('password_confirm'));

        if ($usuario == '' || strlen($usuario) > 50) {
            return redirect()->to(base_url('registro'))->with('error', 'El usuario es obligatorio (máximo 50 caracteres).');
        }
        if (strlen($password) < 8) {
            return redirect()->to(base_url('registro'))->with('error', 'La contraseña debe tener al menos 8 caracteres.');
        }
        if ($password != $repetir) {
            return redirect()->to(base_url('registro'))->with('error', 'Las contraseñas no coinciden.');
        }
        if ($this->usuarios->where('usuario', $usuario)->first()) {
            return redirect()->to(base_url('registro'))->with('error', 'Ese usuario ya existe.');
        }

        $this->usuarios->save([
            'usuario'  => $usuario,
            'password' => password_hash($password, PASSWORD_DEFAULT),
        ]);

        return redirect()->to(base_url('login'))->with('ok', 'Cuenta creada. Ya podés ingresar.');
    }
}