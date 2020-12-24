<?php

namespace App\Command;

use App\Homework\ArticleContentProviderInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ArticleContentProviderCommand extends Command
{
    protected static $defaultName = 'app:article:content_provider';
    protected $articleContentProvider;

    public function __construct(ArticleContentProviderInterface $articleContentProvider)
    {
        $this->articleContentProvider = $articleContentProvider;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Консольная команда для генерации контента')
            ->addArgument('paragraphs', InputArgument::REQUIRED, 'Количество параграфов')
            ->addArgument('word', InputArgument::OPTIONAL, 'Слово для вставки', $default = null)
            ->addArgument('wordCount', InputArgument::OPTIONAL, 'Количество вставок', $default = 0)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $paragraphs = (int) $input->getArgument('paragraphs');
        $word = $input->getArgument('word');
        $wordCount = (int) $input->getArgument('wordCount');

        if ($word && !$wordCount) {
            throw new \Exception('Не указано число повторений');
        }

        $result = $this->articleContentProvider->get($paragraphs, $word, $wordCount);

        $io->success($result);

        return Command::SUCCESS;
    }
}
