<?php

namespace App\Homework;

use Faker\Factory;

class CommentContentProvider implements CommentContentProviderInterface
{
    private static $repeatWords = 'myWord';

    private $faker;
    private $pasteWords;

    public function __construct(PasteWordsInterface $pasteWords)
    {
        $this->faker = Factory::create();
        $this->pasteWords = $pasteWords;
    }

    public function get(string $word = null, int $wordsCount = 0): string
    {
        $result = $this->faker->paragraph;

        if ($word) {
            $result = $this->pasteWords->paste($result, $word, $wordsCount);
        }

        return $result;
    }

    public function getRandom(): string
    {
        $word = null;
        $wordCount = 0;

        if ($this->faker->boolean(70)) {
            $word = static::$repeatWords;
            $wordCount = $this->faker->numberBetween(2, 5);
        }

        return $this->get($word, $wordCount);
    }
}
