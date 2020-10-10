<?php
/**
 *  Хелпер вывода
 */

namespace helperOutput;

/**
 * Функция выводит в контейнере <pre> структурированную информацию о параметре $data
 * @param $data
 */
function printArray($data)
{
    echo "<pre style='  color: orange;
  background-color: #000;'>";
    print_r($data);
    echo "</pre>";
}