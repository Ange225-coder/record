<?php

    namespace App\Controller\PartnerController\HousingController\Adding\Apartments\GeneralInfos;

    use App\Forms\Fields\Partners\Housing\Adding\Apartments\GeneralInfos\ApartmentAlreadyRegisteredFields;
    use App\Forms\Types\Partners\Housing\Adding\Apartments\GeneralInfos\ApartmentAlreadyRegisteredTypes;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Session\Session;
    use Symfony\Component\Routing\Annotation\Route;

    class ApartmentAlreadyRegisteredController extends AbstractController
    {
        #[Route(path: '/partner/add/apartment-already-registered', name: 'apartment_already_registered')]
        public function apartmentAlreadyRegistered(Request $request, Session $session): Response
        {
            $apartmentAlreadyRegisteredFields = new ApartmentAlreadyRegisteredFields();

            $apartmentAlreadyRegisteredTypes = $this->createForm(ApartmentAlreadyRegisteredTypes::class, $apartmentAlreadyRegisteredFields);

            $apartmentAlreadyRegisteredTypes->handleRequest($request);

            if($apartmentAlreadyRegisteredTypes->isSubmitted() && $apartmentAlreadyRegisteredTypes->isValid()) {

                $session->set('apartment_already_registered', $apartmentAlreadyRegisteredFields->getWhereApartmentIsAlreadyRegistered());

                return $this->redirectToRoute('apartment_name');
            }

            return $this->render('partners/housing/adding/apartments/generalInfos/apartmentAlreadyRegistered.html.twig', [
                'alreadyRegisteredForm' => $apartmentAlreadyRegisteredTypes->createView(),
            ]);
        }
    }