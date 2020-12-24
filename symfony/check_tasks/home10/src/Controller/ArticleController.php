<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    private static $maxLastComments = 3;

    /**
     * @Route("/", name="app_articles_index")
     * @param ArticleRepository $articleRepository
     * @param CommentRepository $commentRepository
     * @return Response
     */
    public function homepage(ArticleRepository $articleRepository, CommentRepository $commentRepository)
    {
        return $this->render('articles/index.html.twig', [
            'articles' => $articleRepository->findLatestPublished(),
            'lastComments' => $commentRepository->getLastComments(self::$maxLastComments),
        ]);
    }

    /**
     * @Route("/articles/{slug}", name="app_articles_show")
     * @param Article $article
     * @return Response
     */
    public function show(Article $article)
    {
        return $this->render('articles/show.html.twig', ['article' => $article]);
    }

    /**
     * @Route("/articles/{slug}/vote/up", name="app_articles_vote_up", methods={"POST"})
     * @param Article $article
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function voteUp(Article $article, EntityManagerInterface $em)
    {
        $article->voteUp();
        $em->flush();
        return $this->json(['votes' => $article->getVoteCount()]);
    }

    /**
     * @Route("/articles/{slug}/vote/down", name="app_articles_vote_down", methods={"POST"})
     * @param Article $article
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function voteDown(Article $article, EntityManagerInterface $em)
    {
        $article->voteDown();
        $em->flush();
        return $this->json(['votes' => $article->getVoteCount()]);
    }

}
