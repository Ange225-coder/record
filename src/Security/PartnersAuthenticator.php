<?php

    namespace App\Security;

    use App\Entity\Tables\Partners\Partner;
    use Symfony\Component\HttpFoundation\RedirectResponse;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
    use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
    use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
    use Symfony\Component\Security\Http\Authenticator\AbstractLoginFormAuthenticator;
    use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
    use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
    use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
    use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
    use Symfony\Component\Security\Http\SecurityRequestAttributes;
    use Symfony\Component\Security\Http\Util\TargetPathTrait;
    use Doctrine\ORM\EntityManagerInterface;
    use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

    class PartnersAuthenticator extends AbstractLoginFormAuthenticator
    {
        use TargetPathTrait;

        public const LOGIN_ROUTE = 'partner_login';

        private EntityManagerInterface $entityManager;
        private UserPasswordHasherInterface $passwordHasher;

        public function __construct(private UrlGeneratorInterface $urlGenerator, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher)
        {
            $this->entityManager = $entityManager;
            $this->passwordHasher = $passwordHasher;
        }

        public function authenticate(Request $request): Passport
        {
            $email = $request->getPayload()->getString('email');
            $plainPass = $request->getPayload()->getString('password');

            $partner = $this->entityManager->getRepository(Partner::class)->findOneBy([
                'email' => $email,
            ]);

            if(!$partner) {
                throw new CustomUserMessageAuthenticationException('Nous n\'avons trouvé aucun compte associé à ce nom d\'utilisateur');
            }

            if(!$this->passwordHasher->isPasswordValid($partner, $plainPass)) {
                throw new CustomUserMessageAuthenticationException('L\'adresse email et le mot de passe que vous avez indiqué ne correspondent pas');
            }

            $request->getSession()->set(SecurityRequestAttributes::LAST_USERNAME, $email);

            return new Passport(
                new UserBadge($email),
                new PasswordCredentials($request->getPayload()->getString('password')),
                [
                    new CsrfTokenBadge('authenticate', $request->getPayload()->getString('_csrf_token')),            ]
            );
        }

        public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
        {
            if ($targetPath = $this->getTargetPath($request->getSession(), $firewallName)) {
                return new RedirectResponse($targetPath);
            }

            // For example:
            return new RedirectResponse($this->urlGenerator->generate('partner_home'));
            //throw new \Exception('TODO: provide a valid redirect inside '.__FILE__);
        }

        protected function getLoginUrl(Request $request): string
        {
            return $this->urlGenerator->generate(self::LOGIN_ROUTE);
        }
    }
