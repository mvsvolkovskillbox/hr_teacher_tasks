<?php

namespace App\Controller\Api;

use App\Homework\ArticleContentProviderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiArticleController extends AbstractController
{
    /**
     * @Route("/api/v1/article_content", name="app_json_api")
     * @param Request $request
     * @param ArticleContentProviderInterface $articleContentProvider
     * @return Response
     */
    public function articleContentGenerate(Request $request, ArticleContentProviderInterface $articleContentProvider)
    {
        $params = json_decode($request->getContent(), true);
         $result = $articleContentProvider->get($params['paragraphs'], $params['word'], $params['wordCount']);
        return new JsonResponse(['text' => $result]);
    }
}
