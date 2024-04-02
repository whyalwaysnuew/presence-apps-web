<<<<<<< HEAD
<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Auth;
use App\Controllers\Dashboard;
use App\Controllers\Presence;


/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index', ['filter' => 'auth']);

$routes->get('auth', 'Auth::index');
$routes->post('auth/login', 'Auth::login');
$routes->post('auth/register', 'Auth::register');
$routes->get('auth/logout', 'Auth::logout');


$routes->get('presence', 'Presence::index');
$routes->get('presence/getReverseLocation', 'Presence::getReverseLocation');
$routes->post('presence/uploadFile', 'Presence::uploadFile');
$routes->post('presence/removeFile', 'Presence::removeFile');
$routes->post('presence/store', 'Presence::store');
$routes->get('presence/history', 'Presence::history');


$routes->get('division', 'Division::index');
$routes->get('division/create', 'Division::create');
$routes->post('division/store', 'Division::store');
$routes->get('division/edit', 'Division::edit');
$routes->post('division/update', 'Division::update');
$routes->get('division/delete', 'Division::delete');
=======
<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Auth;
use App\Controllers\Dashboard;
use App\Controllers\Presence;


/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index', ['filter' => 'auth']);

$routes->get('auth', 'Auth::index');
$routes->post('auth/login', 'Auth::login');
$routes->post('auth/register', 'Auth::register');
$routes->get('auth/logout', 'Auth::logout');


$routes->get('presence', 'Presence::index');
$routes->get('presence/getReverseLocation', 'Presence::getReverseLocation');
$routes->post('presence/uploadFile', 'Presence::uploadFile');
$routes->post('presence/removeFile', 'Presence::removeFile');
$routes->post('presence/store', 'Presence::store');
$routes->get('presence/history', 'Presence::history');
>>>>>>> 2800c1c (test)
