<?php

    namespace App\Controller\PartnerController\AuthController;

    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Attribute\Route;
    use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

    class LoginController extends AbstractController
    {
        #[Route(path: '/partner/login', name: 'partner_login')]
        public function login(AuthenticationUtils $authenticationUtils): Response
        {
             if ($this->getUser()) {
                 return $this->redirectToRoute('partner_home');
             }

            // get the login error if there is one
            $error = $authenticationUtils->getLastAuthenticationError();

            // last username entered by the user
            $lastUsername = $authenticationUtils->getLastUsername();

            return $this->render('partners/auth/login.html.twig', [
                'last_username' => $lastUsername,
                'error' => $error,
            ]);
        }

        #[Route(path: '/partner/logout', name: 'partner_logout')]
        public function logout(): void
        {
            throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
        }
    }
