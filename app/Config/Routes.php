<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\TaskController;
use App\Controllers\UsersController;
/**
 * @var RouteCollection $routes
 */
$routes->get('/', [TaskController::class, 'index'] , ['filter' => 'auth']);
$routes->get('to-do', [TaskController::class, 'index'], ['filter' => 'auth']);
$routes->post('addTask', [TaskController::class, 'create'], ['filter' => 'auth']);
$routes->post('updateTask/(:segment)', [TaskController::class, 'update'], ['filter' => 'auth']);
$routes->post('register', [UsersController::class, 'register'], ['filter' => 'guest']);
$routes->post('login', [UsersController::class, 'login'], ['filter' => 'guest']);
$routes->post('logout', [UsersController::class, 'logout'], ['filter' => 'auth']);
$routes->delete('delete/(:segment)', [TaskController::class, 'delete'], ['filter' => 'auth']);
$routes->get('loginPage', [UsersController::class, 'loginPage'], ['filter' => 'guest']);
$routes->get('registration', [UsersController::class, 'registrationPage'], ['filter' => 'guest']);