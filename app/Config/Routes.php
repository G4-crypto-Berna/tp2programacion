<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

$routes->get('/', 'Login::index');
$routes->get('/login', 'Login::index');
$routes->post('/login/validacion', 'Login::validacion');
$routes->get('/login/salir', 'Login::salir');
$routes->get('/registro', 'Login::nuevo');
$routes->post('/registro/guardar', 'Login::guardar');

$routes->get('/examenes', 'Examenes::index');
$routes->get('/examenes/nuevo', 'Examenes::nuevo');
$routes->post('/examenes/insertar', 'Examenes::insertar');
$routes->get('/examenes/editar/(:num)', 'Examenes::editar/$1');
$routes->post('/examenes/actualizar/(:num)', 'Examenes::actualizar/$1');
$routes->post('/examenes/borrar/(:num)', 'Examenes::borrar/$1');
$routes->get('/examenes/ver/(:num)', 'Examenes::ver/$1');

$routes->post('/preguntas/insertar/(:num)', 'Preguntas::insertar/$1');
$routes->post('/preguntas/borrar/(:num)', 'Preguntas::borrar/$1');