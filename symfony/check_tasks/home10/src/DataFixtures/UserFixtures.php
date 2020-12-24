<?php

namespace App\DataFixtures;

use App\Entity\ApiToken;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends BaseFixtures
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function loadData(ObjectManager $manager)
    {
        $this->create(User::class, function (User $user) use ($manager) {
            $user
                ->setEmail('admin@symfony.skillbox')
                ->setFirstName('Администратор')
                ->setPassword($this->passwordEncoder->encodePassword($user, '123456'))
                ->setRoles(['ROLE_ADMIN'])
                ->setIsActive(1)
            ;
            $manager->persist(new ApiToken($user));
        });

        $this->create(User::class, function (User $user) use ($manager) {
            $user
                ->setEmail('api@symfony.skillbox')
                ->setFirstName('API')
                ->setPassword($this->passwordEncoder->encodePassword($user, '123456'))
                ->setRoles(['ROLE_API'])
                ->setIsActive(1)
            ;

            for ($i = 0; $i < 3; $i++) {
                $manager->persist(new ApiToken($user));
            }
        });

        $this->createMany(User::class, 10, function(User $user) use ($manager) {
            $user
                ->setEmail($this->faker->email)
                ->setFirstName($this->faker->firstName)
                ->setPassword($this->passwordEncoder->encodePassword($user, '123456'))
            ;

            if ($this->faker->boolean(70)) {
                $user->setIsActive(0);
            } else {
                $user->setIsActive(1);
            }
            $manager->persist(new ApiToken($user));
        });
    }
}
