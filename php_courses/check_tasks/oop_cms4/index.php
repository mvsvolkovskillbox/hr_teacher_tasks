<?php

error_reporting(E_ALL);
ini_set('display_errors',true);

require_once 'bootstrap.php';

use App\Router;
use App\Application;
use App\Controller;
use App\View;

$router = new Router(); // создаем маршрутизатор

$router->get('/about', Controller::class . '@about');  // Регистрируем маршрут "/about"

// Регистрируем маршрут по примеру основного задания используя замыкание
$router->get('/', function() {
    return new View('index', ['title' => 'Index Page']);
});

// создаем приложение и передаем ему маршрутизатор
$application = new Application($router);

// Запуск приложения
$application->run();
