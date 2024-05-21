<?php

    namespace App\Controller\UsersController\RegistrationController;

    use App\Entity\Tables\Users\Users;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Form\FormError;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Routing\Annotation\Route;
    use App\Forms\Types\Users\Registration\RegistrationTypesEmailForm;
    use App\Forms\Fields\Users\Registration\RegistrationFieldsEmailForm;
    use Doctrine\ORM\EntityManagerInterface;
    use Symfony\Component\HttpFoundation\Session\Session;

    class RegistrationEmailFormController extends AbstractController
    {
        #[Route(path: '/sign-up/email', name: 'sign_up_email_form')]
        public function registrationEmailForm(Request $request, EntityManagerInterface $entityManager, Session $session): Response
        {
            $emailFormFields = new RegistrationFieldsEmailForm();

            $emailFormTypes = $this->createForm(RegistrationTypesEmailForm::class, $emailFormFields);

            $emailFormTypes->handleRequest($request);

            if($emailFormTypes->isSubmitted() && $emailFormTypes->isValid()) {

                $existingEmail = $entityManager->getRepository(Users::class)->findOneBy([
                    'email' => $emailFormFields->getEmail(),
                ]);

                if($existingEmail) {
                    $emailFormTypes->get('email')->addError(new FormError('L\'e-mail n\'est pas valide ou a déjà été pris'));
                }
                else {
                    $session->set('user_email', $emailFormFields->getEmail());

                    return $this->redirectToRoute('sign_up_pwd_form');
                }
            }

            return $this->render('users/registration/emailForm.html.twig', [
                'emailForm' => $emailFormTypes->createView(),
            ]);
        }
    }