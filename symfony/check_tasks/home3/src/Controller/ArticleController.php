<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Homework\ArticleProvider;
use App\Homework\ArticleContentProvider;

class ArticleController extends AbstractController
{
    private $words = [
        'cat',
        'car',
        'php',
        'symfony',
        'go',
        'dog',
        'hot',
        'laravel',
        'alligator',
        'bear',
    ];
    
    /**
     * @Route("/", name="homepage")
     *
     * @param ArticleProvider $articles
     * @return Response
     */
    public function homepage(ArticleProvider $articles): Response
    {
        return $this->render('articles/homepage.html.twig', ['articles' => $articles->articles()]);
    }
    
    /**
     * @Route("/articles/{slug}", name="detail")
     *
     * @param                                      $slug
     * @param ArticleProvider                      $articles
     * @param ArticleContentProvider               $contentProvider
     * @return Response
     * @throws \Exception
     */
    public function detail($slug, ArticleProvider $articles, ArticleContentProvider $contentProvider): Response
    {
        $word = null;
        $wordsCount = 0;
        
        if (random_int(0, 100) >= 70) {
            $word = $this->words[random_int(0, 9)];
            $wordsCount = random_int(1, 20);
        }

        $content = $contentProvider->get(random_int(2, 10), $word, $wordsCount);
        
        $article = $articles->article();
        
        return $this->render('articles/detail.html.twig', [
            'article' => $article,
            'content' => $content,
        ]);
    }
}
