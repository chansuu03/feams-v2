<?php 

$routes->group('election', ['namespace' => 'Modules\Election\Controllers'], function($routes)
{
    $routes->get('/', 'Elections::index');
    $routes->match(['get', 'post'], 'set', 'Elections::set');

    $routes->get('positions', 'Positions::index');
    $routes->post('positions/add', 'Positions::add');
    $routes->get('positions/del/(:num)', 'Positions::delete/$1');
    $routes->post('positions/edit', 'Positions::edit');

    $routes->get('candidates', 'Candidates::index');
    $routes->post('candidates/add', 'Candidates::add');
    $routes->post('candidates/pos', 'Candidates::posEdit');
    $routes->get('candidates/del/(:num)', 'Candidates::delete/$1');

    $routes->get('voting', 'Voting::index');
    $routes->post('vote', 'Voting::castVote');
});