<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Tag;
use App\Homework\ArticleContentProviderInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ArticleFixtures extends BaseFixtures implements DependentFixtureInterface
{
    private static $users = ['Флекс Абсолютович', 'Василий ПиЭйчПи', 'Хэтээмэль Цеэсесович'];
    private static $images = ['article-1.jpeg', 'article-2.jpeg', 'article-3.jpg'];
    private static $keywords = ['js', 'php', 'html', 'css', 'jquery'];
    private static $titles = [
        'Что делать, если надо верстать?',
        'До чего же я люблю PHP!',
        'Если пролил кофе на клавиатуру',
        'Искусство сражения с бутстрапом',
        'Покоряя пик Балмера',
    ];

    private $articleContentProvider;

    public function __construct(ArticleContentProviderInterface $articleContentProvider)
    {
        $this->articleContentProvider = $articleContentProvider;
    }

    public function loadData(ObjectManager $manager)
    {
        $this->createMany(Article::class, 10, function(Article $article) use ($manager) {
            $keywords = implode(',', $this->faker->randomElements(static::$keywords, $this->faker->numberBetween(1, 3)));

            $article
                ->setTitle($this->faker->randomElement(static::$titles))
                ->setDescription($this->faker->paragraph(1))
                ->setBody($this->articleContentProvider->getRandom())
                ->setAuthor($this->faker->randomElement(static::$users))
                ->setVoteCount($this->faker->numberBetween(0, 10))
                ->setKeywords($keywords)
                ->setImageFilename($this->faker->randomElement(static::$images));

            if ($this->faker->boolean(60)) {
                $article->setPublishedAt($this->faker->dateTimeBetween('-60 days', '-1 days'));
            }

            /** @var Tag $tags */
            $tags = [];
            for ($i = 0; $i < $this->faker->numberBetween(0, 5); $i++) {
                $tags[] = $this->getRandomReference(Tag::class);
            }

            foreach ($tags as $tag) {
                $article->addTag($tag);
            }
        });
    }

    public function getDependencies()
    {
        return [
            TagFixtures::class,
        ];
    }
}
