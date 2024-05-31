<?php

    namespace App\Controller\PartnerController\HousingController\Adding\Apartments\GeneralInfos;

    use App\Forms\Fields\Partners\Housing\Adding\Apartments\GeneralInfos\ApartmentPlaceFields;
    use App\Forms\Types\Partners\Housing\Adding\Apartments\GeneralInfos\ApartmentPlaceTypes;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Session\Session;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Component\Security\Http\Attribute\IsGranted;

    class ApartmentPlaceController extends AbstractController
    {
        #[Route(path: '/partner/add/apartment-place', name: 'apartment_place')]
        #[IsGranted('ROLE_PARTNER')]
        public function apartmentPlace(Request $request, Session $session): Response
        {
            $apartmentPlaceFields = new ApartmentPlaceFields();

            $apartmentPlaceTypes = $this->createForm(ApartmentPlaceTypes::class, $apartmentPlaceFields);

            $apartmentPlaceTypes->handleRequest($request);

            if($apartmentPlaceTypes->isSubmitted() && $apartmentPlaceTypes->isValid()) {

                $session->set('apartment_country', $apartmentPlaceFields->getCountry());
                $session->set('apartment_address', $apartmentPlaceFields->getAddress());

                if($apartmentPlaceFields->getPostalCode() !== null) {
                    $session->set('apartment_postalCode', $apartmentPlaceFields->getPostalCode());
                }
                else {
                    $session->set('apartment_postalCode', null);
                }

                $session->set('apartment_town', $apartmentPlaceFields->getTown());

                return $this->redirectToRoute('apartment_map');
            }

            return $this->render('partners/housing/adding/apartments/generalInfos/apartmentPlace.html.twig', [
                'apartmentPlaceForm' => $apartmentPlaceTypes->createView(),
            ]);
        }
    }