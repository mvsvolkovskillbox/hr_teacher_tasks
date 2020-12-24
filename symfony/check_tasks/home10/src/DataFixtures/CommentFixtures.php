<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Comment;
use App\Homework\CommentContentProviderInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CommentFixtures extends BaseFixtures implements DependentFixtureInterface
{
    private $commentContentProvider;

    public function __construct(CommentContentProviderInterface $commentContentProvider)
    {
        $this->commentContentProvider = $commentContentProvider;
    }

    public function loadData(ObjectManager $manager)
    {
        $this->createMany(Comment::class, 100, function(Comment $comment) {
            $comment
                ->setAuthorName($this->faker->name())
                ->setContent($this->commentContentProvider->getRandom())
                ->setCreatedAt($this->faker->dateTimeBetween('-100 days', '-1 day'))
                ->setArticle($this->getRandomReference(Article::class));

            if ($this->faker->boolean) {
                $comment->setDeletedAt($this->faker->dateTimeThisMonth);
            }
        });

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ArticleFixtures::class,
        ];
    }
}
