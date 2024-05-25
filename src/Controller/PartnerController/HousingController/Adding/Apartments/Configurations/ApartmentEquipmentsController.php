<?php

    namespace App\Controller\PartnerController\HousingController\Adding\Apartments\Configurations;

    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Routing\Annotation\Route;

    class ApartmentEquipmentsController extends AbstractController
    {
        #[Route(path: '/partner/add/apartment-equipment', name: 'apartment_equipments')]
        public function apartmentEquipments(): Response
        {
            /**
             * verifie les valeurs de sessions et affiche les pour voir la valeur de housing area
             */

            return $this->render('partners/housing/adding/apartments/configurations/apartmentEquipments.html.twig');
        }
    }