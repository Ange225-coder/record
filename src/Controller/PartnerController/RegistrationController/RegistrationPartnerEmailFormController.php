<?php

    namespace App\Controller\PartnerController\RegistrationController;

    use App\Entity\Tables\Partners\Partner;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Form\FormError;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\RequestStack;
    //use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Routing\Annotation\Route;
    use App\Forms\Fields\Partners\Registration\RegistrationEmailFields;
    use App\Forms\Types\Partners\Registration\RegistrationEmailTypes;
    use Doctrine\ORM\EntityManagerInterface;
    //use Symfony\Component\HttpFoundation\Session\SessionInterface;

    class RegistrationPartnerEmailFormController extends AbstractController
    {
        private RequestStack $requestStack;
        private EntityManagerInterface $entityManager;

        public function __construct(RequestStack $requestStack, EntityManagerInterface $entityManager)
        {
            $this->requestStack = $requestStack;
            $this->entityManager = $entityManager;
        }

        #[Route(path: '/partner/registration/email', name: 'partner_registration_email')]
        public function partnersRegistrationEmailForm(): Response
        {
            $registrationEmailFields = new RegistrationEmailFields();

            $registrationEmailTypes = $this->createForm(RegistrationEmailTypes::class, $registrationEmailFields);

            $request = $this->requestStack->getCurrentRequest();
            $registrationEmailTypes->handleRequest($request);

            if($registrationEmailTypes->isSubmitted() && $registrationEmailTypes->isValid()) {

                $existingEmail = $this->entityManager->getRepository(Partner::class)->findOneBy([
                    'email' => $registrationEmailFields->getEmail(),
                ]);

                if($existingEmail) {
                    $registrationEmailTypes->get('email')->addError(new FormError('Vous avez déjà un compte associé à cet email : ' .$registrationEmailFields->getEmail(). '. Vous pouvez vous connecter directement'));
                }
                else {
                    $session = $this->requestStack->getCurrentRequest()->getSession();
                    $session->set('partner_email', $registrationEmailFields->getEmail());

                    return $this->redirectToRoute('partner_registration_contact_details');
                }
            }

            return $this->render('partners/registration/registrationEmailForm.html.twig', [
                'emailForm' => $registrationEmailTypes->createView(),
            ]);
        }
    }