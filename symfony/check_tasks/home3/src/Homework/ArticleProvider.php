<?php
namespace App\Homework;

class ArticleProvider
{
    /**
     * @return array
     * @throws \Exception
     */
    public function article(): array
    {
        $id = random_int(0, 4);
        
        return $this->articles()[$id];
    }
    
    /**
     * @return array
     */
    public function articles(): array
    {
        return [
            [
                'title' => 'Что делать, если надо верстать?',
                'slug' => 'what-to-do-if-i-have-to-be-a-front',
                'image' => 'images/article-2.jpeg'
            ],
            [
                'title' => 'Facebook ест твои данные',
                'slug' => 'hungry-facebook',
                'image' => 'images/article-1.jpeg'
            ],
            [
                'title' => 'Когда пролил кофе на клавиатуру',
                'slug' => 'when-pull-the-coffee-on-keyboard',
                'image' => 'images/article-3.jpg'
            ],
            [
                'title' => 'Golang и Php сразятся на UFC 256',
                'slug' => 'go-vs-php',
                'image' => 'images/article-4.png'
            ],
            [
                'title' => 'Как создать свой стартап?',
                'slug' => 'how-to-become-a-king',
                'image' => 'images/article-5.jpg'
            ],
        ];
    }
}
