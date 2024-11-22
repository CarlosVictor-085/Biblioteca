<?php



use CodeIgniter\Router\RouteCollection;



/**

 * @var RouteCollection $routes

 */

$routes->get('/', 'Login::index');

$routes->post('/login/authenticate', 'Login::authenticate');

$routes->get('/logout', 'Login::logout');

$routes->set404Override('Erro::index');


//$routes->setAutoRoute(true);

