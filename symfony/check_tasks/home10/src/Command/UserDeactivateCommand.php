<?php

namespace App\Command;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class UserDeactivateCommand extends Command
{
    protected static $defaultName = 'app:user:deactivate';
    protected $userRepository;
    protected $em;

    public function __construct(UserRepository $userRepository, EntityManagerInterface $em)
    {
        $this->userRepository = $userRepository;
        $this->em = $em;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Deactivete user or revert user activity')
            ->addArgument('id', InputArgument::REQUIRED, 'User ID')
            ->addOption('reverse', null, InputOption::VALUE_NONE, 'Revert activity')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $userId = $input->getArgument('id');

        $user = $this->userRepository->findOneBy(['id' => $userId]);
        if (!$user) {
            throw new \Exception('User not find');
        }

        if ($input->getOption('reverse')) {
            $user->revertActivity();
        } else {
            $user->setUnActive();
        }
        $this->em->flush();

        $message = 'Пользователь с id=' . $userId . ' теперь ' . ($user->getIsActive() ? 'активен' : 'не активен');
        $io->success($message);
        return Command::SUCCESS;
    }
}
