<?php

    namespace App\Controller\PartnerController\HousingController\Adding\Apartments;

    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;
    use App\Forms\Types\Partners\Housing\Adding\Apartments\ApartmentAlreadyRegisteredTypes;
    use App\Forms\Fields\Partners\Housing\Adding\Apartments\ApartmentAlreadyRegisteredFields;

    class ApartmentAlreadyRegisteredController extends AbstractController
    {
        #[Route(path: '/partner/add/apartment-already-registered', name: 'apartment_already_registered')]
        public function apartmentAlreadyRegistered(): Response
        {
            $apartmentAlreadyRegisteredFields = new ApartmentAlreadyRegisteredFields();

            $apartmentAlreadyRegisteredTypes = $this->createForm(ApartmentAlreadyRegisteredTypes::class, $apartmentAlreadyRegisteredFields);

            return $this->render('partners/housing/adding/apartments/apartmentAlreadyRegistered.html.twig', [
                'alreadyRegisteredForm' => $apartmentAlreadyRegisteredTypes->createView(),
            ]);
        }
    }