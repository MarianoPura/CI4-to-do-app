<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\TaskController;
/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('to-do', [TaskController::class, 'index']);
$routes->post('addTask', [TaskController::class, 'create']);
$routes->post('deleteTask/(:segment)', [TaskController::class, 'delete']);
$routes->post('updateTask/(:segment)', [TaskController::class, 'update']);
