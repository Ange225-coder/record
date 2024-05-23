<?php

    namespace App\Controller\PartnerController\HousingController\Adding\Apartments\Confirmation;

    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

    class AnApartmentConfirmationController extends AbstractController
    {
        #[Route(path: '/partner/adding/an_apartment/confirmation', name: 'an_apartment_confirmation')]
        public function anApartmentConfirmation(): Response
        {
            return $this->render('partners/housing/adding/apartments/confirmation/anApartmentConfirmation.html.twig');
        }
    }