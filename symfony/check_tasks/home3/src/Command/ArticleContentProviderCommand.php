<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Homework\ArticleContentProviderInterface;

class ArticleContentProviderCommand extends Command
{
    protected static $defaultName = 'app:article:content_provider';
    
    /**
     * @var ArticleContentProviderInterface
     */
    protected $articleContentProvider;

    public function __construct(string $name = null, ArticleContentProviderInterface $articleContentProvider)
    {
        parent::__construct($name);
        $this->articleContentProvider = $articleContentProvider;
        
    }
    
    protected function configure()
    {
        $this
            ->setDescription('Результат его работы ArticleContentProviderInterface')
            ->addArgument('paragraphs', InputArgument::REQUIRED, 'Количество параграфов')
            ->addArgument('word', InputArgument::OPTIONAL, 'Слово для вставки')
            ->addArgument('wordsCount', InputArgument::OPTIONAL, 'Количество вставок')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        
        $word = $input->getArgument('word') ? $input->getArgument('word') : null;
        $wordsCount = $input->getArgument('wordsCount') ? $input->getArgument('wordsCount') : 0;

        $result = $this->articleContentProvider->get($input->getArgument('paragraphs'), $word, $wordsCount);
        
        $io->note(sprintf('You passed an argument: %s', $result));

        return Command::SUCCESS;
    }
}
