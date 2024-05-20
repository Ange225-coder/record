<?php

    namespace App\Security;

    use App\Entity\Tables\Users\Users;
    use Symfony\Component\HttpFoundation\RedirectResponse;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
    use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
    use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
    use Symfony\Component\Security\Http\Authenticator\AbstractLoginFormAuthenticator;
    use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
    use Symfony\Component\Security\Http\Authenticator\Passport\Badge\RememberMeBadge;
    use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
    use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
    use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
    use Symfony\Component\Security\Http\SecurityRequestAttributes;
    use Symfony\Component\Security\Http\Util\TargetPathTrait;
    use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
    use Doctrine\ORM\EntityManagerInterface;

    class UsersAuthenticator extends AbstractLoginFormAuthenticator
    {
        use TargetPathTrait;

        public const LOGIN_ROUTE = 'user_login';

        private UserPasswordHasherInterface $passwordHasher;
        private EntityManagerInterface $entityManager;

        public function __construct(private UrlGeneratorInterface $urlGenerator, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager)
        {
            $this->passwordHasher = $passwordHasher;
            $this->entityManager = $entityManager;
        }

        public function authenticate(Request $request): Passport
        {
            $email = $request->getPayload()->getString('email');
            $plainPass = $request->getPayload()->getString('password');

            $user = $this->entityManager->getRepository(Users::class)->findOneBy([
                'email' => $email,
            ]);

            if(!$user) {
                throw new CustomUserMessageAuthenticationException('Nom d\'utilisateur ou mot de passe incorrect');
            }

            if(!$this->passwordHasher->isPasswordValid($user, $plainPass)) {
                throw new CustomUserMessageAuthenticationException('Nom d\'utilisateur ou mot de passe incorrect');
            }

            $request->getSession()->set(SecurityRequestAttributes::LAST_USERNAME, $email);

            return new Passport(
                new UserBadge($email),
                new PasswordCredentials($request->getPayload()->getString('password')),
                [
                    new CsrfTokenBadge('authenticate', $request->getPayload()->getString('_csrf_token')),
                    new RememberMeBadge(),
                ]
            );
        }

        public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
        {
            if ($targetPath = $this->getTargetPath($request->getSession(), $firewallName)) {
                return new RedirectResponse($targetPath);
            }

            // For example:
            return new RedirectResponse($this->urlGenerator->generate('home'));
            //throw new \Exception('TODO: provide a valid redirect inside '.__FILE__);
        }

        protected function getLoginUrl(Request $request): string
        {
            return $this->urlGenerator->generate(self::LOGIN_ROUTE);
        }
    }
