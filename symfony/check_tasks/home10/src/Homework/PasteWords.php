<?php

namespace App\Homework;

class PasteWords implements PasteWordsInterface
{
    public function paste(string $text, string $word, int $wordsCount = 1): string
    {
        $arr_tmp = explode(' ', $text);
        for ($i = 0; $i < $wordsCount; $i++) {
            array_splice($arr_tmp, rand(0, sizeof($arr_tmp)), 0, $word);
        }
        return implode(' ', $arr_tmp);
    }
}
