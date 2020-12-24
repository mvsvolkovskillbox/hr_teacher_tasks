<?php

namespace App\Homework;

class ArticleProvider
{
    public function articles(): array
    {
        return [
            [
                'title' => 'Что делать, если надо верстать?',
                'slug' => 'chto_delat_esli_nado_verstat',
                'image' => 'article-2.jpeg',
            ],
            [
                'title' => 'Facebook ест твои данные',
                'slug' => 'facebook_est_tvoi_dannye',
                'image' => 'article-1.jpeg',
            ],
            [
                'title' => 'Когда пролил кофе на клавиатуру',
                'slug' => 'kogda_prolil_kofe_na_klaviaturu',
                'image' => 'article-3.jpg',
            ]
        ];
    }

    public function article(string $slug): ?array
    {
        return array_reduce($this->articles(), function($acc, $item) use ($slug) {
            return $item['slug'] == $slug ? $item : $acc;
        }, null);
    }
}
