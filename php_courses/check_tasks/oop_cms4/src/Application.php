<?php
/**
 * Класс Application
 */

namespace App;

use App\Router as Router;

/**
 * Class Application
 * @package App
 */
class Application
{
    private $router; // Маршрутизатор

    /**
     * Application constructor.
     * @param Router $router
     */
    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    /**
     * Метод проверяет результат метода dispatch.
     * Если передан объект-потомок Renderable, то он выводится методом render(),
     * иначе выводим результат с помощью echo
     */
    public function run()
    {
        $result = $this->router->dispatch();

        // проверяем, является ли экземпляр потомком Renderable
        if(is_object($result) && $result instanceof Renderable) {
            // Если да, то выводим его методом render()
            $result->render();
        } else {
            // Если нет, то просто выводим с помощью echo
            echo $result;
        }
    }
}
