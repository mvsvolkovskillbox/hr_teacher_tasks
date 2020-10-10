<?php
/**
 * Класс View
 */

namespace App;

use App\Renderable as Renderable;

/**
 * Class View
 * @package App
 */
class View implements Renderable
{
    private $view;
    private $parameters;

    /**
     * View constructor.
     * @param string $view
     * @param array $parameters
     */
    public function __construct(string $view, array $parameters = [])
    {
        // Преобразуем параметр $view в путь до нужного шаблона
        $this->view = VIEW_DIR . strtolower(str_replace('.','/',$view)) . ".php";
        $this->parameters = $parameters;
    }

    /**
     *  Метод проверяет существование шаблона $this->view и делает require при его наличии
     *  Параметры для вывода находятся в массиве $parameters
     */
    public function render()
    {
        $parameters = $this->parameters;
        if(file_exists($this->view)) {
            require $this->view;
        } else {
            echo "Данного шаблона не существует";
        }
    }
}