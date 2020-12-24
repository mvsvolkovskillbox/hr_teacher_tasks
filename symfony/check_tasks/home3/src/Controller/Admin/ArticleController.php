<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Homework\ArticleContentProvider;

class ArticleController extends AbstractController
{
    /**
     * @Route("/admin/article_content", name="admin_article_content")
     *
     * @param Request $request
     * @return Response
     */
    public function adminArticleContent(Request $request, ArticleContentProvider $contentProvider): Response
    {
        $content = '';
        
        if ($request->query->get('paragraphs')) {
            $content = $contentProvider->get($request->query->get('paragraphs'), $request->query->get('word') ?? null, $request->query->get('wordsCount') ?? 0);
        }

        return $this->render('articles/article_content.html.twig', [
            'content' => $content
        ]);
    }
}
