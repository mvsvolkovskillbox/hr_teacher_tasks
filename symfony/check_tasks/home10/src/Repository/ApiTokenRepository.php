<?php

namespace App\Repository;

use App\Entity\ApiToken;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;

/**
 * @method ApiToken|null find($id, $lockMode = null, $lockVersion = null)
 * @method ApiToken|null findOneBy(array $criteria, array $orderBy = null)
 * @method ApiToken[]    findAll()
 * @method ApiToken[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ApiTokenRepository extends ServiceEntityRepository
{
    private $logger;

    public function __construct(ManagerRegistry $registry, LoggerInterface $logger)
    {
        $this->logger = $logger;
        parent::__construct($registry, ApiToken::class);
    }

    public function log(ApiToken $token, string $pathName, string $url)
    {
        $user = $token->getUser();
        $tokensList = implode(
            ' / ',
            $user->getApiTokens()->map(function ($item) {
                return $item->getToken();
            })->toArray()
        );

        $message = sprintf(
            'Авторизация пользователя %s с токенами %s по маршруту %s url %s',
            $user->getEmail(),
            $tokensList,
            $pathName,
            $url
        );
        $this->logger->info($message);
    }
}
