<?php

    namespace App\Controller\PartnerController\RegistrationController;

    use App\Entity\Tables\Partners\Partner;
    use Symfony\Component\Form\FormError;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
    use Symfony\Component\HttpFoundation\Session\Session;
    use Doctrine\ORM\EntityManagerInterface;
    use App\Forms\Fields\Partners\Registration\RegistrationPwdFields;
    use App\Forms\Types\Partners\Registration\RegistrationPwdTypes;
    use App\Security\PartnersAuthenticator;
    use Symfony\Component\Security\Core\Exception\AuthenticationException;
    use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
    use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

    class RegistrationPartnerPwdFormController extends AbstractController
    {
        #[Route(path: '/partner/registration/pwd', name: 'partner_registration_pwd')]
        public function registrationPartnerPwdForm(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher, Session $session, UserAuthenticatorInterface $authenticator, PartnersAuthenticator $partnersAuthenticator): Response
        {
            //datas which will entered in database
            $email = $session->get('partner_email');
            $firstName = $session->get('partner_fist_name');
            $lastName = $session->get('partner_last_name');
            $contact = $session->get('partner_contact');

            $registrationPwdFields = new RegistrationPwdFields();

            $partnerEntity = new Partner();

            $registrationPwdTypes = $this->createForm(RegistrationPwdTypes::class, $registrationPwdFields);

            $registrationPwdTypes->handleRequest($request);


            if($registrationPwdTypes->isSubmitted() && $registrationPwdTypes->isValid()) {

                if($registrationPwdFields->getPassword() === $registrationPwdFields->getConfirmPwd()) {
                    $partnerEntity->setEmail($email);
                    $partnerEntity->setFirstName($firstName);
                    $partnerEntity->setLastName($lastName);
                    $partnerEntity->setContact($contact);
                    $partnerEntity->setPassword($passwordHasher->hashPassword($partnerEntity, $registrationPwdFields->getPassword()));

                    $entityManager->persist($partnerEntity);
                    $entityManager->flush();

                    //authenticate new partner here
                    try {
                        $authenticator->authenticateUser($partnerEntity, $partnersAuthenticator, $request);

                        return $this->redirectToRoute('partner_housing');
                    }
                    catch (CustomUserMessageAuthenticationException $e) {
                        $this->addFlash('authentication_failed', $e->getMessage());

                        return $this->redirectToRoute('partner_registration_pwd');
                    }
                    catch (AuthenticationException) {
                        $this->addFlash('authentication_error', 'Une erreur est survenue');

                        return $this->redirectToRoute('partner_registration_pwd');
                    }

                }
                else {
                    $registrationPwdTypes->get('confirmPwd')->addError(new FormError('Les mots de passe ne sont pas identique, veuillez réessayer.'));
                }
            }

            return $this->render('partners/registration/savePwd.html.twig', [
                'pwdForm' => $registrationPwdTypes->createView(),
            ]);
        }
    }