<?php

/**
 * Фукнция, подгружающая классы из директории $base_dir
 */
spl_autoload_register(function ($class) {
    // префикс пространства имен
    $prefix = 'App\\';

    // базовый каталог для префикса пространства имен
    $base_dir = $_SERVER['DOCUMENT_ROOT'] . '/src/';

    // Использует ли класс префикс пространства имен?
    $len = strlen($prefix);
    if(strncmp($prefix, $class, $len) !== 0) {
        // нет, переходим к следующему зарегистрированному автоподгрузчику
        return;
    }

    // получаем относительное имя класса
    $relative_class = substr($class, $len);

    // Создаем имя файла
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    // Если файл существует, то цепляем его
    if(file_exists($file)) {
        require $file;
    }

});
// хелпер вывода, содержит функцию printArray(), таже print_r(), только в черном стиле и с тегами <pre>
require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/helperOutput.php';

define('APP_DIR',  $_SERVER['DOCUMENT_ROOT']); // Корень проекта
define('VIEW_DIR',  $_SERVER['DOCUMENT_ROOT'] . '/view/'); // Корень всех представлений
