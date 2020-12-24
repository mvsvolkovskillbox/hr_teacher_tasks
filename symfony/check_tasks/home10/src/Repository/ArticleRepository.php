<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    /**
     * @return Article[] Returns an array of Article objects
     */
    public function findLatestPublished()
    {
        return $this
            ->published($this->latest())
            ->leftJoin('a.comments', 'c')
            ->addSelect('c')
            ->leftJoin('a.tags', 't')
            ->addSelect('t')
            ->getQuery()
            ->getResult();
    }

    private function published(QueryBuilder $qb = null)
    {
        return $this->getOrCreateQueryBuilder($qb)->andWhere('a.publishedAt IS NOT NULL');
    }

    private function latest(QueryBuilder $qb = null)
    {
        return $this->getOrCreateQueryBuilder($qb)->orderBy('a.publishedAt', 'DESC');
    }

    /**
     * @param QueryBuilder $qb
     * @return QueryBuilder
     */
    private function getOrCreateQueryBuilder(QueryBuilder $qb = null): QueryBuilder
    {
        return $qb ?? $this->createQueryBuilder('a');
    }

    private function selectAttachedComments(QueryBuilder $qb): QueryBuilder
    {
        return $qb
            ->innerJoin('a.comments', 'c')
            ->addSelect('c');
    }
}
