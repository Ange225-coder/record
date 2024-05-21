<?php

    namespace App\Controller\PartnerController\RegistrationController;

    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;
    use App\Forms\Fields\Partners\Registration\RegistrationContactDetailsFields;
    use App\Forms\Types\Partners\Registration\RegistrationContactDetailsTypes;
    use Symfony\Component\HttpFoundation\Session\Session;

    class RegistrationPartnerContactDetailsFormController extends AbstractController
    {
        #[Route(path: '/partner/registration/contact-details', name: 'partner_registration_contact_details')]
        public function partnerRegistrationContactDetailsForm(Request $request, Session $session): Response
        {
            $registrationContactDetailsFields = new RegistrationContactDetailsFields();

            $registrationContactDetailTypes = $this->createForm(RegistrationContactDetailsTypes::class, $registrationContactDetailsFields);

            $registrationContactDetailTypes->handleRequest($request);

            if($registrationContactDetailTypes->isSubmitted() && $registrationContactDetailTypes->isValid()) {

                $session->set('partner_fist_name', $registrationContactDetailsFields->getFirstName());
                $session->set('partner_last_name', $registrationContactDetailsFields->getLastName());
                $session->set('partner_contact', $registrationContactDetailsFields->getContact());

                return $this->redirectToRoute('partner_registration_pwd');
            }

            return $this->render('partners/registration/saveContactDetail.html.twig', [
                'contactDetailsForm' => $registrationContactDetailTypes->createView(),
            ]);
        }
    }