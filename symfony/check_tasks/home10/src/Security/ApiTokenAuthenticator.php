<?php

namespace App\Security;

use App\Repository\ApiTokenRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;

class ApiTokenAuthenticator extends AbstractGuardAuthenticator
{
    private $apiTokenRepository;

    public function __construct(ApiTokenRepository $apiTokenRepository)
    {
        $this->apiTokenRepository = $apiTokenRepository;
    }

    public function supports(Request $request)
    {
        return $request->headers->has('Authorization') && 0 === strpos($request->headers->get('Authorization'), 'Bearer ');
    }

    public function getCredentials(Request $request)
    {
        return [
            'token' => substr($request->headers->get('Authorization'), 7),
            'url' => $request->getPathInfo(),
            'pathName' => $request->get('_route'),
        ];
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $token = $this->apiTokenRepository->findOneBy(['token' =>$credentials['token']]);
        if (!$token) {
            throw new CustomUserMessageAuthenticationException('Token not find');
        }
        if ($token->isExpired()) {
            throw new CustomUserMessageAuthenticationException('Token expired');
        }

        $user = $token->getUser();
        if (!$user->getIsActive()) {
            throw new CustomUserMessageAuthenticationException('Go away boogeeman!');
        }

        $this->apiTokenRepository->log(
            $token,
            $credentials['pathName'],
            $credentials['url']
        );

        return $token->getUser();
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        return true;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        return new JsonResponse(['message' => $exception->getMessage()], 401);
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $providerKey)
    {
        // continue
    }

    public function start(Request $request, AuthenticationException $authException = null)
    {
        throw new \Exception("Never called");
    }

    public function supportsRememberMe()
    {
        return false;
    }
}
