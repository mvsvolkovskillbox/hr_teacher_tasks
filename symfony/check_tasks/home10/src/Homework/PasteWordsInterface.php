<?php

namespace App\Homework;

interface PasteWordsInterface
{
    public function paste(string $text, string $word, int $wordsCount = 1): string;
}