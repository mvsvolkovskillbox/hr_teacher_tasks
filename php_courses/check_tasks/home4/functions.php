<?php

/**
 * Фукнкция вывода меню
 * @param array входной массив для вывода меню
 * @param string $location меняет стиль вывода меню в зависимости от параметра (head/foot)
 */

function showMenu(array $arrays, string $location = 'head')
{
    if ($location === 'head') {
        foreach (arraySort($arrays) as $value) {
            $url = $_SERVER["REQUEST_URI"] === $value['path'] ? "text-decoration:underline" : "";
            echo "<li><a href='{$value['path']}' style='font-size: 16px;{$url}'>" .
                cutString($value['title']) . "</a></li>";
        }
    } elseif ($location === 'foot') {
        foreach (arraySort($arrays, 'title', SORT_DESC) as $value) {
            $url = $_SERVER["REQUEST_URI"] === $value['path'] ? "text-decoration:underline" : "";
            echo "<li><a href='{$value['path']}' style='font-size: 12px;{$url}'>" .
                cutString($value['title']) . "</a></li>";
        }
    }
}

/**
 * Вспомогаьельная фукнкция сортировки меню
 * @param array $array входной массив, для сортировки
 * @param string $key ключ элементов этого массива, по которому будет осуществлена сортировка (sort/title)
 * @param string $sort направление сортировки по возрастанию/по убыванию (SORT_ASC/SORT_DESC)
 * @return array $array возращает результат этой сортировки
 */

function arraySort(array $array, $key = 'sort', $sort = SORT_ASC): array
{
    $arrayValue = [];
    foreach ($array as $k => $arr) {
        $arrayValue[$k] = $arr[$key];

    }
    array_multisort($arrayValue, $sort, $array);
    return $array;

}

/**
 * Вспомогаьельная фукнкция обрезания строки
 * @param string $line входящая строка
 * @param string $length максимальная длина строки
 * @param string $appends добавления... к концу строки
 * @return string $line выводит строку после обработки
 */
function cutString($line, $length = 12, $appends = '...'): string
{
    if (mb_strlen($line) > 15) {
        $line = iconv_substr($line, 0, $length, 'UTF-8');
        $line .= $appends;
    }
    return $line;
}

/**
 * Фукнкция вывода заголовка
 * @param array $arr входящий массив меню
 */
function outputHead(array $arr)
{
    foreach ($arr as $value) {
        if ($_SERVER["REQUEST_URI"] === $value['path']) {
            return $value['title'];
        }
    }
}
