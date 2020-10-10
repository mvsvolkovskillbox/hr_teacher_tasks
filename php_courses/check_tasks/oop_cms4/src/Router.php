<?php
/**
 * Класс Router
 */

namespace App;

/**
 * Class Router
 * @package App
 */
class Router
{
    private $routes; // массив маршрутов

    /**
     * Метод регистрирует маршруты
     * @param $uri
     * @param $callback
     */
    public function get($uri, $callback)
    {
        $this->routes[] = ['uri' => $uri, 'callback' => $callback];
    }

    /**
     *  Метод сравнивает запрос в адресной строке с маршрутами в $this->routes и при совпадении выводит соответствующее
     *  сообщение связанного замыкания или статических методов класса Controller
     *
     */
    public function dispatch()
    {
        foreach ($this->routes as $route) {
            if(is_string($route['callback'])) { // Если значение $route['callback'] строка, заменяем в нем "@" на "::" и вызываем метод
                if($_SERVER['REQUEST_URI'] == $route['uri']) {
                    return str_replace('@', '::', $route['callback'])();
                };
            } else if(is_object($route['callback'])) { // Если значение $route['callback'] объект, то выводим значение замыкания методом __invoke()
                if ($_SERVER['REQUEST_URI'] == $route['uri']) {
                    return $route['callback']->__invoke();
                };
            }
        }
    }
}
