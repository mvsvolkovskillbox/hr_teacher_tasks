<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Homework\ArticleProvider;
use App\Homework\ArticleContentProvider;

class ArticleController extends AbstractController
{
    /**
     * @Route("/api/v1/article_content/", name="api_article_content", methods={"GET"})
     *
     * @param ArticleProvider $articles
     * @param ArticleContentProvider $contentProvider
     * @return Response
     */
    public function apiArticleContent(Request $request, ArticleProvider $articles, ArticleContentProvider $contentProvider): Response
    {
        $arguments = \json_decode($request->getContent());
        $text = $contentProvider->get($arguments->paragraphs, $arguments->word ?? null, $arguments->wordCount ?? 0);
        
        return new JsonResponse(['text' => $text]);
    }
}
