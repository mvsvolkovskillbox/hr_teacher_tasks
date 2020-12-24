<?php

namespace App\Homework;

use Faker\Factory;

class ArticleContentProvider implements ArticleContentProviderInterface
{
    private static $repeatWords = ['word1', 'word2', 'word3', 'word4', 'word5'];
    private static $countRepeatWords = 10;

    private $faker;
    private $markBold;
    private $pasteWords;

    public function __construct(bool $markBold, PasteWordsInterface $pasteWords)
    {
        $this->faker = Factory::create();
        $this->markBold = $markBold;
        $this->pasteWords = $pasteWords;
    }

    public function get(int $paragraphs, string $word = null, int $wordsCount = 0): string
    {
        $result = $this->faker->paragraphs($paragraphs, true);
        if ($word) {
            $word = $this->markBold ? "**{$word}**" : "*{$word}*";
            $result = $this->pasteWords->paste($result, $word, $wordsCount);
        }
        return $result;
    }

    public function getRandom(): string
    {
        $word = null;
        $wordCount = 0;

        if ($this->faker->boolean(70)) {
            $word = $this->faker->randomElement(static::$repeatWords);
            $wordCount = static::$countRepeatWords;
        }

        return $this->get($this->faker->numberBetween(2, 10), $word, $wordCount);
    }
}