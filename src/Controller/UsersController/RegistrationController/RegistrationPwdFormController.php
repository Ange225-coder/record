<?php

    namespace App\Controller\UsersController\RegistrationController;

    use App\Entity\Tables\Users\Users;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Form\FormError;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Request;
    use App\Forms\Fields\Users\Registration\RegistrationFieldsPwdForm;
    use App\Forms\Types\Users\Registration\RegistrationTypesPwdForm;
    use Doctrine\ORM\EntityManagerInterface;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Component\HttpFoundation\Session\Session;
    use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
    use Symfony\Component\Security\Core\Exception\AuthenticationException;
    use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
    use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
    use App\Security\UsersAuthenticator;

    class RegistrationPwdFormController extends AbstractController
    {
        #[Route(path: '/sign-up/pwd', name: 'sign_up_pwd_form')]
        public function registrationPwdForm(Request $request, EntityManagerInterface $entityManager, Session $session, UserPasswordHasherInterface $passwordHasher, UserAuthenticatorInterface $authenticator, UsersAuthenticator $usersAuthenticator): Response
        {
            $email = $session->get('user_email');
            $userEntity = new Users();

            $pwdFormFields = new RegistrationFieldsPwdForm();

            $pwdFormTypes = $this->createForm(RegistrationTypesPwdForm::class, $pwdFormFields);

            $pwdFormTypes->handleRequest($request);

            if($pwdFormTypes->isSubmitted() && $pwdFormTypes->isValid()) {

                if($pwdFormFields->getPassword() === $pwdFormFields->getConfirmPwd()) {
                    $userEntity->setEmail($email);
                    $userEntity->setPassword($passwordHasher->hashPassword($userEntity, $pwdFormFields->getPassword()));

                    $entityManager->persist($userEntity);
                    $entityManager->flush();
                }
                else {
                    $pwdFormTypes->get('confirmPwd')->addError(new FormError('Les mot de passe ne sont pas identique, Veuillez réessayer.'));
                }

                //authenticate user here
                try {
                    $authenticator->authenticateUser($userEntity, $usersAuthenticator, $request);

                    return $this->redirectToRoute('home');
                }
                catch (CustomUserMessageAuthenticationException $e) {
                    $this->addFlash('authentication_failed', $e->getMessage());

                    return $this->redirectToRoute('sign_up_pwd_form');
                }

                catch (AuthenticationException $e) {
                    $this->addFlash('error_authentication', 'Une erreur est survenue');

                    return $this->redirectToRoute('sign_up_pwd_form');
                }
            }

            return $this->render('users/registration/pwdForm.html.twig', [
                'pwdForm' => $pwdFormTypes->createView(),
                'email' => $email,
            ]);
        }
    }