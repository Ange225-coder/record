<?php

    namespace App\Controller\PartnerController\HousingController\Adding\Apartments\Configurations;

    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;

    class ApartmentInfosController extends AbstractController
    {
        #[Route(path: '/partner/add/apartment-info', name: 'apartment_info')]
        public function apartmentInfos(): Response
        {
            return $this->render('/partners/housing/adding/apartments/configurations/apartmentInfo.html.twig');
        }
    }